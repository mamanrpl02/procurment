<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RField;
use App\Models\RTable;
use App\Models\Workflow;
use App\Models\WorkflowAction;
use App\Models\WorkflowCondition;
use App\Models\WorkflowGroup;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class WorkflowController extends Controller
{
    public function index(Request $request)
    {
        $query = Workflow::with(['table', 'workflowGroup']);

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where('workflow_name', 'like', "%{$search}%");
        }

        if ($request->filled('table_id')) {
            $query->where('sys_id_r_tables', $request->table_id);
        }

        if ($request->filled('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        $workflows = $query
            ->orderBy('sys_id_r_workflow_groups')
            ->orderBy('sort_order')
            ->paginate(10)
            ->withQueryString();

        return view('workflows.index', [
            'workflows' => $workflows,
            'tables' => RTable::where('is_active', true)
                ->orderBy('table_label')
                ->get(),
        ]);
    }

    public function create()
    {
        return view('workflows.create', [
            'tables' => RTable::where('is_active', true)
                ->orderBy('table_label')
                ->get(),
            'workflow' => null,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateWorkflow($request);

        DB::transaction(function () use ($validated) {
            $sortOrder = Workflow::where(
                'sys_id_r_workflow_groups',
                $validated['sys_id_r_workflow_groups']
            )->max('sort_order') ?? 0;

            $workflow = Workflow::create([
                'sys_id_r_tables' => $validated['sys_id_r_tables'],
                'sys_id_r_workflow_groups' => $validated['sys_id_r_workflow_groups'],
                'workflow_name' => $validated['workflow_name'],
                'workflow_type' => 'set_value',
                'description' => $validated['description'] ?? null,
                'sort_order' => $sortOrder + 1,
                'is_active' => $validated['is_active'],
            ]);

            $this->saveRules($workflow, $validated);
        });

        return redirect()->route('workflows.index')
            ->with('success', 'Workflow berhasil dibuat.');
    }

    public function edit(Workflow $workflow)
    {
        $workflow->load(['conditions', 'actions']);

        return view('workflows.edit', [
            'workflow' => $workflow,
            'tables' => RTable::where('is_active', true)
                ->orderBy('table_label')
                ->get(),
        ]);
    }

    public function update(Request $request, Workflow $workflow)
    {
        $validated = $this->validateWorkflow($request);

        DB::transaction(function () use ($workflow, $validated) {
            $workflow->update([
                'sys_id_r_tables' => $validated['sys_id_r_tables'],
                'sys_id_r_workflow_groups' => $validated['sys_id_r_workflow_groups'],
                'workflow_name' => $validated['workflow_name'],
                'workflow_type' => 'set_value',
                'description' => $validated['description'] ?? null,
                'is_active' => $validated['is_active'],
            ]);

            // Ganti kondisi dan aksi dengan konfigurasi terbaru.
            $workflow->conditions()->delete();
            $workflow->actions()->delete();

            $this->saveRules($workflow, $validated);
        });

        return redirect()->route('workflows.index')
            ->with('success', 'Workflow berhasil diperbarui.');
    }

    public function destroy(Workflow $workflow)
    {
        $workflow->delete();

        return redirect()->route('workflows.index')
            ->with('success', 'Workflow berhasil dihapus.');
    }

    /**
     * Mengambil grouping dan field berdasarkan tabel yang dipilih.
     */
    public function options(RTable $table)
    {
        abort_unless($table->is_active, 404);

        return response()->json([
            'groups' => WorkflowGroup::where(
                'table_name',
                $table->table_name
            )
                ->where('is_active', true)
                ->orderBy('group_name')
                ->get()
                ->map(fn ($group) => [
                    'id' => $group->getKey(),
                    'name' => $group->group_name,
                ]),

            'condition_fields' => $this->fieldOptions($table, 'condition'),

            'action_fields' => $this->fieldOptions($table, 'action'),
        ]);
    }

    private function fieldOptions(RTable $table, string $purpose)
    {
        $query = RField::where(
            'sys_id_r_tables',
            $table->getKey()
        )->where('is_active', true);

        if ($purpose === 'condition') {
            $query->where('is_condition_allowed', true);
        } else {
            $query->where('is_action_allowed', true);
        }

        return $query->orderBy('field_label')
            ->get()
            ->map(fn ($field) => [
                'id' => $field->getKey(),
                'name' => $field->field_label,
                'type' => $field->field_type,
            ]);
    }

    /**
     * Validasi konfigurasi workflow dan kecocokan tabel, grouping,
     * condition fields, serta action fields.
     */
    private function validateWorkflow(Request $request): array
    {
        $validated = $request->validate([
            'sys_id_r_tables' => [
                'required',
                'integer',
                Rule::exists('r_tables', 'sys_id_r_tables')
                    ->where('is_active', true),
            ],
            'sys_id_r_workflow_groups' => [
                'required',
                'integer',
                Rule::exists('r_workflow_groups', 'sys_id_r_workflow_groups')
                    ->where('is_active', true),
            ],
            'workflow_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'required|boolean',

            'conditions' => 'nullable|array',
            'conditions.*.sys_id_r_fields' => 'required|integer|exists:r_fields,sys_id_r_fields',
            'conditions.*.operator' => [
                'required',
                Rule::in([
                    'equals',
                    'not_equals',
                    'greater_than',
                    'less_than',
                    'greater_than_or_equal',
                    'less_than_or_equal',
                    'is_empty',
                    'is_not_empty',
                ]),
            ],
            'conditions.*.condition_value' => 'nullable|string|max:1000',
            'conditions.*.logical_operator' => [
                'required',
                Rule::in(['AND', 'OR']),
            ],

            'actions' => 'required|array|min:1',
            'actions.*.sys_id_r_fields' => 'required|integer|exists:r_fields,sys_id_r_fields',
            'actions.*.action_value' => 'nullable|string|max:1000',
        ]);

        $table = RTable::findOrFail($validated['sys_id_r_tables']);

        $group = WorkflowGroup::findOrFail(
            $validated['sys_id_r_workflow_groups']
        );

        if ($group->table_name !== $table->table_name || !$group->is_active) {
            abort(422, 'Grouping Workflow tidak sesuai dengan tabel transaksi.');
        }

        foreach ($validated['conditions'] ?? [] as $condition) {
            $field = RField::findOrFail($condition['sys_id_r_fields']);

            if (
                (int) $field->sys_id_r_tables !== (int) $table->getKey()
                || !$field->is_active
                || !$field->is_condition_allowed
            ) {
                abort(422, 'Field kondisi tidak valid untuk tabel yang dipilih.');
            }

            if (in_array($condition['operator'], ['is_empty', 'is_not_empty'])) {
                continue;
            }

            if (!isset($condition['condition_value']) || $condition['condition_value'] === '') {
                abort(422, 'Nilai kondisi wajib diisi.');
            }
        }

        foreach ($validated['actions'] as $action) {
            $field = RField::findOrFail($action['sys_id_r_fields']);

            if (
                (int) $field->sys_id_r_tables !== (int) $table->getKey()
                || !$field->is_active
                || !$field->is_action_allowed
            ) {
                abort(422, 'Field tindakan tidak valid untuk tabel yang dipilih.');
            }

            if (!isset($action['action_value']) || $action['action_value'] === '') {
                abort(422, 'Nilai tindakan wajib diisi.');
            }
        }

        return $validated;
    }

    private function saveRules(Workflow $workflow, array $validated): void
    {
        foreach ($validated['conditions'] ?? [] as $condition) {
            WorkflowCondition::create([
                'sys_id_r_workflows' => $workflow->getKey(),
                'sys_id_r_fields' => $condition['sys_id_r_fields'],
                'operator' => $condition['operator'],
                'condition_value' => $condition['condition_value'] ?? null,
                'logical_operator' => $condition['logical_operator'],
            ]);
        }

        foreach ($validated['actions'] as $action) {
            WorkflowAction::create([
                'sys_id_r_workflows' => $workflow->getKey(),
                'sys_id_r_fields' => $action['sys_id_r_fields'],
                'action_type' => 'set_value',
                'field_state' => null,
                'action_value' => $action['action_value'],
            ]);
        }
    }

}

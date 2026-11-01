<?php

namespace App\Http\Controllers;

use App\Models\WorkflowGroup;
use Illuminate\Http\Request;
use App\Models\RTable;
use Illuminate\Validation\Rule;

class WorkflowGroupController extends Controller
{
    /**
     * Ambil daftar tabel yang aktif dari master r_tables.
     * Key   = nama tabel fisik
     * Value = label tabel untuk ditampilkan di UI
     */
    private function supportedTables()
    {
        return RTable::query()
            ->where('is_active', true)
            ->orderBy('table_label')
            ->pluck('table_label', 'table_name');
    }

    public function index(Request $request)
    {
        $query = WorkflowGroup::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('group_name', 'like', "%{$search}%")
                    ->orWhere('table_name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('table_name')) {
            $query->where('table_name', $request->table_name);
        }

        if ($request->filled('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        $workflowGroups = $query
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('workflow-groups.index', [
            'workflowGroups' => $workflowGroups,
            'supportedTables' => $this->supportedTables(),
        ]);
    }

    public function create()
    {
        return view('workflow-groups.create', [
            'supportedTables' => $this->supportedTables(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'group_name' => 'required|string|max:255',
            'table_name' => [
                'required',
                Rule::exists('r_tables', 'table_name')
                    ->where('is_active', true),
            ],
            'description' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        WorkflowGroup::create($validated);

        return redirect()
            ->route('workflow-groups.index')
            ->with('success', 'Grouping Workflow berhasil dibuat.');
    }

    public function edit(WorkflowGroup $workflowGroup)
    {
        return view('workflow-groups.edit', [
            'workflowGroup' => $workflowGroup,
            'supportedTables' => $this->supportedTables(),
        ]);
    }

    public function update(
        Request $request,
        WorkflowGroup $workflowGroup
    ) {
        $validated = $request->validate([
            'group_name' => 'required|string|max:255',
            'table_name' => [
                'required',
                Rule::exists('r_tables', 'table_name')
                    ->where('is_active', true),
            ],
            'description' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        $workflowGroup->update($validated);

        return redirect()
            ->route('workflow-groups.index')
            ->with('success', 'Grouping Workflow berhasil diperbarui.');
    }

    public function destroy(WorkflowGroup $workflowGroup)
    {
        // Nanti tambahkan pengecekan relasi workflow sebelum menghapus.
        $workflowGroup->delete();

        return redirect()
            ->route('workflow-groups.index')
            ->with('success', 'Grouping Workflow berhasil dihapus.');
    }
}
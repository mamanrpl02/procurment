<?php

namespace App\Http\Controllers;

use App\Models\RField;
use App\Models\RTable;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Schema;

class RFieldController extends Controller
{
    private function activeTables()
    {
        return RTable::where('is_active', true)
            ->orderBy('table_label')
            ->get();
    }

    private function fieldTypes(): array
    {
        return [
            'string' => 'Text',
            'text' => 'Long Text',
            'integer' => 'Integer',
            'decimal' => 'Decimal',
            'date' => 'Date',
            'boolean' => 'Boolean',
        ];
    }

    public function index(Request $request)
    {
        $query = RField::with('table');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('field_name', 'like', "%{$search}%")
                    ->orWhere('field_label', 'like', "%{$search}%");
            });
        }

        if ($request->filled('sys_id_r_tables')) {
            $query->where('sys_id_r_tables', $request->sys_id_r_tables);
        }

        if ($request->filled('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        return view('r-fields.index', [
            'fields' => $query->orderBy('field_label')
                ->paginate(10)->withQueryString(),
            'tables' => $this->activeTables(),
        ]);
    }

    public function create()
    {
        return view('r-fields.create', [
            'tables' => $this->activeTables(),
            'fieldTypes' => $this->fieldTypes(),
            'columnsByTable' => $this->columnsByTable(),
        ]);
    }

    private function columnsByTable(): array
    {
        $result = [];

        foreach ($this->activeTables() as $table) {
            if (Schema::hasTable($table->table_name)) {
                $result[$table->getKey()] =
                    Schema::getColumnListing($table->table_name);
            }
        }

        return $result;
    }

    private function validateField(Request $request, ?RField $field = null): array
    {
        $validated = $request->validate([
            'sys_id_r_tables' => [
                'required',
                Rule::exists('r_tables', 'sys_id_r_tables')
                    ->where('is_active', true),
            ],
            'field_name' => 'required|string|max:255',
            'field_label' => 'required|string|max:255',
            'field_type' => ['required', Rule::in(array_keys($this->fieldTypes()))],
            'is_condition_allowed' => 'required|boolean',
            'is_action_allowed' => 'required|boolean',
            'is_active' => 'required|boolean',
        ]);

        $table = RTable::findOrFail($validated['sys_id_r_tables']);

        if (!Schema::hasColumn($table->table_name, $validated['field_name'])) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'field_name' => 'Field tersebut tidak ditemukan di tabel fisik.',
            ]);
        }

        $duplicate = RField::where(
            'sys_id_r_tables',
            $validated['sys_id_r_tables']
        )->where('field_name', $validated['field_name']);

        if ($field) {
            $duplicate->where(
                'sys_id_r_fields',
                '!=',
                $field->getKey()
            );
        }

        if ($duplicate->exists()) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'field_name' => 'Field ini sudah terdaftar untuk tabel tersebut.',
            ]);
        }

        return $validated;
    }

    public function store(Request $request)
    {
        RField::create($this->validateField($request));

        return redirect()->route('r-fields.index')
            ->with('success', 'Master field berhasil ditambahkan.');
    }

    public function edit(RField $rField)
    {
        return view('r-fields.edit', [
            'rField' => $rField,
            'tables' => $this->activeTables(),
            'fieldTypes' => $this->fieldTypes(),
            'columnsByTable' => $this->columnsByTable(),
        ]);
    }

    public function update(Request $request, RField $rField)
    {
        RField::whereKey($rField->getKey())
            ->update($this->validateField($request, $rField));

        return redirect()->route('r-fields.index')
            ->with('success', 'Master field berhasil diperbarui.');
    }

    public function destroy(RField $rField)
    {
        $rField->delete();

        return redirect()->route('r-fields.index')
            ->with('success', 'Master field berhasil dihapus.');
    }
}
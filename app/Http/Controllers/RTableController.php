<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RTable; 
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;



class RTableController extends Controller
{
    private function availableTables(): array
{
    return collect(\Illuminate\Support\Facades\Schema::getTableListing())
        ->map(function ($table) {
            // Ambil nama tabel tanpa prefix schema PostgreSQL.
            return str_contains($table, '.')
                ? substr($table, strrpos($table, '.') + 1)
                : $table;
        })
        ->filter(function ($table) {
            // Hanya tampilkan tabel transaksi.
            return str_starts_with($table, 'tr_');
        })
        ->unique()
        ->values()
        ->all();
}

    public function index(Request $request)
    {
        $query = RTable::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('table_name', 'like', "%{$search}%")
                    ->orWhere('table_label', 'like', "%{$search}%");
            });
        }

        if ($request->filled('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        $tables = $query->orderBy('table_label')
            ->paginate(10)
            ->withQueryString();

        return view('r-tables.index', [
            'tables' => $tables,
            'availableTables' => $this->availableTables(),
        ]);
    }

    public function create()
    {
        return view('r-tables.create', [
            'availableTables' => $this->availableTables(),
        ]);
    }

    public function store(Request $request)
    {
        $available = $this->availableTables();

        $validated = $request->validate([
            'table_name' => [
                'required',
                'string',
                Rule::in($available),
                'unique:r_tables,table_name',
            ],
            'table_label' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        RTable::create($validated);

        return redirect()
            ->route('r-tables.index')
            ->with('success', 'Master tabel berhasil ditambahkan.');
    }

    public function edit(RTable $rTable)
    {
        return view('r-tables.edit', [
            'rTable' => $rTable,
            'availableTables' => $this->availableTables(),
        ]);
    }

    public function update(Request $request, RTable $rTable)
    {
        $validated = $request->validate([
            'table_name' => [
                'required',
                'string',
                Rule::in($this->availableTables()),
                Rule::unique('r_tables', 'table_name')
                    ->ignore($rTable->getKey(), 'sys_id_r_tables'),
            ],
            'table_label' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        $rTable->update($validated);

        return redirect()
            ->route('r-tables.index')
            ->with('success', 'Master tabel berhasil diperbarui.');
    }

    public function destroy(RTable $rTable)
    {
        if ($rTable->fields()->exists()) {
            return back()->with(
                'error',
                'Tabel ini masih memiliki master field. Hapus atau pindahkan field terlebih dahulu.'
            );
        }

        $rTable->delete();

        return redirect()
            ->route('r-tables.index')
            ->with('success', 'Master tabel berhasil dihapus.');
    }
}

@extends('layout.appLayoutMain')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Master Fields</h1>
            <p class="mt-1 text-sm text-gray-500">Kelola field yang tersedia untuk kondisi dan action workflow.</p>
        </div>
        <a href="{{ route('r-fields.create') }}"
           class="rounded-lg bg-green-700 px-4 py-2.5 text-center text-sm font-semibold text-white">+ Tambah Field</a>
    </div>

    @if(session('success'))
        <div class="rounded-lg bg-green-50 p-3 text-sm text-green-700">{{ session('success') }}</div>
    @endif

    <form method="GET" class="flex flex-col gap-3 rounded-xl border bg-white p-4 sm:flex-row">
        <input name="search" value="{{ request('search') }}" placeholder="Cari field..."
               class="min-w-0 flex-1 rounded-lg border px-3 py-2 text-sm">
        <select name="sys_id_r_tables" class="rounded-lg border px-3 py-2 text-sm">
            <option value="">Semua Tabel</option>
            @foreach($tables as $table)
                <option value="{{ $table->getKey() }}" @selected((string) request('sys_id_r_tables') === (string) $table->getKey())>
                    {{ $table->table_label }}
                </option>
            @endforeach
        </select>
        <select name="is_active" class="rounded-lg border px-3 py-2 text-sm">
            <option value="">Semua Status</option>
            <option value="1" @selected(request('is_active') === '1')>Aktif</option>
            <option value="0" @selected(request('is_active') === '0')>Nonaktif</option>
        </select>
        <button class="rounded-lg bg-gray-800 px-4 py-2 text-sm text-white">Cari</button>
        <a href="{{ route('r-fields.index') }}" class="rounded-lg border px-4 py-2 text-center text-sm">Reset</a>
    </form>

    <div class="overflow-x-auto rounded-xl border bg-white">
        <table class="min-w-full divide-y text-sm">
            <thead class="bg-gray-50 text-left text-gray-600">
                <tr>
                    <th class="px-5 py-3">Field</th>
                    <th class="px-5 py-3">Tabel</th>
                    <th class="px-5 py-3">Tipe</th>
                    <th class="px-5 py-3">Kondisi</th>
                    <th class="px-5 py-3">Action</th>
                    <th class="px-5 py-3">Status</th>
                    <th class="px-5 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($fields as $field)
                    <tr>
                        <td class="px-5 py-4">
                            <p class="font-medium text-gray-800">{{ $field->field_label }}</p>
                            <p class="text-xs text-gray-500">{{ $field->field_name }}</p>
                        </td>
                        <td class="px-5 py-4">{{ $field->table->table_label ?? '-' }}</td>
                        <td class="px-5 py-4">{{ $field->field_type }}</td>
                        <td class="px-5 py-4">{{ $field->is_condition_allowed ? 'Ya' : 'Tidak' }}</td>
                        <td class="px-5 py-4">{{ $field->is_action_allowed ? 'Ya' : 'Tidak' }}</td>
                        <td class="px-5 py-4">{{ $field->is_active ? 'Aktif' : 'Nonaktif' }}</td>
                        <td class="whitespace-nowrap px-5 py-4 text-right">
                            <a href="{{ route('r-fields.edit', $field) }}" class="text-blue-700">Edit</a>
                            <form method="POST" action="{{ route('r-fields.destroy', $field) }}"
                                  class="ml-3 inline" onsubmit="return confirm('Hapus master field ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="px-5 py-10 text-center text-gray-500">Belum ada master field.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="border-t px-5 py-4">{{ $fields->links() }}</div>
    </div>
</div>
@endsection

@extends('layout.appLayoutMain')


@section('content')
<div class="space-y-6">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Master Tables</h1>
            <p class="mt-1 text-sm text-gray-500">Daftar tabel yang dapat dikonfigurasi untuk workflow.</p>
        </div>
        <a href="{{ route('r-tables.create') }}"
           class="rounded-lg bg-green-700 px-4 py-2.5 text-center text-sm font-semibold text-white">+ Tambah Tabel</a>
    </div>

    @if(session('success'))
        <div class="rounded-lg bg-green-50 p-3 text-sm text-green-700">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="rounded-lg bg-red-50 p-3 text-sm text-red-700">{{ session('error') }}</div>
    @endif

    <form method="GET" class="flex flex-col gap-3 rounded-xl border bg-white p-4 sm:flex-row">
        <input name="search" value="{{ request('search') }}" placeholder="Cari nama atau label tabel..."
               class="min-w-0 flex-1 rounded-lg border px-3 py-2 text-sm">
        <select name="is_active" class="rounded-lg border px-3 py-2 text-sm">
            <option value="">Semua Status</option>
            <option value="1" @selected(request('is_active') === '1')>Aktif</option>
            <option value="0" @selected(request('is_active') === '0')>Nonaktif</option>
        </select>
        <button class="rounded-lg bg-gray-800 px-4 py-2 text-sm text-white">Cari</button>
        <a href="{{ route('r-tables.index') }}" class="rounded-lg border px-4 py-2 text-center text-sm">Reset</a>
    </form>

    <div class="overflow-x-auto rounded-xl border bg-white">
        <table class="min-w-full divide-y text-sm">
            <thead class="bg-gray-50 text-left text-gray-600">
                <tr>
                    <th class="px-5 py-3">Nama Tabel</th>
                    <th class="px-5 py-3">Label</th>
                    <th class="px-5 py-3">Deskripsi</th>
                    <th class="px-5 py-3">Status</th>
                    <th class="px-5 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($tables as $table)
                    <tr>
                        <td class="px-5 py-4 font-medium">{{ $table->table_name }}</td>
                        <td class="px-5 py-4">{{ $table->table_label }}</td>
                        <td class="px-5 py-4">{{ $table->description ?: '-' }}</td>
                        <td class="px-5 py-4">
                            <span class="rounded-full px-2.5 py-1 text-xs {{ $table->is_active ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                {{ $table->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="whitespace-nowrap px-5 py-4 text-right">
                            <a href="{{ route('r-tables.edit', $table) }}" class="text-blue-700">Edit</a>
                            <form method="POST" action="{{ route('r-tables.destroy', $table) }}"
                                  class="ml-3 inline" onsubmit="return confirm('Hapus master tabel ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-5 py-10 text-center text-gray-500">Belum ada master tabel.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="border-t px-5 py-4">{{ $tables->links() }}</div>
    </div>
</div>
@endsection

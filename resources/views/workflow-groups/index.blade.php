@extends('layout.appLayoutMain')


@section('content')
<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Grouping Workflow</h1>
            <p class="mt-1 text-sm text-gray-500">
                Kelola kelompok aturan berdasarkan tabel transaksi.
            </p>
        </div>

        <a href="{{ route('workflow-groups.create') }}"
           class="rounded-lg bg-green-700 px-4 py-2.5 text-center text-sm font-semibold text-white hover:bg-green-800">
            + Tambah Grouping
        </a>
    </div>

    @if(session('success'))
        <div class="rounded-lg border border-green-200 bg-green-50 p-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="rounded-lg border border-red-200 bg-red-50 p-3 text-sm text-red-700">
            Ada input yang belum valid.
        </div>
    @endif

    <div class="rounded-xl border border-gray-200 bg-white p-4">
        <form method="GET" action="{{ route('workflow-groups.index') }}"
              class="flex flex-col gap-3 sm:flex-row">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Cari nama grouping..."
                   class="min-w-0 flex-1 rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-green-700 focus:outline-none">

            <select name="table_name"
                    class="rounded-lg border border-gray-300 px-3 py-2 text-sm">
                <option value="">Semua Tabel</option>
                @foreach($supportedTables as $key => $label)
                    <option value="{{ $key }}" @selected(request('table_name') === $key)>
                        {{ $label }}
                    </option>
                @endforeach
            </select>

            <select name="is_active"
                    class="rounded-lg border border-gray-300 px-3 py-2 text-sm">
                <option value="">Semua Status</option>
                <option value="1" @selected(request('is_active') === '1')>Aktif</option>
                <option value="0" @selected(request('is_active') === '0')>Nonaktif</option>
            </select>

            <button class="rounded-lg bg-gray-800 px-4 py-2 text-sm font-medium text-white">
                Cari
            </button>

            <a href="{{ route('workflow-groups.index') }}"
               class="rounded-lg border border-gray-300 px-4 py-2 text-center text-sm">
                Reset
            </a>
        </form>
    </div>

    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50 text-left text-gray-600">
                    <tr>
                        <th class="px-5 py-3 font-semibold">Nama Grouping</th>
                        <th class="px-5 py-3 font-semibold">Tabel</th>
                        <th class="px-5 py-3 font-semibold">Deskripsi</th>
                        <th class="px-5 py-3 font-semibold">Status</th>
                        <th class="px-5 py-3 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse($workflowGroups as $group)
                        <tr class="hover:bg-gray-50">
                            <td class="px-5 py-4 font-semibold text-gray-800">
                                {{ $group->group_name }}
                            </td>

                            <td class="whitespace-nowrap px-5 py-4">
                                {{ $supportedTables[$group->table_name] ?? $group->table_name }}
                            </td>

                            <td class="max-w-xs px-5 py-4 text-gray-600">
                                {{ $group->description ?: '-' }}
                            </td>

                            <td class="px-5 py-4">
                                @if($group->is_active)
                                    <span class="rounded-full bg-green-50 px-2.5 py-1 text-xs font-medium text-green-700">
                                        Aktif
                                    </span>
                                @else
                                    <span class="rounded-full bg-gray-100 px-2.5 py-1 text-xs font-medium text-gray-600">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>

                            <td class="whitespace-nowrap px-5 py-4 text-right">
                                <a href="{{ route('workflow-groups.edit', $group) }}"
                                   class="font-medium text-blue-700 hover:underline">
                                    Edit
                                </a>

                                <form action="{{ route('workflow-groups.destroy', $group) }}"
                                      method="POST" class="ml-3 inline"
                                      onsubmit="return confirm('Yakin ingin menghapus grouping ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="font-medium text-red-600 hover:underline">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-12 text-center text-gray-500">
                                Belum ada Grouping Workflow.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-gray-200 px-5 py-4">
            {{ $workflowGroups->links() }}
        </div>
    </div>
</div>
@endsection

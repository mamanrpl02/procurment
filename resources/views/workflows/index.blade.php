
@extends('layout.appLayoutMain')

@section('content')
<div class="space-y-6">

    <!-- Header -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-xl font-bold text-slate-900">Workflow Management</h1>
            <p class="mt-1 text-sm text-slate-500">
                Kelola aturan otomatis untuk transaksi.
            </p>
        </div>

        <a href="{{ route('workflows.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-lg bg-green-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-green-800">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2">
                <path d="M12 5v14M5 12h14" />
            </svg>
            Add Workflow
        </a>
    </div>

    <!-- Notification -->
    @if(session('success'))
        <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            {{ session('error') }}
        </div>
    @endif

    <!-- Summary -->
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
        <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
            <p class="text-xs font-medium text-slate-500">Total Workflow</p>
            <p class="mt-2 text-2xl font-bold text-slate-900">
                {{ $workflows->total() }}
            </p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
            <p class="text-xs font-medium text-slate-500">Active di Halaman Ini</p>
            <p class="mt-2 text-2xl font-bold text-green-700">
                {{ $workflows->getCollection()->where('is_active', true)->count() }}
            </p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
            <p class="text-xs font-medium text-slate-500">Inactive di Halaman Ini</p>
            <p class="mt-2 text-2xl font-bold text-slate-500">
                {{ $workflows->getCollection()->where('is_active', false)->count() }}
            </p>
        </div>
    </div>

    <!-- Filter -->
    <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
        <form method="GET" action="{{ route('workflows.index') }}"
            class="grid grid-cols-1 gap-3 md:grid-cols-4">

            <div class="md:col-span-2">
                <label class="mb-1 block text-xs font-medium text-slate-600">
                    Cari Workflow
                </label>
                <input type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama workflow..."
                    class="w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm outline-none focus:border-green-600">
            </div>

            <div>
                <label class="mb-1 block text-xs font-medium text-slate-600">
                    Transaksi
                </label>
                <select name="table_id"
                    class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2.5 text-sm outline-none focus:border-green-600">
                    <option value="">Semua Transaksi</option>
                    @foreach($tables as $table)
                        <option value="{{ $table->getKey() }}"
                            @selected((string) request('table_id') === (string) $table->getKey())>
                            {{ $table->table_label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="mb-1 block text-xs font-medium text-slate-600">
                    Status
                </label>
                <select name="is_active"
                    class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2.5 text-sm outline-none focus:border-green-600">
                    <option value="">Semua Status</option>
                    <option value="1" @selected(request('is_active') === '1')>Active</option>
                    <option value="0" @selected(request('is_active') === '0')>Inactive</option>
                </select>
            </div>

            <div class="flex gap-2 md:col-span-4 md:justify-end">
                <a href="{{ route('workflows.index') }}"
                    class="rounded-lg border border-slate-200 px-4 py-2 text-sm font-medium text-slate-600 hover:bg-slate-50">
                    Reset
                </a>

                <button type="submit"
                    class="rounded-lg bg-slate-800 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-900">
                    Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Workflow Table -->
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-100 px-5 py-4">
            <h2 class="text-sm font-semibold text-slate-900">Daftar Workflow</h2>
            <p class="mt-1 text-xs text-slate-500">
                Aturan otomatis yang sudah dikonfigurasi.
            </p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[750px] text-left">
                <thead class="bg-slate-50">
                    <tr class="text-xs font-semibold uppercase tracking-wide text-slate-500">
                        <th class="px-5 py-3">Nama Workflow</th>
                        <th class="px-5 py-3">Transaksi</th>
                        <th class="px-5 py-3">Grouping</th>
                        <th class="px-5 py-3">Jenis Aturan</th>
                        <th class="px-5 py-3">Status</th>
                        <th class="px-5 py-3 text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse($workflows as $workflow)
                        <tr class="text-sm hover:bg-slate-50">
                            <td class="px-5 py-4">
                                <div class="font-semibold text-slate-800">
                                    {{ $workflow->workflow_name }}
                                </div>
                                @if($workflow->description)
                                    <div class="mt-1 max-w-xs truncate text-xs text-slate-400">
                                        {{ $workflow->description }}
                                    </div>
                                @endif
                            </td>

                            <td class="px-5 py-4 text-slate-600">
                                {{ $workflow->table?->table_label ?? '-' }}
                            </td>

                            <td class="px-5 py-4 text-slate-600">
                                {{ $workflow->workflowGroup?->group_name ?? '-' }}
                            </td>

                            <td class="px-5 py-4">
                                <span class="rounded-md bg-blue-50 px-2.5 py-1 text-xs font-medium text-blue-700">
                                    Set Value
                                </span>
                            </td>

                            <td class="px-5 py-4">
                                @if($workflow->is_active)
                                    <span class="inline-flex rounded-full bg-green-50 px-2.5 py-1 text-xs font-medium text-green-700">
                                        Active
                                    </span>
                                @else
                                    <span class="inline-flex rounded-full bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-500">
                                        Inactive
                                    </span>
                                @endif
                            </td>

                            <td class="px-5 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('workflows.edit', $workflow) }}"
                                        class="rounded-lg border border-slate-200 px-3 py-1.5 text-xs font-semibold text-slate-600 hover:bg-slate-100">
                                        Edit
                                    </a>

                                    <form method="POST"
                                        action="{{ route('workflows.destroy', $workflow) }}"
                                        onsubmit="return confirm('Yakin ingin menghapus workflow ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="rounded-lg border border-red-100 px-3 py-1.5 text-xs font-semibold text-red-600 hover:bg-red-50">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-12 text-center">
                                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-slate-100">
                                    <svg class="h-6 w-6 text-slate-400" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.6">
                                        <path d="M4 5h16v14H4zM8 9h8M8 13h5" />
                                    </svg>
                                </div>
                                <p class="mt-3 text-sm font-semibold text-slate-700">
                                    Belum ada Workflow
                                </p>
                                <p class="mt-1 text-xs text-slate-400">
                                    Buat workflow pertama untuk mulai mengatur otomatisasi transaksi.
                                </p>
                                <a href="{{ route('workflows.create') }}"
                                    class="mt-4 inline-flex rounded-lg bg-green-700 px-4 py-2 text-xs font-semibold text-white hover:bg-green-800">
                                    Add Workflow
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($workflows->hasPages())
            <div class="border-t border-slate-100 px-5 py-4">
                {{ $workflows->links() }}
            </div>
        @endif
    </div>

</div>
@endsection

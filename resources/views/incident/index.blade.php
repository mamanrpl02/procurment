@extends('layout.appLayoutMain')

@section('content')
<div class="mx-auto max-w-[1600px] space-y-6">

    {{-- Page Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <div class="mb-2 flex items-center gap-2 text-sm text-slate-500">
                <span>Incident Management</span>
                <span>/</span>
                <span class="text-slate-800">All Incidents</span>
            </div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">
                Incident Management
            </h1>
            <p class="mt-1 text-sm text-slate-500">
                Kelola dan pantau seluruh tiket incident.
            </p>
        </div>

        <a href="{{ url('/incidents/create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-app-green px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-green-800">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 4v16m8-8H4" />
            </svg>
            Create Incident
        </a>
    </div>

    {{-- Summary Cards --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-2xl border border-app-border bg-white p-5">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-slate-500">Total Incidents</p>
                <span class="rounded-xl bg-slate-100 p-2 text-slate-600">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </span>
            </div>
            <p class="mt-4 text-3xl font-bold text-slate-900">248</p>
            <p class="mt-1 text-xs text-slate-500">Seluruh tiket incident</p>
        </div>

        <div class="rounded-2xl border border-app-border bg-white p-5">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-slate-500">New</p>
                <span class="rounded-xl bg-blue-50 p-2 text-blue-600">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>
            </div>
            <p class="mt-4 text-3xl font-bold text-slate-900">32</p>
            <p class="mt-1 text-xs text-slate-500">Menunggu penanganan</p>
        </div>

        <div class="rounded-2xl border border-app-border bg-white p-5">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-slate-500">In Progress</p>
                <span class="rounded-xl bg-amber-50 p-2 text-amber-600">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M12 6v6l4 2" />
                        <circle cx="12" cy="12" r="9" stroke-width="1.8" />
                    </svg>
                </span>
            </div>
            <p class="mt-4 text-3xl font-bold text-slate-900">56</p>
            <p class="mt-1 text-xs text-slate-500">Sedang ditangani</p>
        </div>

        <div class="rounded-2xl border border-app-border bg-white p-5">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-slate-500">Resolved</p>
                <span class="rounded-xl bg-green-50 p-2 text-green-600">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13l4 4L19 7" />
                    </svg>
                </span>
            </div>
            <p class="mt-4 text-3xl font-bold text-slate-900">160</p>
            <p class="mt-1 text-xs text-slate-500">Sudah diselesaikan</p>
        </div>
    </div>

    {{-- Incident Table --}}
    <div class="overflow-hidden rounded-2xl border border-app-border bg-white">

        {{-- Table Header --}}
        <div class="flex flex-col gap-4 border-b border-app-border p-5 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h2 class="text-base font-semibold text-slate-900">All Incidents</h2>
                <p class="mt-1 text-sm text-slate-500">Daftar seluruh tiket incident.</p>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row">
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="7" stroke-width="1.8" />
                        <path stroke-linecap="round" stroke-width="1.8" d="m16 16 4 4" />
                    </svg>
                    <input type="search" id="incidentSearch" placeholder="Search incident..."
                        class="w-full rounded-xl border border-app-border py-2.5 pl-9 pr-3 text-sm outline-none transition placeholder:text-slate-400 focus:border-app-green focus:ring-2 focus:ring-green-100 sm:w-64">
                </div>

                <select id="statusFilter"
                    class="rounded-xl border border-app-border bg-white px-3 py-2.5 text-sm text-slate-600 outline-none focus:border-app-green focus:ring-2 focus:ring-green-100">
                    <option value="">All Status</option>
                    <option value="New">New</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Pending">Pending</option>
                    <option value="Resolved">Resolved</option>
                    <option value="Closed">Closed</option>
                </select>
            </div>
        </div>

        {{-- Responsive Table --}}
        <div class="custom-scrollbar overflow-x-auto">
            <table class="w-full min-w-[1050px] text-left text-sm">
                <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                    <tr>
                        <th class="px-5 py-4 font-semibold">Incident ID</th>
                        <th class="px-5 py-4 font-semibold">Short Description</th>
                        <th class="px-5 py-4 font-semibold">Category</th>
                        <th class="px-5 py-4 font-semibold">Priority</th>
                        <th class="px-5 py-4 font-semibold">Assigned To</th>
                        <th class="px-5 py-4 font-semibold">Status</th>
                        <th class="px-5 py-4 text-right font-semibold">Action</th>
                    </tr>
                </thead>

                <tbody id="incidentTableBody" class="divide-y divide-slate-100">

                    <tr class="incident-row transition hover:bg-slate-50/70"
                        data-search="INC-2026-00001 email outlook tidak bisa diakses application and software budi santoso">
                        <td class="whitespace-nowrap px-5 py-4">
                            <a href="#" class="font-semibold text-app-green hover:underline">INC-2026-00001</a>
                            <p class="mt-1 text-xs text-slate-400">28 Oct 2026</p>
                        </td>
                        <td class="max-w-xs px-5 py-4">
                            <p class="font-medium text-slate-800">Email Outlook tidak bisa diakses</p>
                            <p class="mt-1 text-xs text-slate-500">Reported by Andi Pratama</p>
                        </td>
                        <td class="whitespace-nowrap px-5 py-4 text-slate-600">Application</td>
                        <td class="whitespace-nowrap px-5 py-4">
                            <span class="inline-flex items-center gap-1.5 font-medium text-red-600">
                                <span class="h-2 w-2 rounded-full bg-red-500"></span> High
                            </span>
                        </td>
                        <td class="whitespace-nowrap px-5 py-4 text-slate-600">Budi Santoso</td>
                        <td class="whitespace-nowrap px-5 py-4">
                            <span class="rounded-full bg-blue-50 px-2.5 py-1 text-xs font-medium text-blue-700">New</span>
                        </td>
                        <td class="whitespace-nowrap px-5 py-4 text-right">
                            <a href="#" class="font-medium text-slate-600 hover:text-app-green">View details</a>
                        </td>
                    </tr>

                    <tr class="incident-row transition hover:bg-slate-50/70"
                        data-search="INC-2026-00002 koneksi vpn terputus network infrastructure siti rahma">
                        <td class="whitespace-nowrap px-5 py-4">
                            <a href="#" class="font-semibold text-app-green hover:underline">INC-2026-00002</a>
                            <p class="mt-1 text-xs text-slate-400">28 Oct 2026</p>
                        </td>
                        <td class="px-5 py-4">
                            <p class="font-medium text-slate-800">Koneksi VPN terputus</p>
                            <p class="mt-1 text-xs text-slate-500">Reported by Siti Rahma</p>
                        </td>
                        <td class="whitespace-nowrap px-5 py-4 text-slate-600">Network</td>
                        <td class="whitespace-nowrap px-5 py-4">
                            <span class="inline-flex items-center gap-1.5 font-medium text-amber-600">
                                <span class="h-2 w-2 rounded-full bg-amber-500"></span> Medium
                            </span>
                        </td>
                        <td class="whitespace-nowrap px-5 py-4 text-slate-600">Dimas Saputra</td>
                        <td class="whitespace-nowrap px-5 py-4">
                            <span class="rounded-full bg-amber-50 px-2.5 py-1 text-xs font-medium text-amber-700">In Progress</span>
                        </td>
                        <td class="whitespace-nowrap px-5 py-4 text-right">
                            <a href="#" class="font-medium text-slate-600 hover:text-app-green">View details</a>
                        </td>
                    </tr>

                    <tr class="incident-row transition hover:bg-slate-50/70"
                        data-search="INC-2026-00003 printer tidak merespons hardware infrastructure rina putri">
                        <td class="whitespace-nowrap px-5 py-4">
                            <a href="#" class="font-semibold text-app-green hover:underline">INC-2026-00003</a>
                            <p class="mt-1 text-xs text-slate-400">27 Oct 2026</p>
                        </td>
                        <td class="px-5 py-4">
                            <p class="font-medium text-slate-800">Printer tidak merespons</p>
                            <p class="mt-1 text-xs text-slate-500">Reported by Rina Putri</p>
                        </td>
                        <td class="whitespace-nowrap px-5 py-4 text-slate-600">Hardware</td>
                        <td class="whitespace-nowrap px-5 py-4">
                            <span class="inline-flex items-center gap-1.5 font-medium text-slate-500">
                                <span class="h-2 w-2 rounded-full bg-slate-400"></span> Low
                            </span>
                        </td>
                        <td class="whitespace-nowrap px-5 py-4 text-slate-600">Rina Putri</td>
                        <td class="whitespace-nowrap px-5 py-4">
                            <span class="rounded-full bg-purple-50 px-2.5 py-1 text-xs font-medium text-purple-700">Pending</span>
                        </td>
                        <td class="whitespace-nowrap px-5 py-4 text-right">
                            <a href="#" class="font-medium text-slate-600 hover:text-app-green">View details</a>
                        </td>
                    </tr>

                    <tr class="incident-row transition hover:bg-slate-50/70"
                        data-search="INC-2026-00004 aplikasi absensi error application nanda putra">
                        <td class="whitespace-nowrap px-5 py-4">
                            <a href="#" class="font-semibold text-app-green hover:underline">INC-2026-00004</a>
                            <p class="mt-1 text-xs text-slate-400">26 Oct 2026</p>
                        </td>
                        <td class="px-5 py-4">
                            <p class="font-medium text-slate-800">Aplikasi absensi mengalami error</p>
                            <p class="mt-1 text-xs text-slate-500">Reported by Nanda Putra</p>
                        </td>
                        <td class="whitespace-nowrap px-5 py-4 text-slate-600">Application</td>
                        <td class="whitespace-nowrap px-5 py-4">
                            <span class="inline-flex items-center gap-1.5 font-medium text-red-600">
                                <span class="h-2 w-2 rounded-full bg-red-500"></span> High
                            </span>
                        </td>
                        <td class="whitespace-nowrap px-5 py-4 text-slate-600">Nanda Putra</td>
                        <td class="whitespace-nowrap px-5 py-4">
                            <span class="rounded-full bg-green-50 px-2.5 py-1 text-xs font-medium text-green-700">Resolved</span>
                        </td>
                        <td class="whitespace-nowrap px-5 py-4 text-right">
                            <a href="#" class="font-medium text-slate-600 hover:text-app-green">View details</a>
                        </td>
                    </tr>

                    <tr class="incident-row transition hover:bg-slate-50/70"
                        data-search="INC-2026-00005 hard disk server penuh server infrastructure arif hidayat">
                        <td class="whitespace-nowrap px-5 py-4">
                            <a href="#" class="font-semibold text-app-green hover:underline">INC-2026-00005</a>
                            <p class="mt-1 text-xs text-slate-400">25 Oct 2026</p>
                        </td>
                        <td class="px-5 py-4">
                            <p class="font-medium text-slate-800">Storage server hampir penuh</p>
                            <p class="mt-1 text-xs text-slate-500">Reported by Arif Hidayat</p>
                        </td>
                        <td class="whitespace-nowrap px-5 py-4 text-slate-600">Server</td>
                        <td class="whitespace-nowrap px-5 py-4">
                            <span class="inline-flex items-center gap-1.5 font-medium text-red-600">
                                <span class="h-2 w-2 rounded-full bg-red-500"></span> Critical
                            </span>
                        </td>
                        <td class="whitespace-nowrap px-5 py-4 text-slate-600">Arif Hidayat</td>
                        <td class="whitespace-nowrap px-5 py-4">
                            <span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-600">Closed</span>
                        </td>
                        <td class="whitespace-nowrap px-5 py-4 text-right">
                            <a href="#" class="font-medium text-slate-600 hover:text-app-green">View details</a>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

        {{-- Table Footer --}}
        <div class="flex flex-col gap-3 border-t border-app-border px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
            <p id="resultCount" class="text-sm text-slate-500">
                Showing 5 sample incidents
            </p>

            <div class="flex items-center gap-2">
                <button type="button" disabled
                    class="rounded-lg border border-app-border px-3 py-2 text-sm text-slate-400">
                    Previous
                </button>
                <button type="button"
                    class="rounded-lg bg-app-green px-3.5 py-2 text-sm font-medium text-white">
                    1
                </button>
                <button type="button" disabled
                    class="rounded-lg border border-app-border px-3 py-2 text-sm text-slate-400">
                    Next
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Search & Filter: JavaScript native, data masih dummy --}}
<script>
    const searchInput = document.getElementById('incidentSearch');
    const statusFilter = document.getElementById('statusFilter');
    const incidentRows = document.querySelectorAll('.incident-row');
    const resultCount = document.getElementById('resultCount');

    function filterIncidents() {
        const keyword = searchInput.value.toLowerCase().trim();
        const selectedStatus = statusFilter.value.toLowerCase();
        let visibleCount = 0;

        incidentRows.forEach(row => {
            const searchableText = row.dataset.search.toLowerCase();
            const rowStatus = row.querySelector('td:nth-child(6)').textContent.trim().toLowerCase();

            const matchesSearch = searchableText.includes(keyword);
            const matchesStatus = !selectedStatus || rowStatus === selectedStatus;
            const isVisible = matchesSearch && matchesStatus;

            row.classList.toggle('hidden', !isVisible);

            if (isVisible) visibleCount++;
        });

        resultCount.textContent = `Showing ${visibleCount} sample incidents`;
    }

    searchInput.addEventListener('input', filterIncidents);
    statusFilter.addEventListener('change', filterIncidents);
</script>
@endsection

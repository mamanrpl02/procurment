@extends('layout.suplier')

@section('content')
    <!-- Header -->
    <div class="flex flex-col gap-4 border-b border-slate-100 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6">
        <div>
            <h2 class="text-lg font-semibold text-slate-800">Doctor List</h2>
            <p class="mt-1 text-sm text-slate-400">Manage and monitor your doctors.</p>
        </div>

        <button
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-tealbrand-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-tealbrand-700">
            <i data-lucide="plus" class="h-4 w-4"></i>
            Add Doctor
        </button>
    </div>

    <!-- Search & Filter -->
    <div class="flex flex-col gap-3 border-b border-slate-100 p-4 sm:flex-row sm:items-center sm:justify-between sm:px-6">
        <div class="relative w-full sm:max-w-xs">
            <i data-lucide="search" class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400"></i>
            <input id="doctorTableSearch" type="search" placeholder="Search doctor..."
                class="w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-9 pr-4 text-sm outline-none transition placeholder:text-slate-400 focus:border-tealbrand-500 focus:ring-4 focus:ring-tealbrand-500/10" />
        </div>

        <select id="doctorStatusFilter"
            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-600 outline-none focus:border-tealbrand-500 sm:w-40">
            <option value="all">All Status</option>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full min-w-[680px] text-left">
            <thead>
                <tr class="bg-slate-50/80 text-[11px] font-semibold uppercase tracking-wider text-slate-400">
                    <th class="px-6 py-4">Doctor</th>
                    <th class="px-6 py-4">Specialty</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Appointments</th>
                    <th class="px-6 py-4 text-right">Action</th>
                </tr>
            </thead>

            <tbody id="doctorTableBody" class="divide-y divide-slate-100 text-sm">

                <!-- Row 1 -->
                <tr class="transition hover:bg-tealbrand-50/40" data-status="active">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?auto=format&fit=crop&w=100&q=80"
                                alt="Dr. Adrian" class="h-10 w-10 rounded-xl object-cover" />
                            <div>
                                <p class="font-semibold text-slate-700">Dr. Adrian Smith</p>
                                <p class="mt-1 text-xs text-slate-400">adrian@example.com</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-slate-500">Cardiologist</td>
                    <td class="px-6 py-4">
                        <span
                            class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-600">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                            Active
                        </span>
                    </td>
                    <td class="px-6 py-4 font-medium text-slate-600">124</td>
                    <td class="px-6 py-4 text-right">
                        <button class="rounded-lg p-2 text-slate-400 transition hover:bg-slate-100 hover:text-tealbrand-600"
                            aria-label="More actions">
                            <i data-lucide="ellipsis" class="h-5 w-5"></i>
                        </button>
                    </td>
                </tr>

                <!-- Row 2 -->
                <tr class="transition hover:bg-tealbrand-50/40" data-status="active">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?auto=format&fit=crop&w=100&q=80"
                                alt="Dr. Olivia" class="h-10 w-10 rounded-xl object-cover" />
                            <div>
                                <p class="font-semibold text-slate-700">Dr. Olivia Wilson</p>
                                <p class="mt-1 text-xs text-slate-400">olivia@example.com</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-slate-500">Neurologist</td>
                    <td class="px-6 py-4">
                        <span
                            class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-600">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                            Active
                        </span>
                    </td>
                    <td class="px-6 py-4 font-medium text-slate-600">86</td>
                    <td class="px-6 py-4 text-right">
                        <button class="rounded-lg p-2 text-slate-400 transition hover:bg-slate-100 hover:text-tealbrand-600"
                            aria-label="More actions">
                            <i data-lucide="ellipsis" class="h-5 w-5"></i>
                        </button>
                    </td>
                </tr>

                <!-- Row 3 -->
                <tr class="transition hover:bg-tealbrand-50/40" data-status="inactive">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <img src="https://images.unsplash.com/photo-1622253692010-333f2da6031d?auto=format&fit=crop&w=100&q=80"
                                alt="Dr. James" class="h-10 w-10 rounded-xl object-cover" />
                            <div>
                                <p class="font-semibold text-slate-700">Dr. James Miller</p>
                                <p class="mt-1 text-xs text-slate-400">james@example.com</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-slate-500">Dermatologist</td>
                    <td class="px-6 py-4">
                        <span
                            class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-500">
                            <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                            Inactive
                        </span>
                    </td>
                    <td class="px-6 py-4 font-medium text-slate-600">42</td>
                    <td class="px-6 py-4 text-right">
                        <button class="rounded-lg p-2 text-slate-400 transition hover:bg-slate-100 hover:text-tealbrand-600"
                            aria-label="More actions">
                            <i data-lucide="ellipsis" class="h-5 w-5"></i>
                        </button>
                    </td>
                </tr>
                <!-- Row 3 -->
                <tr class="transition hover:bg-tealbrand-50/40" data-status="inactive">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <img src="https://images.unsplash.com/photo-1622253692010-333f2da6031d?auto=format&fit=crop&w=100&q=80"
                                alt="Dr. James" class="h-10 w-10 rounded-xl object-cover" />
                            <div>
                                <p class="font-semibold text-slate-700">Dr. James Miller</p>
                                <p class="mt-1 text-xs text-slate-400">james@example.com</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-slate-500">Dermatologist</td>
                    <td class="px-6 py-4">
                        <span
                            class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-500">
                            <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                            Inactive
                        </span>
                    </td>
                    <td class="px-6 py-4 font-medium text-slate-600">42</td>
                    <td class="px-6 py-4 text-right">
                        <button
                            class="rounded-lg p-2 text-slate-400 transition hover:bg-slate-100 hover:text-tealbrand-600"
                            aria-label="More actions">
                            <i data-lucide="ellipsis" class="h-5 w-5"></i>
                        </button>
                    </td>
                </tr>
                <!-- Row 3 -->
                <tr class="transition hover:bg-tealbrand-50/40" data-status="inactive">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <img src="https://images.unsplash.com/photo-1622253692010-333f2da6031d?auto=format&fit=crop&w=100&q=80"
                                alt="Dr. James" class="h-10 w-10 rounded-xl object-cover" />
                            <div>
                                <p class="font-semibold text-slate-700">Dr. James Miller</p>
                                <p class="mt-1 text-xs text-slate-400">james@example.com</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-slate-500">Dermatologist</td>
                    <td class="px-6 py-4">
                        <span
                            class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-500">
                            <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                            Inactive
                        </span>
                    </td>
                    <td class="px-6 py-4 font-medium text-slate-600">42</td>
                    <td class="px-6 py-4 text-right">
                        <button
                            class="rounded-lg p-2 text-slate-400 transition hover:bg-slate-100 hover:text-tealbrand-600"
                            aria-label="More actions">
                            <i data-lucide="ellipsis" class="h-5 w-5"></i>
                        </button>
                    </td>
                </tr>
                <!-- Row 3 -->
                <tr class="transition hover:bg-tealbrand-50/40" data-status="inactive">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <img src="https://images.unsplash.com/photo-1622253692010-333f2da6031d?auto=format&fit=crop&w=100&q=80"
                                alt="Dr. James" class="h-10 w-10 rounded-xl object-cover" />
                            <div>
                                <p class="font-semibold text-slate-700">Dr. James Miller</p>
                                <p class="mt-1 text-xs text-slate-400">james@example.com</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-slate-500">Dermatologist</td>
                    <td class="px-6 py-4">
                        <span
                            class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-500">
                            <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                            Inactive
                        </span>
                    </td>
                    <td class="px-6 py-4 font-medium text-slate-600">42</td>
                    <td class="px-6 py-4 text-right">
                        <button
                            class="rounded-lg p-2 text-slate-400 transition hover:bg-slate-100 hover:text-tealbrand-600"
                            aria-label="More actions">
                            <i data-lucide="ellipsis" class="h-5 w-5"></i>
                        </button>
                    </td>
                </tr>
                <!-- Row 3 -->
                <tr class="transition hover:bg-tealbrand-50/40" data-status="inactive">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <img src="https://images.unsplash.com/photo-1622253692010-333f2da6031d?auto=format&fit=crop&w=100&q=80"
                                alt="Dr. James" class="h-10 w-10 rounded-xl object-cover" />
                            <div>
                                <p class="font-semibold text-slate-700">Dr. James Miller</p>
                                <p class="mt-1 text-xs text-slate-400">james@example.com</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-slate-500">Dermatologist</td>
                    <td class="px-6 py-4">
                        <span
                            class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-500">
                            <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                            Inactive
                        </span>
                    </td>
                    <td class="px-6 py-4 font-medium text-slate-600">42</td>
                    <td class="px-6 py-4 text-right">
                        <button
                            class="rounded-lg p-2 text-slate-400 transition hover:bg-slate-100 hover:text-tealbrand-600"
                            aria-label="More actions">
                            <i data-lucide="ellipsis" class="h-5 w-5"></i>
                        </button>
                    </td>
                </tr>

                <!-- Empty state -->
                <tr id="doctorEmptyState" class="hidden">
                    <td colspan="5" class="px-6 py-12 text-center">
                        <i data-lucide="search-x" class="mx-auto h-8 w-8 text-slate-300"></i>
                        <p class="mt-3 text-sm font-medium text-slate-600">No doctors found</p>
                        <p class="mt-1 text-xs text-slate-400">Try another search or filter.</p>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

    <!-- Footer / Pagination -->
    <div
        class="flex flex-col gap-3 border-t border-slate-100 px-5 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-6">
        <p id="doctorTableCount" class="text-xs text-slate-400">
            Showing 3 doctors
        </p>

        <div class="flex items-center gap-1">
            <button disabled
                class="flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200 text-slate-300 disabled:cursor-not-allowed"
                aria-label="Previous page">
                <i data-lucide="chevron-left" class="h-4 w-4"></i>
            </button>
            <button
                class="flex h-8 min-w-8 items-center justify-center rounded-lg bg-tealbrand-600 px-2 text-xs font-semibold text-white">1</button>
            <button disabled
                class="flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200 text-slate-300 disabled:cursor-not-allowed"
                aria-label="Next page">
                <i data-lucide="chevron-right" class="h-4 w-4"></i>
            </button>
        </div>
    </div>
@endsection

@extends('layout.procurment')

@section('content')
    <div class="mx-auto max-w-screen-2xl space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <div class="mb-2 flex items-center gap-2 text-xs font-medium text-emerald-600">
                    <i data-lucide="ticket-check" class="h-4 w-4"></i>
                    Procurement <span class="text-slate-300">/</span> Ticketing PO
                </div>

                <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                    Ticketing PO
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Kelola pengajuan dan pantau proses Purchase Order.
                </p>
            </div>

            <a href="{{ url('/procurment/create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                <i data-lucide="plus" class="h-4 w-4"></i>
                Buat Tiket PO
            </a>
        </div>

        {{-- STATISTICS --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
            @php
                $stats = [
                    [
                        'label' => 'Total Tiket',
                        'value' => 128,
                        'note' => 'Seluruh pengajuan PO',
                        'icon' => 'tickets',
                        'color' => 'blue',
                    ],
                    [
                        'label' => 'Menunggu',
                        'value' => 24,
                        'note' => 'Belum ditindaklanjuti',
                        'icon' => 'clock-3',
                        'color' => 'amber',
                    ],
                    [
                        'label' => 'Diproses',
                        'value' => 18,
                        'note' => 'Sedang ditangani',
                        'icon' => 'refresh-cw',
                        'color' => 'violet',
                    ],
                    [
                        'label' => 'Selesai',
                        'value' => 86,
                        'note' => 'Tiket terselesaikan',
                        'icon' => 'check-circle-2',
                        'color' => 'emerald',
                    ],
                ];
            @endphp

            @foreach ($stats as $stat)
                <div
                    class="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500">{{ $stat['label'] }}</p>
                            <p class="mt-3 text-3xl font-bold tracking-tight text-slate-900">{{ $stat['value'] }}</p>
                            <p class="mt-2 text-xs text-slate-400">{{ $stat['note'] }}</p>
                        </div>

                        <div
                            class="flex h-11 w-11 items-center justify-center rounded-xl
                        {{ match ($stat['color']) {
                            'blue' => 'bg-blue-50 text-blue-600',
                            'amber' => 'bg-amber-50 text-amber-600',
                            'violet' => 'bg-violet-50 text-violet-600',
                            default => 'bg-emerald-50 text-emerald-600',
                        } }}">
                            <i data-lucide="{{ $stat['icon'] }}" class="h-5 w-5"></i>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- LIST --}}
        <section class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm">

            <div
                class="flex flex-col gap-4 border-b border-slate-100 p-5 sm:p-6 xl:flex-row xl:items-center xl:justify-between">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">Daftar Tiket PO</h2>
                    <p class="mt-1 text-sm text-slate-500">Informasi seluruh tiket pengajuan Purchase Order.</p>
                </div>

                <div class="flex flex-col gap-3 sm:flex-row">
                    <div class="relative sm:w-72">
                        <i data-lucide="search" class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400"></i>
                        <input id="searchTicket" type="search" placeholder="Cari nomor PO atau supplier..."
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 py-2.5 pl-10 pr-4 text-sm outline-none transition focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10">
                    </div>

                    <select id="filterStatus"
                        class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-600 outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10">
                        <option value="">Semua Status</option>
                        <option value="Menunggu">Menunggu</option>
                        <option value="Diproses">Diproses</option>
                        <option value="Selesai">Selesai</option>
                        <option value="Ditolak">Ditolak</option>
                    </select>
                </div>
            </div>

            {{-- DESKTOP TABLE --}}
            <div class="hidden overflow-x-auto md:block">
                <table class="w-full min-w-[850px] text-left">
                    <thead class="bg-slate-50">
                        <tr class="border-y border-slate-100 text-xs font-semibold uppercase tracking-wider text-slate-500">
                            <th class="px-6 py-4">Nomor Tiket / PO</th>
                            <th class="px-6 py-4">Supplier</th>
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4">Prioritas</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="ticketTableBody" class="divide-y divide-slate-100"></tbody>
                </table>
            </div>

            {{-- MOBILE LIST --}}
            <div id="ticketMobileList" class="grid gap-3 p-4 md:hidden"></div>

            {{-- EMPTY STATE --}}
            <div id="emptyState" class="hidden px-5 py-16 text-center">
                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">
                    <i data-lucide="inbox" class="h-7 w-7"></i>
                </div>
                <h3 class="mt-4 font-semibold text-slate-800">Tiket tidak ditemukan</h3>
                <p class="mt-1 text-sm text-slate-500">Coba gunakan kata kunci atau filter yang berbeda.</p>
            </div>

            {{-- PAGINATION --}}
            <div
                class="flex flex-col gap-3 border-t border-slate-100 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
                <p id="paginationInfo" class="text-xs text-slate-500"></p>
                <div class="flex items-center gap-2">
                    <button id="prevPage" type="button"
                        class="rounded-lg border border-slate-200 px-3 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-50 disabled:opacity-40">
                        Sebelumnya
                    </button>
                    <span id="pageInfo" class="text-xs text-slate-500"></span>
                    <button id="nextPage" type="button"
                        class="rounded-lg border border-slate-200 px-3 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-50 disabled:opacity-40">
                        Berikutnya
                    </button>
                </div>
            </div>
        </section>

    </div>

    <script>
        (() => {
            const tickets = [{
                    id: 'TPO-00128',
                    po: 'PO/2026/00128',
                    supplier: 'PT Sumber Makmur',
                    category: 'Revisi PO',
                    date: '2026-10-20',
                    priority: 'Tinggi',
                    status: 'Diproses',
                    requester: 'Andi Pratama',
                    description: 'Permohonan revisi kuantitas barang pada dokumen purchase order.'
                },
                {
                    id: 'TPO-00127',
                    po: 'PO/2026/00127',
                    supplier: 'CV Mitra Sejahtera',
                    category: 'Pembuatan PO',
                    date: '2026-10-20',
                    priority: 'Normal',
                    status: 'Menunggu',
                    requester: 'Siti Rahmawati',
                    description: 'Pengajuan pembuatan PO untuk kebutuhan operasional.'
                },
                {
                    id: 'TPO-00126',
                    po: 'PO/2026/00126',
                    supplier: 'PT Teknologi Nusantara',
                    category: 'Dokumen PO',
                    date: '2026-10-19',
                    priority: 'Urgent',
                    status: 'Menunggu',
                    requester: 'Budi Santoso',
                    description: 'Dokumen PO perlu segera dilengkapi.'
                },
                {
                    id: 'TPO-00125',
                    po: 'PO/2026/00125',
                    supplier: 'PT Karya Mandiri',
                    category: 'Kendala Pengiriman',
                    date: '2026-10-18',
                    priority: 'Rendah',
                    status: 'Selesai',
                    requester: 'Dewi Anggraini',
                    description: 'Konfirmasi kendala pengiriman barang dari supplier.'
                },
                {
                    id: 'TPO-00124',
                    po: 'PO/2026/00124',
                    supplier: 'CV Berkah Abadi',
                    category: 'Revisi PO',
                    date: '2026-10-17',
                    priority: 'Normal',
                    status: 'Diproses',
                    requester: 'Rizky Firmansyah',
                    description: 'Perubahan detail item dalam dokumen PO.'
                },
                {
                    id: 'TPO-00123',
                    po: 'PO/2026/00123',
                    supplier: 'PT Cipta Persada',
                    category: 'Pembatalan PO',
                    date: '2026-10-16',
                    priority: 'Tinggi',
                    status: 'Ditolak',
                    requester: 'Nadia Putri',
                    description: 'Permohonan pembatalan PO karena perubahan kebutuhan.'
                },
                {
                    id: 'TPO-00122',
                    po: 'PO/2026/00122',
                    supplier: 'PT Indo Teknik',
                    category: 'Pembuatan PO',
                    date: '2026-10-15',
                    priority: 'Normal',
                    status: 'Selesai',
                    requester: 'Agus Setiawan',
                    description: 'Pengajuan PO untuk pengadaan barang.'
                },
                {
                    id: 'TPO-00121',
                    po: 'PO/2026/00121',
                    supplier: 'PT Global Industri',
                    category: 'Dokumen PO',
                    date: '2026-10-14',
                    priority: 'Urgent',
                    status: 'Diproses',
                    requester: 'Rina Amelia',
                    description: 'Permintaan kelengkapan dokumen pengadaan.'
                },
                {
                    id: 'TPO-00120',
                    po: 'PO/2026/00120',
                    supplier: 'CV Sinar Abadi',
                    category: 'Pembuatan PO',
                    date: '2026-10-13',
                    priority: 'Rendah',
                    status: 'Menunggu',
                    requester: 'Fajar Nugraha',
                    description: 'Pengajuan PO baru untuk kebutuhan kantor.'
                }
            ];

            const $ = id => document.getElementById(id);
            const pageSize = 5;
            let currentPage = 1;

            const escapeHTML = value => String(value ?? '').replace(/[&<>"']/g, c => ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#39;'
            } [c]));

            const statusClass = status => ({
                Menunggu: 'bg-amber-50 text-amber-700 ring-1 ring-amber-200',
                Diproses: 'bg-violet-50 text-violet-700 ring-1 ring-violet-200',
                Selesai: 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200',
                Ditolak: 'bg-rose-50 text-rose-700 ring-1 ring-rose-200'
            } [status] || 'bg-slate-100 text-slate-600');

            const priorityClass = priority => ({
                Rendah: 'text-slate-500',
                Normal: 'text-blue-600',
                Tinggi: 'text-orange-600',
                Urgent: 'text-rose-600'
            } [priority] || 'text-slate-500');

            const dateFormat = date => new Date(date + 'T00:00:00').toLocaleDateString('id-ID', {
                day: '2-digit',
                month: 'short',
                year: 'numeric'
            });

            function getFiltered() {
                const q = $('searchTicket').value.trim().toLowerCase();
                const status = $('filterStatus').value;

                return tickets.filter(t => {
                    const text = [t.id, t.po, t.supplier, t.category, t.requester].join(' ').toLowerCase();
                    return text.includes(q) && (!status || t.status === status);
                }).sort((a, b) => b.date.localeCompare(a.date));
            }

            function render() {
                const filtered = getFiltered();
                const totalPages = Math.max(1, Math.ceil(filtered.length / pageSize));
                currentPage = Math.min(currentPage, totalPages);

                const start = (currentPage - 1) * pageSize;
                const items = filtered.slice(start, start + pageSize);

                $('ticketTableBody').innerHTML = items.map(t => `
            <tr class="transition hover:bg-slate-50/80">
                <td class="px-6 py-4">
                    <p class="font-semibold text-slate-800">${escapeHTML(t.po)}</p>
                    <p class="mt-1 text-xs text-slate-400">${escapeHTML(t.id)} · ${escapeHTML(t.category)}</p>
                </td>
                <td class="px-6 py-4">
                    <p class="text-sm font-medium text-slate-700">${escapeHTML(t.supplier)}</p>
                    <p class="mt-1 text-xs text-slate-400">${escapeHTML(t.requester)}</p>
                </td>
                <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-500">${dateFormat(t.date)}</td>
                <td class="px-6 py-4">
                    <span class="text-sm font-semibold ${priorityClass(t.priority)}">● ${escapeHTML(t.priority)}</span>
                </td>
                <td class="px-6 py-4">
                    <span class="inline-flex whitespace-nowrap rounded-full px-2.5 py-1 text-xs font-semibold ${statusClass(t.status)}">${escapeHTML(t.status)}</span>
                </td>
                <td class="px-6 py-4">
                    <div class="flex justify-end gap-2">
                        <button type="button" data-detail="${escapeHTML(t.id)}" title="Lihat detail"
                            class="rounded-lg border border-slate-200 p-2 text-slate-500 hover:bg-slate-50">
                            <i data-lucide="eye" class="h-4 w-4"></i>
                        </button>
                        <a href="{{ url('/procurment/ticketing-po/form') }}?edit=${encodeURIComponent(t.id)}"
                            title="Edit tiket" class="rounded-lg border border-emerald-100 p-2 text-emerald-600 hover:bg-emerald-50">
                            <i data-lucide="pencil" class="h-4 w-4"></i>
                        </a>
                    </div>
                </td>
            </tr>
        `).join('');

                $('ticketMobileList').innerHTML = items.map(t => `
            <article class="rounded-xl border border-slate-200 p-4">
                <div class="flex items-start justify-between gap-3">
                    <div class="min-w-0">
                        <h3 class="break-words font-semibold text-slate-800">${escapeHTML(t.po)}</h3>
                        <p class="mt-1 text-xs text-slate-400">${escapeHTML(t.id)}</p>
                    </div>
                    <span class="shrink-0 rounded-full px-2.5 py-1 text-[11px] font-semibold ${statusClass(t.status)}">${escapeHTML(t.status)}</span>
                </div>
                <div class="mt-4 space-y-2 text-sm text-slate-500">
                    <p class="flex items-center gap-2"><i data-lucide="building-2" class="h-4 w-4"></i>${escapeHTML(t.supplier)}</p>
                    <p class="flex items-center gap-2"><i data-lucide="calendar" class="h-4 w-4"></i>${dateFormat(t.date)}</p>
                    <div class="flex items-center justify-between gap-2 border-t border-slate-100 pt-3">
                        <span class="text-xs font-semibold ${priorityClass(t.priority)}">${escapeHTML(t.priority)}</span>
                        <div class="flex gap-2">
                            <button type="button" data-detail="${escapeHTML(t.id)}" class="rounded-lg border border-slate-200 p-2 text-slate-500">
                                <i data-lucide="eye" class="h-4 w-4"></i>
                            </button>
                            <a href="{{ url('/procurment/ticketing-po/form') }}?edit=${encodeURIComponent(t.id)}" class="rounded-lg border border-emerald-100 p-2 text-emerald-600">
                                <i data-lucide="pencil" class="h-4 w-4"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </article>
        `).join('');

                $('emptyState').classList.toggle('hidden', items.length > 0);
                $('ticketTableBody').closest('table').classList.toggle('hidden', items.length === 0);
                $('ticketMobileList').classList.toggle('hidden', items.length === 0);

                $('paginationInfo').textContent = filtered.length ?
                    `Menampilkan ${start + 1}–${Math.min(start + pageSize, filtered.length)} dari ${filtered.length} tiket` :
                    'Tidak ada tiket';

                $('pageInfo').textContent = `${currentPage} / ${totalPages}`;
                $('prevPage').disabled = currentPage <= 1;
                $('nextPage').disabled = currentPage >= totalPages;

                if (window.lucide) lucide.createIcons();
            }

            $('searchTicket').addEventListener('input', () => {
                currentPage = 1;
                render();
            });

            $('filterStatus').addEventListener('change', () => {
                currentPage = 1;
                render();
            });

            $('prevPage').addEventListener('click', () => {
                if (currentPage > 1) {
                    currentPage--;
                    render();
                }
            });

            $('nextPage').addEventListener('click', () => {
                const pages = Math.ceil(getFiltered().length / pageSize);
                if (currentPage < pages) {
                    currentPage++;
                    render();
                }
            });

            // Detail dummy menggunakan dialog browser.
            document.addEventListener('click', event => {
                const button = event.target.closest('[data-detail]');
                if (!button) return;

                const t = tickets.find(item => item.id === button.dataset.detail);
                if (!t) return;

                alert(
                    `Nomor Tiket: ${t.id}\n` +
                    `Nomor PO: ${t.po}\n` +
                    `Supplier: ${t.supplier}\n` +
                    `Kategori: ${t.category}\n` +
                    `Tanggal: ${dateFormat(t.date)}\n` +
                    `Pemohon: ${t.requester}\n` +
                    `Prioritas: ${t.priority}\n` +
                    `Status: ${t.status}\n\n` +
                    `Deskripsi:\n${t.description}`
                );
            });

            render();
        })();
    </script>
@endsection

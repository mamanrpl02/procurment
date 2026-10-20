@extends('layout.procurment')

@section('content')
    <div class="mx-auto max-w-5xl space-y-6">

        {{-- BREADCRUMB --}}
        <div class="flex flex-wrap items-center gap-2 text-xs font-medium text-slate-400">
            <a href="{{ url('/procurment/ticketing-po') }}" class="hover:text-emerald-600">Ticketing PO</a>
            <i data-lucide="chevron-right" class="h-3.5 w-3.5"></i>
            <span id="breadcrumbLabel" class="text-emerald-600">Buat Tiket</span>
        </div>

        {{-- HEADER --}}
        <div>
            <h1 id="pageTitle" class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Buat Tiket PO</h1>
            <p id="pageSubtitle" class="mt-2 text-sm leading-6 text-slate-500">
                Isi informasi berikut untuk mengajukan kebutuhan atau kendala Purchase Order.
            </p>
        </div>

        {{-- DEMO NOTICE --}}
        <div class="flex items-start gap-3 rounded-xl border border-blue-100 bg-blue-50/70 p-4">
            <i data-lucide="info" class="mt-0.5 h-5 w-5 shrink-0 text-blue-600"></i>
            <div>
                <p class="text-sm font-semibold text-blue-900">Mode pratinjau frontend</p>
                <p class="mt-1 text-xs leading-5 text-blue-800">
                    Data pada halaman ini hanya contoh. Pengajuan tidak dikirim ke database.
                </p>
            </div>
        </div>

        <form id="ticketForm" class="space-y-6">

            {{-- INFORMATION --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm">
                <div class="flex items-center gap-3 border-b border-slate-100 px-5 py-5 sm:px-7">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                        <i data-lucide="file-text" class="h-5 w-5"></i>
                    </div>
                    <div>
                        <h2 class="font-bold text-slate-900">Informasi Pengajuan</h2>
                        <p class="mt-1 text-xs text-slate-500">Informasi utama Purchase Order.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-5 p-5 sm:grid-cols-2 sm:p-7">

                    <div>
                        <label for="ticketNumber" class="mb-2 block text-sm font-semibold text-slate-700">Nomor
                            Tiket</label>
                        <input id="ticketNumber" readonly
                            class="w-full cursor-not-allowed rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-500 outline-none"
                            value="TPO-AUTO">
                        <p class="mt-1.5 text-xs text-slate-400">Nomor tiket contoh untuk pratinjau.</p>
                    </div>

                    <div>
                        <label for="poNumber" class="mb-2 block text-sm font-semibold text-slate-700">
                            Nomor PO <span class="text-rose-500">*</span>
                        </label>
                        <input id="poNumber" required maxlength="100" placeholder="Contoh: PO/2026/00128"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition placeholder:text-slate-400 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10">
                    </div>

                    <div>
                        <label for="supplier" class="mb-2 block text-sm font-semibold text-slate-700">
                            Nama Supplier <span class="text-rose-500">*</span>
                        </label>
                        <input id="supplier" required maxlength="150" placeholder="Masukkan nama supplier"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition placeholder:text-slate-400 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10">
                    </div>

                    <div>
                        <label for="category" class="mb-2 block text-sm font-semibold text-slate-700">
                            Kategori Tiket <span class="text-rose-500">*</span>
                        </label>
                        <select id="category" required
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10">
                            <option value="">Pilih kategori</option>
                            <option>Pembuatan PO</option>
                            <option>Revisi PO</option>
                            <option>Pembatalan PO</option>
                            <option>Dokumen PO</option>
                            <option>Kendala Pengiriman</option>
                            <option>Lainnya</option>
                        </select>
                    </div>

                    <div>
                        <label for="priority" class="mb-2 block text-sm font-semibold text-slate-700">
                            Prioritas <span class="text-rose-500">*</span>
                        </label>
                        <select id="priority" required
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10">
                            <option>Normal</option>
                            <option>Rendah</option>
                            <option>Tinggi</option>
                            <option>Urgent</option>
                        </select>
                    </div>

                    <div>
                        <label for="requester" class="mb-2 block text-sm font-semibold text-slate-700">
                            Nama Pemohon <span class="text-rose-500">*</span>
                        </label>
                        <input id="requester" required maxlength="150" placeholder="Nama lengkap pemohon"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition placeholder:text-slate-400 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10">
                    </div>

                    <div>
                        <label for="requestDate" class="mb-2 block text-sm font-semibold text-slate-700">
                            Tanggal Pengajuan <span class="text-rose-500">*</span>
                        </label>
                        <input id="requestDate" type="date" required
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10">
                    </div>
                </div>
            </section>

            {{-- DESCRIPTION --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm">
                <div class="flex items-center gap-3 border-b border-slate-100 px-5 py-5 sm:px-7">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                        <i data-lucide="message-square-text" class="h-5 w-5"></i>
                    </div>
                    <div>
                        <h2 class="font-bold text-slate-900">Detail Permintaan</h2>
                        <p class="mt-1 text-xs text-slate-500">Jelaskan kebutuhan atau kendala yang dialami.</p>
                    </div>
                </div>

                <div class="space-y-5 p-5 sm:p-7">
                    <div>
                        <label for="description" class="mb-2 block text-sm font-semibold text-slate-700">
                            Deskripsi / Kendala <span class="text-rose-500">*</span>
                        </label>
                        <textarea id="description" required maxlength="3000" rows="5"
                            placeholder="Jelaskan detail pengajuan, kendala, atau perubahan yang diperlukan..."
                            class="w-full resize-y rounded-xl border border-slate-200 px-4 py-3 text-sm leading-6 outline-none transition placeholder:text-slate-400 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10"></textarea>

                        <div class="mt-2 flex justify-between gap-3">
                            <p class="text-xs text-slate-400">Tuliskan informasi yang jelas dan lengkap.</p>
                            <p class="shrink-0 text-xs text-slate-400"><span id="descriptionCount">0</span>/3000</p>
                        </div>
                    </div>

                    <div>
                        <label for="attachment" class="mb-2 block text-sm font-semibold text-slate-700">
                            Dokumen Pendukung <span class="font-normal text-slate-400">(opsional)</span>
                        </label>

                        <label for="attachment"
                            class="flex cursor-pointer flex-col items-center justify-center rounded-xl border-2 border-dashed border-slate-200 bg-slate-50/70 px-4 py-8 text-center transition hover:border-emerald-400 hover:bg-emerald-50/50">
                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-xl bg-white text-emerald-600 shadow-sm">
                                <i data-lucide="cloud-upload" class="h-6 w-6"></i>
                            </div>
                            <p class="mt-3 text-sm font-semibold text-slate-700">Klik untuk memilih dokumen</p>
                            <p class="mt-1 text-xs text-slate-400">PDF, JPG, PNG, DOCX · Maksimal 5 MB</p>
                            <p id="attachmentName" class="mt-2 break-all text-xs font-medium text-emerald-700"></p>
                        </label>
                        <input id="attachment" type="file" accept=".pdf,.jpg,.jpeg,.png,.docx" class="hidden">
                    </div>
                </div>
            </section>

            {{-- ACTIONS --}}
            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:items-center sm:justify-between">
                <a href="{{ url('/procurment/ticketing-po') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">
                    <i data-lucide="arrow-left" class="h-4 w-4"></i>
                    Kembali ke Daftar
                </a>

                <button type="submit" id="submitButton"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-100">
                    <i data-lucide="send" class="h-4 w-4"></i>
                    <span>Ajukan Tiket PO</span>
                </button>
            </div>
        </form>
    </div>

    {{-- TOAST --}}
    <div id="toast" role="status"
        class="pointer-events-none fixed bottom-5 right-5 z-50 hidden max-w-sm items-center gap-3 rounded-xl bg-slate-900 px-4 py-3 text-sm font-medium text-white shadow-xl">
        <i data-lucide="check-circle-2" class="h-5 w-5 shrink-0 text-emerald-400"></i>
        <span id="toastMessage"></span>
    </div>

    <script>
        (() => {
            const $ = id => document.getElementById(id);

            const dummyTickets = {
                'TPO-00128': {
                    po: 'PO/2026/00128',
                    supplier: 'PT Sumber Makmur',
                    category: 'Revisi PO',
                    priority: 'Tinggi',
                    requester: 'Andi Pratama',
                    date: '2026-10-20',
                    description: 'Permohonan revisi kuantitas barang pada dokumen purchase order.'
                },
                'TPO-00127': {
                    po: 'PO/2026/00127',
                    supplier: 'CV Mitra Sejahtera',
                    category: 'Pembuatan PO',
                    priority: 'Normal',
                    requester: 'Siti Rahmawati',
                    date: '2026-10-20',
                    description: 'Pengajuan pembuatan PO untuk kebutuhan operasional.'
                },
                'TPO-00126': {
                    po: 'PO/2026/00126',
                    supplier: 'PT Teknologi Nusantara',
                    category: 'Dokumen PO',
                    priority: 'Urgent',
                    requester: 'Budi Santoso',
                    date: '2026-10-19',
                    description: 'Dokumen PO perlu segera dilengkapi untuk proses pengadaan.'
                }
            };

            const params = new URLSearchParams(window.location.search);
            const editId = params.get('edit');
            const isEdit = Boolean(editId && dummyTickets[editId]);
            const selectedTicket = isEdit ? dummyTickets[editId] : null;

            function setValue(id, value) {
                $(id).value = value ?? '';
            }

            function showToast(message) {
                $('toastMessage').textContent = message;
                $('toast').classList.remove('hidden');
                $('toast').classList.add('flex');

                window.setTimeout(() => {
                    $('toast').classList.add('hidden');
                    $('toast').classList.remove('flex');
                }, 3000);
            }

            $('requestDate').value = new Date().toLocaleDateString('en-CA');

            if (isEdit) {
                $('pageTitle').textContent = 'Edit Tiket PO';
                $('pageSubtitle').textContent = 'Perbarui informasi pengajuan Purchase Order.';
                $('breadcrumbLabel').textContent = 'Edit Tiket';
                $('submitButton').innerHTML = '<i data-lucide="save" class="h-4 w-4"></i><span>Simpan Perubahan</span>';

                setValue('ticketNumber', editId);
                setValue('poNumber', selectedTicket.po);
                setValue('supplier', selectedTicket.supplier);
                setValue('category', selectedTicket.category);
                setValue('priority', selectedTicket.priority);
                setValue('requester', selectedTicket.requester);
                setValue('requestDate', selectedTicket.date);
                setValue('description', selectedTicket.description);
            } else {
                setValue('ticketNumber', 'TPO-' + String(Date.now()).slice(-6));
            }

            function updateCount() {
                $('descriptionCount').textContent = $('description').value.length;
            }

            $('description').addEventListener('input', updateCount);
            updateCount();

            $('attachment').addEventListener('change', () => {
                const file = $('attachment').files[0];
                $('attachmentName').textContent = '';

                if (!file) return;

                const validExtension = /\.(pdf|jpe?g|png|docx)$/i.test(file.name);
                const validSize = file.size <= 5 * 1024 * 1024;

                if (!validExtension || !validSize) {
                    alert('Pilih file PDF, JPG, PNG, atau DOCX maksimal 5 MB.');
                    $('attachment').value = '';
                    return;
                }

                $('attachmentName').textContent = file.name;
            });

            $('ticketForm').addEventListener('submit', event => {
                event.preventDefault();

                if (!$('ticketForm').reportValidity()) return;

                showToast(isEdit ?
                    'Simulasi edit berhasil. Data belum disimpan.' :
                    'Simulasi pengajuan berhasil. Data belum disimpan.');

                // Tidak ada request server dan tidak ada penyimpanan database.
            });

            if (window.lucide) lucide.createIcons();
        })();
    </script>
@endsection

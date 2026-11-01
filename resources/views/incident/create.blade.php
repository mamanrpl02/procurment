
@extends('layout.appLayoutMain')

@section('content')
<div class="mx-auto max-w-5xl space-y-6">

    {{-- Page Header --}}
    <div>
        <a href="{{ url('/incidents') }}"
            class="mb-4 inline-flex items-center gap-2 text-sm font-medium text-slate-500 transition hover:text-app-green">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m15 18-6-6 6-6" />
            </svg>
            Back to Incidents
        </a>

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-slate-900">Create Incident</h1>
                <p class="mt-1 text-sm text-slate-500">
                    Isi informasi incident untuk membuat tiket baru.
                </p>
            </div>

            <span class="inline-flex w-fit items-center gap-2 rounded-full border border-blue-100 bg-blue-50 px-3 py-1.5 text-xs font-medium text-blue-700">
                <span class="h-2 w-2 rounded-full bg-blue-500"></span>
                New Incident
            </span>
        </div>
    </div>

    {{-- Form --}}
    <form id="incidentForm" class="space-y-6">

        {{-- Incident Information --}}
        <section class="overflow-hidden rounded-2xl border border-app-border bg-white">
            <div class="border-b border-app-border px-5 py-4 sm:px-6">
                <div class="flex items-center gap-3">
                    <div class="rounded-xl bg-green-50 p-2 text-app-green">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5l5 5v11a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-semibold text-slate-900">Incident Information</h2>
                        <p class="mt-0.5 text-sm text-slate-500">Informasi utama tiket incident.</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-5 p-5 sm:grid-cols-2 sm:p-6">

                <div>
                    <label for="number" class="mb-2 block text-sm font-medium text-slate-700">
                        Incident Number
                    </label>
                    <input id="number" type="text" value="Auto-generated" disabled
                        class="w-full rounded-xl border border-app-border bg-slate-50 px-3.5 py-2.5 text-sm text-slate-400 outline-none">
                    <p class="mt-1.5 text-xs text-slate-400">Nomor akan dibuat otomatis.</p>
                </div>

                <div>
                    <label for="reportedFor" class="mb-2 block text-sm font-medium text-slate-700">
                        Reported For <span class="text-red-500">*</span>
                    </label>
                    <input id="reportedFor" name="reported_for" type="text"
                        placeholder="Masukkan nama pelapor" required
                        class="w-full rounded-xl border border-app-border px-3.5 py-2.5 text-sm outline-none transition placeholder:text-slate-400 focus:border-app-green focus:ring-2 focus:ring-green-100">
                </div>

                <div class="sm:col-span-2">
                    <label for="shortDescription" class="mb-2 block text-sm font-medium text-slate-700">
                        Short Description <span class="text-red-500">*</span>
                    </label>
                    <input id="shortDescription" name="short_description" type="text"
                        placeholder="Contoh: Email Outlook tidak bisa diakses" maxlength="160" required
                        class="w-full rounded-xl border border-app-border px-3.5 py-2.5 text-sm outline-none transition placeholder:text-slate-400 focus:border-app-green focus:ring-2 focus:ring-green-100">
                    <div class="mt-1.5 flex justify-between gap-3">
                        <p class="text-xs text-slate-400">Jelaskan masalah secara singkat.</p>
                        <p id="descriptionCounter" class="shrink-0 text-xs text-slate-400">0/160</p>
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="description" class="mb-2 block text-sm font-medium text-slate-700">
                        Description
                    </label>
                    <textarea id="description" name="description" rows="4"
                        placeholder="Jelaskan detail kendala, pesan error, atau kronologi kejadian..."
                        class="w-full resize-y rounded-xl border border-app-border px-3.5 py-3 text-sm outline-none transition placeholder:text-slate-400 focus:border-app-green focus:ring-2 focus:ring-green-100"></textarea>
                </div>

            </div>
        </section>

        {{-- Classification --}}
        <section class="overflow-hidden rounded-2xl border border-app-border bg-white">
            <div class="border-b border-app-border px-5 py-4 sm:px-6">
                <div class="flex items-center gap-3">
                    <div class="rounded-xl bg-amber-50 p-2 text-amber-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M4 6h16M4 12h10M4 18h7" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-semibold text-slate-900">Classification</h2>
                        <p class="mt-0.5 text-sm text-slate-500">Kategori, dampak, urgensi, dan prioritas.</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-5 p-5 sm:grid-cols-2 sm:p-6">

                <div>
                    <label for="category" class="mb-2 block text-sm font-medium text-slate-700">
                        Category <span class="text-red-500">*</span>
                    </label>
                    <select id="category" name="category" required
                        class="w-full rounded-xl border border-app-border bg-white px-3.5 py-2.5 text-sm text-slate-700 outline-none focus:border-app-green focus:ring-2 focus:ring-green-100">
                        <option value="">Select category</option>
                        <option>Application</option>
                        <option>Hardware</option>
                        <option>Network</option>
                        <option>Server</option>
                        <option>Software</option>
                        <option>Other</option>
                    </select>
                </div>

                <div>
                    <label for="subcategory" class="mb-2 block text-sm font-medium text-slate-700">
                        Subcategory
                    </label>
                    <select id="subcategory" name="subcategory"
                        class="w-full rounded-xl border border-app-border bg-white px-3.5 py-2.5 text-sm text-slate-700 outline-none focus:border-app-green focus:ring-2 focus:ring-green-100">
                        <option value="">Select subcategory</option>
                        <option>Email</option>
                        <option>Operating System</option>
                        <option>Connectivity</option>
                        <option>Printer</option>
                        <option>Database</option>
                    </select>
                </div>

                <div>
                    <label for="impact" class="mb-2 block text-sm font-medium text-slate-700">
                        Impact <span class="text-red-500">*</span>
                    </label>
                    <select id="impact" name="impact" required
                        class="w-full rounded-xl border border-app-border bg-white px-3.5 py-2.5 text-sm outline-none focus:border-app-green focus:ring-2 focus:ring-green-100">
                        <option value="">Select impact</option>
                        <option value="1">1 - High</option>
                        <option value="2">2 - Medium</option>
                        <option value="3">3 - Low</option>
                    </select>
                </div>

                <div>
                    <label for="urgency" class="mb-2 block text-sm font-medium text-slate-700">
                        Urgency <span class="text-red-500">*</span>
                    </label>
                    <select id="urgency" name="urgency" required
                        class="w-full rounded-xl border border-app-border bg-white px-3.5 py-2.5 text-sm outline-none focus:border-app-green focus:ring-2 focus:ring-green-100">
                        <option value="">Select urgency</option>
                        <option value="1">1 - High</option>
                        <option value="2">2 - Medium</option>
                        <option value="3">3 - Low</option>
                    </select>
                </div>

                <div class="sm:col-span-2">
                    <label for="priority" class="mb-2 block text-sm font-medium text-slate-700">
                        Priority
                    </label>
                    <input id="priority" type="text" value="Set after impact and urgency are selected"
                        readonly
                        class="w-full rounded-xl border border-app-border bg-slate-50 px-3.5 py-2.5 text-sm text-slate-500 outline-none">
                    <p class="mt-1.5 text-xs text-slate-400">
                        Untuk UI ini, prioritas dihitung otomatis berdasarkan impact dan urgency.
                    </p>
                </div>

            </div>
        </section>

        {{-- Assignment --}}
        <section class="overflow-hidden rounded-2xl border border-app-border bg-white">
            <div class="border-b border-app-border px-5 py-4 sm:px-6">
                <div class="flex items-center gap-3">
                    <div class="rounded-xl bg-blue-50 p-2 text-blue-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M17 20h5v-2a3 3 0 00-5.2-2M17 20H7m10 0v-2c0-.7-.2-1.4-.6-2M7 20H2v-2a3 3 0 015.2-2M7 20v-2c0-.7.2-1.4.6-2m0 0a5 5 0 019.8 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-semibold text-slate-900">Assignment</h2>
                        <p class="mt-0.5 text-sm text-slate-500">Tim dan petugas yang menangani incident.</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-5 p-5 sm:grid-cols-2 sm:p-6">

                <div>
                    <label for="assignmentGroup" class="mb-2 block text-sm font-medium text-slate-700">
                        Assignment Group
                    </label>
                    <select id="assignmentGroup" name="assignment_group"
                        class="w-full rounded-xl border border-app-border bg-white px-3.5 py-2.5 text-sm outline-none focus:border-app-green focus:ring-2 focus:ring-green-100">
                        <option value="">Select assignment group</option>
                        <option>Service Desk</option>
                        <option>Application Support</option>
                        <option>IT Infrastructure</option>
                        <option>Network Support</option>
                        <option>Database Administration</option>
                    </select>
                </div>

                <div>
                    <label for="assignedTo" class="mb-2 block text-sm font-medium text-slate-700">
                        Assigned To
                    </label>
                    <select id="assignedTo" name="assigned_to"
                        class="w-full rounded-xl border border-app-border bg-white px-3.5 py-2.5 text-sm outline-none focus:border-app-green focus:ring-2 focus:ring-green-100">
                        <option value="">Select assignee</option>
                        <option>Budi Santoso</option>
                        <option>Dimas Saputra</option>
                        <option>Rina Putri</option>
                    </select>
                    <p class="mt-1.5 text-xs text-slate-400">
                        Contoh data statis untuk desain UI.
                    </p>
                </div>

            </div>
        </section>

        {{-- Additional Information --}}
        <section class="overflow-hidden rounded-2xl border border-app-border bg-white">
            <div class="border-b border-app-border px-5 py-4 sm:px-6">
                <div class="flex items-center gap-3">
                    <div class="rounded-xl bg-purple-50 p-2 text-purple-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M15.2 3.8a2.1 2.1 0 013 3L8 17l-4 1 1-4L15.2 3.8z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-semibold text-slate-900">Additional Information</h2>
                        <p class="mt-0.5 text-sm text-slate-500">Informasi pendukung incident.</p>
                    </div>
                </div>
            </div>

            <div class="space-y-5 p-5 sm:p-6">
                <div>
                    <label for="attachment" class="mb-2 block text-sm font-medium text-slate-700">
                        Attachment
                    </label>
                    <label for="attachment"
                        class="flex cursor-pointer flex-col items-center justify-center rounded-xl border-2 border-dashed border-app-border px-4 py-8 text-center transition hover:border-app-green hover:bg-green-50/30">
                        <svg class="mb-3 h-8 w-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M12 16V4m0 0L7 9m5-5l5 5M5 14v5a1 1 0 001 1h12a1 1 0 001-1v-5" />
                        </svg>
                        <span class="text-sm font-medium text-slate-700">Click to upload a file</span>
                        <span class="mt-1 text-xs text-slate-400">PNG, JPG, PDF (UI preview only)</span>
                        <input id="attachment" name="attachment" type="file" class="hidden"
                            accept=".png,.jpg,.jpeg,.pdf">
                    </label>
                    <p id="fileName" class="mt-2 text-sm text-slate-500"></p>
                </div>

                <div>
                    <label for="workNotes" class="mb-2 block text-sm font-medium text-slate-700">
                        Work Notes
                    </label>
                    <textarea id="workNotes" name="work_notes" rows="3"
                        placeholder="Catatan internal untuk tim support..."
                        class="w-full resize-y rounded-xl border border-app-border px-3.5 py-3 text-sm outline-none transition placeholder:text-slate-400 focus:border-app-green focus:ring-2 focus:ring-green-100"></textarea>
                </div>
            </div>
        </section>

        {{-- Form Actions --}}
        <div class="sticky bottom-0 z-10 -mx-4 border-t border-app-border bg-white/95 px-4 py-4 backdrop-blur sm:-mx-6 sm:px-6 lg:static lg:mx-0 lg:rounded-2xl lg:border lg:px-6">
            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                <a href="{{ url('/incidents') }}"
                    class="inline-flex items-center justify-center rounded-xl border border-app-border bg-white px-5 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50">
                    Cancel
                </a>

                <button type="reset"
                    class="inline-flex items-center justify-center rounded-xl border border-app-border bg-white px-5 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50">
                    Reset Form
                </button>

                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-app-green px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-green-800">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13l4 4L19 7" />
                    </svg>
                    Create Incident
                </button>
            </div>
        </div>

    </form>
</div>

{{-- Interaksi UI saja, belum menyimpan data --}}
<script>
    const incidentForm = document.getElementById('incidentForm');
    const shortDescription = document.getElementById('shortDescription');
    const descriptionCounter = document.getElementById('descriptionCounter');
    const attachment = document.getElementById('attachment');
    const fileName = document.getElementById('fileName');

    const impact = document.getElementById('impact');
    const urgency = document.getElementById('urgency');
    const priority = document.getElementById('priority');

    shortDescription.addEventListener('input', () => {
        descriptionCounter.textContent = `${shortDescription.value.length}/160`;
    });

    attachment.addEventListener('change', () => {
        fileName.textContent = attachment.files.length
            ? `Selected file: ${attachment.files[0].name}`
            : '';
    });

    function calculatePriority() {
        if (!impact.value || !urgency.value) {
            priority.value = 'Set after impact and urgency are selected';
            return;
        }

        // Matriks contoh untuk UI. Nanti sesuaikan dengan aturan sistem.
        const matrix = {
            '1-1': 'P1 - Critical',
            '1-2': 'P2 - High',
            '1-3': 'P3 - Medium',
            '2-1': 'P2 - High',
            '2-2': 'P3 - Medium',
            '2-3': 'P4 - Low',
            '3-1': 'P3 - Medium',
            '3-2': 'P4 - Low',
            '3-3': 'P4 - Low'
        };

        priority.value = matrix[`${impact.value}-${urgency.value}`];
    }

    impact.addEventListener('change', calculatePriority);
    urgency.addEventListener('change', calculatePriority);

    incidentForm.addEventListener('submit', (event) => {
        event.preventDefault();
        alert('UI demo: data belum disimpan karena backend belum dibuat.');
    });
</script>
@endsection

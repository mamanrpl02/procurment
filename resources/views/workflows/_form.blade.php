
@php
    $isEdit = isset($workflow) && $workflow;
    $selectedTable = old('sys_id_r_tables', $workflow->sys_id_r_tables ?? '');

    $initialConditions = old('conditions',
        $isEdit
            ? $workflow->conditions->map(fn ($item) => [
                'sys_id_r_fields' => $item->sys_id_r_fields,
                'operator' => $item->operator,
                'condition_value' => $item->condition_value,
                'logical_operator' => $item->logical_operator,
            ])->values()->all()
            : []
    );

    $initialActions = old('actions',
        $isEdit
            ? $workflow->actions->map(fn ($item) => [
                'sys_id_r_fields' => $item->sys_id_r_fields,
                'action_value' => $item->action_value,
            ])->values()->all()
            : [['sys_id_r_fields' => '', 'action_value' => '']]
    );
@endphp

<form method="POST"
    action="{{ $isEdit ? route('workflows.update', $workflow) : route('workflows.store') }}"
    class="space-y-6">

    @csrf
    @if($isEdit)
        @method('PUT')
    @endif

    @if($errors->any())
        <div class="rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
            <p class="mb-2 font-semibold">Ada data yang perlu diperbaiki:</p>
            <ul class="list-inside list-disc space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Informasi Workflow -->
    <section class="space-y-4">
        <div>
            <h3 class="text-sm font-semibold text-slate-900">Informasi Workflow</h3>
            <p class="mt-1 text-xs text-slate-500">
                Tentukan nama dan transaksi yang akan menggunakan aturan ini.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <div class="md:col-span-2">
                <label class="mb-1.5 block text-sm font-medium text-slate-700">
                    Nama Workflow <span class="text-red-500">*</span>
                </label>
                <input type="text"
                    name="workflow_name"
                    value="{{ old('workflow_name', $workflow->workflow_name ?? '') }}"
                    placeholder="Contoh: Otomatisasi Status Purchase Order"
                    required
                    class="w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm outline-none focus:border-green-600 focus:ring-2 focus:ring-green-100">
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-medium text-slate-700">
                    Untuk Transaksi <span class="text-red-500">*</span>
                </label>
                <select name="sys_id_r_tables"
                    id="workflow-table"
                    required
                    class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2.5 text-sm outline-none focus:border-green-600 focus:ring-2 focus:ring-green-100">
                    <option value="">Pilih transaksi</option>
                    @foreach($tables as $table)
                        <option value="{{ $table->getKey() }}"
                            @selected((string) $selectedTable === (string) $table->getKey())>
                            {{ $table->table_label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-medium text-slate-700">
                    Grouping Workflow <span class="text-red-500">*</span>
                </label>
                <select name="sys_id_r_workflow_groups"
                    id="workflow-group"
                    required
                    data-selected="{{ old('sys_id_r_workflow_groups', $workflow->sys_id_r_workflow_groups ?? '') }}"
                    class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2.5 text-sm outline-none focus:border-green-600 focus:ring-2 focus:ring-green-100">
                    <option value="">Pilih grouping</option>
                </select>
                <p class="mt-1 text-xs text-slate-400">
                    Grouping akan mengikuti transaksi yang dipilih.
                </p>
            </div>

            <div class="md:col-span-2">
                <label class="mb-1.5 block text-sm font-medium text-slate-700">
                    Deskripsi
                </label>
                <textarea name="description"
                    rows="3"
                    placeholder="Jelaskan fungsi workflow ini..."
                    class="w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm outline-none focus:border-green-600 focus:ring-2 focus:ring-green-100">{{ old('description', $workflow->description ?? '') }}</textarea>
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-medium text-slate-700">
                    Status
                </label>
                <select name="is_active"
                    class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2.5 text-sm outline-none focus:border-green-600">
                    <option value="1" @selected((string) old('is_active', $workflow->is_active ?? 1) === '1')>
                        Active
                    </option>
                    <option value="0" @selected((string) old('is_active', $workflow->is_active ?? 1) === '0')>
                        Inactive
                    </option>
                </select>
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-medium text-slate-700">
                    Jenis Aturan
                </label>
                <div class="rounded-lg border border-green-200 bg-green-50 px-3 py-2.5">
                    <div class="text-sm font-semibold text-green-800">Set Value</div>
                    <p class="mt-1 text-xs text-green-700">
                        Mengisi nilai field secara otomatis berdasarkan kondisi.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <div class="border-t border-slate-100"></div>

    <!-- Conditions -->
    <section class="space-y-4">
        <div class="flex items-start justify-between gap-3">
            <div>
                <h3 class="text-sm font-semibold text-slate-900">Atur Kondisi</h3>
                <p class="mt-1 text-xs text-slate-500">
                    Tentukan kapan aturan otomatis ini dijalankan.
                </p>
            </div>

            <button type="button"
                id="add-condition"
                class="shrink-0 rounded-lg border border-slate-200 px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50">
                + Tambah Kondisi
            </button>
        </div>

        <div id="conditions-container" class="space-y-3"></div>

        <p class="text-xs text-slate-400">
            Kondisi dapat dikosongkan jika aturan ingin dijalankan setiap kali transaksi disimpan.
        </p>
    </section>

    <div class="border-t border-slate-100"></div>

    <!-- Actions -->
    <section class="space-y-4">
        <div class="flex items-start justify-between gap-3">
            <div>
                <h3 class="text-sm font-semibold text-slate-900">Atur Tindakan</h3>
                <p class="mt-1 text-xs text-slate-500">
                    Tentukan field yang akan diisi ketika kondisi terpenuhi.
                </p>
            </div>

            <button type="button"
                id="add-action"
                class="shrink-0 rounded-lg border border-slate-200 px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50">
                + Tambah Tindakan
            </button>
        </div>

        <div id="actions-container" class="space-y-3"></div>
    </section>

    <div class="flex flex-col-reverse gap-2 border-t border-slate-100 pt-5 sm:flex-row sm:justify-end">
        <a href="{{ route('workflows.index') }}"
            class="rounded-lg border border-slate-200 px-5 py-2.5 text-center text-sm font-semibold text-slate-600 hover:bg-slate-50">
            Batal
        </a>

        <button type="submit"
            class="rounded-lg bg-green-700 px-5 py-2.5 text-sm font-semibold text-white hover:bg-green-800">
            {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Workflow' }}
        </button>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const tableSelect = document.getElementById('workflow-table');
    const groupSelect = document.getElementById('workflow-group');
    const conditionsContainer = document.getElementById('conditions-container');
    const actionsContainer = document.getElementById('actions-container');

    const initialConditions = @json($initialConditions);
    const initialActions = @json($initialActions);

    let conditionFields = [];
    let actionFields = [];

    const optionsUrlTemplate = @json(route('workflows.options', ['table' => '__TABLE__']));

    function makeSelect(name, items, selected, placeholder) {
        const select = document.createElement('select');
        select.name = name;
        select.required = true;
        select.className = 'w-full rounded-lg border border-slate-200 bg-white px-3 py-2.5 text-sm outline-none focus:border-green-600';

        const first = document.createElement('option');
        first.value = '';
        first.textContent = placeholder;
        select.appendChild(first);

        items.forEach(item => {
            const option = document.createElement('option');
            option.value = item.id;
            option.textContent = item.name;
            option.selected = String(item.id) === String(selected);
            select.appendChild(option);
        });

        return select;
    }

    function makeInput(name, value, placeholder, type = 'text') {
        const input = document.createElement('input');
        input.type = type;
        input.name = name;
        input.value = value ?? '';
        input.placeholder = placeholder;
        input.required = true;
        input.className = 'w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm outline-none focus:border-green-600';
        return input;
    }

    function makeOperatorSelect(name, selected) {
        const operators = [
            ['equals', 'Sama dengan'],
            ['not_equals', 'Tidak sama dengan'],
            ['greater_than', 'Lebih besar dari'],
            ['less_than', 'Lebih kecil dari'],
            ['greater_than_or_equal', 'Lebih besar atau sama dengan'],
            ['less_than_or_equal', 'Lebih kecil atau sama dengan'],
            ['is_empty', 'Kosong'],
            ['is_not_empty', 'Tidak kosong'],
        ];

        const select = document.createElement('select');
        select.name = name;
        select.required = true;
        select.className = 'w-full rounded-lg border border-slate-200 bg-white px-3 py-2.5 text-sm outline-none focus:border-green-600';

        operators.forEach(([value, label]) => {
            const option = document.createElement('option');
            option.value = value;
            option.textContent = label;
            option.selected = value === selected;
            select.appendChild(option);
        });

        return select;
    }

    function makeLogicalSelect(name, selected) {
        const select = document.createElement('select');
        select.name = name;
        select.className = 'w-full rounded-lg border border-slate-200 bg-white px-3 py-2.5 text-sm outline-none';

        [
            ['AND', 'Dan (AND)'],
            ['OR', 'Atau (OR)'],
        ].forEach(([value, label]) => {
            const option = document.createElement('option');
            option.value = value;
            option.textContent = label;
            option.selected = value === selected;
            select.appendChild(option);
        });

        return select;
    }

    function makeLabel(text) {
        const label = document.createElement('label');
        label.textContent = text;
        label.className = 'mb-1.5 block text-xs font-medium text-slate-600';
        return label;
    }

    function makeColumn(labelText, element) {
        const wrapper = document.createElement('div');
        wrapper.appendChild(makeLabel(labelText));
        wrapper.appendChild(element);
        return wrapper;
    }

    function updateConditionValue(row) {
        const operator = row.querySelector('.condition-operator');
        const valueInput = row.querySelector('.condition-value');

        const noValue = ['is_empty', 'is_not_empty'].includes(operator.value);

        valueInput.disabled = noValue;
        valueInput.required = !noValue;
        valueInput.placeholder = noValue ? 'Tidak memerlukan nilai' : 'Masukkan nilai';
        valueInput.classList.toggle('bg-slate-100', noValue);
    }

    function addCondition(data = {}) {
        const index = conditionsContainer.children.length;
        const row = document.createElement('div');
        row.className = 'condition-row rounded-xl border border-slate-200 bg-slate-50 p-4 space-y-3';

        const top = document.createElement('div');
        top.className = 'flex items-center justify-between';

        const title = document.createElement('span');
        title.className = 'text-xs font-semibold text-slate-700';
        title.textContent = 'Kondisi ' + (index + 1);

        const remove = document.createElement('button');
        remove.type = 'button';
        remove.textContent = 'Hapus';
        remove.className = 'text-xs font-medium text-red-600 hover:text-red-700';
        remove.addEventListener('click', () => {
            row.remove();
            renumberConditions();
        });

        top.append(title, remove);

        const grid = document.createElement('div');
        grid.className = 'grid grid-cols-1 gap-3 md:grid-cols-2';

        const fieldSelect = makeSelect(
            `conditions[${index}][sys_id_r_fields]`,
            conditionFields,
            data.sys_id_r_fields,
            'Pilih field'
        );

        const operatorSelect = makeOperatorSelect(
            `conditions[${index}][operator]`,
            data.operator || 'equals'
        );
        operatorSelect.classList.add('condition-operator');

        const valueInput = makeInput(
            `conditions[${index}][condition_value]`,
            data.condition_value,
            'Masukkan nilai'
        );
        valueInput.classList.add('condition-value');

        const logicalSelect = makeLogicalSelect(
            `conditions[${index}][logical_operator]`,
            data.logical_operator || 'AND'
        );

        grid.append(
            makeColumn('Field yang diperiksa', fieldSelect),
            makeColumn('Kondisi', operatorSelect),
            makeColumn('Nilai pembanding', valueInput),
            makeColumn('Penghubung kondisi', logicalSelect)
        );

        operatorSelect.addEventListener('change', () => updateConditionValue(row));

        row.append(top, grid);
        conditionsContainer.appendChild(row);

        updateConditionValue(row);
    }

    function renumberConditions() {
        [...conditionsContainer.children].forEach((row, index) => {
            row.querySelector('span').textContent = 'Kondisi ' + (index + 1);

            row.querySelectorAll('select, input').forEach(input => {
                input.name = input.name.replace(
                    /conditions\[\d+\]/,
                    `conditions[${index}]`
                );
            });
        });
    }

    function addAction(data = {}) {
        const index = actionsContainer.children.length;
        const row = document.createElement('div');
        row.className = 'action-row rounded-xl border border-slate-200 bg-slate-50 p-4';

        const top = document.createElement('div');
        top.className = 'mb-3 flex items-center justify-between';

        const title = document.createElement('span');
        title.className = 'text-xs font-semibold text-slate-700';
        title.textContent = 'Tindakan ' + (index + 1);

        const remove = document.createElement('button');
        remove.type = 'button';
        remove.textContent = 'Hapus';
        remove.className = 'text-xs font-medium text-red-600 hover:text-red-700';
        remove.addEventListener('click', () => {
            if (actionsContainer.children.length <= 1) {
                alert('Minimal harus ada satu tindakan.');
                return;
            }

            row.remove();
            renumberActions();
        });

        top.append(title, remove);

        const grid = document.createElement('div');
        grid.className = 'grid grid-cols-1 gap-3 md:grid-cols-2';

        const fieldSelect = makeSelect(
            `actions[${index}][sys_id_r_fields]`,
            actionFields,
            data.sys_id_r_fields,
            'Pilih field tujuan'
        );

        const valueInput = makeInput(
            `actions[${index}][action_value]`,
            data.action_value,
            'Masukkan nilai yang akan diisi'
        );

        grid.append(
            makeColumn('Isi field', fieldSelect),
            makeColumn('Dengan nilai', valueInput)
        );

        row.append(top, grid);
        actionsContainer.appendChild(row);
    }

    function renumberActions() {
        [...actionsContainer.children].forEach((row, index) => {
            row.querySelector('span').textContent = 'Tindakan ' + (index + 1);

            row.querySelectorAll('select, input').forEach(input => {
                input.name = input.name.replace(
                    /actions\[\d+\]/,
                    `actions[${index}]`
                );
            });
        });
    }

    async function loadTableOptions(tableId) {
        groupSelect.innerHTML = '<option value="">Memuat grouping...</option>';
        groupSelect.disabled = true;
        conditionsContainer.innerHTML = '';
        actionsContainer.innerHTML = '';

        conditionFields = [];
        actionFields = [];

        if (!tableId) {
            groupSelect.innerHTML = '<option value="">Pilih transaksi terlebih dahulu</option>';
            return;
        }

        try {
            const url = optionsUrlTemplate.replace('__TABLE__', encodeURIComponent(tableId));
            const response = await fetch(url, {
                headers: { 'Accept': 'application/json' }
            });

            if (!response.ok) {
                throw new Error('Gagal mengambil konfigurasi transaksi.');
            }

            const data = await response.json();

            groupSelect.innerHTML = '<option value="">Pilih grouping</option>';

            data.groups.forEach(group => {
                const option = document.createElement('option');
                option.value = group.id;
                option.textContent = group.name;
                groupSelect.appendChild(option);
            });

            groupSelect.disabled = false;

            conditionFields = data.condition_fields;
            actionFields = data.action_fields;

            if (data.groups.length === 0) {
                groupSelect.innerHTML = '<option value="">Belum ada grouping untuk transaksi ini</option>';
                groupSelect.disabled = true;
            }

            if (conditionFields.length === 0) {
                const info = document.createElement('p');
                info.className = 'text-xs text-amber-600';
                info.textContent = 'Belum ada field yang diizinkan sebagai kondisi pada Setting Field.';
                conditionsContainer.appendChild(info);
            }

            if (actionFields.length === 0) {
                const info = document.createElement('p');
                info.className = 'text-xs text-amber-600';
                info.textContent = 'Belum ada field yang diizinkan sebagai tindakan pada Setting Field.';
                actionsContainer.appendChild(info);
            }

            initialConditions.forEach(condition => addCondition(condition));

            initialActions.forEach(action => addAction(action));

            if (actionsContainer.children.length === 0 && actionFields.length > 0) {
                addAction();
            }

            groupSelect.value = groupSelect.dataset.selected || '';
            groupSelect.dataset.selected = '';
        } catch (error) {
            groupSelect.innerHTML = '<option value="">Gagal memuat grouping</option>';
            console.error(error);
            alert('Tidak dapat memuat pilihan transaksi. Silakan coba lagi.');
        }
    }

    document.getElementById('add-condition').addEventListener('click', () => {
        if (conditionFields.length === 0) {
            alert('Belum ada field kondisi yang tersedia. Periksa Setting Field.');
            return;
        }
        addCondition();
    });

    document.getElementById('add-action').addEventListener('click', () => {
        if (actionFields.length === 0) {
            alert('Belum ada field tindakan yang tersedia. Periksa Setting Field.');
            return;
        }
        addAction();
    });

    tableSelect.addEventListener('change', function () {
        groupSelect.dataset.selected = '';
        initialConditions.length = 0;
        initialActions.length = 0;
        loadTableOptions(this.value);
    });

    if (tableSelect.value) {
        loadTableOptions(tableSelect.value);
    }
});
</script>

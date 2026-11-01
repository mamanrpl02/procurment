
@php
    $isEdit = isset($rField);
@endphp

<form method="POST"
      action="{{ $isEdit ? route('r-fields.update', $rField) : route('r-fields.store') }}"
      class="space-y-5">
    @csrf
    @if($isEdit)
        @method('PUT')
    @endif

    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700">Tabel Induk *</label>
        <select id="fieldTable" name="sys_id_r_tables" required
                class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm">
            <option value="">Pilih tabel</option>
            @foreach($tables as $table)
                <option value="{{ $table->getKey() }}"
                    @selected((string) old('sys_id_r_tables', $rField->sys_id_r_tables ?? '') === (string) $table->getKey())>
                    {{ $table->table_label }} ({{ $table->table_name }})
                </option>
            @endforeach
        </select>
        @error('sys_id_r_tables') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700">Nama Field Fisik *</label>
        <select id="fieldName" name="field_name" required
                class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm">
            <option value="">Pilih tabel terlebih dahulu</option>
        </select>
        <p class="mt-1 text-xs text-gray-500">Pilihan diambil dari kolom fisik tabel.</p>
        @error('field_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700">Label Field *</label>
        <input name="field_label" required
               value="{{ old('field_label', $rField->field_label ?? '') }}"
               placeholder="Contoh: Status PO"
               class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm">
        @error('field_label') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700">Tipe Field *</label>
        <select name="field_type" required
                class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm">
            @foreach($fieldTypes as $value => $label)
                <option value="{{ $value }}"
                    @selected(old('field_type', $rField->field_type ?? 'string') === $value)>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="space-y-3 rounded-lg border border-gray-200 p-4">
        <p class="text-sm font-semibold text-gray-800">Penggunaan Field</p>

        @foreach([
            'is_condition_allowed' => 'Boleh digunakan sebagai kondisi',
            'is_action_allowed' => 'Boleh diubah melalui action',
            'is_active' => 'Field aktif',
        ] as $name => $label)
            <label class="flex items-center gap-3 text-sm text-gray-700">
                <input type="hidden" name="{{ $name }}" value="0">
                <input type="checkbox" name="{{ $name }}" value="1"
                    @checked((bool) old($name, $rField->$name ?? true))
                    class="rounded border-gray-300 text-green-700">
                {{ $label }}
            </label>
        @endforeach
    </div>

    <div class="flex flex-col-reverse gap-3 border-t pt-5 sm:flex-row sm:justify-end">
        <a href="{{ route('r-fields.index') }}"
           class="rounded-lg border border-gray-300 px-4 py-2.5 text-center text-sm">Batal</a>
        <button class="rounded-lg bg-green-700 px-5 py-2.5 text-sm font-semibold text-white">
            {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Field' }}
        </button>
    </div>
</form>

<script>
    const columnsByTable = @json($columnsByTable);
    const tableSelect = document.getElementById('fieldTable');
    const fieldSelect = document.getElementById('fieldName');

    const initialField = @json(old('field_name', $rField->field_name ?? ''));

    function updateFieldOptions(selected = '') {
        const columns = columnsByTable[tableSelect.value] || [];

        fieldSelect.innerHTML = '<option value="">Pilih field</option>';

        columns.forEach(column => {
            const option = document.createElement('option');
            option.value = column;
            option.textContent = column;
            option.selected = column === selected;
            fieldSelect.appendChild(option);
        });
    }

    tableSelect.addEventListener('change', () => updateFieldOptions());
    updateFieldOptions(initialField);
</script>

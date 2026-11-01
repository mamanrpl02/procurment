
@php
    $isEdit = isset($rTable);
@endphp

<form method="POST"
      action="{{ $isEdit ? route('r-tables.update', $rTable) : route('r-tables.store') }}"
      class="space-y-5">
    @csrf
    @if($isEdit)
        @method('PUT')
    @endif

    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700">Nama Tabel *</label>
        <select name="table_name" required
                class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm">
            <option value="">Pilih tabel transaksi</option>
            @foreach($availableTables as $name)
                <option value="{{ $name }}"
                    @selected(old('table_name', $rTable->table_name ?? '') === $name)>
                    {{ $name }}
                </option>
            @endforeach
        </select>
        <p class="mt-1 text-xs text-gray-500">
            Pilihan diambil dari tabel fisik database dengan prefix tr_.
        </p>
        @error('table_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700">Label Tabel *</label>
        <input name="table_label" required
               value="{{ old('table_label', $rTable->table_label ?? '') }}"
               placeholder="Contoh: Purchase Order"
               class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm">
        @error('table_label') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700">Deskripsi</label>
        <textarea name="description" rows="3"
                  class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm">{{ old('description', $rTable->description ?? '') }}</textarea>
        @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700">Status *</label>
        <select name="is_active" required
                class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm">
            <option value="1" @selected((string) old('is_active', isset($rTable) ? (int) $rTable->is_active : 1) === '1')>Aktif</option>
            <option value="0" @selected((string) old('is_active', isset($rTable) ? (int) $rTable->is_active : 1) === '0')>Nonaktif</option>
        </select>
    </div>

    <div class="flex flex-col-reverse gap-3 border-t pt-5 sm:flex-row sm:justify-end">
        <a href="{{ route('r-tables.index') }}"
           class="rounded-lg border border-gray-300 px-4 py-2.5 text-center text-sm">Batal</a>
        <button class="rounded-lg bg-green-700 px-5 py-2.5 text-sm font-semibold text-white">
            {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Tabel' }}
        </button>
    </div>
</form>

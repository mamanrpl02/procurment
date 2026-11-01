
@php
    $isEdit = isset($workflowGroup);
    $selectedTable = (string) old(
        'table_name',
        $workflowGroup->table_name ?? ''
    );
    $selectedStatus = (string) old(
        'is_active',
        isset($workflowGroup) ? (int) $workflowGroup->is_active : 1
    );
@endphp

<form method="POST"
      action="{{ $isEdit
          ? route('workflow-groups.update', $workflowGroup)
          : route('workflow-groups.store') }}"
      class="space-y-5">

    @csrf

    @if($isEdit)
        @method('PUT')
    @endif

    {{-- Nama Grouping --}}
    <div>
        <label for="group_name" class="mb-1.5 block text-sm font-medium text-gray-700">
            Nama Grouping *
        </label>

        <input
            id="group_name"
            type="text"
            name="group_name"
            required
            maxlength="255"
            value="{{ old('group_name', $workflowGroup->group_name ?? '') }}"
            placeholder="Contoh: PO - Default Values"
            class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-green-700 focus:outline-none focus:ring-1 focus:ring-green-700"
        >

        @error('group_name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Tabel Transaksi --}}
    <div>
        <label for="table_name" class="mb-1.5 block text-sm font-medium text-gray-700">
            Tabel Transaksi *
        </label>

        <select
            id="table_name"
            name="table_name"
            required
            class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-green-700 focus:outline-none focus:ring-1 focus:ring-green-700"
        >
            <option value="">Pilih Tabel</option>

            @foreach($supportedTables as $tableName => $tableLabel)
                <option
                    value="{{ $tableName }}"
                    @selected($selectedTable === (string) $tableName)
                >
                    {{ $tableLabel }} ({{ $tableName }})
                </option>
            @endforeach
        </select>

        @if($supportedTables->isEmpty())
            <p class="mt-1 text-sm text-amber-700">
                Belum ada tabel aktif di Master Tables. Tambahkan tabel terlebih dahulu.
            </p>
        @else
            <p class="mt-1 text-xs text-gray-500">
                Daftar tabel diambil dari Master Tables yang berstatus aktif.
            </p>
        @endif

        @error('table_name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Deskripsi --}}
    <div>
        <label for="description" class="mb-1.5 block text-sm font-medium text-gray-700">
            Deskripsi
        </label>

        <textarea
            id="description"
            name="description"
            rows="4"
            placeholder="Jelaskan fungsi grouping ini..."
            class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-green-700 focus:outline-none focus:ring-1 focus:ring-green-700"
        >{{ old('description', $workflowGroup->description ?? '') }}</textarea>

        @error('description')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Status --}}
    <div>
        <label for="is_active" class="mb-1.5 block text-sm font-medium text-gray-700">
            Status *
        </label>

        <select
            id="is_active"
            name="is_active"
            required
            class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-green-700 focus:outline-none focus:ring-1 focus:ring-green-700"
        >
            <option value="1" @selected($selectedStatus === '1')>
                Aktif
            </option>
            <option value="0" @selected($selectedStatus === '0')>
                Nonaktif
            </option>
        </select>

        @error('is_active')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Tombol --}}
    <div class="flex flex-col-reverse gap-3 border-t border-gray-200 pt-5 sm:flex-row sm:justify-end">
        <a
            href="{{ route('workflow-groups.index') }}"
            class="rounded-lg border border-gray-300 px-4 py-2.5 text-center text-sm font-medium text-gray-700 hover:bg-gray-50"
        >
            Batal
        </a>

        <button
            type="submit"
            @disabled($supportedTables->isEmpty())
            class="rounded-lg bg-green-700 px-5 py-2.5 text-sm font-semibold text-white hover:bg-green-800 disabled:cursor-not-allowed disabled:opacity-50"
        >
            {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Grouping' }}
        </button>
    </div>
</form>

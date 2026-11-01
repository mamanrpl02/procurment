
@php
    $isEdit = isset($purchaseOrder);
    $statuses = ['Open', 'In Progress', 'Closed'];
@endphp

<form method="POST"
      action="{{ $isEdit ? route('purchase-orders.update', $purchaseOrder) : route('purchase-orders.store') }}"
      class="space-y-6">
    @csrf

    @if($isEdit)
        @method('PUT')
    @endif

    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
        <div class="md:col-span-2">
            <label class="mb-1.5 block text-sm font-medium text-gray-700">Judul PO *</label>
            <input name="title" required value="{{ old('title', $purchaseOrder->title ?? '') }}"
                   placeholder="Contoh: Pengadaan Laptop"
                   class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-green-700 focus:outline-none">
            @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="mb-1.5 block text-sm font-medium text-gray-700">Requester *</label>
            <input name="requester" required value="{{ old('requester', $purchaseOrder->requester ?? '') }}"
                   placeholder="Nama pemohon"
                   class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-green-700 focus:outline-none">
            @error('requester') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="mb-1.5 block text-sm font-medium text-gray-700">Supplier *</label>
            <input name="supplier" required value="{{ old('supplier', $purchaseOrder->supplier ?? '') }}"
                   placeholder="Nama supplier"
                   class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-green-700 focus:outline-none">
            @error('supplier') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="mb-1.5 block text-sm font-medium text-gray-700">Tanggal PO *</label>
            <input type="date" name="po_date" required
                   value="{{ old('po_date', isset($purchaseOrder) ? $purchaseOrder->po_date->format('Y-m-d') : date('Y-m-d')) }}"
                   class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-green-700 focus:outline-none">
            @error('po_date') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="mb-1.5 block text-sm font-medium text-gray-700">Total Amount (Rp) *</label>
            <input type="number" name="total_amount" required min="0" step="0.01"
                   value="{{ old('total_amount', $purchaseOrder->total_amount ?? '0') }}"
                   placeholder="0"
                   class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-green-700 focus:outline-none">
            @error('total_amount') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
           <label class="mb-1.5 block text-sm font-medium text-gray-700">Status</label>
<select name="status"
        class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-green-700 focus:outline-none">
    
    <!-- Opsi Kosong / Default -->
    <option value="" @selected(old('status', $purchaseOrder->status ?? '') === '')>-- Pilih Status --</option>
    
    @foreach($statuses as $status)
        <option value="{{ $status }}"
            @selected(old('status', $purchaseOrder->status ?? '') === $status)>
            {{ $status }}
        </option>
    @endforeach
</select>
            @error('status') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="md:col-span-2">
            <label class="mb-1.5 block text-sm font-medium text-gray-700">Deskripsi</label>
            <textarea name="description" rows="4"
                      placeholder="Jelaskan keperluan PO..."
                      class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-green-700 focus:outline-none">{{ old('description', $purchaseOrder->description ?? '') }}</textarea>
            @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
    </div>

    <div class="flex flex-col-reverse gap-3 border-t border-gray-200 pt-5 sm:flex-row sm:justify-end">
        <a href="{{ route('purchase-orders.index') }}"
           class="rounded-lg border border-gray-300 px-4 py-2.5 text-center text-sm font-medium text-gray-700 hover:bg-gray-50">
            Batal
        </a>
        <button type="submit"
                class="rounded-lg bg-green-700 px-5 py-2.5 text-sm font-semibold text-white hover:bg-green-800">
            {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Tiket PO' }}
        </button>
    </div>
</form>

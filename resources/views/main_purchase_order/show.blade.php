@extends('layout.appLayoutMain')

@section('content')
<div class="mx-auto max-w-4xl space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <a href="{{ route('purchase-orders.index') }}"
               class="text-sm text-green-700 hover:underline">← Kembali ke Daftar Tiket PO</a>
            <h1 class="mt-3 text-2xl font-bold text-gray-800">{{ $purchaseOrder->title }}</h1>
            <p class="mt-1 text-sm text-gray-500">{{ $purchaseOrder->po_number }}</p>
        </div>

        <a href="{{ route('purchase-orders.edit', $purchaseOrder) }}"
           class="rounded-lg bg-green-700 px-4 py-2.5 text-center text-sm font-semibold text-white hover:bg-green-800">
            Edit Tiket
        </a>
    </div>

    @if(session('success'))
        <div class="rounded-lg border border-green-200 bg-green-50 p-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="rounded-xl border border-gray-200 bg-white p-5 sm:p-7">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div>
                <p class="text-sm text-gray-500">Nomor PO</p>
                <p class="mt-1 font-semibold text-green-700">{{ $purchaseOrder->po_number }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Status</p>
                <p class="mt-1 font-semibold text-gray-800">{{ $purchaseOrder->status }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Judul PO</p>
                <p class="mt-1 font-medium text-gray-800">{{ $purchaseOrder->title }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Requester</p>
                <p class="mt-1 font-medium text-gray-800">{{ $purchaseOrder->requester }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Supplier</p>
                <p class="mt-1 font-medium text-gray-800">{{ $purchaseOrder->supplier }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Tanggal PO</p>
                <p class="mt-1 font-medium text-gray-800">
                    {{ $purchaseOrder->po_date->format('d M Y') }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Total Amount</p>
                <p class="mt-1 font-semibold text-gray-800">
                    Rp {{ number_format((float) $purchaseOrder->total_amount, 0, ',', '.') }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Dibuat Pada</p>
                <p class="mt-1 font-medium text-gray-800">
                    {{ $purchaseOrder->created_at->format('d M Y H:i') }}
                </p>
            </div>

            <div class="sm:col-span-2">
                <p class="text-sm text-gray-500">Deskripsi</p>
                <p class="mt-1 whitespace-pre-line text-gray-800">{{ $purchaseOrder->description ?: '-' }}</p>
            </div>
        </div>

        <div class="mt-8 border-t border-gray-200 pt-5">
            <form action="{{ route('purchase-orders.destroy', $purchaseOrder) }}"
                  method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus tiket PO ini?')">
                @csrf
                @method('DELETE')

                <button class="rounded-lg border border-red-200 px-4 py-2 text-sm font-medium text-red-600 hover:bg-red-50">
                    Hapus Tiket
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

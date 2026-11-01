@extends('layout.appLayoutMain')

@section('content')
<div class="mx-auto max-w-4xl space-y-6">
    <div>
        <a href="{{ route('purchase-orders.index') }}"
           class="text-sm text-green-700 hover:underline">← Kembali ke Daftar Tiket PO</a>
        <h1 class="mt-3 text-2xl font-bold text-gray-800">Tambah Tiket PO</h1>
        <p class="mt-1 text-sm text-gray-500">Isi informasi dasar pengajuan Purchase Order.</p>
    </div>

    <div class="rounded-xl border border-gray-200 bg-white p-5 sm:p-7">
        @include('main_purchase_order._form')
    </div>
</div>
@endsection

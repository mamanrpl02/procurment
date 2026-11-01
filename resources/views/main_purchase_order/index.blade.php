@extends('layout.appLayoutMain')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Tiket Purchase Order</h1>
            <p class="mt-1 text-sm text-gray-500">Kelola seluruh tiket pengajuan PO.</p>
        </div>

        <a href="{{ route('purchase-orders.create') }}"
           class="rounded-lg bg-green-700 px-4 py-2.5 text-center text-sm font-semibold text-white hover:bg-green-800">
            + Tambah Tiket PO
        </a>
    </div>

    @if(session('success'))
        <div class="rounded-lg border border-green-200 bg-green-50 p-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="rounded-lg border border-red-200 bg-red-50 p-3 text-sm text-red-700">
            Ada data yang belum valid. Silakan periksa kembali form.
        </div>
    @endif

    <div class="rounded-xl border border-gray-200 bg-white p-4">
        <form method="GET" action="{{ route('purchase-orders.index') }}"
              class="flex flex-col gap-3 sm:flex-row">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Cari nomor PO, judul, requester, supplier..."
                   class="min-w-0 flex-1 rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-green-700 focus:outline-none">

            <select name="status"
                    class="rounded-lg border border-gray-300 px-3 py-2 text-sm">
                <option value="">Semua Status</option>
                @foreach(['Open', 'In Progress', 'Closed'] as $status)
                    <option value="{{ $status }}" @selected(request('status') === $status)>
                        {{ $status }}
                    </option>
                @endforeach
            </select>

            <button class="rounded-lg bg-gray-800 px-4 py-2 text-sm font-medium text-white">
                Cari
            </button>

            <a href="{{ route('purchase-orders.index') }}"
               class="rounded-lg border border-gray-300 px-4 py-2 text-center text-sm">
                Reset
            </a>
        </form>
    </div>

    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50 text-left text-gray-600">
                    <tr>
                        <th class="px-5 py-3 font-semibold">Nomor PO</th>
                        <th class="px-5 py-3 font-semibold">Judul PO</th>
                        <th class="px-5 py-3 font-semibold">Requester</th>
                        <th class="px-5 py-3 font-semibold">Supplier</th>
                        <th class="px-5 py-3 font-semibold">Tanggal PO</th>
                        <th class="px-5 py-3 font-semibold">Total Amount</th>
                        <th class="px-5 py-3 font-semibold">Status</th>
                        <th class="px-5 py-3 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse($purchaseOrders as $po)
                        <tr class="hover:bg-gray-50">
                            <td class="whitespace-nowrap px-5 py-4 font-medium text-green-700">
                                {{ $po->po_number }}
                            </td>
                            <td class="px-5 py-4">{{ $po->title }}</td>
                            <td class="px-5 py-4">{{ $po->requester }}</td>
                            <td class="px-5 py-4">{{ $po->supplier }}</td>
                            <td class="whitespace-nowrap px-5 py-4">
                                {{ $po->po_date->format('d M Y') }}
                            </td>
                            <td class="whitespace-nowrap px-5 py-4">
                                Rp {{ number_format((float) $po->total_amount, 0, ',', '.') }}
                            </td>
                            <td class="whitespace-nowrap px-5 py-4">
                                <span class="rounded-full px-2.5 py-1 text-xs font-medium
                                    {{ $po->status === 'Open' ? 'bg-blue-50 text-blue-700' : '' }}
                                    {{ $po->status === 'In Progress' ? 'bg-amber-50 text-amber-700' : '' }}
                                    {{ $po->status === 'Closed' ? 'bg-green-50 text-green-700' : '' }}">
                                    {{ $po->status }}
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-5 py-4 text-right">
                                <a href="{{ route('purchase-orders.show', $po) }}"
                                   class="font-medium text-green-700 hover:underline">Detail</a>
                                <a href="{{ route('purchase-orders.edit', $po) }}"
                                   class="ml-3 font-medium text-blue-700 hover:underline">Edit</a>

                                <form action="{{ route('purchase-orders.destroy', $po) }}"
                                      method="POST" class="ml-3 inline"
                                      onsubmit="return confirm('Yakin ingin menghapus tiket PO ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="font-medium text-red-600 hover:underline">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-5 py-12 text-center text-gray-500">
                                Belum ada tiket PO.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-gray-200 px-5 py-4">
            {{ $purchaseOrders->links() }}
        </div>
    </div>
</div>
@endsection

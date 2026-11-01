<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use Illuminate\Support\Facades\DB;
use App\Services\WorkflowEngine;


class PurchaseOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = PurchaseOrder::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('po_number', 'like', "%{$search}%")
                    ->orWhere('title', 'like', "%{$search}%")
                    ->orWhere('requester', 'like', "%{$search}%")
                    ->orWhere('supplier', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $purchaseOrders = $query
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('main_purchase_order.index', compact('purchaseOrders'));
    }

    public function create()
    {
        return view('main_purchase_order.create');
    }

    

public function store(Request $request, WorkflowEngine $workflowEngine)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'requester' => 'required|string|max:255',
        'supplier' => 'required|string|max:255',
        'po_date' => 'required|date',
        'total_amount' => 'required|numeric|min:0',
        'description' => 'nullable|string',
        'status' => 'nullable|string|max:255',
    ]);

    DB::transaction(function () use ($validated, $workflowEngine) {

        // Jalankan workflow sebelum data disimpan.
        $attributes = $workflowEngine->apply(
            'tr_purchase_orders',
            $validated,
            'add'
        );

        // Jika workflow tidak mengisi status, gunakan Draft.
        if (empty($attributes['status'])) {
            $attributes['status'] = 'Draft';
        }

        // Simpan hasil yang sudah diproses workflow.
        $purchaseOrder = PurchaseOrder::create($attributes);

        // Generate nomor PO.
        $purchaseOrder->update([
            'po_number' => 'PO-' . now()->format('Ymd') . '-'
                . str_pad(
                    (string) $purchaseOrder->getKey(),
                    5,
                    '0',
                    STR_PAD_LEFT
                ),
        ]);
    });

    return redirect()
        ->route('purchase-orders.index')
        ->with('success', 'Tiket PO berhasil dibuat.');
}



    public function show(PurchaseOrder $purchaseOrder)
    {
        return view('main_purchase_order.show', compact('purchaseOrder'));
    }

    public function edit(PurchaseOrder $purchaseOrder)
    {
        return view('main_purchase_order.edit', compact('purchaseOrder'));
    }

   
public function update(
    Request $request,
    PurchaseOrder $purchaseOrder,
    WorkflowEngine $workflowEngine
) {
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'requester' => 'required|string|max:255',
        'supplier' => 'required|string|max:255',
        'po_date' => 'required|date',
        'total_amount' => 'required|numeric|min:0',
        'description' => 'nullable|string',
        'status' => 'nullable|string|max:255',
    ]);

    DB::transaction(function () use (
        $validated,
        $purchaseOrder,
        $workflowEngine
    ) {
        // Gabungkan data lama dan input terbaru untuk evaluasi kondisi.
        $context = array_merge(
            $purchaseOrder->getAttributes(),
            $validated
        );

        $attributes = $workflowEngine->apply(
            'tr_purchase_orders',
            $context,
            'update',
            (string) $purchaseOrder->getKey()
        );

        // Fill akan tetap mengikuti konfigurasi fillable pada model.
        $purchaseOrder->fill($attributes);
        $purchaseOrder->save();
    });

    return redirect()
        ->route('purchase-orders.show', $purchaseOrder)
        ->with('success', 'Tiket PO berhasil diperbarui.');
}


    public function destroy(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->delete();

        return redirect()
            ->route('purchase-orders.index')
            ->with('success', 'Tiket PO berhasil dihapus.');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $table = 'tr_purchase_orders';

    protected $primaryKey = 'sys_id_tr_purchase_orders';

    protected $fillable = [
        'po_number',
        'title',
        'requester',
        'supplier',
        'po_date',
        'total_amount',
        'description',
        'status',
    ];

    protected $casts = [
        'po_date' => 'date',
        'total_amount' => 'decimal:2',
    ];

}

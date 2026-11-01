<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tr_purchase_orders', function (Blueprint $table) {
            $table->bigIncrements('sys_id_tr_purchase_orders');

            $table->string('po_number')->nullable()->unique();
            $table->string('title');
            $table->string('requester');
            $table->string('supplier');
            $table->date('po_date');
            $table->decimal('total_amount', 15, 2)->default(0);
            $table->text('description')->nullable();
            $table->string('status');

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};

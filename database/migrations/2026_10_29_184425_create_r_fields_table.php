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
        Schema::create('r_fields', function (Blueprint $table) {
            $table->bigIncrements('sys_id_r_fields');

            $table->unsignedBigInteger('sys_id_r_tables');

            $table->string('field_name');
            $table->string('field_label');
            $table->string('field_type')->default('string');

            $table->boolean('is_condition_allowed')->default(true);
            $table->boolean('is_action_allowed')->default(true);
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->foreign('sys_id_r_tables')
                ->references('sys_id_r_tables')
                ->on('r_tables')
                ->cascadeOnDelete();

            $table->unique(['sys_id_r_tables', 'field_name']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('r_fields');
    }
};

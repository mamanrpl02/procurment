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
        // 1. Master Workflow
        Schema::create('r_workflows', function (Blueprint $table) {
            $table->bigIncrements('sys_id_r_workflows');

            $table->unsignedBigInteger('sys_id_r_tables');
            $table->unsignedBigInteger('sys_id_r_workflow_groups');

            $table->string('workflow_name');
            $table->string('workflow_type');
            $table->text('description')->nullable();

            $table->unsignedInteger('sort_order')->default(1);
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->foreign('sys_id_r_tables')
                ->references('sys_id_r_tables')
                ->on('r_tables')
                ->restrictOnDelete();

            $table->foreign('sys_id_r_workflow_groups')
                ->references('sys_id_r_workflow_groups')
                ->on('r_workflow_groups')
                ->restrictOnDelete();

            $table->index([
                'sys_id_r_workflow_groups',
                'sort_order',
            ]);
        });

        // 2. Workflow Conditions
        Schema::create('r_workflow_conditions', function (Blueprint $table) {
            $table->bigIncrements('sys_id_r_workflow_conditions');

            $table->unsignedBigInteger('sys_id_r_workflows');
            $table->unsignedBigInteger('sys_id_r_fields');

            $table->string('operator');
            $table->text('condition_value')->nullable();
            $table->string('logical_operator')->default('AND');

            $table->timestamps();

            $table->foreign('sys_id_r_workflows')
                ->references('sys_id_r_workflows')
                ->on('r_workflows')
                ->cascadeOnDelete();

            $table->foreign('sys_id_r_fields')
                ->references('sys_id_r_fields')
                ->on('r_fields')
                ->restrictOnDelete();
        });

        // 3. Workflow Actions
        Schema::create('r_workflow_actions', function (Blueprint $table) {
            $table->bigIncrements('sys_id_r_workflow_actions');

            $table->unsignedBigInteger('sys_id_r_workflows');
            $table->unsignedBigInteger('sys_id_r_fields');

            $table->string('action_type');
            $table->string('field_state')->nullable();
            $table->text('action_value')->nullable();

            $table->timestamps();

            $table->foreign('sys_id_r_workflows')
                ->references('sys_id_r_workflows')
                ->on('r_workflows')
                ->cascadeOnDelete();

            $table->foreign('sys_id_r_fields')
                ->references('sys_id_r_fields')
                ->on('r_fields')
                ->restrictOnDelete();
        });

        // 4. Workflow Execution Logs
        Schema::create('tr_workflow_execution_logs', function (Blueprint $table) {
            $table->bigIncrements('sys_id_tr_workflow_execution_logs');

            $table->unsignedBigInteger('sys_id_r_workflows')
                ->nullable();

            $table->string('table_name');
            $table->string('record_id')->nullable();
            $table->string('event_name');
            $table->string('execution_status');
            $table->text('message')->nullable();
            $table->json('context')->nullable();

            $table->timestamps();

            $table->foreign('sys_id_r_workflows')
                ->references('sys_id_r_workflows')
                ->on('r_workflows')
                ->nullOnDelete();

            $table->index(['table_name', 'record_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tr_workflow_execution_logs');
        Schema::dropIfExists('r_workflow_actions');
        Schema::dropIfExists('r_workflow_conditions');
        Schema::dropIfExists('r_workflows');
    }

};

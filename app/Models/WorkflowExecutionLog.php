<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkflowExecutionLog extends Model
{
    protected $table = 'tr_workflow_execution_logs';

    protected $primaryKey = 'sys_id_tr_workflow_execution_logs';

    protected $fillable = [
        'sys_id_r_workflows',
        'table_name',
        'record_id',
        'event_name',
        'execution_status',
        'message',
        'context',
    ];

    protected $casts = [
        'context' => 'array',
    ];

    public function getRouteKeyName(): string
    {
        return $this->primaryKey;
    }

    public function workflow(): BelongsTo
    {
        return $this->belongsTo(
            Workflow::class,
            'sys_id_r_workflows',
            'sys_id_r_workflows'
        );
    }
}
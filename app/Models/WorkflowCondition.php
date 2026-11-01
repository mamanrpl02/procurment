<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkflowCondition extends Model
{
    protected $table = 'r_workflow_conditions';

    protected $primaryKey = 'sys_id_r_workflow_conditions';

    protected $fillable = [
        'sys_id_r_workflows',
        'sys_id_r_fields',
        'operator',
        'condition_value',
        'logical_operator',
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

    public function field(): BelongsTo
    {
        return $this->belongsTo(
            RField::class,
            'sys_id_r_fields',
            'sys_id_r_fields'
        );
    }
}

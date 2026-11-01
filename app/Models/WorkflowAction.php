<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class WorkflowAction extends Model
{
    protected $table = 'r_workflow_actions';

    protected $primaryKey = 'sys_id_r_workflow_actions';

    protected $fillable = [
        'sys_id_r_workflows',
        'sys_id_r_fields',
        'action_type',
        'field_state',
        'action_value',
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Workflow extends Model
{
    protected $table = 'r_workflows';

    protected $primaryKey = 'sys_id_r_workflows';

    protected $fillable = [
        'sys_id_r_tables',
        'sys_id_r_workflow_groups',
        'workflow_name',
        'workflow_type',
        'description',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    public function getRouteKeyName(): string
    {
        return $this->primaryKey;
    }

    public function table(): BelongsTo
    {
        return $this->belongsTo(
            RTable::class,
            'sys_id_r_tables',
            'sys_id_r_tables'
        );
    }

    public function workflowGroup(): BelongsTo
    {
        return $this->belongsTo(
            WorkflowGroup::class,
            'sys_id_r_workflow_groups',
            'sys_id_r_workflow_groups'
        );
    }

    public function conditions(): HasMany
    {
        return $this->hasMany(
            WorkflowCondition::class,
            'sys_id_r_workflows',
            'sys_id_r_workflows'
        );
    }

    public function actions(): HasMany
    {
        return $this->hasMany(
            WorkflowAction::class,
            'sys_id_r_workflows',
            'sys_id_r_workflows'
        );
    }

    public function executionLogs(): HasMany
    {
        return $this->hasMany(
            WorkflowExecutionLog::class,
            'sys_id_r_workflows',
            'sys_id_r_workflows'
        );
    }
}

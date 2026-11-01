<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkflowGroup extends Model
{
    protected $table = 'r_workflow_groups';

    protected $primaryKey = 'sys_id_r_workflow_groups';

    protected $fillable = [
        'group_name',
        'table_name',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getRouteKeyName(): string
    {
        return $this->primaryKey;
    }
}
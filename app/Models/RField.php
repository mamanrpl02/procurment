<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RField extends Model
{
    protected $table = 'r_fields';

    protected $primaryKey = 'sys_id_r_fields';

    protected $fillable = [
        'sys_id_r_tables',
        'field_name',
        'field_label',
        'field_type',
        'is_condition_allowed',
        'is_action_allowed',
        'is_active',
    ];

    protected $casts = [
        'is_condition_allowed' => 'boolean',
        'is_action_allowed' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function table()
    {
        return $this->belongsTo(
            RTable::class,
            'sys_id_r_tables',
            'sys_id_r_tables'
        );
    }

    public function getRouteKeyName(): string
    {
        return $this->primaryKey;
    }
}

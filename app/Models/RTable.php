<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RTable extends Model
{
    protected $table = 'r_tables';

    protected $primaryKey = 'sys_id_r_tables';

    protected $fillable = [
        'table_name',
        'table_label',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function fields()
    {
        return $this->hasMany(
            RField::class,
            'sys_id_r_tables',
            'sys_id_r_tables'
        );
    }

    public function getRouteKeyName(): string
    {
        return $this->primaryKey;
    }
}

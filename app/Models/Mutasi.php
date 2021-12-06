<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mutasi extends Model
{
    protected $guarded = [];

    protected $dates = ['date'];

    public function status()
    {
        return $this->belongsTo('App\Models\Status', 'status_id', 'id');
    }
    public function warehouse_f()
    {
        return $this->belongsTo('App\Models\Warehouse', 'warehouse_from', 'id');
    }
    public function warehouse_t()
    {
        return $this->belongsTo('App\Models\Warehouse', 'warehouse_to', 'id');
    }

    public function type()
    {
        return $this->belongsTo('App\Models\Type', 'type_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
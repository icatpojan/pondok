<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    protected $dates = ['tgl_masuk'];

    public function status()
    {
        return $this->belongsTo('App\Models\Status', 'status_id', 'id');
    }
    public function warehouse()
    {
        return $this->belongsTo('App\Models\Warehouse', 'warehouse_id', 'id');
    }
    public function type()
    {
        return $this->belongsTo('App\Models\Type', 'type_id', 'id');
    }
}
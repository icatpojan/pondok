<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $guarded = [];

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
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'produk_id', 'id');
    }
}
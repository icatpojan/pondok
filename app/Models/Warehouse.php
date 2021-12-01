<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
   protected $guarded = [];
    public function produk()
    {
        return $this->hasMany('App\Models\Produk', 'warehouse_id', 'id');
    }
    // public function detail()
    // {
    //     return $this->hasMany('App\Models\Detail', 'warehouse_id', 'id');
    // }

    public function province()
    {
        return $this->belongsTo('App\Models\Province', 'area', 'province_id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public $guarded = [];

    public function customer()
    {
        return $this->hasMany('App\Models\Pelanggan', 'province_id', 'province_id');
    }

    public function gudang()
    {
        return $this->belongsTo('App\Models\Gudang', 'area', 'province_id');
    }
}
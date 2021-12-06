<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
   protected $guarded = [];
    public function province()
    {
        return $this->belongsTo('App\Models\Province', 'province_id', 'province_id');
    }
}
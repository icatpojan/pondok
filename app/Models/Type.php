<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
   protected $guarded = [];

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }
    public function product()
    {
        return $this->hasMany('App\Models\Product', 'tipe_id', 'id');
    }
}
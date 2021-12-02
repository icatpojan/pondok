<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
   protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
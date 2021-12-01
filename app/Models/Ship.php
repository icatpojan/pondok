<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    protected $guarded = [];
    protected $dates = ['airtime_start', 'airtime_end'];
}
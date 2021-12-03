<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $dates = ['airtime_end', 'airtime_start', 'due_date', 'tanggal'];
    public $guarded = [];
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id', 'id');
    }
    public function ship()
    {
        return $this->belongsTo('App\Models\Ship', 'ship_id', 'id');
    }
}
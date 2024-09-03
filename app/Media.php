<?php

namespace App; // Sesuaikan namespace dengan struktur folder Anda

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $guarded = []; // Menentukan bahwa tidak ada atribut yang dilindungi
    protected $table = 'media'; // Sesuaikan dengan nama tabel di database
}

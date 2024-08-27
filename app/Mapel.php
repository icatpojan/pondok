<?php

namespace App; // Sesuaikan namespace dengan struktur folder Anda

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    protected $guarded = []; // Menentukan bahwa tidak ada atribut yang dilindungi
    protected $table = 'mapel_tables'; // Sesuaikan dengan nama tabel di database
}

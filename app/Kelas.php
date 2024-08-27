<?php

namespace App; // Sesuaikan namespace dengan struktur folder Anda

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $guarded = []; // Menentukan bahwa tidak ada atribut yang dilindungi
    protected $table = 'kelas_tables'; // Sesuaikan dengan nama tabel di database

    public function users()
    {
        return $this->hasMany('App\User', 'id', 'kelas');
    }
}

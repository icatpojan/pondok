<?php

namespace App; // Sesuaikan namespace dengan struktur folder Anda

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $guarded = []; // Menentukan bahwa tidak ada atribut yang dilindungi
    protected $table = 'materi_tables'; // Sesuaikan dengan nama tabel di database

    public function mapelkelas()
    {
        return $this->belongsTo('App\MapelKelas', 'mapel_kelas_id', 'id');
    }
}

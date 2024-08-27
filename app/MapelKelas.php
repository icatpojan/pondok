<?php

namespace App; // Sesuaikan namespace dengan struktur folder Anda

use Illuminate\Database\Eloquent\Model;

class MapelKelas extends Model
{
    protected $guarded = []; // Menentukan bahwa tidak ada atribut yang dilindungi
    protected $table = 'mapel_kelas_tables'; // Sesuaikan dengan nama tabel di database

    public function mapel()
    {
        return $this->belongsTo('App\Mapel', 'mapel_id', 'id');
    }
    public function kelas()
    {
        return $this->belongsTo('App\Kelas', 'kelas_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'guru_id', 'id');
    }
}

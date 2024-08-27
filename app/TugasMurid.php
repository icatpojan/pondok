<?php

namespace App; // Sesuaikan namespace dengan struktur folder Anda

use Illuminate\Database\Eloquent\Model;

class TugasMurid extends Model
{
    protected $guarded = []; // Menentukan bahwa tidak ada atribut yang dilindungi
    protected $table = 'tugas_murid_tables'; // Sesuaikan dengan nama tabel di database
    public function mapelkelas()
    {
        return $this->belongsTo('App\MapelKelas', 'mapel_kelas_id', 'id');
    }
}

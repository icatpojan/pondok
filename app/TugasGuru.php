<?php

namespace App; // Sesuaikan namespace dengan struktur folder Anda

use Illuminate\Database\Eloquent\Model;

class TugasGuru extends Model
{
    protected $guarded = []; // Menentukan bahwa tidak ada atribut yang dilindungi
    protected $table = 'tugas_guru_tables'; // Sesuaikan dengan nama tabel di database
    protected $dates = ['batas_waktu'];
    public function mapelkelas()
    {
        return $this->belongsTo('App\MapelKelas', 'mapel_kelas_id', 'id');
    }
    public function tugasmurid()
    {
        return $this->hasMany('App\TugasMurid', 'tugas_id', 'id');
    }
}

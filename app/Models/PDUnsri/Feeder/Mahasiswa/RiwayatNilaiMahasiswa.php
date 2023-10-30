<?php

namespace App\Models\PDUnsri\Feeder\Mahasiswa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatNilaiMahasiswa extends Model
{
    use HasFactory;
    protected $table = 'riwayat_nilai_mahasiswa';
    public $timestamps = false;
    public $incrementing = false;
}

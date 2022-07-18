<?php

namespace App\Models\PDUnsri\Feeder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusMahasiswa extends Model
{
    use HasFactory;
    protected $table = 'pd_feeder_status_mahasiswa';
    protected $primaryKey = 'id_status_mahasiswa';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'id_status_mahasiswa', 'nama_status_mahasiswa',
    ];
}

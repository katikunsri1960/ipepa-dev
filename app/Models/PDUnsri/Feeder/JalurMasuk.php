<?php

namespace App\Models\PDUnsri\Feeder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JalurMasuk extends Model
{
    use HasFactory;
    protected $table = 'pd_feeder_jalur_masuk';
    protected $primaryKey = 'id_jalur_masuk';
    public $timestamps = false;

    protected $fillable = [
        'id_jalur_masuk', 'nama_jalur_masuk',
    ];
}

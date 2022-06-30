<?php

namespace App\Models\PDUnsri\Feeder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KebutuhanKhusus extends Model
{
    use HasFactory;
    protected $table = 'pd_feeder_kebutuhan_khusus';
    protected $primaryKey = 'id_kebutuhan_khusus';
    protected $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'id_kebutuhan_khusus', 'nama_kebutuhan_khusus',
    ];
}

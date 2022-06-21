<?php

namespace App\Models\PDUnsri;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negara extends Model
{
    use HasFactory;

    protected $table = 'pd_negara';
    protected $primaryKey = 'id_negara';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'id_negara', 'nama_negara',
    ];


}

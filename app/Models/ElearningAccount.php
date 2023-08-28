<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElearningAccount extends Model
{
    use HasFactory;
    protected $fillable = [
        'nim',
        'nama_depan',
        'nama_belakang',
        'email',
        'kpm',
        'created'
    ];
}

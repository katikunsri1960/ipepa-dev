<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public const ADMINISTRATOR = 1;
    public const ADMIN_UNIVERSITAS = 2;
    public const ADMIN_FAKULTAS = 3;
    public const ADMIN_PRODI = 4;
}

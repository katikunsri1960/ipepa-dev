<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiConfig extends Model
{
    use HasFactory;
    

    protected $fillable = [
        'name', 'username', 'password','api_url', 'api_key',
    ];

    protected $hidden = [
        'password',
    ];
}

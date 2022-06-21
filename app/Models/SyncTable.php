<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyncTable extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'table_name',
        'api_path',
        'last_sync',
    ];
    
}

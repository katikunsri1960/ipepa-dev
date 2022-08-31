<?php

namespace App\Models\PDUnsri\Feeder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyncTable extends Model
{
    use HasFactory;
    protected $table = 'sync_tables';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;
}

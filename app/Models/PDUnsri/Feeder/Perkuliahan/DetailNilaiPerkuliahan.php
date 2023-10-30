<?php

namespace App\Models\PDUnsri\Feeder\Perkuliahan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailNilaiPerkuliahan extends Model
{
    use HasFactory;
    protected $table = 'detail_nilai_perkuliahan';
    public $timestamps = false;
    public $incrementing = false;
}

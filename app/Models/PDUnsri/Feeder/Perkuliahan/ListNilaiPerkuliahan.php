<?php

namespace App\Models\PDUnsri\Feeder\Perkuliahan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListNilaiPerkuliahan extends Model
{
    use HasFactory;
    protected $table = 'pd_feeder_list_nilai_perkuliahan';
    public $timestamps = false;
    public $incrementing = false;
}

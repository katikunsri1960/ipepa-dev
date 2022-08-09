<?php

namespace App\Models\PDUnsri\Feeder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ListMahasiswa extends Model
{
    use HasFactory;
    protected $table = 'pd_feeder_list_mahasiswa';

    public function JenisKelamin(): Attribute
    {
        return new Attribute(
            get: function ($value) {
                if ($value == 'L') {
                    return 'Laki-laki';
                } elseif ($value == 'P') {
                    return 'Perempuan';
                } else {
                    return '-';
                }
            },

        );
    }

    public function scopeSearch($keyword)
    {
        return $this->where(function($query) use($keyword){
            $query->where('nama_mahasiswa', 'like', '%'.$keyword.'%')
                ->orWhere('nim', 'like', '%'.$keyword.'%')
                ->orWhere('nama_program_studi', 'like', '%'.$keyword.'%');
        });
    }



}

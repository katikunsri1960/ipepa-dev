<?php

namespace App\Models\PDUnsri\Feeder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    use HasFactory;
    protected $table = 'pd_feeder_program_studi';
    protected $primaryKey = 'id_program_studi';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'id_prodi', 'kode_program_studi', 'nama_program_studi', 'status', 'id_jenjang_pendidikan', 'nama_jenjang_pendidikan'
    ];

    /**
     * Get the JenjangPendidikan associated with the ProgramStudi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function JenjangPendidikan(): HasOne
    {
        return $this->hasOne(JenjangPendidikan::class, 'id_jenjang_didik', 'id_jenjang_pendidikan');
    }
}

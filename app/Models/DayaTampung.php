<?php

namespace App\Models;

use App\Models\PDUnsri\Feeder\ProgramStudi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayaTampung extends Model
{
    use HasFactory;
    protected $fillable = ['jalur_ujian_id', 'id_prodi', 'kode_pusat', 'tahun','daya_tampung'];

    /**
     * Get the ProgramStudi associated with the DayaTampung
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ProgramStudi()
    {
        return $this->hasOne(ProgramStudi::class, 'id_prodi', 'id_prodi');
    }

    /**
     * Get the JalurUjian associated with the DayaTampung
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function JalurUjian()
    {
        return $this->hasOne(JalurUjian::class, 'id', 'jalur_ujian_id');
    }
}

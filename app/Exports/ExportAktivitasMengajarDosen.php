<?php

namespace App\Exports;

use App\Models\PDUnsri\Feeder\Dosen\AktivitasMengajarDosen;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportAktivitasMengajarDosen implements FromCollection, WithHeadings
{
    public function __construct(string $program_studi, string $semester)
    {
        $this->program_studi = $program_studi;
        $this->semester = $semester;
    }
    public function collection()
    {
        $data = AktivitasMengajarDosen::leftJoin('pd_feeder_detail_biodata_dosen','pd_feeder_detail_biodata_dosen.id_dosen','pd_feeder_aktivitas_mengajar_dosen.id_dosen')->leftJoin('pd_feeder_mata_kuliah','pd_feeder_mata_kuliah.id_matkul','pd_feeder_aktivitas_mengajar_dosen.id_matkul');

        return $data->select('nidn','pd_feeder_aktivitas_mengajar_dosen.nama_dosen')
                    ->addSelect(DB::raw('(SELECT CONCAT(pd_feeder_jenjang_pendidikan.nama_jenjang_didik," ",pd_feeder_program_studi.nama_program_studi) FROM pd_feeder_program_studi LEFT JOIN pd_feeder_jenjang_pendidikan ON pd_feeder_program_studi.id_jenjang_pendidikan = pd_feeder_jenjang_pendidikan.id_jenjang_didik WHERE pd_feeder_program_studi.id_prodi = pd_feeder_aktivitas_mengajar_dosen.id_prodi) AS nama_program_studi'))
                    ->addSelect('pd_feeder_aktivitas_mengajar_dosen.nama_mata_kuliah','pd_feeder_aktivitas_mengajar_dosen.nama_kelas_kuliah','pd_feeder_mata_kuliah.kode_mata_kuliah','pd_feeder_mata_kuliah.sks_mata_kuliah','pd_feeder_aktivitas_mengajar_dosen.rencana_minggu_pertemuan','pd_feeder_aktivitas_mengajar_dosen.realisasi_minggu_pertemuan')
                    ->where('pd_feeder_aktivitas_mengajar_dosen.id_prodi', $this->program_studi)->where('pd_feeder_aktivitas_mengajar_dosen.id_periode', $this->semester)->get();
    }
    public function headings(): array
    {
        return [
            'NIDN',
            'NAMA DOSEN',
            'PROGRAM STUDI',
            'KODE MATA KULIAH',
            'NAMA MATA KULIAH',
            'KELAS KULIAH',
            'BOBOT (SKS)',
            'RENCANA MINGGU PERTEMUAN',
            'REALISASI MINGGU PERTEMUAN'
        ];
    }
}

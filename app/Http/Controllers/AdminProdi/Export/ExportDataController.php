<?php

namespace App\Http\Controllers\AdminProdi\Export;

use App\Exports\ExportAktivitasMengajarDosen;
use App\Exports\ExportAktivitasPerkuliahan;
use App\Exports\ExportDaftarMahasiswa;
use App\Exports\ExportKelasPerkuliahan;
use App\Exports\ExportKRSMahasiswa;
use App\Exports\ExportMahasiswaLulusDO;
use App\Exports\ExportMataKuliah;
use App\Exports\ExportNilaiTransfer;
use App\Exports\ExportPenugasanDosen;
use App\Exports\ExportTranskrip;
use App\Http\Controllers\Controller;
use App\Models\PDUnsri\Feeder\ProgramStudi;
use App\Models\PDUnsri\Feeder\Semester;
use App\Models\PDUnsri\Feeder\TahunAjaran;
use App\Models\RolesUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ExportDataController extends Controller
{

    public function index(Request $req)
    {
        $this->authorize('admin-prodi');

        $prodiId = RolesUser::where('user_id', auth()->user()->id)->value('fak_prod_id');

        $table_name = array("Daftar Mahasiswa", "Nilai Transfer", "Penugasan Dosen", "Mata Kuliah", "Kelas Perkuliahan", "KRS Mahasiswa", "Aktivitas Mengajar Dosen", "Aktivitas Kuliah", "Mahasiswa Lulus/DO", "Transkrip");

        $program_studi = ProgramStudi::select('id_prodi', DB::raw("CONCAT(nama_jenjang_pendidikan,' ',nama_program_studi) AS nama_program_studi"))->where('pd_feeder_program_studi.id_prodi',$prodiId)->get();

        $periode = TahunAjaran::select('id_tahun_ajaran','nama_tahun_ajaran')->orderby('nama_tahun_ajaran', 'desc')->get();

        $semester = Semester::select('id_semester','nama_semester')->orderby('id_semester', 'desc')->get();

        if($req->table_name == "Daftar Mahasiswa"){
            return Excel::download(new ExportDaftarMahasiswa($req->program_studi, $req->periode), 'DAFTAR MAHASISWA-'.$req->program_studi.'-'.$req->periode.'.xlsx');
        }

        if($req->table_name == "Penugasan Dosen"){
            return Excel::download(new ExportPenugasanDosen($req->program_studi, $req->periode), 'DAFTAR PENUGASAN DOSEN-'.$req->program_studi.'-'.$req->periode.'.xlsx');
        }

        if($req->table_name == "Mata Kuliah"){
            return Excel::download(new ExportMataKuliah($req->program_studi), 'DAFTAR MATA KULIAH-'.$req->program_studi.'.xlsx');
        }

        if($req->table_name == "Aktivitas Kuliah"){
            return Excel::download(new ExportAktivitasPerkuliahan($req->program_studi, $req->semester), 'DAFTAR AKTIVITAS KULIAH-'.$req->program_studi.'-'.$req->semester.'.xlsx');
        }

        if($req->table_name == "Mahasiswa Lulus/DO"){
            return Excel::download(new ExportMahasiswaLulusDO($req->program_studi, $req->periode), 'DAFTAR MAHASISWA LULUS DO-'.$req->program_studi.'-'.$req->periode.'.xlsx');
        }

        if($req->table_name == "Nilai Transfer"){
            return Excel::download(new ExportNilaiTransfer($req->program_studi, $req->periode), 'DAFTAR NILAI TRANSFER MAHASISWA-'.$req->program_studi.'-'.$req->periode.'.xlsx');
        }

        if($req->table_name == "KRS Mahasiswa"){
            return Excel::download(new ExportKRSMahasiswa($req->program_studi, $req->semester), 'DAFTAR KRS MAHASISWA-'.$req->program_studi.'-'.$req->semester.'.xlsx');
        }

        if($req->table_name == "Aktivitas Mengajar Dosen"){
            return Excel::download(new ExportAktivitasMengajarDosen($req->program_studi, $req->semester), 'DAFTAR AKTIVITAS MENGAJAR DOSEN-'.$req->program_studi.'-'.$req->semester.'.xlsx');
        }

        if($req->table_name == "Kelas Perkuliahan"){
            return Excel::download(new ExportKelasPerkuliahan($req->program_studi, $req->semester), 'JADWAL KELAS PERKULIAHAN-'.$req->program_studi.'-'.$req->semester.'.xlsx');
        }

        if($req->table_name == "Transkrip"){
            return Excel::download(new ExportTranskrip($req->program_studi, $req->semester), 'DAFTAR TRANSKRIP MAHASISWA-'.$req->program_studi.'-'.$req->semester.'.xlsx');
        }



        return view('backend.prodi.export-data.index', compact('table_name', 'program_studi', 'periode', 'semester'));
    }
}

<?php

namespace App\Http\Controllers\AdminUniv\Export;

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
use App\Models\PDUnsri\Feeder\ListMahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ExportDataController extends Controller
{

    public function index(Request $req)
    {
        $this->authorize('admin-univ');

        $table_name = array("Daftar Mahasiswa", "Nilai Transfer", "Penugasan Dosen", "Mata Kuliah", "Kelas Perkuliahan", "KRS Mahasiswa", "Aktivitas Mengajar Dosen", "Aktivitas Kuliah", "Mahasiswa Lulus/DO", "Transkrip");

        $program_studi = ProgramStudi::select('id_prodi', DB::raw("CONCAT(nama_jenjang_pendidikan,' ',nama_program_studi) AS nama_program_studi"))->orderby('id_jenjang_pendidikan', 'asc')->get();

        $periode = Semester::select('id_tahun_ajaran',DB::raw("LEFT(nama_semester,9) AS nama_tahun_ajaran"))->orderby('id_tahun_ajaran', 'desc')->distinct()->get();

        $semester = Semester::select('id_semester','nama_semester')->orderby('id_semester', 'desc')->get();

        $status_mahasiswa = ListMahasiswa::select('nama_status_mahasiswa')->orderby('nama_status_mahasiswa','asc')->distinct()->get();

        if($req->table_name == "Daftar Mahasiswa"){
            return Excel::download(new ExportDaftarMahasiswa($req->program_studi, $req->periode, $req->status_mahasiswa), 'DAFTAR MAHASISWA-'.$req->periode.'.xlsx');
        }

        if($req->table_name == "Penugasan Dosen"){
            return Excel::download(new ExportPenugasanDosen($req->program_studi, $req->periode), 'DAFTAR PENUGASAN DOSEN-'.$req->periode.'.xlsx');
        }

        if($req->table_name == "Mata Kuliah"){
            return Excel::download(new ExportMataKuliah($req->program_studi), 'DAFTAR MATA KULIAH-'.$req->program_studi.'.xlsx');
        }

        if($req->table_name == "Aktivitas Kuliah"){
            return Excel::download(new ExportAktivitasPerkuliahan($req->program_studi, $req->semester), 'DAFTAR AKTIVITAS KULIAH-'.$req->program_studi.'-'.$req->semester.'.xlsx');
        }

        if($req->table_name == "Mahasiswa Lulus/DO"){
            return Excel::download(new ExportMahasiswaLulusDO($req->program_studi, $req->periode), 'DAFTAR MAHASISWA LULUS DO-'.$req->periode.'.xlsx');
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



        return view('backend.univ.export-data.index', compact('table_name', 'program_studi', 'periode', 'semester', 'status_mahasiswa'));
    }
}

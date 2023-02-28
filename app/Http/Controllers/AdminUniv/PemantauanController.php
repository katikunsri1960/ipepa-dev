<?php

namespace App\Http\Controllers\AdminUniv;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PDUnsri\Feeder\ListMahasiswa;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class PemantauanController extends Controller
{
    public function index(Request $req)
    {

         // get distinct from nama_status with collection
         $status = ListMahasiswa::select('nama_status_mahasiswa as nama_status')->distinct()->get();
        // collection values to array
        $status = $status->map(function ($item, $key) {
            return $item->nama_status;
        })->values()->toArray();

        $angkatan = ListMahasiswa::select(DB::raw('LEFT(id_periode, 4) as angkatan'))->distinct()->get();

        $angkatan = $angkatan->map(function ($item, $key) {
            return $item->angkatan;
        })->values()->toArray(); 

        //sort $angkatan ascending
        sort($angkatan);

        //eloquent query count List Mahasiswa by left id periode
        $mahasiswaFix = ListMahasiswa::select(DB::raw('LEFT(id_periode, 4) as angkatan'), 'nama_status_mahasiswa as nama_status', DB::raw('count(*) as total'))
                                    ->groupBy('angkatan', 'nama_status')
                                    ->orderBy('angkatan')
                                    ->get();

        if ($req->has('start') && $req->has('end') && $req->start != null && $req->end != null) {
            $mahasiswaFix = $mahasiswaFix->filter(function ($item, $key) use ($req) {
                return $item->angkatan >= $req->start && $item->angkatan <= $req->end;
            });
        }

        // convert collection into 3d array with angkatan as key, status second as key inside angkatan, and total as value
        $mahasiswaFix = $mahasiswaFix->groupBy('angkatan')->map(function ($item, $key) {
            return $item->groupBy('nama_status')->map(function ($item, $key) {
                return $item->map(function ($item, $key) {
                    return $item->total;
                });
            });
        })->toArray();

        // convert total into value with key status
        foreach ($mahasiswaFix as $key => $value) {
            foreach ($value as $key2 => $value2) {
                $mahasiswaFix[$key][$key2] = $value2[0];
            }
        }

        // convert mahasiswafix to array and fill empty status
        foreach ($mahasiswaFix as $key => $value) {
            foreach ($status as $key2 => $value2) {
                if (!array_key_exists($value2, $value)) {
                    $mahasiswaFix[$key][$value2] = 0;
                }
            }
        }

        // sort key status
        foreach ($mahasiswaFix as $key => $value) {
            ksort($mahasiswaFix[$key]);
        }
        
        $totalPerYear = json_encode($mahasiswaFix, JSON_NUMERIC_CHECK);
      
        $mahasiswaPerStatus = json_encode($mahasiswaFix, JSON_NUMERIC_CHECK);

        // dd($status);

        return view('backend.univ.pemantauan.index', compact('mahasiswaFix', 'totalPerYear', 'mahasiswaPerStatus', 'angkatan'));
    }

    public function dev(Request $req)
    {
      
        // get distinct from nama_status with collection
        $status = ListMahasiswa::select('nama_status_mahasiswa as nama_status')->distinct()->get();
        // collection values to array
        $status = $status->map(function ($item, $key) {
            return $item->nama_status;
        })->values()->toArray();

        $angkatan = ListMahasiswa::select(DB::raw('LEFT(id_periode, 4) as angkatan'))->distinct()->get();

        $angkatan = $angkatan->map(function ($item, $key) {
            return $item->angkatan;
        })->values()->toArray(); 

        //sort $angkatan ascending
        sort($angkatan);

        //eloquent query count List Mahasiswa by left id periode
        $mahasiswaFix = ListMahasiswa::select(DB::raw('LEFT(id_periode, 4) as angkatan'), 'nama_status_mahasiswa as nama_status', DB::raw('count(*) as total'))
                                    ->groupBy('angkatan', 'nama_status')
                                    ->orderBy('angkatan')
                                    ->get();

        if ($req->has('start') && $req->has('end') && $req->start != null && $req->end != null) {
            $mahasiswaFix = $mahasiswaFix->filter(function ($item, $key) use ($req) {
                return $item->angkatan >= $req->start && $item->angkatan <= $req->end;
            });
        }

        // convert collection into 3d array with angkatan as key, status second as key inside angkatan, and total as value
        $mahasiswaFix = $mahasiswaFix->groupBy('angkatan')->map(function ($item, $key) {
            return $item->groupBy('nama_status')->map(function ($item, $key) {
                return $item->map(function ($item, $key) {
                    return $item->total;
                });
            });
        })->toArray();

        // convert total into value with key status
        foreach ($mahasiswaFix as $key => $value) {
            foreach ($value as $key2 => $value2) {
                $mahasiswaFix[$key][$key2] = $value2[0];
            }
        }

        // convert mahasiswafix to array and fill empty status
        foreach ($mahasiswaFix as $key => $value) {
            foreach ($status as $key2 => $value2) {
                if (!array_key_exists($value2, $value)) {
                    $mahasiswaFix[$key][$value2] = 0;
                }
            }
        }

        // sort key status
        foreach ($mahasiswaFix as $key => $value) {
            ksort($mahasiswaFix[$key]);
        }
        
        $totalPerYear = json_encode($mahasiswaFix, JSON_NUMERIC_CHECK);
      
        $mahasiswaPerStatus = json_encode($mahasiswaFix, JSON_NUMERIC_CHECK);


        return view('backend.univ.pemantauan.index', compact('mahasiswaFix', 'totalPerYear', 'mahasiswaPerStatus', 'angkatan'));
    }
}

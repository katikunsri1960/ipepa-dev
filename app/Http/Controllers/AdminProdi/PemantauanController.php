<?php

namespace App\Http\Controllers\AdminProdi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PDUnsri\Feeder\ListMahasiswa;
use App\Models\RolesUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class PemantauanController extends Controller
{
    public function index(Request $req)
    {
        $this->authorize('admin-prodi');

        $prodiId = RolesUser::where('user_id', auth()->user()->id)->value('fak_prod_id');

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
        $mahasiswaFix = ListMahasiswa::where('id_prodi', $prodiId)->select(DB::raw('LEFT(id_periode, 4) as angkatan'), 'nama_status_mahasiswa as nama_status', DB::raw('count(*) as total'))
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

        return view('backend.prodi.pemantauan.index', compact('mahasiswaFix', 'totalPerYear', 'mahasiswaPerStatus', 'angkatan'));
    }

    public function dev(Request $req)
    {
        $this->authorize('admin-prodi');

        $prodiId = RolesUser::where('user_id', auth()->user()->id)->value('fak_prod_id');

        $mahasiswa = ListMahasiswa::where('pd_feeder_list_mahasiswa.id_prodi', $prodiId)->leftJoin('pd_feeder_list_mahasiswa_lulus_do as lo', 'pd_feeder_list_mahasiswa.id_registrasi_mahasiswa',  'lo.id_registrasi_mahasiswa')
                                    ->select('pd_feeder_list_mahasiswa.id_registrasi_mahasiswa as id_rm', 'pd_feeder_list_mahasiswa.nama_status_mahasiswa as nama_status',
                                            'pd_feeder_list_mahasiswa.id_periode as angkatan', 'lo.tgl_masuk_sp as tgl_masuk', 'lo.tgl_sk_yudisium')->orderBy('angkatan', 'asc')->get();

        // get distinct from nama_status
        $status = $mahasiswa->map(function ($item, $key) {
            return $item->nama_status;
        })->unique()->values()->toArray();



        $mahasiswaFix = $mahasiswa->map(function ($item, $key) {
            $item->angkatan = substr($item->angkatan, 0, 4);
            return $item;
        });

        // get array angkatan
        $angkatan = $mahasiswaFix->map(function ($item, $key) {
            return $item->angkatan;
        })->unique()->values()->toArray();

        // filter by range year
        if ($req->has('start') && $req->has('end') && $req->start != null && $req->end != null) {
            $mahasiswaFix = $mahasiswaFix->filter(function ($item, $key) use ($req) {
                return $item->angkatan >= $req->start && $item->angkatan <= $req->end;
            });
        }

        //total per year
        $total = $mahasiswaFix->groupBy('angkatan')->map(function ($item, $key) {
            return $item->count();
        })->toArray();

        $totalPerYear = json_encode($total, JSON_NUMERIC_CHECK);

        $mahasiswaFix = $mahasiswaFix->groupBy('angkatan')->map(function ($item, $key) {
            return $item->groupBy('nama_status');

        });

        $mahasiswaFix = $mahasiswaFix->sortBy('nama_status')->map(function ($item, $key) {
            return $item->map(function ($item, $key) {
                return $item->count();
            });
        })->toArray();

        // fill empty status and sort by status
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

        // make count into percentage with total 100%
        // foreach ($mahasiswaFix as $key => $value) {
        //     $total = array_sum($value);
        //     foreach ($value as $key2 => $value2) {
        //         $mahasiswaFix[$key][$key2] = round(($value2 / $total) * 100, 2);
        //     }
        // }

        //convert to json
        // $mahasiswaFix = json_encode($mahasiswaFix, JSON_NUMERIC_CHECK);

        // // dd($mahasiswaFix);
        // dd($mahasiswaFix);

        $mahasiswaPerStatus = json_encode($mahasiswaFix, JSON_NUMERIC_CHECK);

        // dd($status);

        return view('backend.prodi.pemantauan.dev', compact('mahasiswaFix', 'totalPerYear', 'mahasiswaPerStatus', 'angkatan'));
    }
}

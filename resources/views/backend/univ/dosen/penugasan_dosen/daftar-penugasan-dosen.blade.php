@extends('layouts.admin-univ.layout')
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h2>Penugasan Dosen</h2>
    </div>
    <div class="ibox-content p-md">
        <div class="row">
            <div class="col-lg-12">
                <div class="widget yellow-bg no-padding">
                    <div class="p-m">
                        <h3 class="font-bold no-margins">
                            Catatan :
                        </h3>
                        <h5>Mencatat penugasan dosen setiap tahunnya, Data penugasan hanya dapat di ubah pada laman <a href="http://pddikti.kemendikbud.go.id">http://pddikti.kemendikbud.go.id</a></h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4 col-12">
                <form method="GET" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control" name="keyword"
                            placeholder="Search by NIDN or Nama" value="{{request()->get('keyword','')}}"> <span class="input-group-btn">
                            <button class="btn btn-default">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <div class="pt-2">
            <table class="table table-bordered table-hover table-responsive" id="table-mahasiswa">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">NIDN / NUP / NIDK</th>
                        <th class="text-center">Jenis Kelamin</th>
                        <th class="text-center">Tahun Ajaran</th>
                        <th class="text-center">Program Studi</th>
                        <th class="text-center">No. Surat Tugas</th>
                        <th class="text-center">Tanggal Surat Tugas</th>
                        <th class="text-center">Homebase?</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dosen as $d => $data)
                    <tr>
                        <td class="text-center">{{$dosen->firstItem() + $d}}</td>
                        <td><a href="{{route('admin-univ.detail-daftar-penugasan-dosen', ['id' => $data->id_dosen,'tahun' => $data->id_tahun_ajaran,'prodi' => $data->id_prodi])}}" name="req">{{$data->nama_dosen}}</a> </td>
                        <td class="text-center">{{$data->nidn}}</td>
                        <td class="text-center">{{$data->jk}}</td>
                        <td class="text-center">{{$data->nama_tahun_ajaran}}</td>
                        <td class="text-center">{{$data->nama_program_studi}}</td>
                        <td class="text-center">{{$data->nomor_surat_tugas}}</td>
                        <td class="text-center">{{$data->tanggal_surat_tugas}}</td>
                        <td class="text-center">{{$data->a_sp_homebase}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- {{$dosen->getOptions()}} --}}
            {!! $dosen->withQueryString()->links() !!}
        </div>

        {{-- {{$dosen->onEachSide(5)->links()}} --}}
    </div>
</div>

@endsection

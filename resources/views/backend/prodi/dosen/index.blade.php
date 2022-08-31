@extends('layouts.admin-prodi.layout')
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h2>Daftar Dosen</h2>
    </div>
    <div class="ibox-content p-md">
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
                        <th class="text-center">NIDN</th>
                        <th class="text-center">Jenis Kelamin</th>
                        <th class="text-center">Agama</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Tanggal Lahir</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dosen as $d => $data)
                    <tr>
                        <td class="text-center">{{$dosen->firstItem() + $d}}</td>
                        <td><a href="{{route('admin-prodi.detail-dosen', ['id' => $data->id_dosen])}}">{{$data->nama_dosen}}</a> </td>
                        <td class="text-center">{{$data->nidn}}</td>
                        <td class="text-center">{{$data->jenis_kelamin}}</td>
                        <td class="text-center">{{$data->nama_agama}}</td>
                        <td class="text-center">{{$data->nama_status_aktif}}</td>
                        <td class="text-center">{{$data->tanggal_lahir}}</td>
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

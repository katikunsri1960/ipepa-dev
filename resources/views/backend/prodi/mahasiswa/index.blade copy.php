@extends('layouts.admin-prodi.layout')
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-content p-md">
        <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4 col-12">
                <form method="GET" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control" name="keyword"
                            placeholder="Search by NIM, Nama, Program Studi" value="{{request()->get('keyword','')}}"> <span class="input-group-btn">
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
                        <th class="text-center">NIM</th>
                        <th class="text-center">Jenis Kelamin</th>
                        <th class="text-center">Agama</th>
                        <th class="text-center">Total SKS Diambil</th>
                        <th class="text-center">Tanggal Lahir</th>
                        <th class="text-center">Program Studi</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Angkatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mahasiswa as $m => $data)
                    <tr>
                        <td class="text-center">{{$mahasiswa->firstItem() + $m}}</td>
                        <td><a href="{{route('admin-prodi.detail-mahasiswa', ['id' => $data->id_mahasiswa])}}">{{$data->nama_mahasiswa}}</a> </td>
                        <td class="text-center">{{$data->nim}}</td>
                        <td class="text-center">{{$data->jenis_kelamin}}</td>
                        <td class="text-center">{{$data->nama_agama}}</td>
                        <td class="text-center">{{$data->total_sks}}</td>
                        <td class="text-center">{{$data->tanggal_lahir}}</td>
                        <td class="text-center">{{$data->nama_program_studi}}</td>
                        <td class="text-center">{{$data->nama_status_mahasiswa}}</td>
                        <td class="text-center">
                            @if(strlen($data->id_periode) > 4)
                            {{substr($data->id_periode, 0, 4)}}
                            @else
                            {{$data->id_periode}}
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- {{$mahasiswa->getOptions()}} --}}
            {!! $mahasiswa->withQueryString()->links() !!}
        </div>

        {{-- {{$mahasiswa->onEachSide(5)->links()}} --}}
    </div>
</div>

@endsection

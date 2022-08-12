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
                    @foreach($mahasiswa as $m)
                    <tr>
                        <td>{{$m->nama_mahasiswa}}</td>
                        <td>{{$m->nim}}</td>
                        <td>{{$m->jenis_kelamin}}
                        </td>
                        <td>{{$m->nama_agama}}</td>
                        <td class="text-center">{{$m->total_sks}}</td>
                        <td>{{$m->tanggal_lahir}}</td>
                        <td>{{$m->nama_program_studi}}</td>
                        <td>{{$m->nama_status_mahasiswa}}</td>
                        <td class="text-center">
                            @if(strlen($m->id_periode) > 4)
                            {{substr($m->id_periode, 0, 4)}}
                            @else
                            {{$m->id_periode}}
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

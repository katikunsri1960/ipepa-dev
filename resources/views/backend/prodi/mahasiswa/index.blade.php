@extends('layouts.admin-prodi.layout')
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-content p-md">
        <div class="row">
            <div class="col-md-8">
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-filter"><i
                        class="fa-solid fa-filter"></i><span style="margin-left: 6px; margin-right: 6px">Filter</span>
                </button>

                <div id="modal-filter" class="modal fade" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="row">
                                    <form method="GET">
                                        <div class="form-group">
                                            <label>Program Studi</label>
                                            <select name="prodi" id="prodi" class="form-control">
                                                <option value=""></option>
                                                @foreach ($prodi as $p)
                                                <option value="{{$p->id_prodi}}">{{$p->nama_program_studi}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Pilih Angkatan</label>
                                            <select name="angkatan" id="angkatan" class="chosen-select" multiple tabindex="4">
                                                <option value=""></option>
                                                @foreach ($angkatan as $ang)
                                                <option value="{{$ang->id_periode}}">
                                                    @if(strlen($ang->id_periode) > 4)
                                                    {{substr($ang->id_periode, 0, 4)}}
                                                    @else
                                                    {{$ang->id_periode}}
                                                    @endif
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Pilih Status Mahasiswa</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value=""></option>
                                                @foreach ($status as $s)
                                                <option value="{{$s->nama_status_mahasiswa}}">
                                                    {{$s->nama_status_mahasiswa}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Pilih Jenis Kelamin</label>
                                            <select name="jk" id="jk" class="form-control">
                                                <option value=""></option>
                                                @foreach ($jk as $j)
                                                <option value="{{$j->jenis_kelamin}}">{{$j->jenis_kelamin}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Pilih Agama</label>
                                            <select name="agama" id="agama" class="form-control">
                                                <option value=""></option>
                                                @foreach ($agama as $a)
                                                <option value="{{$a->id_agama}}">{{$a->nama_agama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button class="btn btn-warning" type="submit">Apply Filter</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12">
                <form method="GET" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control" name="keyword"
                            placeholder="Search by NIM, Nama, Program Studi" value="{{request()->get('keyword','')}}">
                        <span class="input-group-btn">
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
                        <td><a
                                href="{{route('admin-prodi.detail-mahasiswa', ['id' => $data->id_mahasiswa])}}">{{$data->nama_mahasiswa}}</a>
                        </td>
                        <td class="text-center">{{$data->nim}}</td>
                        <td class="text-center">{{$data->jenis_kelamin}}</td>
                        <td class="text-center">{{$data->nama_agama}}</td>
                        <td class="text-center">
                            @if (!empty($data->total))
                            {{$data->total}}
                            @else
                            0
                            @endif
                        </td>
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

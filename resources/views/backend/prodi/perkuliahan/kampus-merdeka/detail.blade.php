@extends('layouts.admin-prodi.layout')
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Kegiatan Kampus Merdeka</h5>
    </div>
    <div class="ibox-content">
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary pull-right" href="{{route('admin-prodi.kampus-merdeka')}}"><i
                        class="fa-solid fa-list"></i> <span>Daftar</span></a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="widget yellow-bg no-padding text-vertical-midle">
                    <div class="p-md">
                        <h4>Menampilkan dan mengelola data nilai mahasiswa dari kegiatan kampus merdeka </h4>
                    </div>
                </div>
            </div>
        </div><br>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Program Studi <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ $data->nama_prodi }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Jenis Aktivitas <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ $data->nama_jenis_aktivitas }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Semester</label>
                    <input type="name" class="form-control" disabled value="{{ $data->nama_semester }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Judul</label>
                    <textarea class="form-control" disabled>{{ $data->judul }}</textarea>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Jenis Anggota <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ $data->nama_jenis_anggota }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Keterangan</label>
                    <input type="name" class="form-control" disabled value="{{ $data->keterangan }}">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="ibox float-e-margins">
    <div class="ibox-content">
        <div class="row m-t-sm">
            <div class="col-lg-12">
                <div class="panel blank-panel">
                    <div class="panel-heading">
                        <div class="panel-options">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab-1" data-toggle="tab" aria-expanded="true">PESERTA AKTIVITAS</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab-1">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No.</th>
                                            <th class="text-center">NIM</th>
                                            <th class="text-center">Nama Peserta</th>
                                            <th class="text-center">Jenis</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($anggota as $a)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{$a->nim}}</td>
                                            <td class="text-left">{{$a->nama_mahasiswa}}</td>
                                            <td class="text-center">{{$a->jenis_peran}}<br>{{$a->nama_jenis_peran}}
                                            </td>
                                            <td class="text-center">
                                                {{-- detail --}}

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

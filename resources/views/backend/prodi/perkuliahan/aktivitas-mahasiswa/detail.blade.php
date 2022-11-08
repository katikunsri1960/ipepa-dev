@extends('layouts.admin-prodi.layout')
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Aktivitas Mahasiswa</h5>
    </div>
    <div class="ibox-content">
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary pull-right" href="{{route('admin-prodi.aktivitas-mahasiswa')}}"><i class="fa-solid fa-list"></i> <span>Daftar Aktivitas</span></a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="widget yellow-bg no-padding text-vertical-midle">
                    <div class="p-md">
                        <h4>Mengelola aktivitas mahasiswa per periode </h4>
                    </div>
                </div>
            </div>
        </div><br>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Program Studi <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ $detail[0]->nama_prodi}}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Semester <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ $detail[0]->nama_semester}}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Nomor SK Tugas</label>
                    <input type="name" class="form-control" disabled value="{{ $detail[0]->sk_tugas}}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Tanggal SK Tugas</label>
                    <input type="name" class="form-control" disabled value="{{ $detail[0]->tanggal_sk_tugas}}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Jenis Aktivitas <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ $detail[0]->nama_jenis_aktivitas}}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Jenis Anggota</label>
                    <input type="name" class="form-control" disabled value="{{ $detail[0]->nama_jenis_anggota}}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Judul <span style="color: red">*</span></label>
                    <input type="text" class="form-control" disabled value="{{ $detail[0]->judul}}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Keterangan</label>
                    <input type="text" class="form-control" disabled value="{{ $detail[0]->keterangan}}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Lokasi</label>
                    <input type="name" class="form-control" disabled value="{{ $detail[0]->lokasi}}">
                </div>
            </div>
        </div>
    </div>
</div><br>
<div class="ibox float-e-margins">
    {{-- <div class="ibox-title">
        <h5>Informasi Detail Mahasiswa</h5>
        <div class="ibox-tools">
            <a class="collapse-link">
                <i class="fa fa-chevron-up"></i>
            </a>
            <a class="close-link">
                <i class="fa fa-times"></i>
            </a>
        </div>
    </div> --}}
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
                                <li class="">
                                    <a href="#tab-2" data-toggle="tab" aria-expanded="false">DOSEN PEMBIMBING</a>
                                </li>
                                <li class="">
                                    <a href="#tab-3" data-toggle="tab" aria-expanded="false">DOSEN PENGUJI</a>
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
                                            <th class="text-center">NIM</th>
                                            <th class="text-center">Nama Mahasiswa</th>
                                            <th class="text-center">Jenis</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($detail as $pes)
                                            <tr>
                                                <td class="text-center">{{$pes->nim}}</td>
                                                <td class="text-left">{{$pes->nama_mahasiswa}}</td>
                                                <td class="text-center">{{$pes->jenis_peran}}<br>{{$pes->nama_jenis_peran}}</td>
                                                <td class="text-center">-</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="tab-2">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            {{-- <th class="text-center">No.</th> --}}
                                            <th class="text-center">NIDN/ NUPN/ NIDK </th>
                                            <th class="text-center">Nama Dosen</th>
                                            <th class="text-center">Pembimbing Ke</th>
                                            <th class="text-center">Kategori Kegiatan</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pembimbing as $no => $data)
                                            <tr>
                                                {{-- <td class="text-center">{{$data->firstItem() + $no}}</td> --}}
                                                <td class="text-left">{{$data->nidn}}</td>
                                                <td class="text-left">{{$data->nama_dosen}}</td>
                                                <td class="text-center">{{$data->pembimbing_ke}}</td>
                                                <td class="text-center">{{$data->jenis_aktivitas}}</td>
                                                <td class="text-center">-</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="tab-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            {{-- <th class="text-center">No.</th> --}}
                                            <th class="text-center">NIDN/ NUPN/ NIDK </th>
                                            <th class="text-center">Nama Dosen</th>
                                            <th class="text-center">Pembimbing Ke</th>
                                            <th class="text-center">Kategori Kegiatan</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($penguji as $no => $data)
                                            <tr>
                                                {{-- <td class="text-center">{{$data->firstItem() + $no}}</td> --}}
                                                <td class="text-left">{{$data->nidn}}</td>
                                                <td class="text-left">{{$data->nama_dosen}}</td>
                                                <td class="text-center">{{$data->penguji_ke}}</td>
                                                <td class="text-center">{{$data->nama_kategori_kegiatan}}</td>
                                                <td class="text-center">-</td>
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

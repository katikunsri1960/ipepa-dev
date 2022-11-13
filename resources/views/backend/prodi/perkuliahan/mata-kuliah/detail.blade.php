@extends('layouts.admin-prodi.layout')
@section('content')

<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Mata kuliah</h5>
    </div>
    <div class="ibox-content">
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary pull-right" href="{{route('admin-prodi.mata-kuliah')}}"><i class="fa-solid fa-list"></i> <span>Daftar Mata Kuliah</span></a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="widget yellow-bg no-padding text-vertical-midle">
                    <div class="p-md">
                        <h4>Menampilkan dan Mengelola Mata Kuliah</h4>
                    </div>
                </div>
            </div>
        </div><br>

        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Kode Mata Kuliah <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ $detail_matkul[0]->kode_mata_kuliah }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Nama Mata Kuliah <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ $detail_matkul[0]->nama_mata_kuliah }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Program Studi Pengampu <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ $detail_matkul[0]->nama_program_studi }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Jenis Mata Kuliah</label>
                    <input type="name" class="form-control" disabled value="{{ $detail_matkul[0]->nama_jenis_mk }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Bobot Mata Kuliah</label>
                    <input type="name" class="form-control" disabled value="{{ $detail_matkul[0]->sks_mata_kuliah }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Bobot Tatap Muka</label>
                    <input type="name" class="form-control" disabled value="{{ $detail_matkul[0]->sks_tatap_muka }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Bobot Praktikum</label>
                    <input type="name" class="form-control" disabled value="{{ $detail_matkul[0]->sks_praktek }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Bobot Praktek Lapangan</label>
                    <input type="name" class="form-control" disabled value="{{ $detail_matkul[0]->sks_praktek_lapangan }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Bobot Simulasi</label>
                    <input type="name" class="form-control" disabled value="{{ $detail_matkul[0]->sks_simulasi }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Metode Pembelajaran</label>
                    <input type="name" class="form-control" disabled value="{{ $detail_matkul[0]->metode_kuliah }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Tanggal Mulai Efektif</label>
                    <input type="name" class="form-control" disabled value="{{ $detail_matkul[0]->tanggal_mulai_efektif }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Tanggal Akhir Efektif</label>
                    <input type="name" class="form-control" disabled value="{{ $detail_matkul[0]->tanggal_selesai_efektif }}">
                </div>
            </div>
        </div>
    </div>
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
                                    <a href="#tab-1" data-toggle="tab" aria-expanded="true">RENCANA PEMBELAJARAN</a>
                                </li>
                                <li class="">
                                    <a href="#tab-2" data-toggle="tab" aria-expanded="false">RENCANA EVALUASI</a>
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
                                            <th rowspan="2" class="text-center">No.</th>
                                            <th rowspan="2" class="text-center">Pertemuan</th>
                                            <th rowspan="2" class="text-center">Materi</th>
                                            <th rowspan="2" class="text-center">Materi (Inggris)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pembelajaran as $no => $data)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-left">{{$data->pertemuan}}</td>
                                                <td class="text-left">{{$data->materi_indonesia}}</td>
                                                <td class="text-left">{{$data->materi_inggris}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="tab-2">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="text-center">No.</th>
                                            <th rowspan="2" class="text-center">Basis Evaluasi</th>
                                            <th rowspan="2" class="text-center">Komponen Evaluasi</th>
                                            <th rowspan="2" class="text-center">Deskripsi</th>
                                            <th rowspan="2" class="text-center">Bobot (%)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($evaluasi as $data)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-left">{{$data->jenis_evaluasi}}</td>
                                                <td class="text-center">{{$data->nama_evaluasi}}</td>
                                                <td class="text-left">{{$data->deskripsi_indonesia}}</td>
                                                <td class="text-center">{{$data->bobot_evaluasi}}</td>
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

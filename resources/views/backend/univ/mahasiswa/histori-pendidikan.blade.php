@extends('layouts.admin-univ.layout')
@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Informasi Detail Mahasiswa</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
                <a class="close-link">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        @include('backend.univ.mahasiswa.btn-nav')
    </div>

    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Data Mahasiswa</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
                <a class="close-link">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="name" class="form-control" disabled value="{{ $mahasiswa->nama_mahasiswa }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="name" class="form-control" disabled value="{{ $mahasiswa->tempat_lahir }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <input type="name" class="form-control" disabled value="{{ $mahasiswa->jenis_kelamin }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="name" class="form-control" disabled value="{{ $mahasiswa->tanggal_lahir }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Agama</label>
                        <input type="name" class="form-control" disabled value="{{ $mahasiswa->nama_agama }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>History Pendidikan Mahasiswa</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
                <a class="close-link">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        <div class="ibox-content">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Action</th>
                        <th class="text-center">NIM</th>
                        <th class="text-center">Jnis Pendaftaran</th>
                        <th class="text-center">Periode</th>
                        <th class="text-center">Tanggal Masuk</th>
                        <th class="text-center">Perguruan Tinggi</th>
                        <th class="text-center">Program Studi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($riwayat as $dataR)
                        <tr>
                            <td class="text-center"><button class="btn btn-info btn-circle" type="button"
                                data-toggle="modal" data-target="#modal-form"><i class="fa fa-file"></i></button></td>
                            <td class="text-center">{{$dataR->nim}}</td>
                            <td class="text-center">{{$dataR->nama_jenis_daftar}}</td>
                            <td class="text-center">{{$dataR->nama_periode_masuk}}</td>
                            <td class="text-center">{{$dataR->tanggal_daftar}}</td>
                            <td class="text-center">{{$dataR->nama_perguruan_tinggi}}</td>
                            <td class="text-center">{{$dataR->nama_program_studi}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="modal-form" class="modal fade" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>NIM</label>
                                        <input type="text" class="form-control" disabled value="{{ ($riwayat[0]->nim!='') $riwayat[0]->nim ? "-" }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Jenis Pendaftaran</label>
                                        <input type="text" class="form-control" disabled value="{{ ($riwayat[0]->nama_jenis_daftar!='') ? $riwayat[0]->nama_jenis_daftar :"-" }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Jalur Pendaftaran</label>
                                        <input type="text" class="form-control" disabled value="{{ ($riwayat[0]->jalur_masuk!='') ? $riwayat[0]->jalur_masuk :"-" }}">
                                    </div>
                                </div>
                                <div class="col-lg-6"><div class="form-group">
                                    <label>Periode Pendaftaran</label>
                                    <input type="text" class="form-control" disabled value="{{ ($riwayat[0]->nama_periode_masuk!='') ? $riwayat[0]->nama_periode_masuk :"-" }}">
                                </div></div>
                                <div class="col-lg-6"><div class="form-group">
                                    <label>Tanggal Masuk</label>
                                    <input type="text" class="form-control" disabled value="{{ ($riwayat[0]->tanggal_daftar!='') ? $riwayat[0]->tanggal_daftar :"-" }}">
                                </div></div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Pembiayaan Awal</label>
                                        <input type="text" class="form-control" disabled value="{{ ($riwayat[0]->nama_pembiayaan_awal!='') ? $riwayat[0]->nama_pembiayaan_awal :"-" }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Biaya Masuk</label>
                                        <input type="text" class="form-control" disabled value="{{ ($riwayat[0]->biaya_masuk!='') ? $riwayat[0]->biaya_masuk :"-" }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Perguruan Tinggi</label>
                                        <input type="text" class="form-control" disabled value="{{ ($riwayat[0]->nama_perguruan_tinggi!='') ? $riwayat[0]->nama_perguruan_tinggi :"-" }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Fakultas / Program Studi</label>
                                        <input type="text" class="form-control" disabled value="{{ ($riwayat[0]->nama_program_studi!='') ? $riwayat[0]->nama_program_studi :"-" }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Peminatan</label>
                                        <input type="text" class="form-control" disabled value="{{ ($riwayat[0]->nama_bidang_minat!='') ? $riwayat[0]->nama_bidang_minat :"-" }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

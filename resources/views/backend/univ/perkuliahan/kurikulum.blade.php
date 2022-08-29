@extends('layouts.admin-univ.layout')
@section('content')
    <!-- <div class="ibox float-e-margins">
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
        @include('backend.univ.perkuliahan.btn-nav')
    </div> -->
    <!-- <div class="ibox float-e-margins">
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
                        <label>NIM</label>
                        <input type="name" class="form-control" disabled value="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="name" class="form-control" disabled value="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Program Studi</label>
                        <input type="name" class="form-control" disabled value="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Angkatan</label>
                        <input type="name" class="form-control" disabled value="">
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Kurikulum</h5>
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
                        <th rowspan="2" class="text-center" style="vertical-align: middle">No.</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Nama Kurikulum</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Program Studi</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Mulai Berlaku</th>
                        <th colspan="3" class="text-center" style="vertical-align: middle">Aturan Jumlah sks</th>
                        <th colspan="2" class="text-center" style="vertical-align: middle">Jumlah sks Matakuliah</th>
                    </tr>
                    <tr>
                        <th class="text-center" style="vertical-align: middle">Lulus</th>
                        <th class="text-center" style="vertical-align: middle">Wajib</th>
                        <th class="text-center" style="vertical-align: middle">Pilihan</th>

                        <th class="text-center" style="vertical-align: middle">Wajib</th>
                        <th class="text-center" style="vertical-align: middle">Pilihan</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
@endsection

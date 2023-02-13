@extends('layouts.admin-univ.layout')
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Pengaturan Periode Perkuliahan</h5>
    </div>
    <div class="ibox-content">
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary pull-right" href="{{route('admin-univ.periode-perkuliahan')}}"><i class="fa-solid fa-list"></i> <span>Daftar Periode Perkuliahan</span></a>
            </div>
        </div><br>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Semester <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ ($detail_periode_kuliah[0]->nama_semester!='') ? $detail_periode_kuliah[0]->nama_semester :"-" }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Program Studi <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ ($detail_periode_kuliah[0]->nama_program_studi!='') ? $detail_periode_kuliah[0]->nama_program_studi :"-" }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Target Mahasiswa Baru <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ ($detail_periode_kuliah[0]->jumlah_target_mahasiswa_baru!='') ? $detail_periode_kuliah[0]->jumlah_target_mahasiswa_baru :"-" }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Pendaftar Ikut Seleksi <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ ($detail_periode_kuliah[0]->jumlah_pendaftar_ikut_seleksi!='') ? $detail_periode_kuliah[0]->jumlah_pendaftar_ikut_seleksi :"-" }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Pendaftar Lulus Seleksi <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ ($detail_periode_kuliah[0]->jumlah_pendaftar_lulus_seleksi!='') ? $detail_periode_kuliah[0]->jumlah_pendaftar_lulus_seleksi :"-" }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Daftar Ulang <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ ($detail_periode_kuliah[0]->jumlah_daftar_ulang!='') ? $detail_periode_kuliah[0]->jumlah_daftar_ulang :"-" }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Mengundurkan Diri <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ ($detail_periode_kuliah[0]->jumlah_mengundurkan_diri!='') ? $detail_periode_kuliah[0]->jumlah_mengundurkan_diri :"-" }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Jumlah Minggu Pertemuan</label>
                    <input type="name" class="form-control" disabled value="{{ ($detail_periode_kuliah[0]->jumlah_minggu_pertemuan!='') ? $detail_periode_kuliah[0]->jumlah_minggu_pertemuan :"-" }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Tanggal Perkuliahan <span style="color: red">*</span></label>
                    <input type="date" class="form-control" disabled value="{{ ($detail_periode_kuliah[0]->tanggal_awal_perkuliahan!='') ? $detail_periode_kuliah[0]->tanggal_awal_perkuliahan :"-" }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Akhir Perkuliahan <span style="color: red">*</span></label>
                    <input type="date" class="form-control" disabled value="{{ ($detail_periode_kuliah[0]->tanggal_akhir_perkuliahan!='') ? $detail_periode_kuliah[0]->tanggal_akhir_perkuliahan :"-" }}">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

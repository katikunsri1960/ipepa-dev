@extends('layouts.admin-prodi.layout')
@section('content')

<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Detail Mata Kuliah</h5>
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
        <div class="widget blue-bg no-padding">
            <div class="p-m">
                <h5 class="font-bold no-margins">
                    Menampilkan Mata Kuliah
                </h5>
            </div>
        </div>
        <div class="row p-m">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="kodemk">Kode Mata Kuliah</label>
                    <input type="text" class="form-control" value="{{$detail[0]->kode_mata_kuliah}}" disabled>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="namamk">Nama Mata Kuliah</label>
                    <input type="text" class="form-control" value="{{$detail[0]->nama_mata_kuliah}}" disabled>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="prodiampu">Program Studi Pengampu</label>
                    <input type="text" class="form-control" value="{{$detail[0]->nama_program_studi}}" disabled>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="jenismk">Jenis Mata Kuliah</label>
                    <input type="text" class="form-control" value="{{$detail[0]->nama_jenis_mk}}" disabled>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="bobokmt">Bobot Mata Kuliah</label>
                    <input type="text" class="form-control" value="{{$detail[0]->sks_mata_kuliah}}" disabled>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="bobottm">Bobot Tatap Muka</label>
                    <input type="text" class="form-control" value="{{$detail[0]->sks_tatap_muka}}" disabled>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="bobotprak">Bobot Praktikum</label>
                    <input type="text" class="form-control" value="{{$detail[0]->sks_praktik}}" disabled>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="bobotpl">Bobot Praktek Lapangan</label>
                    <input type="text" class="form-control" value="{{$detail[0]->sks_praktek_lapangan}}" disabled>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="bobotsim">Bobot Simulasi</label>
                    <input type="text" class="form-control" value="{{$detail[0]->sks_simulasi}}" disabled>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="metodepem">Metode Pembelajaran</label>
                    <input type="text" class="form-control" value="{{$detail[0]->metode_kuliah}}" disabled>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="tme">Tanggal Mulai Efektif</label>
                    <input type="text" class="form-control" value="{{$detail[0]->tanggal_mulai_efektif}}" disabled>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="tae">Tanggal Akhir Efektif</label>
                    <input type="text" class="form-control" value="{{$detail[0]->tanggal_selesai_efektif}}" disabled>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

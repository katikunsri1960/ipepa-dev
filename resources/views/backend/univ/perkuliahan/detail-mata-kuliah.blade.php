@extends('layouts.admin-univ.layout')
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Mata kuliah</h5>
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
                    <label>Kode Mata Kuliah *</label>
                    <input type="name" class="form-control" disabled value="{{ $detail_matkul->kode_mata_kuliah }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Nama Mata Kuliah *</label>
                    <input type="name" class="form-control" disabled value="{{ $detail_matkul->nama_mata_kuliah }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Program Studi Pengampu *</label>
                    <input type="name" class="form-control" disabled value="{{ $detail_matkul->nama_program_studi }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Jenis Mata Kuliah</label>
                    <input type="name" class="form-control" disabled value="{{ $detail_matkul->nama_jenis_mk }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Bobot Mata Kuliah</label>
                    <input type="name" class="form-control" disabled value="{{ $detail_matkul->sks_mata_kuliah }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Bobot Tatap Muka</label>
                    <input type="name" class="form-control" disabled value="{{ $detail_matkul->sks_tatap_muka }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Bobot Praktikum</label>
                    <input type="name" class="form-control" disabled value="{{ $detail_matkul->sks_praktek }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Bobot Praktek Lapangan</label>
                    <input type="name" class="form-control" disabled value="{{ $detail_matkul->sks_praktek_lapangan }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Bobot Simulasi</label>
                    <input type="name" class="form-control" disabled value="{{ $detail_matkul->sks_simulasi }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Metode Pembelajaran</label>
                    <input type="name" class="form-control" disabled value="{{ $detail_matkul->metode_kuliah }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Tanggal Mulai Efektif</label>
                    <input type="name" class="form-control" disabled value="{{ $detail_matkul->tanggal_mulai_efektif }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Tanggal Akhir Efektif</label>
                    <input type="name" class="form-control" disabled value="{{ $detail_matkul->tanggal_selesai_efektif }}">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

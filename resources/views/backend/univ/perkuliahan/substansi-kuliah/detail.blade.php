@extends('layouts.admin-univ.layout')
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Substansi Kuliah</h5>
    </div>
    <div class="ibox-content">
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary pull-right" href="{{route('admin-univ.substansi-kuliah')}}"><i class="fa-solid fa-list"></i> <span>Daftar Substansi Kuliah</span></a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="widget yellow-bg no-padding text-vertical-midle">
                    <div class="p-md">
                        <h4>Menampilkan dan Mengelola Substansi</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ibox-content">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Nama Substansi <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ ($detail[0]->nama_substansi!='') ? $detail[0]->nama_substansi :"-" }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Program Studi <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ ($detail[0]->nama_program_studi!='') ? $detail[0]->nama_program_studi :"-" }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Bobot Mata Kuliah (sks)<span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ ($detail[0]->sks_mata_kuliah!='') ? $detail[0]->sks_mata_kuliah :"-" }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Bobot Tatap Muka (sks)</label>
                    <input type="name" class="form-control" disabled value="{{ ($detail[0]->sks_tatap_muka!='') ? $detail[0]->sks_tatap_muka :"-" }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Bobot Praktikum (sks)</label>
                    <input type="name" class="form-control" disabled value="{{ ($detail[0]->sks_praktek!='') ? $detail[0]->sks_praktek :"-" }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Bobot Praktikum Lapangan(sks)</label>
                    <input type="name" class="form-control" disabled value="{{ ($detail[0]->sks_praktek_lapangan!='') ? $detail[0]->sks_praktek_lapangan :"-" }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Bobot Simulasi (sks)</label>
                    <input type="name" class="form-control" disabled value="{{ ($detail[0]->sks_simulasi!='') ? $detail[0]->sks_simulasi :"-" }}">
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

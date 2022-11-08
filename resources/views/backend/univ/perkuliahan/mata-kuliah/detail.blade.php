@extends('layouts.admin-univ.layout')
@section('content')

<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Mata kuliah</h5>
    </div>
    <div class="ibox-content">
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary pull-right" href="{{route('admin-univ.daftar-mata-kuliah')}}"><i class="fa-solid fa-list"></i> <span>Daftar Mata Kuliah</span></a>
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
</div>
@endsection

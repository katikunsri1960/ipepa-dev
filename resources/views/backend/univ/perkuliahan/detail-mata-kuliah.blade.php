@extends('layouts.admin-univ.layout')
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Mata kuliah</h5>

        <div class="ibox-content p-md">
            <div class="row">
                <div class="col-lg-12">
                    <div class="widget yellow-bg no-padding">
                        <div class="p-m">
                            <h3 class="font-bold no-margins">
                                Catatan :
                            </h3>
                            <h5>Menampilkan dan Mengelola Mata Kuliah</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8"></div>
                <div class="col-md-4 col-12">
                    <form method="GET" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" name="keyword"
                                placeholder="Search by NIDN or Nama" value="{{request()->get('keyword','')}}"> <span class="input-group-btn">
                                <button class="btn btn-default">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="ibox-content">
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

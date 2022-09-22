@extends('layouts.admin-univ.layout')
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Mata kuliah</h5>
    </div>
    <div class="ibox-content">
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary pull-right" href="{{route('admin-univ.mahasiswa-lulus-do')}}"><i class="fa-solid fa-list"></i> <span>Daftar Mahasiswa</span></a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="widget yellow-bg no-padding text-vertical-midle">
                    <div class="p-md">
                        <h4>Mengatur Mahasiswa yang Lulus/Drop Out</h4>
                    </div>
                </div>
            </div>
        </div><br>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Mahasiswa <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ $detail_mahasiswa_lulus_do[0]->nim }} - {{ $detail_mahasiswa_lulus_do[0]->nama_mahasiswa }} - {{ $detail_mahasiswa_lulus_do[0]->nama_program_studi }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Jenis Keluar <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ $detail_mahasiswa_lulus_do[0]->nama_jenis_keluar }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Tanggal Keluar <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ $detail_mahasiswa_lulus_do[0]->tanggal_keluar }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Periode Keluar <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ $detail_mahasiswa_lulus_do[0]->nama_semester }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Tanggal SK</label>
                    <input type="name" class="form-control" disabled value="{{ $detail_mahasiswa_lulus_do[0]->tgl_sk_yudisium }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Nomor SK</label>
                    <input type="name" class="form-control" disabled value="{{ $detail_mahasiswa_lulus_do[0]->sk_yudisium }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>IPK <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ number_format($detail_mahasiswa_lulus_do[0]->ipk,2) }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>No Ijazah / No Sertifikat Profesi</label>
                    <input type="name" class="form-control" disabled value="{{ $detail_mahasiswa_lulus_do[0]->no_seri_ijazah }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea class="form-control" disabled> {{ $detail_mahasiswa_lulus_do[0]->keterangan }} </textarea>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

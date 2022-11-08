@extends('layouts.admin-prodi.layout')
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Aktivitas Perkuliahan Mahasiswa</h5>

        <div class="ibox-content p-md">
            <div class="row">
                <div class="col-lg-12">
                    <div class="widget blue-bg no-padding text-vertical-midle">
                        <div class="p-md">
                            <h4>Digunakan untuk mengelola status keaktifan ( Aktif, Cuti, Non Aktif dll) mahasiswa per periode</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ibox-content">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Mahasiswa <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ $detail[0]->nama_mahasiswa}}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Semester  <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ $detail[0]->nama_semester}}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Status Mahasiswa <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ $detail[0]->nama_status_mahasiswa}}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>IPS (Indeks Prestasi Semester)</label>
                    <input type="name" class="form-control" disabled value="{{ $detail[0]->ips}}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>IPK (Indeks Prestasi Komulatif)</label>
                    <input type="name" class="form-control" disabled value="{{ $detail[0]->ipk}}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Jumlah SKS Semester</label>
                    <input type="name" class="form-control" disabled value="{{ $detail[0]->sks_semester}}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Jumlah SKS Total</label>
                    <input type="name" class="form-control" disabled value="{{ $detail[0]->sks_total}}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Biaya Kuliah (semester) <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ $detail[0]->biaya_kuliah_smt}}">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

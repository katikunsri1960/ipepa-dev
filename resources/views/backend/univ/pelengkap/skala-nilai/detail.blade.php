@extends('layouts.admin-univ.layout')
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Skala Penilaian</h5>
    </div>
    <div class="ibox-content">
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary pull-right" href="{{route('admin-univ.skala-nilai')}}"><i class="fa-solid fa-list"></i> <span>Daftar Skala Nilai</span></a>
            </div>
        </div><br>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Program Studi <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ ($detail_skala_nilai[0]->nama_program_studi!='') ? $detail_skala_nilai[0]->nama_program_studi :"-" }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Nilai Huruf <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ ($detail_skala_nilai[0]->nilai_huruf!='') ? $detail_skala_nilai[0]->nilai_huruf :"-" }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Nilai Indeks <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ ($detail_skala_nilai[0]->nilai_indeks!='') ? $detail_skala_nilai[0]->nilai_indeks :"-"}}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Bobot Nilai Minimum <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ ($detail_skala_nilai[0]->bobot_minimum!='') ? $detail_skala_nilai[0]->bobot_minimum :"-" }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Bobot Nilai Maksimum <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ ($detail_skala_nilai[0]->bobot_maksimum!='') ? $detail_skala_nilai[0]->bobot_maksimum :"-" }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Tanggal Mulai Efektif <span style="color: red">*</span></label>
                    <input type="date" class="form-control" disabled value="{{ ($detail_skala_nilai[0]->tanggal_mulai_efektif!='') ? $detail_skala_nilai[0]->tanggal_mulai_efektif :"-" }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Tanggal Akhir Efektif <span style="color: red">*</span></label>
                    <input type="date" class="form-control" disabled value="{{ ($detail_skala_nilai[0]->tanggal_akhir_efektif!='') ? $detail_skala_nilai[0]->tanggal_akhir_efektif :"-" }}">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

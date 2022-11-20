@extends('layouts.admin-prodi.layout')
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Kelas Perkuliahan</h5>
    </div>
    <div class="ibox-content">
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary pull-right" href="{{route('admin-prodi.kelas-perkuliahan')}}"><i class="fa-solid fa-list"></i> <span>Daftar Kelas Perkuliahan</span></a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="widget yellow-bg no-padding text-vertical-midle">
                    <div class="p-md">
                        <h4>Menyimpan Jadwal Perkuliahan Setiap Periode</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ibox-content">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Program Studi  <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ $detail[0]->nama_program_studi}}">
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
                    <label>Mata Kuliah <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ $detail[0]->nama_mata_kuliah}}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Nama Kelas <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ $detail[0]->nama_kelas_kuliah}}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Bobot Mata Kuliah<span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ $detail[0]->sks_mata_kuliah }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Bobot Tatap Muka</label>
                    <input type="name" class="form-control" disabled value="{{ $detail[0]->sks_tatap_muka }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Bobot Praktikum</label>
                    <input type="name" class="form-control" disabled value="{{ $detail[0]->sks_praktek }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Bobot Praktek Lapangan</label>
                    <input type="name" class="form-control" disabled value="{{ $detail[0]->sks_praktek_lapangan }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Bahasan</label>
                    <input type="name" class="form-control" disabled value="{{ $detail[0]->bahasan }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Bobot Simulasi</label>
                    <input type="name" class="form-control" disabled value="{{ $detail[0]->sks_simulasi }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Lingkup</label>
                    <input type="name" class="form-control" disabled value="{{ $detail[0]->ipk}}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Mede Kuliah</label>
                    <input type="name" class="form-control" disabled value="{{ $detail[0]->metode_kuliah }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Tanggal Mulai Efektif</label>
                    <input type="name" class="form-control" disabled value="{{ $detail[0]->tanggal_mulai_efektif}}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Tanggal Akhir Efektif</label>
                    <input type="name" class="form-control" disabled value="{{ $detail[0]->tanggal_akhir_efektif}}">
                </div>
            </div>
        </div>
    </div>

    <div class="ibox-content">
        <div class="row m-t-sm">
            <div class="col-lg-12">
                <div class="panel blank-panel">
                    <div class="panel-heading">
                        <div class="panel-options">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab-1" data-toggle="tab" aria-expanded="true">DOSEN PENGAJAR</a>
                                </li>
                                <li class="">
                                    <a href="#tab-2" data-toggle="tab" aria-expanded="false">MAHASISWA KRS / PESERTA KELAS</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab-1">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="text-center">No.</th>
                                            <th rowspan="2" class="text-center">NIDN</th>
                                            <th rowspan="2" class="text-center">Nama Dosen</th>
                                            <th rowspan="2" class="text-center">Bobot (sks)</th>
                                            <th colspan="2" class="text-center">Pertemuan</th>
                                            <th rowspan="2" class="text-center">Jenis Evaluasi Akademik</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">Rencana</th>
                                            <th class="text-center">Realisasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dosen as $no => $dosen)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-left">{{$dosen->nidn}}</td>
                                                <td class="text-left">{{$dosen->nama_dosen}}</td>
                                                <td class="text-center">{{$dosen->sks_substansi_total}}</td>
                                                <td class="text-center">{{$dosen->rencana_minggu_pertemuan}}</td>
                                                <td class="text-center">{{$dosen->realisasi_minggu_pertemuan}}</td>
                                                <td class="text-center">{{$dosen->nama_jenis_evaluasi}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="tab-2">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No.</th>
                                            <th class="text-center">NIM</th>
                                            <th class="text-center">Nama Mahasiswa</th>
                                            <th class="text-center">Jenis Kelamin</th>
                                            <th class="text-center">Program Studi</th>
                                            <th class="text-center">Angkatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($mahasiswa as $pes)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{$pes->nim}}</td>
                                                <td class="text-left">{{$pes->nama_mahasiswa}}</td>
                                                <td class="text-center">{{$pes->jenis_kelamin}}</td>
                                                <td class="text-center">{{$pes->nama_program_studi}}</td>
                                                <td class="text-center">{{$pes->angkatan}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

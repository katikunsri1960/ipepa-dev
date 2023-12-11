@extends('layouts.admin-univ.layout')
@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Informasi Detail Mahasiswa</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
                <a class="close-link">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        @include('backend.univ.mahasiswa.btn-nav')
    </div>
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Data Mahasiswa</h5>
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
                        <label>NIM</label>
                        <input type="name" class="form-control" disabled value="{{ $mahasiswa->nim }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="name" class="form-control" disabled value="{{ $mahasiswa->nama_mahasiswa }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Program Studi</label>
                        <input type="name" class="form-control" disabled value="{{ $mahasiswa->nama_program_studi }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Angkatan</label>
                        <input type="name" class="form-control" disabled value="@if (strlen($mahasiswa->angkatan) > 4){{ substr($mahasiswa->angkatan, 0, 4) }}@else{{ $mahasiswa->angkatan }}@endif">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Transkrip Mahasiswa</h5>
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
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">No.</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Kode MK</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Nama MK</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Bobot MK (sks)</th>
                        <th colspan="3" class="text-center">Nilai</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">sksk * N.Indeks</th>
                    </tr>
                    <tr>
                        <th class="text-center">Angka</th>
                        <th class="text-center">Huruf</th>
                        <th class="text-center">Indeks</th>
                    </tr>
                </thead>
                @php
                    $sks = 0;
                    $sksindex = 0;
                @endphp
                <tbody>
                    @foreach ($transkrip as $tm)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $tm->kode_mata_kuliah }}</td>
                            <td class="text-left">{{ $tm->nama_mata_kuliah }}</td>
                            <td class="text-center">{{ $tm->sks_mata_kuliah }}</td>
                            <td class="text-center">{{ $tm->nilai_angka }}</td>
                            <td class="text-center">{{ $tm->nilai_huruf }}</td>
                            <td class="text-center">{{ $tm->nilai_indeks }}</td>
                            <td class="text-center">{{$tm->nilai_indeks*$tm->sks_mata_kuliah}}</td>
                        </tr>
                        @php
                            $sks += $tm->sks_mata_kuliah;
                            $sksindex += ($tm->nilai_indeks*$tm->sks_mata_kuliah);
                        @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-center align-middle">Total</th>
                        <th class="text-center align-middle">{{$sks}}</th>
                        <th colspan="3"></th>
                        <th class="text-center align-middle">{{$sksindex}}</th>
                    </tr>
                    <tr>
                        <th colspan="3" class="text-center align-middle">IPK (INDEKS PRESTASI KOMULATIF)</th>
                        <th></th>
                        <th colspan="3">
                            <th class="text-center align-middle">{{number_format($sksindex/$sks, 2)}}</th>
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

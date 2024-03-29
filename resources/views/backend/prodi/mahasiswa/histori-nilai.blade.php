@extends('layouts.admin-prodi.layout')
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
        @include('backend.prodi.mahasiswa.btn-nav')
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
            <h5>KRS Mahasiswa</h5>
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
            <form method="GET">
                <div class="col-lg-3 m-4">
                    <select name="periode" id="periode_aktif" class="form-control">
                        <option value="">Pilih Periode</option>
                        @foreach ($periodeNow as $item)
                        <option value="{{ $item['id_periode'] }}"
                            {{$item['id_periode'] == $periodeAkt ? 'selected' : ''}}
                        >{{ $item['nama_periode'] }}</option>
                        @endforeach
                    </select>

                </div>
                <div class="col-lg-3">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>

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
                <tbody>
                @foreach ($histori as $h)
                    <tr>
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td class="text-center">{{$h->kode_mata_kuliah}}</td>
                        <td class="text-center">{{$h->nama_mata_kuliah}}</td>
                        <td class="text-center">{{$h->sks_mata_kuliah}}</td>
                        <td class="text-center">{{$h->nilai_angka}}</td>
                        <td class="text-center">{{$h->nilai_huruf}}</td>
                        <td class="text-center">{{$h->nilai_indeks}}</td>
                        <td class="text-center">{{$h->nilai_indeks*$h->sks_mata_kuliah}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

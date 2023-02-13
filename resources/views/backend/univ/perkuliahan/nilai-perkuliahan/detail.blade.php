@extends('layouts.admin-univ.layout')
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Nilai Perkuliahan</h5>
    </div>
    <div class="ibox-content">
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary pull-right" href="{{route('admin-univ.nilai-perkuliahan')}}"><i class="fa-solid fa-list"></i> <span>Daftar Nilai Perkuliahan</span></a>
            </div>
        </div>
        <div class="row">
            <table class="table table-borderless m-4">
                <tbody>
                        <tr>
                            <td class="text-left">Program Studi</td>
                            <td class="text-left">: {{ ($detail[0]->nama_prodi!='') ? $detail[0]->nama_prodi :"-" }}</td>
                        </tr>
                        <tr>
                            <td class="text-left">Kode Mata Kuliah</td>
                            <td class="text-left">: {{ ($detail[0]->kode_mata_kuliah!='') ? $detail[0]->kode_mata_kuliah :"-" }}</td>
                        </tr>
                        <tr>
                            <td class="text-left">Mata Kuliah</td>
                            <td class="text-left">: {{ ($detail[0]->nama_mata_kuliah!='') ? $detail[0]->nama_mata_kuliah :"-" }}</td>
                        </tr>
                        <tr>
                            <td class="text-left">Semester</td>
                            <td class="text-left">: {{ ($detail[0]->nm_smt!='') ? $detail[0]->nm_smt :"-" }}</td>
                        </tr>
                        <tr>
                            <td class="text-left">Nama Kelas</td>
                            <td class="text-left">: {{ ($detail[0]->nama_kelas_kuliah!='') ? $detail[0]->nama_kelas_kuliah :"-" }}</td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div><br>
    <div class="ibox-content">
        <div class="row">
            <table class="table table-bordered m-4">
                <thead>
                    <tr>
                        <th rowspan="2" class="text-center">No</th>
                        <th rowspan="2" class="text-center">NIM</th>
                        <th rowspan="2" class="text-center">Nama Mahasiswa</th>
                        <th rowspan="2" class="text-center">Jurusan</th>
                        <th rowspan="2" class="text-center">Angkatan</th>
                        <th colspan="2" class="text-center">Nilai</th>
                    </tr>
                    <tr>
                        <th rowspan="2" class="text-center">Angka</th>
                        <th rowspan="2" class="text-center">Huruf</th>
                    </tr>

                </thead>
                <tbody>
                    @foreach ($mahasiswa as $data)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $data->nim }}</td>
                            <td class="text-left">{{ $data->nama_mahasiswa }}</td>
                            <td class="text-center">{{ $data->nama_program_studi }}</td>
                            <td class="text-center">{{ $data->angkatan }}</td>
                            <td class="text-center">{{ $data->nilai_indeks }}</td>
                            <td class="text-center">{{ $data->nilai_huruf }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

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
                        <input type="name" class="form-control" disabled
                            value="@if (strlen($mahasiswa->angkatan) > 4) {{ substr($mahasiswa->angkatan, 0, 4) }}@else{{ $mahasiswa->angkatan }} @endif">
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
            <div class="form-group col-lg-3">
                <form action="">
                    <select name="periode" id="periode_aktif" class="form-control">
                        <option value="">Pilih Periode</option>
                        @foreach ($periodeNow as $item)
                            <option value="{{ $item['id_periode'] }}">{{ $item['nama_periode'] }}</option>
                        @endforeach
                    </select>
                </form>
            </div>

            <table class="table table-bordered" id="krsMahasiswa">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Kode MK</th>
                        <th class="text-center">Nama MK</th>
                        <th class="text-center">Kelas</th>
                        <th class="text-center">Bobok MK (sks)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($krs as $data)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $data->kode_mata_kuliah }}</td>
                            <td class="text-center">{{ $data->nama_mata_kuliah }}</td>
                            <td class="text-center">{{ $data->nama_kelas_kuliah }}</td>
                            <td class="text-center">{{ $data->sks_mata_kuliah }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection

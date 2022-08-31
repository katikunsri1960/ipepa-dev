@extends('layouts.admin-prodi.layout')
@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Informasi Detail Dosen</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
                <a class="close-link">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        @include('backend.prodi.dosen.btn-nav')
    </div>

    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Detail Aktivitas Mengajar Dosen</h5>
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
                        <label>Nama</label>
                        <input type="name" class="form-control" disabled value="{{ $dosen->nama_dosen }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="name" class="form-control" disabled value="{{ $dosen->tempat_lahir }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <input type="name" class="form-control" disabled value="{{ $dosen->jenis_kelamin }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Status</label>
                        <input type="name" class="form-control" disabled value="{{ $dosen->nama_status_aktif}}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="name" class="form-control" disabled value="{{ $dosen->tanggal_lahir }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Agama</label>
                        <input type="name" class="form-control" disabled value="{{ $dosen->nama_agama }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>NIDN/NUP/NIDK</label>
                        <input type="name" class="form-control" disabled value="{{ $dosen->nidn }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ibox float-e-margins">
        <div class="ibox-content">

            <div class="row m-t-sm">
                <div class="col-lg-12">
                    <div class="panel blank-panel">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <td>Nomor</td>
                                    <td>Periode</td>
                                    <td>Program Studi</td>
                                    <td>Mata Kuliah</td>
                                    <td>Kelas</td>
                                    <td>Rencana</td>
                                    <td>Realisasi</td>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no=1;
                                @endphp
                                @foreach ($aktivitas_mengajar_dosen as $d => $data)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $data->nama_periode }}</td>
                                        <td>{{ $data->nama_program_studi }}</td>
                                        <td style="text-align: left">{{ $data->mata_kuliah }}</td>
                                        <td>{{ $data->nama_kelas_kuliah }}</td>
                                        <td>{{ $data->rencana_minggu_pertemuan }}</td>
                                        <td>{{ $data->realisasi_minggu_pertemuan }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

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
            <h5>Riwayat Kepangkatan Dosen</h5>
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
                                    <td>Bidang Studi</td>
                                    <td>Jenjang</td>
                                    <td>Gelar</td>
                                    <td>Perguruan Tinggi</td>
                                    <td>Fakultas</td>
                                    <td>Tahun Lulus</td>
                                    <td>SKS</td>
                                    <td>IPK</td>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no=1;
                                @endphp
                                @foreach ($riwayat_pendidikan as $d => $data)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $data->nama_bidang_studi }}</td>
                                        <td>{{ $data->nama_jenjang_pendidikan }}</td>
                                        <td>{{ $data->nama_gelar_akademik }}</td>
                                        <td>{{ $data->nama_perguruan_tinggi }}</td>
                                        <td>{{ $data->fakultas }}</td>
                                        <td>{{ $data->tahun_lulus }}</td>
                                        <td>{{ $data->sks_lulus }}</td>
                                        <td>{{ $data->ipk }}</td>
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
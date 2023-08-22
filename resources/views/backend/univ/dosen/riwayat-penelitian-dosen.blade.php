@extends('layouts.admin-univ.layout')
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
        @include('backend.univ.dosen.btn-nav')
    </div>

    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Riwayat Penelitian Dosen</h5>
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
                                    <td>Judul Penelitian</td>
                                    <td>Bidang Ilmu</td>
                                    <td>Lembaga</td>
                                    <td>Tahun</td>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no=1;
                                @endphp
                                @foreach ($riwayat_penelitian as $d => $data)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td style="text-align: left">{{ $data->judul_penelitian }}</td>
                                        <td>{{ $data->nama_kelompok_bidang }}</td>
                                        <td>{{ $data->nama_lembaga_iptek }}</td>
                                        <td>{{ $data->tahun_kegiatan }}</td>
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

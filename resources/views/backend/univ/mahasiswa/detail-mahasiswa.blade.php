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
                        <label>Nama</label>
                        <input type="name" class="form-control" disabled value="{{ $mahasiswa->nama_mahasiswa }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="name" class="form-control" disabled value="{{ $mahasiswa->tempat_lahir }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <input type="name" class="form-control" disabled value="{{ $mahasiswa->jenis_kelamin }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Nama Ibu</label>
                        <input type="name" class="form-control" disabled value="{{ $mahasiswa->nama_ibu_kandung }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="name" class="form-control" disabled value="{{ $mahasiswa->tanggal_lahir }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Agama</label>
                        <input type="name" class="form-control" disabled value="{{ $mahasiswa->nama_agama }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
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
        <div class="ibox-content">

            <div class="row m-t-sm">
                <div class="col-lg-12">
                    <div class="panel blank-panel">
                        <div class="panel-heading">
                            <div class="panel-options">
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#tab-1" data-toggle="tab" aria-expanded="true">Alamat</a>
                                    </li>
                                    <li class="">
                                        <a href="#tab-2" data-toggle="tab" aria-expanded="false">Orang Tua</a>
                                    </li>
                                    <li class="">
                                        <a href="#tab-3" data-toggle="tab" aria-expanded="false">Wali</a>
                                    </li>
                                    <li class="">
                                        <a href="#tab-4" data-toggle="tab" aria-expanded="false">Kebutuhan Khusus</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab-1">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Kewarganegaraan</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $mahasiswa->kewarganegaraan }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>NIK</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $mahasiswa->nik }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>NISN</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $mahasiswa->nisn }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>NPWP</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $mahasiswa->npwp }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Jalan</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $mahasiswa->jalan }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Telephone</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $mahasiswa->telepon }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Dusun</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $mahasiswa->dusun }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <div class="form-group">
                                            <label>RT</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $mahasiswa->rt }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <div class="form-group">
                                            <label>RW</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $mahasiswa->rw }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>HP</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $mahasiswa->handphone }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Kelurahan</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $mahasiswa->kelurahan }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Kode Pos</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $mahasiswa->kode_pos }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>E-Mail</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $mahasiswa->email }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Penerima KPS</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $mahasiswa->penerima_kps }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6"
                                        style="@if ($mahasiswa->penerima_kps == 'Tidak') visibility: hidden @endif">
                                        <div class="form-group">
                                            <label>No. KPS</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $mahasiswa->nomor_kps }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Kecamatan</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $mahasiswa->nama_wilayah }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Alat Transportasi</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $mahasiswa->nama_alat_transportasi }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Jenis Tinggal</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $mahasiswa->nama_jenis_tinggal }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab-2">
                                    <div class="col-lg-6">
                                        <h3 class="text-center">Ayah</h3>
                                        <div class="form-group">
                                            <label>NIK</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $mahasiswa->nik_ayah }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $mahasiswa->nama_ayah }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Lahir</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $mahasiswa->tanggal_lahir_ayah }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Pendidikan</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $mahasiswa->nama_pendidikan_ayah }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Penghasilan</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $mahasiswa->nama_penghasilan_ayah }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <h3 class="text-center">Ibu</h3>
                                        <div class="form-group">
                                            <label>NIK</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $mahasiswa->nik_ibu }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $mahasiswa->nama_ibu_kandung }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Lahir</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $mahasiswa->tanggal_lahir_ibu }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Pendidikan</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $mahasiswa->nama_pendidikan_ibu }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Penghasilan</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $mahasiswa->nama_penghasilan_ibu }}">
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane" id="tab-3">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $mahasiswa->nama_wali }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Pekerjaan</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $mahasiswa->nama_pekerjaan_wali }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Tanggal Lahir</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $mahasiswa->tanggal_lahir_wali }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Penghasilan</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $mahasiswa->nama_penghasilan_wali }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Pendidikan</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $mahasiswa->nama_pendidikan_wali }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab-4">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Kebutuhan Khusus</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $mahasiswa->nama_kebutuhan_khusus_mahasiswa }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

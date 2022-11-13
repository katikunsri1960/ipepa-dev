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
            <h5>Detail Penugasan Dosen</h5>
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
        <div class="ibox-content">

            <div class="row m-t-sm">
                <div class="col-lg-12">
                    <div class="panel blank-panel">
                        <div class="panel-heading">
                            <div class="panel-options">
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#tab-1" data-toggle="tab" aria-expanded="true">Biodata</a>
                                    </li>
                                    <li class="">
                                        <a href="#tab-2" data-toggle="tab" aria-expanded="false">Keluarga</a>
                                    </li>
                                    {{-- <li class="">
                                        <a href="#tab-3" data-toggle="tab" aria-expanded="false">Kebutuhan Khusus</a>
                                    </li> --}}
                                </ul>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab-1">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>NIK</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $dosen->nik }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>NIP</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $dosen->nip }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>NPWP</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $dosen->npwp }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Ikatan Kerja</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $dosen->ikatan_kerja }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Status Pegawai</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $dosen->nama_status_aktif }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Jenis Pegawai</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $dosen->nama_jenis_sdm }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>No SK CPNS</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $dosen->no_sk_cpns }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Tanggal SK CPNS</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $dosen->tanggal_sk_cpns }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>No SK Pengangkatan</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $dosen->no_sk_pengangkatan }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Tanggal SK Pengangkatan</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $dosen->mulai_sk_pengangkatan }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Lembaga Pengangkatan</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $dosen->nama_lembaga_pengangkatan }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Pangkat Golongan</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $dosen->nama_pangkat_golongan }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Sumber Gaji</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $dosen->nama_sumber_gaji }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Jalan</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $dosen->jalan }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <div class="form-group">
                                            <label>RT</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $dosen->rt }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <div class="form-group">
                                            <label>RW</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $dosen->rw }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Dusun</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $dosen->dusun }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Kode Pos</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $dosen->kode_pos }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Kelurahan</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $dosen->ds_kel }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Kecamatan</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $dosen->kecamatan }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Telephone</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $dosen->telepon }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>HP</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $dosen->handphone }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $dosen->email }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab-2">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Status Pernikahan</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $dosen->status_pernikahan }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Suami / Istri</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $dosen->nama_suami_istri }}">
                                        </div>
                                        <div class="form-group">
                                            <label>NIP Suami / Istri</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $dosen->nip_suami_istri }}">
                                        </div>
                                        <div class="form-group">
                                            <label>TMT PNS</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $dosen->tanggal_mulai_pns }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Pekerjaan</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $dosen->nama_pekerjaan_suami_istri }}">
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="tab-pane" id="tab-3">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Kebutuhan Khusus</label>
                                            <input type="name" class="form-control" disabled
                                                value="{{ $mahasiswa->nama_kebutuhan_khusus_mahasiswa }}">
                                        </div>
                                    </div>
                                </div> --}}
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

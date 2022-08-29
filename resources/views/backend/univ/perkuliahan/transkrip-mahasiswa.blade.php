@extends('layouts.admin-univ.layout')
@section('content')
    <!-- <div class="ibox float-e-margins">
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
        @include('backend.univ.perkuliahan.btn-nav')
    </div> -->
    <!-- <div class="ibox float-e-margins">
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
                        <input type="name" class="form-control" disabled value="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="name" class="form-control" disabled value="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Program Studi</label>
                        <input type="name" class="form-control" disabled value="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Angkatan</label>
                        <input type="name" class="form-control" disabled value="">
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Checklist Transkrip Nilai</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-wrench"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#">Config option 1</a>
                    </li>
                    <li><a href="#">Config option 2</a>
                    </li>
                </ul>
                <a class="close-link">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <form role="form">
                        <div class="form-group"><label>NIM / Nama Mahasiswa</label> <input type="nim/nama" placeholder="" class="form-control"></div>
                            <button class="btn btn-md btn-primary pull-center col-md-4 col-md-offset-4" type="submit"><i class="fa fa-search"></i><strong> Cari</strong></button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection


@extends('layouts.admin-prodi.layout')
@section('content')
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="widget lazur-bg p-xl">
                <h2><strong>Selamat Datang !</strong></h2><br>
                <h2><strong>{{auth()->user()->name}} - {{$profil_pt[0]['nama_perguruan_tinggi']}}</strong></h2>
                <div class="text-right">
                    <i class="fa fa-cloud fa-4x"></i> <i class="fa fa-cloud fa-4x"></i> <i class="fa fa-cloud fa-4x"></i>
                </div>
                <hr>
                <h4>Notes :</h4>
                <p><i class="fa fa-hand-o-right"></i> Data yang ditampilkan pada halaman ini merupakan data dari Neo Feeder PDDIKTI<br><i class="fa fa-hand-o-right"></i> Last Sync Table ({{$sync_table[0]['last_sync']}} - {{$sync_table[0]['table_name']}})</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="widget navy-bg p-xl pull-right">
                <h2><strong>{{$profil_pt[0]['nama_perguruan_tinggi']}}</strong></h2><br>
                <table class="table">
                    <tr>
                        <td class="col-md-4"><span><h4>Alamat</h4></span><td>
                        <td><h4> : </h4></td>
                        <td class="col-md-8"><h4>{{ $profil_pt[0]['jalan'] }}</h4></td>
                    </tr>
                    <tr>
                        <td class="col-md-4"><span><h4>Telephone</h4></span><td>
                        <td><h4> : </h4></td>
                        <td class="col-md-8"><h4>{{$profil_pt[0]['telepon']}}</h4></td>
                    </tr>
                    <tr>
                        <td class="col-md-4"><span><h4>Email</h4></span><td>
                        <td><h4> : </h4></td>
                        <td class="col-md-8"><h4>{{$profil_pt[0]['email']}}</h4></td>
                    </tr>
                    <tr>
                        <td class="col-md-4"><span><h4>Website</h4></span><td>
                        <td><h4> : </h4></td>
                        <td class="col-md-8"><h4>{{$profil_pt[0]['website']}}</h4></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="widget navy-bg p-xl pull-right">
                <h2><strong> Detail Last Sync Table</strong></h2><br>
                <table class="table">
                    <tr>
                        <td class="col-md-4"><span><h4>Tanggal Sync</h4></span><td>
                        <td><h4> : </h4></td>
                        <td class="col-md-8"><h4>{{ $sync_table[0]['last_sync'] }}</h4></td>
                    </tr>
                    <tr>
                        <td class="col-md-4"><span><h4>Nama</h4></span><td>
                        <td><h4> : </h4></td>
                        <td class="col-md-8"><h4>{{$sync_table[0]['name']}}</h4></td>
                    </tr>
                    <tr>
                        <td class="col-md-4"><span><h4>Nama Tabel</h4></span><td>
                        <td><h4> : </h4></td>
                        <td class="col-md-8"><h4>{{$sync_table[0]['table_name']}}</h4></td>
                    </tr>
                    <tr>
                        <td class="col-md-4"><span><h4>Jalur API</h4></span><td>
                        <td><h4> : </h4></td>
                        <td class="col-md-8"><h4>{{$sync_table[0]['api_path']}}</h4></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

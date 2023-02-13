@extends('layouts.admin-prodi.layout')
@section('content')
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="widget p-xl" style="background-color:rgb(32, 34, 107); color: white">
                <h2><strong>Selamat Datang !</strong></h2><br>
                <h2><strong>{{auth()->user()->name}} - {{ !empty($profil_pt[0]['nama_perguruan_tinggi']) ? $profil_pt[0]['nama_perguruan_tinggi'] : "-" }}</strong></h2>
                <div class="text-right">
                    <i class="fa fa-cloud fa-4x"></i> <i class="fa fa-cloud fa-4x"></i> <i class="fa fa-cloud fa-4x"></i>
                </div>
                <hr>
                <h4>Notes :</h4>
                <p><i class="fa fa-hand-o-right"></i> Data yang ditampilkan pada halaman ini merupakan data dari Neo Feeder PDDIKTI<br><i class="fa fa-hand-o-right"></i> Last Sync Table ({{!empty($jumlah_data_sync[0]['updated_at']) ? $jumlah_data_sync[0]['updated_at'] :"-"}} - {{!empty($jumlah_data_sync[0]['table_name']) ? $jumlah_data_sync[0]['table_name'] :"-"}})</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="widget p-xl" style="background-color:rgb(136, 62, 6); color:white">
                <h2><strong>{{!empty($profil_pt[0]['nama_perguruan_tinggi']) ? $profil_pt[0]['nama_perguruan_tinggi'] :"-"}}</strong></h2><br>
                <table class="table">
                    <tr>
                        <td class="col-md-4"><span><h4>Alamat</h4></span><td>
                        <td><h4> : </h4></td>
                        <td class="col-md-8"><h4>{{!empty($profil_pt[0]['jalan']) ? $profil_pt[0]['jalan'] :"-" }}</h4></td>
                    </tr>
                    <tr>
                        <td class="col-md-4"><span><h4>Telephone</h4></span><td>
                        <td><h4> : </h4></td>
                        <td class="col-md-8"><h4>{{!empty($profil_pt[0]['telepon']) ? $profil_pt[0]['telepon'] :"-"}}</h4></td>
                    </tr>
                    <tr>
                        <td class="col-md-4"><span><h4>Email</h4></span><td>
                        <td><h4> : </h4></td>
                        <td class="col-md-8"><h4>{{!empty($profil_pt[0]['email']) ? $profil_pt[0]['email'] :"-"}}</h4></td>
                    </tr>
                    <tr>
                        <td class="col-md-4"><span><h4>Website</h4></span><td>
                        <td><h4> : </h4></td>
                        <td class="col-md-8"><h4>{{!empty($profil_pt[0]['website']) ? $profil_pt[0]['website'] :"-"}}</h4></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h2><strong> Detail Sync Table</strong></h2>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content p-md">
                <div class="row">
                    <form method="get">
                        <div class="col-md-2">
                            <select name="p" id="p" class="form-control" onchange="this.form.submit()">
                                @foreach ($paginate as $p)
                                <option value="{{ $p }}" @if ($p==$valPaginate) selected @endif>{{ $p }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                    <div class="col-lg-4 pull-right">
                        <form method="GET" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="keyword" placeholder="Search by NIDN or Nama"
                                    value="{{ request()->get('keyword', '') }}"> <span class="input-group-btn">
                                    <button class="btn btn-default">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div><br>
                <table class="table table-bordered table-hover table-responsive" id="table-mahasiswa">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Tabel</th>
                            <th class="text-center">Last Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sync_table as $s_tbl => $data)
                            <tr>
                                <td class="text-center">{{ $sync_table->firstItem() + $s_tbl }}</td>
                                <td class="text-center">{{ !empty($data->table_name) ? $data->table_name :"-" }}</td>
                                <td class="text-center">{{ !empty($data->updated_at) ? $data->updated_at :"-" }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $sync_table->withQueryString()->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection

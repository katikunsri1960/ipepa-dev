@extends('layouts.admin-univ.layout')
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Daftar Mata Kuliah</h5>
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
            <div class="col-md-8"></div>
            <div class="col-md-4 col-12">
                <form method="GET" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control" name="keyword"
                            placeholder="Search by Nama MK or Kode MK" value="{{request()->get('keyword','')}}"> <span class="input-group-btn">
                            <button class="btn btn-default">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <div class="p-md">
            <table class="table table-bordered table-hover table-responsive" id="table-matkul">
                <thead>
                    <tr>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">No.</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Kode MK</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Nama Mata Kuliah</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Bobot MK (sks)</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Program Studi</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Jenis Mata Kuliah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mk as $m => $data)
                    <tr>
                        <td class="text-center">{{$mk->firstItem() + $m}}</td>
                        <td  class="text-center"><a href="{{route('admin-univ.detail-mata-kuliah', ['id' => $data->id_matkul])}}">
                        {{$data->kode_mata_kuliah}}</td>
                        <td class="text-left">{{$data->nama_mata_kuliah}}</td>

                        <td class="text-center">{{$data->sks_mata_kuliah}}</td>
                        <td class="text-left">{{$data->nama_program_studi}}</td>
                        <td class="text-center">{{$data->id_jenis_mata_kuliah}}<br>- {{ $data->nama_jenis_mk}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $mk->withQueryString()->links() !!}
        </div>
    </div>
</div>
@endsection

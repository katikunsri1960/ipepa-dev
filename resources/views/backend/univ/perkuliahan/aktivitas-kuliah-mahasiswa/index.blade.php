@extends('layouts.admin-univ.layout')
@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Aktivitas Kuliah Mahasiswa</h5>
        </div>
        <div class="ibox-content p-md">
            <div class="row">
                <div class="col-md-4 col-12">
                    <form method="GET" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" name="keyword"
                                placeholder="Search by NIM, Nama or Nomor Seri Ijazah" value="{{request()->get('keyword','')}}"> <span class="input-group-btn">
                                <button class="btn btn-default">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-12">
                    <p class="pull-right">Halaman ini menampilkan data berdasarakan semester :  <span class="badge badge-primary"><i class="fa fa-calendar" aria-hidden="true"></i></span></p>
                </div>
            </div>
            <div class="pt-2">
                <table class="table table-bordered table-hover table-responsive" id="table-matkul">
                    <thead>
                        <tr>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">No.</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">NIM</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Nama Mahasiswa</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Program Studi</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Angkatan</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Semester</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Status</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">IPS</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">IPK</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">SKS Semester</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">SKS Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($aktivitas_kuliah_mahasiswa as $no => $data)
                    <tr>
                        <td class="text-center">{{$aktivitas_kuliah_mahasiswa->firstItem() + $no}}</td>
                        <td  class="text-left"> <a href="{{route('admin-univ.detail-aktivitas-kuliah-mahasiswa', ['id' => $data->id_mahasiswa])}}">
                        {{$data->nim}}</td>
                        <td class="text-center">{{$data->nama_mahasiswa}}</td>
                        <td class="text-center">{{$data->nama_program_studi}}</td>
                        <td class="text-center">{{$data->angkatan}}</td>
                        <td class="text-center">{{$data->nama_semester}}</td>
                        <td class="text-center">{{$data->nama_status_mahasiswa}}</td>
                        <td class="text-center">{{$data->ips}}</td>
                        <td class="text-center">{{$data->ipk}}</td>
                        <td class="text-center">{{$data->sks_semester}}</td>
                        <td class="text-center">{{$data->sks_total}}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $aktivitas_kuliah_mahasiswa->withQueryString()->links() !!}
        </div>
    </div>
@endsection

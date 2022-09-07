@extends('layouts.admin-univ.layout')
@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Substansi Kuliah</h5>
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
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">No.</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Nama Substansi</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Bobot Mata Kuliah (sks)</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Bobot Tatap Muka (sks)</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Bobot Praktek (sks)</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Bobot Praktek Lapangan (sks)</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Bobot Simulasi (sks)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($substansi as $sub => $data)
                    <tr>
                        <td class="text-center">{{$substansi->firstItem() + $sub}}</td>


                        <td  class="text-center"> <a href="{{route('admin-univ.substansi-kuliah', ['id' => $data->id_substansi])}}">
                        {{$data->nama_substansi}}</td>
                        <td class="text-center">{{$data->sks_mata_kuliah}}</td>
                        <td class="text-center">{{$data->sks_tatap_muka}}</td>
                        <td class="text-center">{{$data->sks_praktek}}</td>
                        if ($data->sks_praktek_lapangan == null) {
                            <td class="text-center">{{$data->sks_praktek_lapangan}}</td>
                        }

                        <td class="text-center">{{$data->sks_simulasi}}</td>

                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection

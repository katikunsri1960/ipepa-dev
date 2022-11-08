@extends('layouts.admin-univ.layout')
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Detail Nilai Perkuliahan</h5>
    </div>
    <div class="ibox-content">
        <div class="row">
            <table class="table table-bordered m-4">
                <thead>
                    <tr>
                        <th rowspan="2" class="text-center">No</th>
                        <th rowspan="2" class="text-center">Kode Mata Kuliah</th>
                        <th rowspan="2" class="text-left">Nama Mata Kuliah</th>
                        {{-- <th colspan="5" class="text-center">Bobok Mata Kuliah (sks)</th> --}}
                        <th rowspan="2" class="text-center">Semester</th>
                        <th rowspan="2" class="text-center">Wajib?</th>
                    </tr>
                    
                </thead>
                <tbody>
                    @foreach ($detail as $data)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $data->nama_prodi }}</td>
                            <td class="text-center">{{ $data->kode_mata_kuliah }}</td>
                            <td class="text-center">{{ $data->nama_mata_kuliah }}</td>
                            <td class="text-center">{{ $data->nm_smt }}</td>
                            <td class="text-center">{{ $data->nama_kelas_kuliah }}</td>
                        </tr>
                    @endforeach

                </tbody>

            </table>



            <div class="col-lg-12">
                <a class="btn btn-primary pull-right" href="{{route('admin-univ.nilai-perkuliahan')}}"><i class="fa-solid fa-list"></i> <span>Daftar Nilai Perkuliahan</span></a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label>Program Studi</label>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="form-group">
                    <input type="name" class="form-control" disabled value="{{ $detail[0]->nama_prodi }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Kode Mata Kuliah <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ $detail[0]->kode_mata_kuliah }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Mata Kuliah <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ $detail[0]->nama_mata_kuliah }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Semester <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ $detail[0]->nm_smt }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Nama Kelas <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ $detail[0]->nama_kelas_kuliah }}">
                </div>
            </div>
        </div>
    </div><br>
    <div class="ibox-content">
        <div class="row">
            <table class="table table-bordered m-4">
                <thead>
                    <tr>
                        <th rowspan="2" class="text-center">No</th>
                        <th rowspan="2" class="text-center">Kode Mata Kuliah</th>
                        <th rowspan="2" class="text-left">Nama Mata Kuliah</th>
                        <th colspan="5" class="text-center">Bobok Mata Kuliah (sks)</th>
                        <th rowspan="2" class="text-center">Semester</th>
                        <th rowspan="2" class="text-center">Wajib?</th>
                    </tr>
                    <tr>
                        <th class="text-center">Mata Kuliah</th>
                        <th class="text-center">Tatap Muka</th>
                        <th class="text-center">Praktikum</th>
                        <th class="text-center">Praktek Lapangan</th>
                        <th class="text-center">Simulasi</th>
                    </tr>
                </thead>
                {{-- <tbody>
                    @foreach ($mata_kuliah_kurikulum as $data)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $data->kode_mata_kuliah }}</td>
                            <td class="text-center">{{ $data->nama_mata_kuliah }}</td>
                            <td class="text-center">{{ number_format($data->sks_mata_kuliah,0) }}</td>
                            <td class="text-center">{{ number_format($data->sks_tatap_muka,0) }}</td>
                            <td class="text-center">{{ number_format($data->sks_praktek,0) }}</td>
                            <td class="text-center">{{ number_format($data->sks_praktek_lapangan,0) }}</td>
                            <td class="text-center">{{ number_format($data->sks_simulasi,0) }}</td>
                            <td class="text-center">{{ $data->semester }}</td>
                            @if ($data->apakah_wajib == '1')
                                <td class="text-center"><i class="fa-solid fa-check"></i></td>
                            @else
                                <td class="text-center"></td>
                            @endif
                        </tr>
                    @endforeach

                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-center">Total</td>
                        <td class="text-center">{{ $sum_sks_mata_kuliah }}</td>
                        <td class="text-center">{{ $sum_sks_tatap_muka }}</td>
                        <td class="text-center">{{ $sum_sks_praktek }}</td>
                        <td class="text-center">{{ $sum_sks_praktek_lapangan }}</td>
                        <td class="text-center">{{ $sum_sks_simulasi }}</td>
                        <td colspan="2" class="text-center"></td>
                    </tr>
                </tfoot> --}}
            </table>
        </div>
    </div>
</div>
@endsection

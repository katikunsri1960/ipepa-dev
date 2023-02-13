@extends('layouts.admin-univ.layout')
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Kurikulum Kuliah</h5>
    </div>
    <div class="ibox-content">
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary pull-right" href="{{route('admin-univ.kurikulum')}}"><i class="fa-solid fa-list"></i> <span>Daftar Kurikulum</span></a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="widget yellow-bg no-padding text-vertical-midle">
                    <div class="p-md">
                        <h4>Mengatur Kurikulum per Program Studi</h4>
                    </div>
                </div>
            </div>
        </div><br>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Nama Kurikulum <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ ($detail_kurikulum[0]->nama_kurikulum!='') ? $detail_kurikulum[0]->nama_kurikulum :"-" }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Nama Program Studi <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ ($detail_kurikulum[0]->nama_program_studi!='') ? $detail_kurikulum[0]->nama_program_studi :"-" }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Mulai Berlaku <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ ($detail_kurikulum[0]->semester_mulai_berlaku!='') ? $detail_kurikulum[0]->semester_mulai_berlaku :"-" }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Jumlah Bobot Mata Kuliah Wajib <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ ($detail_kurikulum[0]->jumlah_sks_wajib!='') ? $detail_kurikulum[0]->jumlah_sks_wajib :"-" }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Jumlah Bobot Mata Kuliah Pilihan <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ ($detail_kurikulum[0]->jumlah_sks_pilihan!='') ? $detail_kurikulum[0]->jumlah_sks_pilihan :"-" }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Jumlah SKS</label>
                    <input type="name" class="form-control" disabled value="{{ ($detail_kurikulum[0]->jumlah_sks_lulus!='') ? $detail_kurikulum[0]->jumlah_sks_lulus :"-" }}">
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
                <tbody>
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
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection

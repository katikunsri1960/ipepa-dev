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
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Program Studi</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">NIlai Huruf</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Nilai Indeks</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Bobot Minimum</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Bobot Maksimum</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Tanggal Mulai Efektif</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Tanggal Akhir Efektif</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
@endsection

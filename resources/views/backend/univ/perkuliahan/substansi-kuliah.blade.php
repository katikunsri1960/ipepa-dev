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

                </tbody>
            </table>
        </div>
    </div>
@endsection

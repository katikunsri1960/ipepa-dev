@extends('layouts.admin-prodi.layout')
@section('content')
    <div class="ibox float-e-margins">
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
        @include('backend.prodi.mahasiswa.btn-nav')
    </div>
    <div class="ibox float-e-margins">
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
                        <input type="name" class="form-control" disabled value="{{ $mahasiswa->nim }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="name" class="form-control" disabled value="{{ $mahasiswa->nama_mahasiswa }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Program Studi</label>
                        <input type="name" class="form-control" disabled value="{{ $mahasiswa->nama_program_studi }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Angkatan</label>
                        <input type="name" class="form-control" disabled value="@if (strlen($mahasiswa->angkatan) > 4){{ substr($mahasiswa->angkatan, 0, 4) }}@else{{ $mahasiswa->angkatan }}@endif">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Aktivitas Perkuliahan Mahasiswa</h5>
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
            <table class="table table-bordered" id="tableMahasiswa">
                <thead>
                    <tr>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Semester</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Status</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">IPS</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">IPK</th>
                        <th colspan="2" class="text-center" >Jumlah SKS</th>
                    </tr>
                    <tr>
                        <th class="text-center">Semester</th>
                        <th class="text-center">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($aktivitas as $akt)
                        <tr>
                            <td class="text-center">{{ $akt->nama_semester }}</td>
                            <td class="text-center">{{ $akt->nama_status_mahasiswa }}</td>
                            <td class="text-center">{{ $akt->ips }}</td>
                            <td class="text-center">{{ $akt->ipk }}</td>
                            <td class="text-center">{{ $akt->sks_semester }}</td>
                            <td class="text-center">{{ $akt->sks_total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('#tableMahasiswa').DataTable({
            paging: false,
            info: false,
            // column 0 order false
            "order": [[ 0, "asc" ]]
        });
    });
</script>
@endpush

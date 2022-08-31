@extends('layouts.admin-prodi.layout')
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
    <div class="ibox-content">
        <table class="table table-bordered" id="table-mk">
            <thead>
                <tr>
                    <th class="text-center" style="vertical-align: middle">No.</th>
                    <th class="text-center" style="vertical-align: middle">Kode MK</th>
                    <th class="text-center" style="vertical-align: middle">Nama Mata Kuliah</th>
                    <th class="text-center" style="vertical-align: middle">Bobot MK (sks)</th>
                    <th class="text-center" style="vertical-align: middle">Program Studi</th>
                    <th class="text-center" style="vertical-align: middle">Jenis Mata Kuliah</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mk as $m)
                <tr>
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td class="text-center"><a
                            href="{{route('admin-prodi.detail-mata-kuliah', ['id'=> $m->id_matkul])}}">{{$m->kode_mata_kuliah}}</a>
                    </td>
                    <td class="text-center">{{$m->nama_mata_kuliah}}</td>
                    <td class="text-center">{{$m->sks_mata_kuliah}}</td>
                    <td class="text-center">{{$m->nama_program_studi}}</td>
                    <td class="text-center">{{$m->id_jenis_mata_kuliah}}<br> - {{$m->nama_jenis_mk}}</td>
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
        $('#table-mk').DataTable();
     });

</script>
@endpush

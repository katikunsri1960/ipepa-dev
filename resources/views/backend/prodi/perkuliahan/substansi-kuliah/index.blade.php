@extends('layouts.admin-prodi.layout')
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

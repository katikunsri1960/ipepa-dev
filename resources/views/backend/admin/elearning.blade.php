@extends('layouts.admin.layout')
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-content p-md">
        @if (session('success'))
        <div class="alert alert-success" id="messageAlert">
            {{ session('success') }}
        </div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger" id="messageAlert">
            {{ session('error') }}
        </div>
        @endif
        <div class="row">
            <div class="col-md-4 m-5">
                <a href="{{route('admin.elearning.create-all')}}" class="btn btn-primary btn-block">Create All</a>
            </div>
            <div class="col-md-4 m-5">
                <a class="btn btn-warning btn-block" onclick="deleteConfirm()">Delete All Created</a>
            </div>
        </div>
        <br><br>
        <div class="container-fluid">
            <div class="row p-3">
                <table class="table table-striped table-bordered table-hover m-5" id="dataTable">
                    <thead class="thead-success">
                        <tr>
                            <th class="text-center align-middle">No</th>
                            <th class="text-center align-middle">NIM</th>
                            <th class="text-center align-middle">Nama Depan</th>
                            <th class="text-center align-middle">Nama Belakang</th>
                            <th class="text-center align-middle">Email</th>
                            <th class="text-center align-middle">KPM</th>
                            <th class="text-center align-middle">Created</th>
                            <th class="text-center align-middle">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                        <tr>
                            <td class="align-middle text-center">{{$loop->iteration}}</td>
                            <td class="align-middle text-center">{{$d->nim}}</td>
                            <td class="align-middle">{{$d->nama_depan}}</td>
                            <td class="align-middle">{{$d->nama_belakang}}</td>
                            <td class="align-middle">{{$d->email}}</td>
                            <td class="align-middle text-center">
                                @if ($d->kpm)
                                {{-- button to see file --}}
                                <a class="btn btn-primary" href="{{route('admin.elearning.show-file', $d->id)}}" target="_blank">Lihat</a>
                                @endif
                            </td>
                            <td class="align-middle text-center" align="middle">
                                @if ($d->created == 0)
                                <span class="label label-danger">Belum Dibuat</span>
                                @else
                                <span class="label label-success">Sudah Dibuat</span>
                                @endif
                            </td>
                            <td class="align-middle text-center">

                                <a class="btn btn-danger" href="{{route('admin.elearning.delete', $d->id)}}" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection
@push('css')
<link href="{{ asset('assets/css/plugins/chosen/bootstrap-chosen.css') }}" rel="stylesheet">
{{-- sweetalert --}}
<link href="{{ asset('assets/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">

@endpush
@push('scripts')
<script src="{{ asset('assets/js/plugins/chosen/chosen.jquery.js') }}"></script>
{{-- sweetalert --}}
<script src="{{ asset('assets/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
{{-- datatable --}}
<script src="{{ asset('assets/js/plugins/dataTables/datatables.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();

        $('#messageAlert').delay(5000).slideUp(300);
    });

    function deleteConfirm() {
        swal({
            title: "Apakah anda yakin ingin menghapus semua data yang sudah dibuat?",
            text: "Data yang sudah dihapus tidak dapat dikembalikan!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya, hapus semua data!",
            closeOnConfirm: false
        }, function (isConfirm) {
            if (!isConfirm) return;
            window.location.href = "{{route('admin.elearning.delete-all-created')}}";
        });
    }


</script>
@endpush

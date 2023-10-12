@extends('layouts.admin-prodi.layout')
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
        @if ($errors->any())
        <div class="alert alert-danger" id="messageAlert">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
         <div class="row">
            <div class="col-lg-12">
                <div class="widget yellow-bg no-padding text-vertical-midle">
                    <div class="p-md">
                        <h4>Menampilkan data Daya Tampung dan Peminat berdasarkan Panitia Penerimaan dan KPA</h4>
                    </div>
                </div>
            </div>
        </div><br>
        <div class="container-fluid table-responsive">
            <div class="row p-3">
                <h2>Daya Tampung</h2>
                <br>
                <table class="table table-striped table-bordered table-hover m-5" id="dataTable">
                    <thead class="thead-success">
                        <tr>
                            <th class="text-center align-middle">No</th>
                            <th class="text-center align-middle">Jalur Ujian</th>
                            <th class="text-center align-middle">Program Studi</th>
                            <th class="text-center align-middle">Kode DIKTI</th>
                            <th class="text-center align-middle">Kode Pusat</th>

                            @foreach ($tahun as $t)
                            <th class="text-center align-middle">{{$t->tahun}}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dayaTampung as $d => $v)
                            <tr>
                                <td class="text-center align-middle">{{$loop->iteration}}</td>
                                <td class="text-center align-middle">{{$v[0]->JalurUjian->nama}}</td>
                                <td class="align-middle">{{$v[0]->ProgramStudi->nama_jenjang_pendidikan}} {{$v[0]->ProgramStudi->nama_program_studi}}</td>
                                <td class="text-center align-middle">{{$v[0]->ProgramStudi->kode_program_studi}}</td>
                                <td class="text-center align-middle">{{$v[0]->kode_pusat}}</td>
                                @foreach ($v as $item)
                                    <td class="text-center align-middle">{{$item->daya_tampung}}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <hr>
        <div class="container-fluid table-responsive">
            <div class="row p-3">
                <h2>Peminat</h2>
                <br>
                <table class="table table-striped table-bordered table-hover m-5" id="peminatSnbp">
                    <thead class="thead-success">
                        <tr>
                            <th class="text-center align-middle">No</th>
                            <th class="text-center align-middle">Jalur Ujian</th>
                            <th class="text-center align-middle">Program Studi</th>
                            <th class="text-center align-middle">Kode DIKTI</th>
                            <th class="text-center align-middle">Kode Pusat</th>

                            @foreach ($tahunPeminat as $t)
                            <th class="text-center align-middle">{{$t->tahun}}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peminatSnbp as $d => $v)
                            <tr>
                                <td class="text-center align-middle">{{$loop->iteration}}</td>
                                <td class="text-center align-middle">{{$v[0]->JalurUjian->nama}}</td>
                                <td class="align-middle">{{$v[0]->ProgramStudi->nama_jenjang_pendidikan}} {{$v[0]->ProgramStudi->nama_program_studi}}</td>
                                <td class="text-center align-middle">{{$v[0]->ProgramStudi->kode_program_studi}}</td>
                                <td class="text-center align-middle">{{$v[0]->kode_pusat}}</td>
                                @foreach ($v as $item)
                                    <td class="text-center align-middle">{{$item->peminat}}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <hr>

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
        $('#dataTable').DataTable({
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                        {extend: 'copy'},
                        {extend: 'csv'},
                        {extend: 'excel', title: 'Data Transkrip'},
                        {extend: 'pdf', title: 'Data Transkrip'},
                        {extend: 'print',
                            customize: function (win) {
                                $(win.document.body).addClass('white-bg');
                                $(win.document.body).css('font-size', '10px');

                                $(win.document.body).find('table')
                                        .addClass('compact')
                                        .css('font-size', 'inherit');
                            }
                        }
                    ]
        });
        $('#snbt').DataTable({
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                        {extend: 'copy'},
                        {extend: 'csv'},
                        {extend: 'excel', title: 'Data Transkrip'},
                        {extend: 'pdf', title: 'Data Transkrip'},
                        {extend: 'print',
                            customize: function (win) {
                                $(win.document.body).addClass('white-bg');
                                $(win.document.body).css('font-size', '10px');

                                $(win.document.body).find('table')
                                        .addClass('compact')
                                        .css('font-size', 'inherit');
                            }
                        }
                    ]
        });

        $('#peminatSnbp').DataTable({
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                        {extend: 'copy'},
                        {extend: 'csv'},
                        {extend: 'excel', title: 'Data Transkrip'},
                        {extend: 'pdf', title: 'Data Transkrip'},
                        {extend: 'print',
                            customize: function (win) {
                                $(win.document.body).addClass('white-bg');
                                $(win.document.body).css('font-size', '10px');

                                $(win.document.body).find('table')
                                        .addClass('compact')
                                        .css('font-size', 'inherit');
                            }
                        }
                    ]
        });

        $('#peminatSnbt').DataTable({
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                        {extend: 'copy'},
                        {extend: 'csv'},
                        {extend: 'excel', title: 'Data Transkrip'},
                        {extend: 'pdf', title: 'Data Transkrip'},
                        {extend: 'print',
                            customize: function (win) {
                                $(win.document.body).addClass('white-bg');
                                $(win.document.body).css('font-size', '10px');

                                $(win.document.body).find('table')
                                        .addClass('compact')
                                        .css('font-size', 'inherit');
                            }
                        }
                    ]
        });

        $('#messageAlert').delay(5000).slideUp(300);
    });

    function deleteAkun()
    {
        // sweetalert confirm
        swal({
            title: "Apakah anda yakin?",
            text: "Setelah dihapus, anda tidak akan bisa mengembalikan data ini!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya, hapus semua data!",
        }
        , function (isConfirm) {
            if (!isConfirm) return;
            // ajax request
            // show loading on ajax request

            $('#loading-overlay').show();

            $.ajax({
                url: "{{route('admin.elearning.delete-account-all')}}",
                type: 'GET',
                success: function (response) {
                    $('#loading-overlay').hide();
                    if (response == true) {
                        swal("Deleted!", "Semua data berhasil dihapus!", "success");
                        window.location.href = "{{route('admin.elearning.delete-akun')}}";
                    } else {
                        swal("Failed!", "Semua data gagal dihapus!", "error");
                    }
                },
                error: function (xhr) {
                    $('#loading-overlay').hide();
                    swal("Failed!", "Semua data gagal dihapus!", "error");
                }
            });
        })

    }


</script>
@endpush

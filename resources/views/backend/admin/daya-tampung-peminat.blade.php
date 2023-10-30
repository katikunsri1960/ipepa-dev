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
            <div class="col-md-2">
                {{-- button to trigger modal --}}
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success btn-block" data-toggle="modal"
                    data-target="#exampleModalCenter">
                    Import Daya Tampung
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Upload Excel Daya Tampung</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{route('admin.dt-import')}}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <input type="file" name="file" class="form-control">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Uploads</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-2 m-5">
                <button type="button" class="btn btn-primary btn-block" data-toggle="modal"
                data-target="#peminat">
                Import Peminat
            </button>

            <!-- Modal -->
            <div class="modal fade" id="peminat" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Upload Excel Peminat</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{route('admin.peminat-import')}}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <input type="file" name="file" class="form-control">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Uploads</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
            {{-- <div class="col-md-2 m-5">
                <button type="button" onclick="deleteAkun()" class="btn btn-primary btn-block">Delete All E-learning Account</button>
            </div>
            <div class="col-md-2 m-5">
                <a href="{{route('admin.elearning.remove-data')}}" class="btn btn-warning btn-block">Truncate Data</a>
            </div> --}}
        </div>
        <br><br>
        <div class="container-fluid table-responsive">
            <div class="row p-3">
                <h2>Daya Tampung SNBP</h2>
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
                <h2>Peminat SNBP</h2>
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
        <div class="container-fluid table-responsiv">
            <div class="row p-3">
                <h2>Daya Tampung SNBT</h2>
                <br>
                <table class="table table-striped table-bordered table-hover m-5" id="snbt">
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
                        @foreach ($snbt as $d => $v)
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
                <h2>Peminat SNBT</h2>
                <br>
                <table class="table table-striped table-bordered table-hover m-5" id="peminatSnbt">
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
                        @foreach ($peminatSnbt as $d => $v)
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

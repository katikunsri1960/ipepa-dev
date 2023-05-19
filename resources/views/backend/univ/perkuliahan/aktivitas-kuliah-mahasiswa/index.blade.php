@extends('layouts.admin-univ.layout')
@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5> Aktivitas Perkuliahan Mahasiswa</h5>
        </div>

        <div class="ibox-content p-md">
            <div class="row">
                <form method="get" id="filter-form">
                    <div class="col-md-2">
                        <button class="btn btn-primary btn-block" type="button" data-toggle="modal" data-target="#modal-filter"><i
                                class="fa-solid fa-filter"></i><span style="margin-left: 6px; margin-right: 6px">Filter</span>
                        </button>

                        <div id="modal-filter" class="modal fade" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="row">

                                            <div class="form-group">
                                                <label>Program Studi</label>
                                                <select name="prodi[]" id="prodi"
                                                    data-placeholder="Pilih Program Studi..."
                                                    class="form-control chosen-select" multiple style="width:350px;"
                                                    tabindex="4">
                                                    <option value=""></option>
                                                    @foreach ($prodi as $p)
                                                        <option value="{{ $p->id_prodi }}"
                                                            @if ($val->prodi && in_array($p->id_prodi, $val->prodi )) selected @endif>
                                                            {{ $p->nama_jenjang_pendidikan }} {{ $p->nama_program_studi }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Pilih Semester</label>
                                                <select name="semester[]" id="semester"
                                                    data-placeholder="Pilih Semester..." class="form-control chosen-select"
                                                    multiple style="width:350px;" tabindex="4">
                                                    <option value=""></option>
                                                    @foreach ($semester as $sem)
                                                        <option value="{{ $sem->id_semester }}" @if ($val->semester &&
                                                            in_array($sem->id_semester, $val->semester)) selected @endif>
                                                            {{ $sem->nama_semester }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Pilih Angkatan</label>
                                                <select name="angkatan[]" id="angkatan" data-placeholder="Pilih Angkatan..."
                                                    class="form-control chosen-select" multiple style="width:350px;"
                                                    tabindex="4">
                                                    <option value=""></option>
                                                    @foreach ($angkatan as $ang)
                                                    <option value="{{ $ang->id_tahun_ajaran }}"
                                                        @php
                                                        if($val->angkatan != ''){
                                                            if($val->angkatan && in_array($ang->id_tahun_ajaran, $val->angkatan)){
                                                                echo 'selected';
                                                            }
                                                        }
                                                        @endphp>
                                                        {{ $ang->id_tahun_ajaran }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Pilih Status Mahasiswa</label>
                                                <select name="status_mahasiswa[]" id="status_mahasiswa"
                                                    data-placeholder="Pilih Status Mahasiswa ..." class="form-control chosen-select"
                                                    multiple style="width:350px;" tabindex="4">
                                                    <option value=""></option>
                                                    @foreach ($status_mahasiswa as $status)
                                                        <option value="{{ $status->nama_status_mahasiswa}}"
                                                            @php
                                                            if($val->status_mahasiswa != ''){
                                                                if($val->status_mahasiswa && in_array($status->nama_status_mahasiswa, $val->status_mahasiswa)){
                                                                    echo 'selected';
                                                                }
                                                            }
                                                            @endphp>
                                                            {{ $status->nama_status_mahasiswa }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button class="btn btn-warning" type="submit" id="applyFilter">Apply Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <a href="{{route('admin-univ.aktivitas-kuliah-mahasiswa')}}" class="btn btn-warning btn-block" id="reset-filter">Reset Filter</a>
                    </div>

                </form>
            </div><br>
            <div class="row">
                <div class="col-md-12">
                    <p class="pull-right">Halaman ini menampilkan data berdasarakan semester :
                        @foreach ($semester as $sem)
                        @if ($val->semester && in_array($sem->id_semester, $val->semester))
                        <span class="badge badge-primary"><i class="fa fa-calendar" aria-hidden="true"></i> {{ $sem->nama_semester }} </span>
                        @endif
                        @endforeach
                    </p>
                </div>
            </div>
            <div class="pt-2">
                <table class="table table-bordered table-hover table-responsive" id="table-akm">
                    <thead>
                        <tr>
                        <th class="text-center" style="vertical-align: middle">No.</th>
                        <th class="text-center" style="vertical-align: middle">NIM</th=>
                        <th class="text-center" style="vertical-align: middle">Nama Mahasiswa</th>
                        <th class="text-center" style="vertical-align: middle">Program Studi</th>
                        <th class="text-center" style="vertical-align: middle">Angkatan</th>
                        <th class="text-center" style="vertical-align: middle">Semester</th>
                        <th class="text-center" style="vertical-align: middle">Status</th>
                        <th class="text-center" style="vertical-align: middle">IPS</th>
                        <th class="text-center" style="vertical-align: middle">IPK</th>
                        <th class="text-center" style="vertical-align: middle">SKS Semester</th>
                        <th class="text-center" style="vertical-align: middle">SKS Total</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
@push('css')
    <link href="{{ asset('assets/css/plugins/chosen/bootstrap-chosen.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <!-- Chosen -->
    <script src="{{ asset('assets/js/plugins/chosen/chosen.jquery.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.chosen-select').chosen({
                width: "100%"
            });

            $('#table-akm').DataTable({
                lengthMenu: [[20, 50, 100, 300, 500], [20, 50, 100, 300, 500]],
                searchable: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin-univ.akm-data') }}",
                    data: function (d) {
                        d.prodi = $('#prodi').val();
                        d.semester = $('#semester').val();
                        d.angkatan = $('#angkatan').val();
                        d.status_mahasiswa = $('#status_mahasiswa').val();
                    }
                },
                pageLength: 20,
                responsive: true,
                ordering: false,
                columns: [
                    {data: 'number', name: 'number', searchable: false, class: 'text-center'},
                    {data: 'nim', name: 'nim', searchable: false,
                            "render": function ( data, type, row, meta ) {
                                var link = '<a href="{{route("admin-univ.detail-aktivitas-kuliah-mahasiswa", ["id" => ":id", "semester" => ":sem"])}}">:data</a>';
                                link = link.replace(':id', row.id_mahasiswa);
                                link = link.replace(':sem', row.id_semester);
                                link = link.replace(':data', data);
                                return link;
                        }
                     },
                    {data: 'nama_mahasiswa', name: 'nama_mahasiswa', searchable: false},
                    {data: 'nama_program_studi', name: 'nama_program_studi'},
                    {data: 'angkatan', name: 'angkatan', searchable: true, class: 'text-center'},
                    {data: 'nama_semester', name: 'nama_semester', searchable: false, class: 'text-center'},
                    {data: 'nama_status_mahasiswa', name: 'nama_status_mahasiswa', searchable: true, class: 'text-center'},
                    {data: 'ips', name: 'ips', searchable: false, class: 'text-center'},
                    {data: 'ipk', name: 'ipk', searchable: false, class: 'text-center'},
                    {data: 'sks_semester', name: 'sks_semester', searchable: false, class: 'text-center'},
                    {data: 'sks_total', name: 'sks_total', searchable: false, class: 'text-center'},
                ],
            });

            $('#applyFilter').on('click', function() {
                table.ajax.reload();// merefresh datatable
                $('#modal-filter').modal('hide'); // hide modal
            });
        });
    </script>
@endpush

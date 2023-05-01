@extends('layouts.admin-univ.layout')
@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h2>Daftar Dosen</h2>
        </div>
        <div class="ibox-content p-md">
            <div class="row">
                <form method="get">
                    <div class="col-md-2">
                        <button class="btn btn-primary btn-block" type="button" data-toggle="modal"
                            data-target="#modal-filter"><i class="fa-solid fa-filter"></i><span
                            style="margin-left: 6px; margin-right: 6px">Filter</span>
                        </button>
                        <div id="modal-filter" class="modal fade" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="form-group">
                                                <label>Pilih Status Kepegawaian</label>
                                                <select name="status_pegawai[]" id="status_pegawai"
                                                    data-placeholder="Pilih Status Kepegawaian..."
                                                    class="form-control chosen-select" multiple style="width:350px;"
                                                    tabindex="4">
                                                    @foreach ($status_pegawai as $s)
                                                        <option value="{{ $s->id_status_aktif }}"
                                                            @if ($val->status_pegawai && in_array($s->id_status_aktif, $val->status_pegawai)) selected @endif>
                                                            {{ $s->nama_status_aktif }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Pilih Jenis Kelamin</label>
                                                <select name="jk[]" id="jk"
                                                    data-placeholder="Pilih Jenis Kelamin..."
                                                    class="form-control chosen-select" multiple style="width:350px;"
                                                    tabindex="4">
                                                    <option value=""></option>
                                                    @foreach ($jk as $j)
                                                        <option
                                                            value="@if ($j->jenis_kelamin == 'Perempuan') P @elseif ($j->jenis_kelamin == 'Laki-laki')L @endif"
                                                            @php
                                                            if($j->jenis_kelamin == 'Perempuan'){
                                                                if($val->jk && in_array(str_replace($j->jenis_kelamin,'Perempuan','P'), $val->jk)){
                                                                    echo 'selected';
                                                                }
                                                            }
                                                            if($j->jenis_kelamin == 'Laki-laki'){
                                                                if($val->jk && in_array(str_replace($j->jenis_kelamin,'Laki-laki','L'), $val->jk)){
                                                                    echo 'selected';
                                                                }
                                                            } @endphp>
                                                            {{ $j->jenis_kelamin }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Pilih Agama</label>
                                                <select name="agama[]" id="agama" data-placeholder="Pilih Agama..."
                                                    class="form-control chosen-select" multiple style="width:350px;"
                                                    tabindex="4">
                                                    <option value=""></option>
                                                    @foreach ($agama as $a)
                                                        <option value="{{ $a->id_agama }}"
                                                            @if ($val->agama && in_array($a->id_agama, $val->agama)) selected @endif>
                                                            {{ $a->nama_agama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button class="btn btn-warning" type="submit">Apply Filter</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <a href="{{route('admin-univ.daftar-dosen')}}" class="btn btn-warning btn-block" id="reset-filter">Reset Filter</a>
                    </div><br><br><hr>
                </form>
            </div>
            <div class="pt-2">
                <table class="table table-bordered table-hover table-responsive" id="table-mahasiswa">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">NIDN</th>
                            <th class="text-center">Jenis Kelamin</th>
                            <th class="text-center">Agama</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Tanggal Lahir</th>
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

            $('#table-mahasiswa').DataTable({
                lengthMenu: [[20, 50, 100, 300, 500], [20, 50, 100, 300, 500]],
                searchable: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin-univ.get-dsn') }}",
                    data: function (d) {
                        d.status_pegawai = $('#status_pegawai').val();
                        d.jk = $('#jk').val();
                        d.agama = $('#agama').val();
                    }
                },
                pageLength: 20,
                responsive: true,
                ordering: false,
                columns: [
                    {data: 'number', name: 'number', searchable: false, class: 'text-center'},
                    {data: 'nama_dosen', name: 'nama_dosen', searchable: false,
                            "render": function ( data, type, row, meta ) {
                                var link = '<a href="{{route("admin-univ.detail-dosen", ["id" => ":id"])}}">:data</a>';
                                link = link.replace(':id', row.id_dosen);
                                link = link.replace(':data', data);
                                return link;
                        }
                     },
                     {data: 'nidn', name: 'nidn', class: 'text-center'},
                    {data: 'jenis_kelamin', name: 'jenis_kelamin', class: 'text-center'},
                    {data: 'nama_agama', name: 'nama_agama', class: 'text-center'},
                    {data: 'nama_status_aktif', name: 'status_pegawai', class: 'text-center'},
                    {data: 'tanggal_lahir', name: 'tanggal_lahir', class: 'text-center'},
                ]
            });

            $('#applyFilter').on('click', function() {
                table.ajax.reload();// merefresh datatable
                $('#modal-filter').modal('hide'); // hide modal
            });
        });
    </script>
@endpush

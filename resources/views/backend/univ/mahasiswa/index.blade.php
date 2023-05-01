@extends('layouts.admin-univ.layout')
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h2>Daftar Mahasiswa</h2>
    </div>
    <div class="ibox-content p-md">
        <div class="row">
            <form method="get"  id="filter-form">
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
                                            <label>Program Studi</label>
                                            <select name="prodi[]" id="prodi" data-placeholder="Pilih Program Studi..."
                                                class="form-control chosen-select" multiple style="width:350px;"
                                                tabindex="4">
                                                <option value=""></option>
                                                @foreach ($prodi as $p)
                                                <option value="{{ $p->id_prodi }}" @if ($val->prodi &&
                                                    in_array($p->id_prodi, $val->prodi)) selected @endif>
                                                    {{ $p->nama_jenjang_pendidikan }} {{ $p->nama_program_studi }}
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
                                                    <option value="{{ $ang->angkatan }}" @if ($val->angkatan &&
                                                        in_array($ang->angkatan, $val->angkatan)) selected @endif>
                                                        {{ $ang->angkatan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Pilih Status Mahasiswa</label>
                                            <select name="status[]" id="status"
                                                data-placeholder="Pilih Status Mahasiswa..."
                                                class="form-control chosen-select" multiple style="width:350px;"
                                                tabindex="4">
                                                <option value=""></option>
                                                @foreach ($status as $s)
                                                <option value="{{ $s->nama_status_mahasiswa }}" @if ($val->status &&
                                                    in_array($s->nama_status_mahasiswa, $val->status)) selected
                                                    @endif>
                                                    {{ $s->nama_status_mahasiswa }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Pilih Jenis Kelamin</label>
                                            <select name="jk[]" id="jk" data-placeholder="Pilih Jenis Kelamin..."
                                                class="form-control chosen-select" multiple style="width:350px;"
                                                tabindex="4">
                                                <option value=""></option>
                                                @foreach ($jk as $j)
                                                <option
                                                    value="@if ($j->jenis_kelamin == 'Perempuan') P @elseif ($j->jenis_kelamin == 'Laki-laki')L @endif"
                                                    @php if($j->jenis_kelamin == 'Perempuan'){
                                                    if($val->jk &&
                                                    in_array(str_replace($j->jenis_kelamin,'Perempuan','P'),
                                                    $val->jk)){
                                                    echo 'selected';
                                                    }
                                                    }
                                                    if($j->jenis_kelamin == 'Laki-laki'){
                                                    if($val->jk &&
                                                    in_array(str_replace($j->jenis_kelamin,'Laki-laki','L'),
                                                    $val->jk)){
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
                                                <option value="{{ $a->id_agama }}" @if ($val->agama &&
                                                    in_array($a->id_agama, $val->agama)) selected @endif>
                                                    {{ $a->nama_agama }}</option>
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
                    <a href="{{route('admin-univ.daftar-mahasiswa')}}" class="btn btn-warning btn-block" id="reset-filter">Reset Filter</a>
                </div><br><br><hr>
            </form>
        </div>
        <div class="pt-2">
            <table class="table table-bordered table-hover table-responsive" id="table-mahasiswa">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">NIM</th>
                        <th class="text-center">Jenis Kelamin</th>
                        <th class="text-center">Agama</th>
                        <th class="text-center">Total SKS Diambil</th>
                        <th class="text-center">Tanggal Lahir</th>
                        <th class="text-center">Program Studi</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Angkatan</th>
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
                    url: "{{ route('admin-univ.get-mhs') }}",
                    data: function (d) {
                        d.prodi = $('#prodi').val();
                        d.angkatan = $('#angkatan').val();
                        d.status = $('#status').val();
                        d.jk = $('#jk').val();
                        d.agama = $('#agama').val();
                    }
                },
                pageLength: 20,
                responsive: true,
                ordering: false,
                columns: [
                    {data: 'number', name: 'number', searchable: false, class: 'text-center'},
                    {data: 'nama_mahasiswa', name: 'nama_mahasiswa', searchable: false,
                            "render": function ( data, type, row, meta ) {
                                var link = '<a href="{{route("admin-univ.detail-mahasiswa", ["id" => ":id"])}}">:data</a>';
                                link = link.replace(':id', row.id_mahasiswa);
                                link = link.replace(':data', data);
                                return link;
                        }
                     },
                    {data: 'nim', name: 'nim', searchable: true},
                    {data: 'jenis_kelamin', name: 'jenis_kelamin', class: 'text-center'},
                    {data: 'nama_agama', name: 'nama_agama', class: 'text-center'},
                    {data: 'total', name: 'total', class: 'text-center', render: function(data, type, row, meta){
                        if (data == null) {
                            return 0;
                        } else {
                            return data;
                        }
                    }},
                    {data: 'tanggal_lahir', name: 'tanggal_lahir', class: 'text-center'},
                    {data: 'nama_program_studi', name: 'nama_program_studi', searchable: true},
                    {data: 'nama_status_mahasiswa', name: 'nama_status_mahasiswa', class: 'text-center'},
                    {data: 'angkatan', name: 'angkatan', class: 'text-center'},

                ]
            });

            $('#applyFilter').on('click', function() {
                table.ajax.reload();// merefresh datatable
                $('#modal-filter').modal('hide'); // hide modal
            });
        });
</script>
@endpush

@extends('layouts.admin-univ.layout')
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Daftar Mahasiswa Lulus / Drop Out</h5>
    </div>

    <div class="ibox-content p-md">
        <div class="row">
            <form method="get">
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
                                                        @if ($val->prodi && in_array($p->id_prodi, $val->prodi)) selected @endif>
                                                        {{ $p->nama_jenjang_pendidikan }} {{ $p->nama_program_studi }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Pilih Angkatan</label>
                                            <select name="angkatan[]" id="angkatan"
                                                data-placeholder="Pilih Angkatan..." class="form-control chosen-select"
                                                multiple style="width:350px;" tabindex="4">
                                                <option value=""></option>
                                                @foreach ($angkatan as $ang)
                                                    <option value="{{ $ang->angkatan }}"
                                                        @if ($val->angkatan && in_array($ang->angkatan, $val->angkatan)) selected @endif>
                                                        {{ $ang->angkatan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Pilih Jenis Keluar</label>
                                            <select name="jenis_keluar[]" id="jenis_keluar"
                                                data-placeholder="Pilih Jenis Keluar Mahasiswa..."
                                                class="form-control chosen-select" multiple style="width:350px;"
                                                tabindex="4">
                                                <option value=""></option>
                                                @foreach ($jenis_keluar as $j)
                                                    <option value="{{ $j->nama_jenis_keluar }}"
                                                        @if ($val->jenis_keluar && in_array($j->nama_jenis_keluar, $val->jenis_keluar)) selected @endif>
                                                        {{ $j->nama_jenis_keluar }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Pilih Tahun Keluar</label>
                                            <select name="tahun_keluar[]" id="tahun_keluar"
                                                data-placeholder="Pilih Tahun Keluar..." class="form-control chosen-select"
                                                multiple style="width:350px;" tabindex="4">
                                                <option value=""></option>
                                                @foreach ($tahun_keluar as $thn)
                                                        <option value="{{ $thn->tahun_keluar }}"
                                                            @php
                                                                if ($val->tahun_keluar && in_array($thn->tahun_keluar, $val->tahun_keluar)) {
                                                                    echo 'selected';
                                                                }
                                                            @endphp>
                                                            {{ $thn->tahun_keluar }}
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
                </div><div class="col-md-2">
                    <a href="{{route('admin-univ.mahasiswa-lulus-do')}}" class="btn btn-warning btn-block" id="reset-filter">Reset Filter</a>
                </div><br><br><hr>

            </form>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p class="pull-right">Halaman ini menampilkan data berdasarakan tahun keluar:
                    @foreach ($tahun_keluar as $t)
                    @if ($val->tahun_keluar && in_array($t->tahun_keluar, $val->tahun_keluar))
                        <span class="label label-primary">{{ $t->tahun_keluar }}</span>
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
                        <th class="text-center" style="vertical-align: middle">NIM</th>
                        <th class="text-center" style="vertical-align: middle">Nama Mahasiswa</th>
                        <th class="text-center" style="vertical-align: middle">Program Studi</th>
                        <th class="text-center" style="vertical-align: middle">Angkatan</th>
                        <th class="text-center" style="vertical-align: middle">Jenis Keluar</th>
                        <th class="text-center" style="vertical-align: middle">Tanggal Keluar</th>
                        <th class="text-center" style="vertical-align: middle">Periode Keluar</th>
                        <th class="text-center" style="vertical-align: middle">Keterangan</th>
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
                    url: "{{ route('admin-univ.lulus-do-data') }}",
                    data: function (d) {
                        d.prodi = $('#prodi').val();
                        d.jenis_keluar = $('#jenis_keluar').val();
                        d.tahun_keluar = $('#tahun_keluar').val();
                        d.angkatan = $('#angkatan').val();
                        d.status_mahasiswa = $('#status_mahasiswa').val();
                    }
                },
                pageLength: 20,
                responsive: true,
                ordering: false,
                columns: [
                    {data: 'number', name: 'number', searchable: false, class: 'text-center'},
                    {data: 'nim', name: 'nim', searchable: true,
                            "render": function ( data, type, row, meta ) {
                                var link = '<a href="{{route("admin-univ.detail-mahasiswa-lulus-do", ["id" => ":id", "tahun" => ":ang"])}}">:data</a>';
                                link = link.replace(':id', row.id_mahasiswa);
                                link = link.replace(':ang', row.angkatan);
                                link = link.replace(':data', data);
                                return link;
                        }
                     },
                    {data: 'nama_mahasiswa', name: 'nama_mahasiswa', searchable: false},
                    {data: 'nama_program_studi', name: 'nama_program_studi'},
                    {data: 'angkatan', name: 'angkatan', searchable: true, class: 'text-center'},
                    {data: 'nama_jenis_keluar', name: 'nama_jenis_keluar', searchable: false, class: 'text-center'},
                    {data: 'tanggal_keluar', name: 'tanggal_keluar', searchable: false, class: 'text-center'},
                    {data: 'nama_semester', name: 'nama_semester', searchable: false, class: 'text-center'},
                    {data: 'keterangan', name: 'keterangan', searchable: false, class: 'text-center'},
                ],
            });

            $('#applyFilter').on('click', function() {
                table.ajax.reload();// merefresh datatable
                $('#modal-filter').modal('hide'); // hide modal
            });
        });
    </script>
@endpush

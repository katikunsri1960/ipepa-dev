@extends('layouts.admin-prodi.layout')
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Aktivitas Mahasiswa</h5>
        </div>

        <div class="ibox-content p-md">
            <div class="row">
                <form method="get" id="filter-form">
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
                                                <select name="prodi[]" id="prodi"
                                                    data-placeholder="Pilih Program Studi..."
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
                                                <label>Pilih Semester</label>
                                                <select name="semester[]" id="semester"
                                                    data-placeholder="Pilih Semester..."
                                                    class="form-control chosen-select" multiple style="width:350px;"
                                                    tabindex="4">
                                                    <option value=""></option>
                                                    @foreach ($semester as $sem)
                                                    <option value="{{ $sem->id_semester }}" @if ($val->semester &&
                                                        in_array($sem->id_semester, $val->semester)) selected @endif>
                                                        {{ $sem->nama_semester }}
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
                        <a href="{{route('admin-prodi.aktivitas-mahasiswa')}}" class="btn btn-warning btn-block" id="reset-filter">Reset Filter</a>
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
                <table class="table table-bordered table-hover table-responsive" id="table-akt-mhs">
                    <thead>
                        <tr>
                            <th class="text-center" style="vertical-align: middle">No.</th>
                            <th class="text-center" style="vertical-align: middle">Program Studi</th>
                            <th class="text-center" style="vertical-align: middle">Semester</th>
                            <th class="text-center" style="vertical-align: middle">Jenis</th>
                            <th class="text-center" style="vertical-align: middle">Judul</th>
                            <th class="text-center" style="vertical-align: middle">Tanggal SK</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                {{-- {!! $aktivitas_mahasiswa->withQueryString()->links() !!} --}}
            </div>
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

            $('#table-akt-mhs').DataTable({
                lengthMenu: [[20, 50, 100, 300, 500], [20, 50, 100, 300, 500]],
                searchable: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin-prodi.am-data') }}",
                    data: function (d) {
                        d.prodi = $('#prodi').val();
                        d.semester = $('#semester').val();
                    }
                },
                pageLength: 20,
                responsive: true,
                ordering: true,
                columns: [
                    {data: 'number', name: 'number', searchable: false, class: 'text-center', sortable: false},
                    {data: 'nama_prodi', name: 'nama_prodi', searchable: false,
                            "render": function ( data, type, row, meta ) {
                                var link = '<a href="{{route("admin-prodi.detail-aktivitas-mahasiswa", ["id" => ":id"])}}">:data</a>';
                                link = link.replace(':id', row.id_aktivitas);
                                link = link.replace(':data', data);
                                return link;
                        }
                     },
                    {data: 'nama_semester', name: 'nama_semester', searchable: false},
                    {data: 'nama_jenis_aktivitas', name: 'nama_jenis_aktivitas', class: 'text-center'},
                    {data: 'judul', name: 'judul', searchable: true, sortable: true},
                    {data: 'tanggal_sk_tugas', name: 'tanggal_sk_tugas', searchable: true, sortable: false},
                ],
            });
            $('#applyFilter').on('click', function() {
                table.ajax.reload();// merefresh datatable
                $('#modal-filter').modal('hide'); // hide modal
            });
        });
</script>
@endpush

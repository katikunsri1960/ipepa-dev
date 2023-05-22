@extends('layouts.admin-univ.layout')
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Kelas Perkuliahan</h5>
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
                                            <label>Pilih Semester</label>
                                            <select name="semester[]" id="semester"
                                                data-placeholder="Pilih Semester..." class="form-control chosen-select"
                                                multiple style="width:350px;" tabindex="4">
                                                <option value=""></option>
                                                <option value="all" @if (in_array('all', $val->semester))
                                                    selected
                                                @endif
                                                 >Semua Semester</option>
                                                @foreach ($semester as $sem)
                                                    <option value="{{ $sem->id_semester }}" @if ($val->semester &&
                                                        in_array($sem->id_semester, $val->semester)) selected @endif>
                                                        {{ $sem->nama_semester }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
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

                                        <button class="btn btn-warning" type="submit">Apply Filter</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <a href="{{route('admin-univ.kelas-perkuliahan')}}" class="btn btn-warning btn-block" id="reset-filter">Reset Filter</a>
                </div><br><br>
                <hr>
            </form>
        </div>
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
            <table class="table table-bordered table-hover table-responsive" id="table-kelas">
                <thead>
                    <tr>
                        <th class="text-center" style="vertical-align: middle">No.</th>
                        <th class="text-center" style="vertical-align: middle">Semester</th>
                        <th class="text-center" style="vertical-align: middle">Kode MK</th>
                        <th class="text-center" style="vertical-align: middle">Nama Mata Kuliah</th>
                        <th class="text-center" style="vertical-align: middle">Nama Kelas</th>
                        <th class="text-center" style="vertical-align: middle">Bobot MK (sks)</th>
                        <th class="text-center" style="vertical-align: middle">Dosen Pengajar</th>
                        <th class="text-center" style="vertical-align: middle">Peserta Kelas</th>
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

            $('#table-kelas').DataTable({
                lengthMenu: [[20, 50, 100, 300, 500], [20, 50, 100, 300, 500]],
                searchable: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin-univ.kelas-data') }}",
                    data: function (d) {
                        d.prodi = $('#prodi').val();
                        if($('#semester').val() != 'all'){
                            d.semester = $('#semester').val();
                        }
                        // d.semester = $('#semester').val();
                        d.angkatan = $('#angkatan').val();
                        d.status_mahasiswa = $('#status_mahasiswa').val();
                    }
                },
                pageLength: 20,
                responsive: true,
                ordering: false,
                columns: [
                    {data: 'number', name: 'number', searchable: false, class: 'text-center'},
                    {data: 'nama_semester', name: 'nama_semester', searchable: false, class: 'text-center'},
                    {data: 'kode_mata_kuliah', name: 'kode_mata_kuliah', searchable: false,
                            "render": function ( data, type, row, meta ) {
                                var link = '<a href="{{route("admin-univ.detail-kelas-perkuliahan", ["id" => ":id", "kelas_kuliah" => ":kelas", "semester" => ":sem"])}}">:data</a>';
                                link = link.replace(':id', row.id_matkul);
                                link = link.replace(':kelas', row.id_kelas_kuliah);
                                link = link.replace(':sem', row.id_semester);
                                link = link.replace(':data', data);
                                return link;
                        }
                     },
                     {data: 'nama_mata_kuliah', name: 'nama_mata_kuliah'},
                    {data: 'nama_kelas_kuliah', name: 'nama_kelas_kuliah', class: 'text-center'},
                    {data: 'sks', name: 'sks', searchable: false, class: 'text-center'},
                    {data: 'nama_dosen', name: 'nama_dosen', searchable: true},
                    {data: 'jumlah_mahasiswa', name: 'jumlah_mahasiswa', searchable: false, class: 'text-center'},
                ],
            });

            $('#applyFilter').on('click', function() {
                table.ajax.reload();// merefresh datatable
                $('#modal-filter').modal('hide'); // hide modal
            });
        });
</script>
@endpush

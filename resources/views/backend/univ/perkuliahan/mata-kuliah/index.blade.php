@extends('layouts.admin-univ.layout')
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Daftar Mata Kuliah</h5>
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
                                                <label>Pilih Program Studi</label>
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
                                                <label>Pilih Jenis Mata Kuliah</label>
                                                <select name="jenis_matkul[]" id="jenis_matkul"
                                                    data-placeholder="Pilih Nama Jenis Mata Kuliah..."
                                                    class="form-control chosen-select" multiple style="width:350px;"
                                                    tabindex="4">
                                                    <option value=""></option>
                                                    @foreach ($jenis_matkul as $p)
                                                            <option value="{{ $p->id_jenis_mata_kuliah }}"
                                                                @if ($val->jenis_matkul && in_array($p->id_jenis_mata_kuliah, $val->jenis_matkul )) selected @endif>
                                                                {{ $p->nama_jenis_mata_kuliah }}
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
                        <a href="{{route('admin-univ.daftar-mata-kuliah')}}" class="btn btn-warning btn-block" id="reset-filter">Reset Filter</a>
                    </div><br><br><hr>
                </form>
            </div>
            <div class="pt-2">
            <table class="table table-bordered table-hover table-responsive" id="table-matkul">
                <thead>
                    <tr>
                        
                    </tr>
                </thead>

            </table>
            {{-- {!! $mata_kuliah->withQueryString()->links() !!} --}}
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

            $('#table-matkul').DataTable({
                lengthMenu: [[20, 50, 100, 300, 500], [20, 50, 100, 300, 500]],
                searchable: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin-univ.mk-data') }}",
                    data: function (d) {
                        d.prodi = $('#prodi').val();
                        d.jenis_matkul = $('#jenis_matkul').val();
                    }
                },
                pageLength: 20,
                responsive: true,
                ordering: false,
                columns: [
                    {data: 'number', name: 'number', searchable: false, class: 'text-center'},
                    {data: 'kode_mata_kuliah', name: 'kode_mata_kuliah', searchable: false, class: 'text-center',
                            "render": function ( data, type, row, meta ) {
                                var link = '<a href="{{route("admin-univ.detail-mata-kuliah", ["id" => ":id"])}}">:data</a>';
                                link = link.replace(':id', row.id_matkul);
                                link = link.replace(':data', data);
                                return link;
                        }
                     },
                    {data: 'nama_mata_kuliah', name: 'nama_mata_kuliah', searchable: true},
                    {data: 'sks_mata_kuliah', name: 'sks_mata_kuliah', class: 'text-center'},
                    {data: 'nama_program_studi', name: 'nama_program_studi', searchable: true},
                    {data: 'id_jm', name: 'id_jenis_mata_kuliah', class:'text-center align-middle', render: function(data, type, row, meta){
                        var join = data + '<br> - ' + row.nama_jm;
                        return join;
                    }},
                ]
            });

            $('#applyFilter').on('click', function() {
                table.ajax.reload();// merefresh datatable
                $('#modal-filter').modal('hide'); // hide modal
            });
        });
    </script>
@endpush

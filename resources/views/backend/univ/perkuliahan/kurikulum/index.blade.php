@extends('layouts.admin-univ.layout')
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Kurikulum</h5>
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
                                        <button class="btn btn-warning" type="submit" id="applyFilter">Apply Filter</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <a href="{{route('admin-univ.kurikulum')}}" class="btn btn-warning btn-block" id="reset-filter">Reset Filter</a>
                </div><br><br><hr>
            </form>
        </div>
        <div class="pt-2">
            <table class="table table-bordered table-hover table-responsive" id="table-matkul">
                <thead>
                    <tr>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">No.</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Nama Kurikulum</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Program Studi</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Mulai Berlaku</th>
                        <th colspan="3" class="text-center" style="vertical-align: middle">Aturan jumlah sks</th>
                        <th colspan="2" class="text-center" style="vertical-align: middle">Jumlah sks Mata kuliah</th>
                    </tr>
                    <tr>
                        <th class="text-center" style="vertical-align: middle">Lulus</th>
                        <th class="text-center" style="vertical-align: middle">Wajib</th>
                        <th class="text-center" style="vertical-align: middle">Pilihan</th>
                        <th class="text-center" style="vertical-align: middle">Wajib</th>
                        <th class="text-center" style="vertical-align: middle">Pilihan</th>
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
        function numberFormat(value) {
            return new Intl.NumberFormat('id-ID').format(value);
        }

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
                    url: "{{ route('admin-univ.get-kurikulum') }}",
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
                    {data: 'nama_kurikulum', name: 'nama_kurikulum', searchable: true,
                            "render": function ( data, type, row, meta ) {
                                var link = '<a href="{{route("admin-univ.detail-kurikulum", ["id" => ":id"])}}">:data</a>';
                                link = link.replace(':id', row.id_kurikulum);
                                link = link.replace(':data', data);
                                return link;
                        }
                     },
                     {data: 'nama_program_studi', name: 'nama_program_studi', searchable: true},
                    {data: 'semester_mulai_berlaku', name: 'semester_mulai_berlaku', searchable: false},
                    {data: 'jumlah_sks_lulus', name: 'jumlah_sks_lulus', class: 'text-center'},
                    {data: 'jumlah_sks_wajib', name: 'jumlah_sks_wajib', class: 'text-center'},
                    {data: 'jumlah_sks_pilihan', name: 'jumlah_sks_pilihan', class: 'text-center'},
                    {data: 'jumlah_sks_mata_kuliah_wajib', name: 'jumlah_sks_mata_kuliah_wajib', class: 'text-center', render: function(data, type, row, meta){
                        return (type === 'display') ? numberFormat(data) : data;
                    }},
                    {data: 'jumlah_sks_mata_kuliah_pilihan', name: 'jumlah_sks_mata_kuliah_pilihan', class: 'text-center', render: function(data, type, row, meta){
                        return (type === 'display') ? numberFormat(data) : data;
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

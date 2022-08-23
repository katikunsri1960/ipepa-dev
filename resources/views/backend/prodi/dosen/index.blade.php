@extends('layouts.admin-prodi.layout')
@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-content p-md">
            <div class="pt-2">
                <table class="table table-bordered table-hover table-responsive" id="table-dosen">
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
                        @foreach ($dosen as $dos)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td><a href="#">{{ $dos->nama_dosen }}</a></td>
                                <td class="text-center">{{ $dos->nidn }}</td>
                                <td class="text-center">{{ $dos->jenis_kelamin }}</td>
                                <td class="text-center">{{ $dos->nama_agama }}</td>
                                <td class="text-center">{{ $dos->nama_status_aktif }}</td>
                                <td class="text-center">{{ $dos->tanggal_lahir }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot></tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

    <script>
        $(document).ready(function() {
            var table = $('#table-dosen').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "processing": true,
                "autoWidth": true,
                "responsive": true,
                "initComplete": function() {
                    this.api()
                        .columns()
                        .every(function() {
                            var column = this;
                            var select = $('<select><option value=""></option></select>')
                                .appendTo($(column.footer()).empty())
                                .on('change', function() {
                                    var val = $.fn.dataTable.util.escapeRegex($(this).val());

                                    column.search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                                });

                            column
                                .data()
                                .unique()
                                .sort()
                                .each(function(d, j) {
                                    select.append('<option value="' + d + '">' + d +
                                        '</option>');
                                });
                        });
                },
            });


        });
    </script>
@endpush

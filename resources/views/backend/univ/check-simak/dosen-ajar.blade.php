@extends('layouts.admin-univ.layout')
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h2>DOSEN AJAR SIMAK UNSRI</h2>
    </div>
    <div class="ibox-content p-md">
        <div id="loading-overlay">
            <div id="loading-spinner"></div>
        </div>
        <div class="row">
            <form id="form-simak" method="get">
                <div class="col-md-4">
                    <select name="prodi" id="prodi" class="form-control chosen-select" required>
                        <option value="">Pilih Prodi</option>
                        @foreach ($prodi as $p)
                        <option value="{{ $p->id_prodi }}">{{ $p->kode_program_studi.' - '.$p->nama_program_studi. '
                            ('.$p->nama_jenjang_pendidikan.')' }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="ta" id="ta" class="form-control chosen-select" required>
                        <option value="">Pilih Tahun Akademik</option>
                        @foreach ($ta as $t)
                        <option value="{{ $t->FTAK }}">{{ $t->FTAK }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Cari!!</button>
                {{-- <div class="col-md-5">
                    <div class="input-group">
                        <input type="text" name="mk" id="mk" class="form-control input"
                            placeholder="Silahkan masukkan Kode MK!!" required>
                        <div class="input-group-btn">

                        </div>
                    </div>
                </div> --}}

            </form>
        </div>
        <hr>
        <div class="pt-2 ml-3 mr-3" id="nilai-data">
            <table id="nilai-data"></table>
        </div>
    </div>
</div>
@endsection

@push('css')
<link href="{{ asset('assets/css/plugins/chosen/bootstrap-chosen.css') }}" rel="stylesheet">
<style>
    #loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: none;
        z-index: 9999;
    }

    #loading-spinner {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 50px;
        height: 50px;
        border: 3px solid #fff;
        border-top-color: #ff7f00;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: translate(-50%, -50%) rotate(0deg); }
        100% { transform: translate(-50%, -50%) rotate(360deg); }
    }
</style>

@endpush
@push('scripts')
<script src="{{ asset('assets/js/plugins/chosen/chosen.jquery.js') }}"></script>
<script>
    // select2
    $(document).ready(function() {
        $('#prodi').chosen({
        width: '100%'
        });
        $('#ta').chosen({
            width: '100%'
        });

        $(document).ajaxStart(function() {
            $('#loading-overlay').show();
        });

        // Menghapus elemen loading screen saat permintaan AJAX selesai atau terjadi kesalahan
        $(document).ajaxStop(function() {
            $('#loading-overlay').hide();
        });

        $('#form-simak').on('submit', function (e) {
                e.preventDefault();
                var prodi = $('#prodi').val();
                var ta = $('#ta').val();
                var mk = $('#mk').val();
                // ajax request
                $.ajax({
                    url: "{{ route('admin-univ.simak-dosen-ajar-data') }}",
                    type: 'GET',
                    data: {prodi: prodi, ta: ta},
                    success: function (response) {
                        var data = response.data;
                        var nilai = $('#nilai-data');

                        console.log(data);

                        nilai.empty();

                        if (data.length > 0) {
                            var table = $('<table>').addClass('table table-bordered table-hover');
                            var thead = $('<thead>').appendTo(table);
                            var tbody = $('<tbody>').appendTo(table);

                            var headerRow = $('<tr>').addClass('text-center').appendTo(thead);
                            $('<th>').addClass('text-center align-middle').text('Tahun Akademik').appendTo(headerRow);
                            $('<th>').addClass('text-center align-middle').text('NIP').appendTo(headerRow);
                            $('<th>').addClass('text-center align-middle').text('Nama Dosen').appendTo(headerRow);
                            $('<th>').addClass('text-center align-middle').text('Kode MK').appendTo(headerRow);
                            $('<th>').addClass('text-center align-middle').text('Kode Kelas').appendTo(headerRow);
                            $('<th>').addClass('text-center align-middle').text('Tatap Muka').appendTo(headerRow);
                            $('<th>').addClass('text-center align-middle').text('Tatap Muka Realisasi').appendTo(headerRow);
                            $('<th>').addClass('text-center align-middle').text('Kode Prodi').appendTo(headerRow);
                            $('<th>').addClass('text-center align-middle').text('SKS Ajar').appendTo(headerRow);
                            $('<th>').addClass('text-center align-middle').text('Jenis Evaluasi').appendTo(headerRow);
                            // looping data
                            $.each(data, function (i, v) {
                                var row = $('<tr>').appendTo(tbody);
                                $('<td>').addClass('text-center align-middle').text(v.KLS_TAK).appendTo(row);
                                $('<td>').addClass('text-center align-middle').text(v.nip).appendTo(row);
                                $('<td>').addClass('align-middle').text(v.nama_dosen).appendTo(row);
                                $('<td>').addClass('align-middle').text(v.KLS_KODEMK).appendTo(row);
                                $('<td>').addClass('text-center align-middle').text(v.KLS_NAMA).appendTo(row);
                                $('<td>').addClass('text-center align-middle').text(v.tatap_muka).appendTo(row);
                                $('<td>').addClass('text-center align-middle').text('').appendTo(row);
                                $('<td>').addClass('text-center align-middle').text(v.kode_prodi).appendTo(row);
                                $('<td>').addClass('text-center align-middle').text('').appendTo(row);
                                $('<td>').addClass('text-center align-middle').text('1').appendTo(row);

                            });

                            nilai.append(table);

                            // activate datatable
                            table.DataTable({
                                dom: '<"html5buttons"B>lTfgitp',
                                // show entries up to 500
                                lengthMenu: [[10, 25, 50, 100, 500, -1], [10, 25, 50, 100, 500, "All"]],
                                buttons: [
                                    {extend: 'copy'},
                                    {extend: 'csv'},
                                    {
                                        extend: 'excel',
                                        title: 'Data Dosen Ajar',
                                        customize: function(xlsx) {
                                            var sheet = xlsx.xl.worksheets['sheet1.xml'];

                                            $('row c[r^="B"]', sheet).each( function () {
                                                // Get cell value
                                                var cellValue = $(this).text();

                                                // Change cell type to 'inlineStr'
                                                $(this).attr('t', 'inlineStr');

                                                // Remove existing cell value
                                                $(this).children().remove();

                                                // Add new 'is' (inline string) element and 't' (text) element with cell value
                                                $(this).append('<is><t>'+cellValue+'</t></is>');
                                            });
                                            $('row c[r^="H"]', sheet).each( function () {
                                                // Get cell value
                                                var cellValue = $(this).text();

                                                // Change cell type to 'inlineStr'
                                                $(this).attr('t', 'inlineStr');

                                                // Remove existing cell value
                                                $(this).children().remove();

                                                // Add new 'is' (inline string) element and 't' (text) element with cell value
                                                $(this).append('<is><t>'+cellValue+'</t></is>');
                                            });
                                        }
                                    },
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
                                ],
                                // columnDefs: [
                                //     {
                                //         targets: 5,
                                //         render: function (data, type, row) {
                                //             return parseInt(data.replace('.', ''));
                                //         }
                                //     }
                                // ]
                            });
                        } else {
                            nilai.append('<h2 class="text-center">Data tidak ditemukan</h2>');
                        }
                    }
                });
            });
    });

</script>
@endpush

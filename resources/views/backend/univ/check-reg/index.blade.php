@extends('layouts.admin-univ.layout')
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h2>Check Registrasi UNSRI</h2>
    </div>
    <div class="ibox-content p-md">
        <div class="row">
            <form id="form-simak" method="get">
                <div class="input-group m-xl">
                    <input type="text" name="nim" id="nim" class="form-control input"
                        placeholder="Silahkan masukkan NIM!!" required>
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-primary">Cari!!</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="pt-2 ml-3 mr-3" id="transkrip-data">
            <table id="transkrip-data"></table>
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
    $(document).ready(function(){
            $('#form-simak').on('submit', function (e) {
                e.preventDefault();
                var nim = $('#nim').val();

                // ajax request
                $.ajax({
                    url: "{{ route('admin-univ.check-transkrip-simak-data') }}",
                    type: 'GET',
                    data: {nim: nim},
                    success: function (response) {
                        var data = response.data;
                        var transkrip = $('#transkrip-data');

                        console.log(data);

                        transkrip.empty();

                        if (data.length > 0) {
                            var table = $('<table>').addClass('table table-bordered table-hover');
                            var thead = $('<thead>').appendTo(table);
                            var tbody = $('<tbody>').appendTo(table);

                            var headerRow = $('<tr>').addClass('text-center').appendTo(thead);
                            $('<th>').addClass('text-center align-middle').text('No').appendTo(headerRow);
                            $('<th>').addClass('text-center align-middle').text('Tahun Akademik').appendTo(headerRow);
                            $('<th>').addClass('text-center align-middle').text('Kode MK').appendTo(headerRow);
                            $('<th>').addClass('text-center align-middle').text('Nama MK').appendTo(headerRow);
                                $('<th>').addClass('text-center align-middle').text('SKS MK').appendTo(headerRow);
                            $('<th>').addClass('text-center align-middle').text('Kode Kelas').appendTo(headerRow);
                                $('<th>').addClass('text-center align-middle').text('Nilai angka').appendTo(headerRow);
                            $('<th>').addClass('text-center align-middle').text('Nilai Huruf').appendTo(headerRow);
                                $('<th>').addClass('text-center align-middle').text('Bobot').appendTo(headerRow);


                            // looping data
                            $.each(data, function (i, v) {
                                var row = $('<tr>').appendTo(tbody);
                                $('<td>').addClass('text-center align-middle').text(i + 1).appendTo(row);
                                $('<td>').addClass('text-center align-middle').text(v.FTAK).appendTo(row);
                                $('<td>').addClass('text-center align-middle').text(v.FCOD).appendTo(row);
                                $('<td>').addClass('align-middle').text(v.FMAT).appendTo(row);
                                $('<td>').addClass('text-center align-middle').text(v.FSKS).appendTo(row);
                                $('<td>').addClass('text-center align-middle').text(v.KLS_NAMA).appendTo(row);
                                $('<td>').addClass('text-center align-middle').text(v.FNIL_AKHIR).appendTo(row);
                                $('<td>').addClass('text-center align-middle').text(v.FNIL).appendTo(row);
                                if (v.FNIL === 'A') {
                                    var bobot = v.FSKS * 4;
                                    $('<td>').addClass('text-center align-middle').text(bobot).appendTo(row);
                                }else if(v.FNIL === 'B'){
                                    var bobot = v.FSKS * 3;
                                    $('<td>').addClass('text-center align-middle').text(bobot).appendTo(row);
                                }else if(v.FNIL === 'C'){
                                    var bobot = v.FSKS * 2;
                                    $('<td>').addClass('text-center align-middle').text(bobot).appendTo(row);
                                } else if(v.FNIL === 'D') {
                                    var bobot = v.FSKS * 1;
                                    $('<td>').addClass('text-center align-middle').text(bobot).appendTo(row);
                                }else if(v.FNIL === 'E') {
                                    var bobot = v.FSKS * 0;
                                    $('<td>').addClass('text-center align-middle').text(bobot).appendTo(row);
                                }else if(v.FNIL === 'F') {
                                    var bobot = '-';
                                    $('<td>').addClass('text-center align-middle').text(bobot).appendTo(row);
                                }



                            });

                            transkrip.append(table);

                            // activate datatable
                            table.DataTable({
                                dom: '<"html5buttons"B>lTfgitp',
                                buttons: [
                                    {extend: 'copy'},
                                    {extend: 'csv'},
                                    {extend: 'excel', title: 'Data Transkrip'},
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
                                ]
                            });
                        }
                    }
                });
            });
        });
</script>
@endpush

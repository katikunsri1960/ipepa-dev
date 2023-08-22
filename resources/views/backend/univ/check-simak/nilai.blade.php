@extends('layouts.admin-univ.layout')
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h2>Check Nilai SIMAK UNSRI</h2>
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
                    url: "{{ route('admin-univ.check-nilai-simak-data') }}",
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
                            $('<th>').addClass('text-center align-middle').text('No').appendTo(headerRow);
                            $('<th>').addClass('text-center align-middle').text('Tahun Akademik').appendTo(headerRow);
                            $('<th>').addClass('text-center align-middle').text('NIM').appendTo(headerRow);
                            $('<th>').addClass('text-center align-middle').text('Nama Mahasiswa').appendTo(headerRow);
                            $('<th>').addClass('text-center align-middle').text('Kode MK').appendTo(headerRow);
                            $('<th>').addClass('text-center align-middle').text('Nama MK').appendTo(headerRow);
                            $('<th>').addClass('text-center align-middle').text('Kode Kelas').appendTo(headerRow);
                            $('<th>').addClass('text-center align-middle').text('Nilai angka').appendTo(headerRow);
                            $('<th>').addClass('text-center align-middle').text('Nilai Huruf').appendTo(headerRow);
                            $('<th>').addClass('text-center align-middle').text('Nilai Indeks').appendTo(headerRow);
                            $('<th>').addClass('text-center align-middle').text('Bobot').appendTo(headerRow);


                            // looping data
                            $.each(data, function (i, v) {
                                var row = $('<tr>').appendTo(tbody);
                                $('<td>').addClass('text-center align-middle').text(i + 1).appendTo(row);
                                $('<td>').addClass('text-center align-middle').text(v.FTAK).appendTo(row);
                                $('<td>').addClass('text-center align-middle').text(v.FNIM).appendTo(row);
                                $('<td>').addClass('align-middle').text(v.FMNAM).appendTo(row);
                                $('<td>').addClass('text-center align-middle').text(v.FCOD).appendTo(row);
                                $('<td>').addClass('align-middle').text(v.nm_mata_kuliah).appendTo(row);
                                $('<td>').addClass('text-center align-middle').text(v.KLS_NAMA).appendTo(row);
                                $('<td>').addClass('text-center align-middle').text(v.FNIL_AKHIR).appendTo(row);
                                $('<td>').addClass('text-center align-middle').text(v.FNIL).appendTo(row);
                                if (v.FNIL === 'A') {
                                    var indeks = 4;
                                    $('<td>').addClass('text-center align-middle').text(indeks).appendTo(row);
                                }else if(v.FNIL === 'B'){
                                    var indeks = 3;
                                    $('<td>').addClass('text-center align-middle').text(indeks).appendTo(row);
                                }else if(v.FNIL === 'C'){
                                    var indeks = 2;
                                    $('<td>').addClass('text-center align-middle').text(indeks).appendTo(row);
                                } else if(v.FNIL === 'D') {
                                    var indeks = 1;
                                    $('<td>').addClass('text-center align-middle').text(indeks).appendTo(row);
                                }else if(v.FNIL === 'E') {
                                    var indeks = 0;
                                    $('<td>').addClass('text-center align-middle').text(indeks).appendTo(row);
                                }else if(v.FNIL === 'F') {
                                    var indeks = '-';
                                    $('<td>').addClass('text-center align-middle').text(indeks).appendTo(row);
                                }

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

                            nilai.append(table);

                            // activate datatable
                            table.DataTable({
                                dom: '<"html5buttons"B>lTfgitp',
                                // show entries up to 500
                                lengthMenu: [[10, 25, 50, 100, 500, -1], [10, 25, 50, 100, 500, "All"]],
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
                        } else {
                            nilai.append('<h2 class="text-center">Data tidak ditemukan</h2>');
                        }
                    }
                });
            });
    });

</script>
@endpush

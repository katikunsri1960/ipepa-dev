@extends('layouts.admin-univ.layout')
@section('content')
<div class="ibox float-e-margins">
    <div id="loading-overlay">
        <div id="loading-spinner"></div>
    </div>
    <div class="ibox-title">
        <h2>Tes Tableau</h2>
    </div>
    <div class="ibox-content p-md">

        <script type='module' src='https://tableau.unsri.ac.id/javascripts/api/tableau.embedding.3.latest.min.js'></script>

        <tableau-viz id='tableau-viz' src='https://tableau.unsri.ac.id/views/penelitian/Dashboard1?:origin=card_share_link&:embed=yes&:toolbar=no' width='100%' height='800' hide-tabs toolbar='no'
        token='{{ $token }}'></tableau-viz>
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
        $(document).ajaxStart(function() {
            $('#loading-overlay').show();
        });

        // Menghapus elemen loading screen saat permintaan AJAX selesai atau terjadi kesalahan
        $(document).ajaxStop(function() {
            $('#loading-overlay').hide();
        });

        $('#semester').chosen({
            width: '100%'
        });
        $('#prodi').chosen({
            width: '100%'
        });

        $('#mahasiswa-data').on('submit', function (e) {
                e.preventDefault();
                var semester = $('#semester').val();
                var prodi = $('#prodi').val();
                var jenis = $('#jenis').val();

                $.ajax({
                    type: "GET",
                    url: "{{route('admin-univ.prestasi-ipepa.data')}}",
                    data: {
                        semester: semester,
                        prodi: prodi,
                        jenis: jenis,
                    },
                    success: function (response) {
                        var data = response.data;
                        console.log(data);
                        var dataMhs = $('#data-mahasiswa');

                        // Kosongkan konten #sebelum mengisi data baru
                        dataMhs.empty();
                        if (data.length > 0) {
                             // Buat elemen tabel dan tambahkan ke #data-dosen
                            var table = $('<table>').addClass('table table-bordered table-hover');
                            var thead = $('<thead>').appendTo(table);
                            var tbody = $('<tbody>').appendTo(table);

                            // Buat baris header dan tambahkan ke thead
                            var headerRow = $('<tr>').addClass('text-center').appendTo(thead);
                            $('<th rowspan="2">').addClass('text-center align-middle').text('No').css('vertical-align', 'middle').appendTo(headerRow);
                            $('<th rowspan="2">').addClass('text-center align-middle').text('Nama Kegiatan').css('vertical-align', 'middle').appendTo(headerRow);
                            $('<th rowspan="2">').addClass('text-center align-middle').text('Tahun Perolehan').css('vertical-align', 'middle').appendTo(headerRow);
                            $('<th colspan="3">').addClass('text-center align-middle').text('Tingkat').appendTo(headerRow);
                            $('<th rowspan="2">').addClass('text-center align-middle').text('Prestasi yang Dicapai').css('vertical-align', 'middle').appendTo(headerRow);
                            var headerRow2 = $('<tr>').addClass('text-center').appendTo(thead);
                            $('<th>').addClass('text-center align-middle').text('Lokal/Wilayah').appendTo(headerRow2);
                            $('<th>').addClass('text-center align-middle').text('Nasional').appendTo(headerRow2);
                            $('<th>').addClass('text-center align-middle').text('Internasional').appendTo(headerRow2);



                            // Buat sel untuk setiap kolom data mahasiswa
                            data.forEach(function (mahasiswa, index) {
                                var row = $('<tr>').appendTo(tbody);
                                $('<td>').addClass('align-middle text-center').text(index + 1).appendTo(row);
                                $('<td>').addClass('align-middle').text(mahasiswa.nama_prestasi).appendTo(row);
                                $('<td>').addClass('align-middle text-center').text(mahasiswa.tahun_prestasi).appendTo(row);
                                if(mahasiswa.id_tingkat_prestasi == 5){
                                    $('<td>').addClass('align-middle text-center').text('').appendTo(row);
                                    $('<td>').addClass('align-middle text-center').text('V').appendTo(row);
                                    $('<td>').addClass('align-middle text-center').text('').appendTo(row);
                                }else if(mahasiswa.id_tingkat_prestasi == 6){
                                    $('<td>').addClass('align-middle text-center').text('').appendTo(row);
                                    $('<td>').addClass('align-middle text-center').text('').appendTo(row);
                                    $('<td>').addClass('align-middle text-center').text('V').appendTo(row);
                                }else{
                                    $('<td>').addClass('align-middle text-center').text('V').appendTo(row);
                                    $('<td>').addClass('align-middle text-center').text('').appendTo(row);
                                    $('<td>').addClass('align-middle text-center').text('').appendTo(row);
                                }
                                if (mahasiswa.peringkat != null) {
                                    $('<td>').addClass('align-middle text-center').text("Peringkat "+mahasiswa.peringkat).appendTo(row);
                                }else{
                                    $('<td>').addClass('align-middle text-center').text("").appendTo(row);
                                }


                            });

                            // count data where id_tingkat_prestasi = 5
                            var count_lokal = 0;
                            var count_nasional = 0;
                            var count_internasional = 0;
                            data.forEach(function (mahasiswa, index) {
                                if(mahasiswa.id_tingkat_prestasi == 5){
                                    count_nasional++;
                                }else if(mahasiswa.id_tingkat_prestasi == 6){
                                    count_internasional++;
                                }else{
                                    count_lokal++;
                                }
                            });


                            // add total
                            var row = $('<tr>').appendTo(tbody);
                            $('<td colspan="3">').addClass('align-middle text-center').text('Jumlah').appendTo(row);
                            $('<td>').addClass('align-middle text-center').text(count_lokal).appendTo(row);
                            $('<td>').addClass('align-middle text-center').text(count_nasional).appendTo(row);
                            $('<td>').addClass('align-middle text-center').text(count_internasional).appendTo(row);
                            $('<td>').addClass('align-middle text-center').text('').appendTo(row);


                            dataMhs.append(table);

                        } else{
                            dataMhs.append(`
                                <div class="col-sm-12 col-md-12">
                                    <div class="alert alert-danger" role="alert">
                                        Data tidak ditemukan!
                                    </div>
                                </div>
                            `);
                        }

                    }
                });
            });
    });
</script>
@endpush

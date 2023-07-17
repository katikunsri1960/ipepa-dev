@extends('layouts.admin-prodi.layout')
@section('content')
<div class="ibox float-e-margins">
    <div id="loading-overlay">
        <div id="loading-spinner"></div>
    </div>
    <div class="ibox-title">
        <h2>IPEPA Mahasiswa Regular & Transfer</h2>
    </div>
    <div class="ibox-content p-md">

        <form id="mahasiswa-data" method="GET">
            <div class="col-sm-12 col-md-12">
                <div class="form-group">
                    <div class="col-md-4">
                        <select name="semester" id="semester"
                            class="form-control @error('semester') is-invalid state-invalid @enderror">
                            <option value="">-- Pilih Tahun --</option>
                            @foreach ($tahunSekarang as $sem)
                            <option value="{{$sem->id_tahun_ajaran}}">{{$sem->id_tahun_ajaran}}
                            </option>
                            @endforeach
                        </select>
                        @error('semester')
                        <span class="text-red" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <button type="submit" class="input-group-text btn btn-primary">Get
                            Data!!</button>
                    </div>
                </div>
            </div>
        </form>
        <hr><br><br>
        <div class="pt-2" id="data-mahasiswa">
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
    function generateGelarList(gelar_akademik) {
            var list = '';

            for (var i = 0; i < gelar_akademik.length; i++) {
                list += '<li>' + gelar_akademik[i] + '</li>';
            }

            return list;
        }

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

        $('#mahasiswa-data').on('submit', function (e) {
                e.preventDefault();
                var semester = $('#semester').val();

                $.ajax({
                    type: "GET",
                    url: "{{route('admin-prodi.regular-transfer.data')}}",
                    data: {
                        semester: semester,
                    },
                    success: function (response) {
                        var data = response.data;
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
                            $('<th rowspan="2">').addClass('text-center align-middle').text('Tahun Akademik').css('vertical-align', 'middle').appendTo(headerRow);
                            $('<th rowspan="2">').addClass('text-center align-middle').text('Semester').css('vertical-align', 'middle').appendTo(headerRow);
                            $('<th colspan="2">').addClass('text-center align-middle').text('Mahasiswa Baru').appendTo(headerRow);
                            $('<th rowspan="2">').addClass('text-center align-middle').text('Jumlah Mahasiswa Aktif').css('vertical-align', 'middle').appendTo(headerRow);
                            $('<th rowspan="2">').addClass('text-center align-middle').text('Jumlah Lulusan').css('vertical-align', 'middle').appendTo(headerRow);
                            $('<th rowspan="2">').addClass('text-center align-middle').text('Jumlah Gagal').css('vertical-align', 'middle').appendTo(headerRow);
                            var headerRow2 = $('<tr>').addClass('text-center').appendTo(thead);
                            $('<th>').addClass('text-center align-middle').text('Regular').appendTo(headerRow2);
                            $('<th>').addClass('text-center align-middle').text('Transfer').appendTo(headerRow2);



                            // Buat sel untuk setiap kolom data mahasiswa
                            data.forEach(function (mahasiswa, index) {
                                var row = $('<tr>').appendTo(tbody);
                                $('<td rowspan="2">').addClass('align-middle text-center').text(index + 1).css('vertical-align', 'middle').appendTo(row);
                                $('<td rowspan="2">').addClass('align-middle text-center').text(mahasiswa.tahun_akademik).css('vertical-align', 'middle').appendTo(row);
                                // $('<td>').addClass('align-middle text-center').text(mahasiswa.tahun_akademik).appendTo(row);
                                $('<td>').addClass('align-middle text-center').text("Ganjil").appendTo(row);
                                $('<td>').addClass('align-middle text-center').text(mahasiswa.data['ganjil']['reguler']).appendTo(row);
                                $('<td>').addClass('align-middle text-center').text(mahasiswa.data['ganjil']['transfer']).appendTo(row);
                                $('<td>').addClass('align-middle text-center').text(mahasiswa.data['ganjil']['aktif']).appendTo(row);
                                $('<td>').addClass('align-middle text-center').text(mahasiswa.data['ganjil']['lulus']).appendTo(row);
                                $('<td>').addClass('align-middle text-center').text(mahasiswa.data['ganjil']['gagal']).appendTo(row);
                                var row2 = $('<tr>').appendTo(tbody);
                                // $('<td>').addClass('align-middle text-center').text(mahasiswa.tahun_akademik).appendTo(row2);
                                $('<td>').addClass('align-middle text-center').text("Genap").appendTo(row2);
                                $('<td>').addClass('align-middle text-center').text(mahasiswa.data['genap']['reguler']).appendTo(row2);
                                $('<td>').addClass('align-middle text-center').text(mahasiswa.data['genap']['transfer']).appendTo(row2);
                                $('<td>').addClass('align-middle text-center').text(mahasiswa.data['genap']['aktif']).appendTo(row2);
                                $('<td>').addClass('align-middle text-center').text(mahasiswa.data['genap']['lulus']).appendTo(row2);
                                $('<td>').addClass('align-middle text-center').text(mahasiswa.data['genap']['gagal']).appendTo(row2);

                            });

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

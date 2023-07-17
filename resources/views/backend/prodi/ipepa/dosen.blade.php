@extends('layouts.admin-prodi.layout')
@section('content')
<div class="ibox float-e-margins">
    <div id="loading-overlay">
        <div id="loading-spinner"></div>
    </div>
    <div class="ibox-title">
        <h2>IPEPA Dosen</h2>
    </div>
    <div class="ibox-content p-md">

        <form id="dosen-data" method="GET">
            <div class="row mb-3">
                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        <label class="form-label">Tahun Semester Sekarang <span
                                class="text-danger">*</span></label>
                        <select name="semester" id="semester" required
                            class="form-control @error('semester') is-invalid state-invalid @enderror">
                            <option value="">-- Pilih Semester --</option>
                            @foreach ($tahunSekarang as $sem)
                            <option value="{{$sem->id_tahun_ajaran}}">{{$sem->id_tahun_ajaran}}
                            </option>
                            @endforeach
                        </select>
                        @error('semester')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        <label class="form-label">Ikatan Kerja Dosen <span
                                class="text-danger">*</span></label>
                        <select name="ikatan" id="ikatan" required
                            class="form-control @error('ikatan') is-invalid state-invalid @enderror">
                            <option value="">-- Pilih Ikatan Kerja --</option>
                            @foreach ($ikatan as $i)
                            <option value="{{$i->id}}">{{$i->nama}}</option>
                            @endforeach
                        </select>
                        @error('ikatan')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6 col-md-6">
                    <button type="submit" class="btn btn-block btn-success">Get
                        Data</button>
                </div>
            </div>
        </form>
        <hr>
        <div class="pt-2" id="data-dosen">
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
        $('#ikatan').chosen({
            width: '100%'
        });

        $('#dosen-data').on('submit', function (e) {
                e.preventDefault();
                var semester = $('#semester').val();
                var ikatan = $('#ikatan').val();

                $.ajax({
                    type: "GET",
                    url: "{{route('admin-prodi.dosen.data')}}",
                    data: {
                        semester: semester,
                        ikatan: ikatan
                    },
                    success: function (response) {
                        // make datatable after ajax success
                        var data = response.data;
                        var dataDosen = $('#data-dosen');

                        // Kosongkan konten #data-dosen sebelum mengisi data baru
                        dataDosen.empty();

                        if (data.length > 0) {
                            // Buat elemen tabel dan tambahkan ke #data-dosen
                            var table = $('<table>').addClass('table table-bordered table-hover');
                            var thead = $('<thead>').appendTo(table);
                            var tbody = $('<tbody>').appendTo(table);

                            // Buat baris header dan tambahkan ke thead
                            var headerRow = $('<tr>').addClass('text-center').appendTo(thead);
                            $('<th>').addClass('text-center align-middle').text('No').css('vertical-align', 'middle').appendTo(headerRow);
                            $('<th>').addClass('text-center align-middle').text('Nama Dosen').css('vertical-align', 'middle').appendTo(headerRow);
                            $('<th>').addClass('text-center align-middle').text('NIDN / NIDK').appendTo(headerRow);
                            $('<th>').addClass('text-center align-middle').text('Gelar').css('vertical-align', 'middle').appendTo(headerRow);
                            $('<th>').addClass('text-center align-middle').text('Jabatan Akademik').appendTo(headerRow);
                            $('<th>').addClass('text-center align-middle').text('Mata Kuliah yang diampu').css('vertical-align', 'middle').appendTo(headerRow);
                            $('<th>').addClass('text-center align-middle').text('Bobot Kredit (sks)').css('vertical-align', 'middle').appendTo(headerRow);

                            // Iterasi melalui data dan tambahkan baris baru pada tbody
                            for (var i = 0; i < data.length; i++) {
                                var d = data[i];
                                var rowspan = d.nama_mk.length;

                                for (var j = 0; j < rowspan; j++) {
                                    var row = $('<tr>');

                                    if (j === 0) {
                                        $('<td>').addClass('text-center').attr('rowspan', rowspan).text(i + 1).appendTo(row);
                                        $('<td>').attr('rowspan', rowspan).text(d.nama_dosen).appendTo(row);
                                        $('<td>').attr('rowspan', rowspan).text(d.nidn).appendTo(row);
                                        $('<td>').attr('rowspan', rowspan).append($('<ol>').addClass('list-style-3').append(generateGelarList(d.gelar_akademik))).appendTo(row);
                                        $('<td class="text-center">').attr('rowspan', rowspan).text(d.jabfung).appendTo(row);
                                    }

                                    $('<td>').text(d.nama_mk[j]).appendTo(row);
                                    $('<td>').addClass('text-center').text(d.sks[j] + ' sks').appendTo(row);

                                    tbody.append(row);
                                }
                            }

                            // Tambahkan tabel ke elemen #data-dosen
                            dataDosen.append(table);
                        } else {
                            // Tampilkan pesan jika data tidak ditemukan
                            var message = $('<div>').addClass('col-sm-12 col-md-12').append(
                                $('<div>').addClass('alert alert-danger').attr('role', 'alert').append(
                                    $('<strong>').text('Maaf!'),
                                    ' Data tidak ditemukan.'
                                )
                            );

                            dataDosen.append(message);
                        }
                    }
                });
            });
    });
</script>
@endpush

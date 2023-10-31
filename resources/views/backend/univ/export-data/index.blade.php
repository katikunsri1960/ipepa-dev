@extends('layouts.admin-univ.layout')
@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Export Data Neofeeder</h5>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="widget yellow-bg p-lg text-center">
                        <div class="m-b-md">
                            <i class="fa fa-bell fa-4x"></i>
                            <h2 class="font-bold no-margins">
                                Notification
                            </h2>
                            <h5>Data yang terdapat dalam file excel hasil export,merupakan data yang<br>sesuai dengan data terakhir sync pada Pangkalan Data UNSRI.</h5>
                        </div>
                    </div>
                </div>
            </div><hr style="border-width: 2px;">
            <div class="row">
                <form method="get" action="{{route('admin-univ.export-data')}}">
                    <div class="col-md-12 text-center">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Tabel <span style="color: red;">*</span></label>
                            <select id='table_name' class="form-control" name="table_name" onchange="Export()" required>
                                <option value="">Pilih Nama Tabel</option>
                                @for ($i = 0; $i < count($table_name); $i++)
                                    <option value="{{ $table_name[$i] }}">{{ $table_name[$i] }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group" id='status_mahasiswa' hidden>
                            <label for="exampleInputEmail1">Status Mahasiswa <span style="color: red;">*</span></label>
                            <select class="form-control" name="status_mahasiswa">
                                <option value="">Pilih Status Mahasiswa</option>
                                <option value="Semua Prodi">Semua Status Mahasiswa</option>
                                @foreach($status_mahasiswa as $sm)
                                    <option value="{{ $sm->nama_status_mahasiswa }}">{{ $sm->nama_status_mahasiswa }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" id='periode' hidden>
                            <label for="exampleInputEmail1">Periode / Angkatan <span style="color: red;">*</span></label>
                            <select class="form-control" name="periode">
                                <option value="">Pilih Periode / Angkatan</option>
                                @foreach($periode as $t)
                                    <option value="{{ $t->id_tahun_ajaran }}">{{ $t->nama_tahun_ajaran }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" id='semester' hidden>
                            <label for="exampleInputEmail1">Semester <span style="color: red;">*</span></label>
                            <select class="form-control" name="semester" >
                                <option value="">Pilih Semester</option>
                                @foreach($semester as $s)
                                    <option value="{{ $s->id_semester }}">{{ $s->nama_semester }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" id='prodi' hidden>
                            <label for="exampleInputEmail1">Program Studi <span style="color: red;">*</span></label>
                            <select class="form-control" name="program_studi" type="hidden">
                                <option value="">Pilih Program Studi</option>
                                @foreach($program_studi as $p)
                                    <option value="{{ $p->id_prodi }}">{{ $p->nama_program_studi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" id='prodi_1' hidden>
                            <label for="exampleInputEmail1">Program Studi <span style="color: red;">*</span></label>
                            <select class="form-control" name="program_studi" type="hidden">
                                <option value="">Pilih Program Studi</option>
                                <option value="Semua Prodi">Semua Program Studi</option>
                                @foreach($program_studi as $p)
                                    <option value="{{ $p->id_prodi }}">{{ $p->nama_program_studi }}</option>
                                @endforeach
                            </select>
                        </div><hr style="border-width: 2px;">
                        <button class="btn btn-primary" type="submit">Export Excel</button>
                    </div>
                </form>
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
        });
    </script>
    <script>
        function Export(){
            if($('#table_name').val() == ''){
                $('#prodi').hide();
                $('#prodi_1').hide();
                $('#periode').hide();
                $('#status_mahasiswa').hide();
                $('#semester').hide();
            }
            if($('#table_name').val() == 'Mata Kuliah'){
                $('#prodi').show();
                $('#prodi_1').hide();
                $('#periode').hide();
                $('#status_mahasiswa').hide();
                $('#semester').hide();
            }
            else if($('#table_name').val() == 'Daftar Mahasiswa'){
                $('#periode').show();
                $('#semester').hide();
                $('#status_mahasiswa').show();
                $('#prodi_1').show();
                $('#prodi').hide();
            }
            if($('#table_name').val() == 'Nilai Transfer'){
                $('#periode').show();
                $('#semester').hide();
                $('#status_mahasiswa').hide();
                $('#prodi_1').hide();
                $('#prodi').show();
            }
            if($('#table_name').val() == 'Penugasan Dosen'){
                $('#periode').show();
                $('#semester').hide();
                $('#status_mahasiswa').hide();
                $('#prodi_1').show();
                $('#prodi').hide();
            }
            if($('#table_name').val() == 'Mahasiswa Lulus/DO'){
                $('#periode').show();
                $('#semester').hide();
                $('#status_mahasiswa').hide();
                $('#prodi_1').show();
                $('#prodi').hide();
            }
            if($('#table_name').val() == 'Kelas Perkuliahan'){
                $('#semester').show();
                $('#periode').hide();
                $('#prodi_1').hide();
                $('#prodi').show();
            }
            if($('#table_name').val() == 'Aktivitas Mengajar Dosen'){
                $('#semester').show();
                $('#periode').hide();
                $('#prodi_1').hide();
                $('#status_mahasiswa').hide();
                $('#prodi').show();
            }
            if($('#table_name').val() == 'KRS Mahasiswa'){
                $('#semester').show();
                $('#periode').hide();
                $('#prodi_1').hide();
                $('#status_mahasiswa').hide();
                $('#prodi').show();
            }
            if($('#table_name').val() == 'Aktivitas Kuliah'){
                $('#semester').show();
                $('#periode').hide();
                $('#prodi_1').hide();
                $('#status_mahasiswa').hide();
                $('#prodi').show();
            }
            if($('#table_name').val() == 'Transkrip'){
                $('#semester').show();
                $('#periode').hide();
                $('#prodi_1').hide();
                $('#status_mahasiswa').hide();
                $('#prodi').show();
            }
        }
    </script>
@endpush


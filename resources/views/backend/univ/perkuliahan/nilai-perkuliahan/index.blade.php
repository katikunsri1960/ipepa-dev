@extends('layouts.admin-univ.layout')
@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Nilai Perkuliahan</h5>
        </div>

        <div class="ibox-content p-md">
            <div class="row">
                <form method="get">
                    <div class="col-md-8">
                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-filter"><i
                                class="fa-solid fa-filter"></i><span style="margin-left: 6px; margin-right: 6px">Filter</span>
                        </button>

                        <div id="modal-filter" class="modal fade" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="form-group">
                                                <label>Pilih Semester</label>
                                                <select name="semester[]" id="semester"
                                                    data-placeholder="Pilih Semester..." class="form-control chosen-select"
                                                    multiple style="width:350px;" tabindex="4">
                                                    <option value=""></option>
                                                    @foreach ($semester as $sem)
                                                        <option value="{{ $sem->nama_semester }}"
                                                            @php
                                                            if($val->prodi != '' && $val->semester == ''){
                                                                if($val->semester && in_array($sem->nama_semester, $val->semester)){
                                                                    echo 'selected';
                                                                }
                                                            }
                                                            elseif($val->semester == ''){
                                                                if($semester_aktif[0]['nama_semester'] && in_array($sem->nama_semester,$semester_aktif[0])){
                                                                    echo 'selected';
                                                                }
                                                            }
                                                            if($val->semester != ''|| $val->prodi != ''){
                                                                if($val->semester && in_array($sem->nama_semester, $val->semester)){
                                                                    echo 'selected';
                                                                }
                                                            }
                                                            @endphp>
                                                            {{ $sem->nama_semester }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Program Studi</label>
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

                                            <button class="btn btn-warning" type="submit">Apply Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><br><br><hr>
                    <div class="col-md-2">
                        <select name="p" id="p" class="form-control" onchange="this.form.submit()">
                            @foreach ($paginate as $p)
                            <option value="{{ $p }}" @if ($p==$valPaginate) selected @endif>{{ $p }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
                <div class="col-lg-4 pull-right">
                    <form method="GET" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" name="keyword" placeholder="Search by Kode MK or Nama MK or Nama Kelas"
                                value="{{ request()->get('keyword', '') }}"> <span class="input-group-btn">
                                <button class="btn btn-default">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p class="pull-right">Halaman ini menampilkan data berdasarakan semester :
                        @if($val->prodi != '' && $val->semester == '')
                        {{"-"}}
                        @elseif($val->semester == '' && $val->prodi == '')
                            <span class="badge badge-primary"><i class="fa fa-calendar" aria-hidden="true"></i>   {{ $semester_aktif[0]['nama_semester'] }}</span>
                        @elseif($val->semester != '' || $val->prodi != '')
                            @foreach ($val->semester as $sem)
                                <span class="badge badge-primary"><i class="fa fa-calendar" aria-hidden="true"></i>   {{ $sem }}</span>
                            @endforeach
                        @endif
                    </p>
                </div>
            </div>
            <div class="pt-2">
                <table class="table table-bordered table-hover table-responsive" id="table-matkul">
                    <thead>
                        <tr>
                        <th class="text-center" style="vertical-align: middle">No.</th>
                        <th class="text-center" style="vertical-align: middle">Semester</th>
                        <th class="text-center" style="vertical-align: middle">Kode MK</th>
                        <th class="text-center" style="vertical-align: middle">Nama Mata Kuliah</th>
                        <th class="text-center" style="vertical-align: middle">Nama Kelas</th>
                        <th class="text-center" style="vertical-align: middle">Bobot MK (sks)</th>
                        <th class="text-center" style="vertical-align: middle">Peserta Kelas</th>
                        <th class="text-center" style="vertical-align: middle">Peserta Sudah di Nilai</th>
                        {{-- <th class="text-center" style="vertical-align: middle">Program Studi</th> --}}

                    </tr>
                </thead>
                <tbody>
                    @foreach($nilai_perkuliahan as $no => $data)
                    <tr>
                        <td class="text-center">{{$nilai_perkuliahan->firstItem() + $no}}</td>
                        <td class="text-center">{{$data->nm_smt}}</td>
                        <td  class="text-left"> <a href="{{route('admin-univ.detail-nilai-perkuliahan', ['id' => $data->id_kelas_kuliah, 'semester' => $data->id_smt])}}"
                            name="req"> {{$data->kode_mata_kuliah}}</a> </td>
                        <td class="text-left">{{$data->nama_mata_kuliah}}</td>
                        <td class="text-center">{{$data->nama_kelas_kuliah}}</td>
                        <td class="text-center">{{$data->sks_mata_kuliah}}</td>
                        <td class="text-center">{{$data->jumlah_mahasiswa_krs}}</td>
                        <td class="text-center">{{$data->jumlah_mahasiswa_dapat_nilai}}</td>
                        {{-- <td class="text-center">{{$data->nama_prodi}}</td> --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $nilai_perkuliahan->withQueryString()->links() !!}
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
@endpush

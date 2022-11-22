@extends('layouts.admin-univ.layout')
@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Periode Perkuliahan</h5>
        </div>
        <div class="ibox-content">
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
                                                <label>Semester</label>
                                                <select name="semester[]" id="semester"
                                                    data-placeholder="Pilih Semester..."
                                                    class="form-control chosen-select" multiple style="width:350px;"
                                                    tabindex="4">
                                                    <option value=""></option>
                                                    @foreach ($semester as $s)
                                                        <option value="{{ $s->nama_semester }}"
                                                            @php
                                                            if($val->prodi != '' && $val->semester == ''){
                                                                if($val->semester && in_array($s->nama_semester, $val->semester)){
                                                                    echo 'selected';
                                                                }
                                                            }
                                                            elseif($val->semester == '' && $val->prodi == ''){
                                                                if($semester_aktif[0]['nama_semester'] && in_array($s->nama_semester,$semester_aktif[0])){
                                                                    echo 'selected';
                                                                }
                                                            }
                                                            if($val->semester != ''|| $val->prodi != ''){
                                                                if($val->semester && in_array($s->nama_semester, $val->semester)){
                                                                    echo 'selected';
                                                                }
                                                            }
                                                            @endphp>
                                                            {{ $s->nama_semester }}
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
                                                            @if ($val->prodi && in_array($p->id_prodi, $val->prodi)) selected @endif>
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
                            <input type="text" class="form-control" name="keyword" placeholder="Search by NIDN or Nama"
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
                        @if ($val->prodi != '' && $val['semester'] == '')
                            {{"-"}}
                        @elseif ($val['semester'] != '' || $val['prodi'] != '')
                            @foreach ($val['semester'] as $s)
                                <span class="badge badge-primary"><i class="fa fa-calendar" aria-hidden="true"></i>   {{ $s }}</span>
                            @endforeach
                        @elseif ($val['semester'] == '' && $val['prodi'] == '')
                            <span class="badge badge-primary"><i class="fa fa-calendar" aria-hidden="true"></i>   {{ $semester_aktif[0]['nama_semester'] }}</span>
                        @endif
                    </p>
                </div>
            </div>
            <div class="pt-2">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th rowspan="2" class="text-center" style="vertical-align: middle">No.</th>
                            <th rowspan="2" class="text-center" style="vertical-align: middle">Semester</th>
                            <th rowspan="2" class="text-center" style="vertical-align: middle">Program Studi</th>
                            <th rowspan="2" class="text-center" style="vertical-align: middle">Status Prodi</th>
                            <th rowspan="2" class="text-center" style="vertical-align: middle">Target Mahasiswa Baru</th>
                            <th rowspan="2" class="text-center" style="vertical-align: middle">Tanggal Awal Perkuliahan</th>
                            <th rowspan="2" class="text-center" style="vertical-align: middle">Tanggal Akhir Perkuliahan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($periode_kuliah as $p => $data)
                        <tr>
                            <td class="text-center">{{$periode_kuliah->firstItem() + $p}}</td>
                            <td  class="text-left"><a href="{{route('admin-univ.detail-periode-perkuliahan', ['prodi' => $data->id_prodi, 'semester' => $data->id_semester])}}">{{$data->nama_semester}}</td>
                            <td class="text-left">{{$data->nama_program_studi}}</td>
                            <td class="text-center">{{$data->status}}</td>
                            <td class="text-center">{{$data->jumlah_target_mahasiswa_baru}}</td>
                            <td class="text-center">{{$data->tanggal_awal_perkuliahan}}</td>
                            <td class="text-center">{{$data->tanggal_akhir_perkuliahan}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $periode_kuliah->withQueryString()->links() !!}
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


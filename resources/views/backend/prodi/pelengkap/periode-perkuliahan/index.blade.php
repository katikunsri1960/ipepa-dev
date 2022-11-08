@extends('layouts.admin-prodi.layout')
@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Skala Penilaian</h5>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-md-8">
                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-filter"><i
                            class="fa-solid fa-filter"></i><span style="margin-left: 6px; margin-right: 6px">Filter</span>
                    </button>

                    <div id="modal-filter" class="modal fade" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="row">
                                        <form method="GET">
                                            <div class="form-group">
                                                <label>Semester</label>
                                                <select name="semester[]" id="semester"
                                                    data-placeholder="Pilih Semester..."
                                                    class="form-control chosen-select" multiple style="width:350px;"
                                                    tabindex="4">
                                                    <option value=""></option>
                                                    @foreach ($semester as $s)
                                                        <option value="{{ $s->id_semester }}"
                                                            @if ($val->semester && in_array($s->id_semester, $val->semester)) selected @endif>
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
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <form method="GET" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" name="keyword"
                                placeholder="Search by Nama Program Studi or Semester" value="{{request()->get('keyword','')}}"> <span class="input-group-btn">
                                <button class="btn btn-default">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>
                    </form>
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
                            <td  class="text-left"><a href="{{route('admin-prodi.detail-periode-perkuliahan', ['prodi' => $data->id_prodi, 'semester' => $data->id_semester])}}">{{$data->nama_semester}}</td>
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


@extends('layouts.admin-univ.layout')
@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Skala Penilaian</h5>
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
            <div class="pt-2">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th rowspan="2" class="text-center" style="vertical-align: middle">No.</th>
                            <th rowspan="2" class="text-center" style="vertical-align: middle">Program Studi</th>
                            <th rowspan="2" class="text-center" style="vertical-align: middle">Nilai Huruf</th>
                            <th rowspan="2" class="text-center" style="vertical-align: middle">Nilai Indeks</th>
                            <th rowspan="2" class="text-center" style="vertical-align: middle">Bobot Minimum</th>
                            <th rowspan="2" class="text-center" style="vertical-align: middle">Bobot Maksimum</th>
                            <th rowspan="2" class="text-center" style="vertical-align: middle">Tanggal Mulai Efektif</th>
                            <th rowspan="2" class="text-center" style="vertical-align: middle">Tanggal Akhir Efektif</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($skala_nilai as $s => $data)
                        <tr>
                            <td class="text-center">{{$skala_nilai->firstItem() + $s}}</td>
                            <td  class="text-left"><a href="{{route('admin-univ.detail-skala-nilai', ['id' => $data->id_bobot_nilai])}}">{{$data->nama_program_studi}}</td>
                            <td class="text-left">{{$data->nilai_huruf}}</td>
                            <td class="text-center">{{$data->nilai_indeks}}</td>
                            <td class="text-center">{{$data->bobot_minimum}}</td>
                            <td class="text-center">{{$data->bobot_maksimum}}</td>
                            <td class="text-center">{{$data->tanggal_mulai_efektif}}</td>
                            <td class="text-center">{{$data->tanggal_akhir_efektif}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $skala_nilai->withQueryString()->links() !!}
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


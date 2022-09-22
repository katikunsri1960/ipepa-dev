@extends('layouts.admin-univ.layout')
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Kurikulum</h5>
    </div>
    <div class="ibox-content p-md">
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
                            placeholder="Search by NIM, Nama or Nomor Seri Ijazah" value="{{request()->get('keyword','')}}"> <span class="input-group-btn">
                            <button class="btn btn-default">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <div class="pt-2">
            <table class="table table-bordered table-hover table-responsive" id="table-matkul">
                <thead>
                    <tr>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">No.</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Nama Kurikulum</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Program Studi</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Mulai Berlaku</th>
                        <th colspan="3" class="text-center" style="vertical-align: middle">Aturan jumlah sks</th>
                        <th colspan="2" class="text-center" style="vertical-align: middle">Jumlah sks Mata kuliah</th>
                    </tr>
                    <tr>
                        <th class="text-center" style="vertical-align: middle">Lulus</th>
                        <th class="text-center" style="vertical-align: middle">Wajib</th>
                        <th class="text-center" style="vertical-align: middle">Pilihan</th>
                        <th class="text-center" style="vertical-align: middle">Wajib</th>
                        <th class="text-center" style="vertical-align: middle">Pilihan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kurikulum as $k => $data)
                    <tr>
                        <td class="text-center">{{$kurikulum->firstItem() + $k}}</td>
                        <td  class="text-left"><a href="{{route('admin-univ.detail-kurikulum', ['id' => $data->id_kurikulum])}}">
                        {{$data->nama_kurikulum}}</td>
                        <td class="text-left">{{$data->nama_program_studi}}</td>
                        <td class="text-center">{{$data->semester_mulai_berlaku}}</td>
                        <td class="text-center">{{$data->jumlah_sks_lulus}}</td>
                        <td class="text-center">{{$data->jumlah_sks_wajib}}</td>
                        <td class="text-center">{{$data->jumlah_sks_pilihan}}</td>
                        <td class="text-center">{{number_format($data->jumlah_sks_mata_kuliah_wajib,0)}}</td>
                        <td class="text-center">{{number_format($data->jumlah_sks_mata_kuliah_pilihan,0)}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $kurikulum->withQueryString()->links() !!}
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

@extends('layouts.admin-univ.layout')
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Aktivitas Mahasiswa</h5>
    </div>
    <div class="ibox-content p-md">
        <div class="row">
            <div class="col-md-8">
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-filter"><i
                        class="fa-solid fa-filter"></i><span style="margin-left: 6px; margin-right: 6px">Filter</span>
                </button>
                <button class="btn btn-primary" id="exportBtn1"><i
                    class="fa-solid fa-file-excel"></i> <span style="margin-left: 6px; margin-right: 6px">Excel</span></button>

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
                                        <div class="form-group">
                                            <label>Pilih Semester</label>
                                            <select name="semester[]" id="semester"
                                                data-placeholder="Pilih Semester..." class="form-control chosen-select"
                                                multiple style="width:350px;" tabindex="4">
                                                <option value=""></option>
                                                @foreach ($semester as $sem)
                                                    <option value="{{ $sem->id_semester }}"
                                                        @if ($val->semester && in_array($sem->id_semester, $val->semester)) selected @endif>
                                                        {{ $sem->nama_semester }}
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
        </div><br>
        <div class="row">
            <div class="col-md-12">
                <p class="pull-right">Halaman ini menampilkan data berdasarakan semester :  <span class="badge badge-primary"><i class="fa fa-calendar" aria-hidden="true"></i></span></p>
            </div>
        </div>
        <div class="pt-2">
            <table class="table table-bordered table-hover table-responsive" id="table-akt-mhs">
                <thead>
                    <tr>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">No.</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Program Studi</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Semester</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Jenis</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Judul</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Tanggal SK</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($aktivitas_mahasiswa as $a => $data)
                    <tr>
                        {{-- {{route('admin-univ.detail-mahasiswa-lulus-do', ['id' => $data->id_mahasiswa, 'tahun' => $data->angkatan])}} --}}
                        <td class="text-center">{{$aktivitas_mahasiswa->firstItem() + $a}}</td>
                        <td  class="text-left"><a href="" name="req">
                        {{$data->nama_prodi}}</td>
                        <td class="text-left">{{$data->nama_semester}}</td>
                        <td class="text-center">{{ $data->nama_jenis_aktivitas }}</td>
                        <td class="text-left">{{$data->judul}}</td>
                        <td class="text-center">{{$data->tanggal_sk_tugas}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $aktivitas_mahasiswa->withQueryString()->links() !!}
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

    <!-- TableToExcel -->
    <script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>

    <script>
        $(document).ready(function() {
            $('.chosen-select').chosen({
                width: "100%"
            });

            $("#exportBtn1").click(function(){
                TableToExcel.convert(document.getElementById("table-akt-mhs"), {
                    name: "Feeder-Unsri.xlsx",
                    sheet: {
                    name: "Sheet1"
                    }
                });
            });
        });
    </script>
@endpush

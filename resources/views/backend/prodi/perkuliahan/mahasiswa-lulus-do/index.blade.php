@extends('layouts.admin-prodi.layout')
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Daftar Mahasiswa Lulus / Drop Out</h5>
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
                                        <div class="form-group">
                                            <label>Pilih Angkatan</label>
                                            <select name="angkatan[]" id="angkatan"
                                                data-placeholder="Pilih Angkatan..." class="form-control chosen-select"
                                                multiple style="width:350px;" tabindex="4">
                                                <option value=""></option>
                                                @foreach ($angkatan as $ang)
                                                    <option value="{{ $ang->angkatan }}"
                                                        @if ($val->angkatan && in_array($ang->angkatan, $val->angkatan)) selected @endif>
                                                        {{ $ang->angkatan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Pilih Jenis Keluar</label>
                                            <select name="jenis_keluar[]" id="jenis_keluar"
                                                data-placeholder="Pilih Jenis Keluar Mahasiswa..."
                                                class="form-control chosen-select" multiple style="width:350px;"
                                                tabindex="4">
                                                <option value=""></option>
                                                @foreach ($jenis_keluar as $j)
                                                    <option value="{{ $j->nama_jenis_keluar }}"
                                                        @if ($val->jenis_keluar && in_array($j->nama_jenis_keluar, $val->jenis_keluar)) selected @endif>
                                                        {{ $j->nama_jenis_keluar }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Pilih Tahun Keluar</label>
                                            <select name="tahun_keluar[]" id="tahun_keluar"
                                                data-placeholder="Pilih Tahun Keluar..." class="form-control chosen-select"
                                                multiple style="width:350px;" tabindex="4">
                                                <option value=""></option>
                                                @foreach ($tahun_keluar as $thn)
                                                    <option value="{{ $thn->tahun_keluar }}"
                                                        @if ($val->tahun_keluar && in_array($thn->tahun_keluar, $val->tahun_keluar)) selected @endif>
                                                        {{ $thn->tahun_keluar }}
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
            <div class="col-md-4 pull-right">
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
                <p class="pull-right">Halaman ini menampilkan data berdasarkan tahun keluar :
                    @if ($val['tahun_keluar'] != '')
                        @foreach ($val['tahun_keluar'] as $s)
                            <span class="badge badge-primary"><i class="fa fa-calendar" aria-hidden="true"></i>   {{ $s }}</span>
                        @endforeach
                    @elseif ($val['prodi'] != '' && $val['tahun_keluar'] = '')
                        @foreach ($val['tahun_keluar'] as $s)

                        @endforeach
                    {{-- @else
                        <span class="badge badge-primary"><i class="fa fa-calendar" aria-hidden="true"></i>   {{ $semester_aktif[0]['nama_semester'] }}</span> --}}
                    @endif
                </p>
            </div>
        </div>
        <div class="pt-2">
            <table class="table table-bordered table-hover table-responsive" id="table-matkul">
                <thead>
                    <tr>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">No.</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">NIM</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Nama Mahasiswa</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Program Studi</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Angkatan</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Jenis Keluar</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Tanggal Keluar</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Periode Keluar</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mahasiswa_lulus_do as $m => $data)
                    <tr>
                        <td class="text-center">{{$mahasiswa_lulus_do->firstItem() + $m}}</td>
                        <td  class="text-left"><a href="{{route('admin-prodi.detail-mahasiswa-lulus-do', ['id' => $data->id_mahasiswa, 'tahun' => $data->angkatan])}}" name="req">
                        {{$data->nim}}</td>
                        <td class="text-left">{{$data->nama_mahasiswa}}</td>
                        <td class="text-left">{{ $data->nama_jenjang_pendidikan }} {{ $data->nama_program_studi }}</td>
                        <td class="text-center">{{$data->angkatan}}</td>
                        <td class="text-center">{{$data->nama_jenis_keluar}}</td>
                        <td class="text-center">{{$data->tanggal_keluar}}</td>
                        <td class="text-center">{{$data->nama_semester}}</td>
                        <td class="text-center">{{$data->keterangan}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $mahasiswa_lulus_do->withQueryString()->links() !!}
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

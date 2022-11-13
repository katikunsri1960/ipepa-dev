@extends('layouts.admin-univ.layout')
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h2>Daftar Mahasiswa</h2>
    </div>
    <div class="ibox-content p-md">
        <div class="row"> 
            {{-- <div class="col-md-2">
                @if ($val->prodi || $val->angkatan || $val->status || $val->jk || $val->agama)
                {{-- Export Filtered Data
                {{-- <form action="{{ route('export.mahasiswa') }}" method="POST">
                    @csrf
                    <input type="hidden" name="prodi" value="{{ $val->prodi }}">
                    <input type="hidden" name="angkatan" value="{{ $val->angkatan }}">
                    <input type="hidden" name="status" value="{{ $val->status }}">
                    <input type="hidden" name="jk" value="{{ $val->jk }}">
                    <input type="hidden" name="agama" value="{{ $val->agama }}">
                    <button class="btn btn-success btn-block" type="submit"><i class="fa-solid fa-file-excel"></i><span
                            style="margin-left: 6px; margin-right: 6px">Export</span>
                    </button>
                </form> --}}
                {{-- <a href="#" class="btn btn-success">Export Filtered Data</a> --}}

                {{-- @else --}}
                {{-- <a href="{{route('admin-univ.export-daftar-mahasiswa')}}" class="btn btn-success">Export Data</a> --}}
                {{-- @endif
            </div> --}}
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
                                            <select name="prodi[]" id="prodi" data-placeholder="Pilih Program Studi..."
                                                class="form-control chosen-select" multiple style="width:350px;"
                                                tabindex="4">
                                                <option value=""></option>
                                                @foreach ($prodi as $p)
                                                <option value="{{ $p->id_prodi }}" @if ($val->prodi &&
                                                    in_array($p->id_prodi, $val->prodi)) selected @endif>
                                                    {{ $p->nama_jenjang_pendidikan }} {{ $p->nama_program_studi }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Pilih Angkatan</label>
                                            <select name="angkatan[]" id="angkatan" data-placeholder="Pilih Angkatan..."
                                                class="form-control chosen-select" multiple style="width:350px;"
                                                tabindex="4">
                                                <option value=""></option>
                                                @foreach ($angkatan as $ang)
                                                <option value="{{ $ang->angkatan }}" @if ($val->angkatan &&
                                                    in_array($ang->id_periode, $val->angkatan)) selected @endif>
                                                    {{ $ang->angkatan }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Pilih Status Mahasiswa</label>
                                            <select name="status[]" id="status"
                                                data-placeholder="Pilih Status Mahasiswa..."
                                                class="form-control chosen-select" multiple style="width:350px;"
                                                tabindex="4">
                                                <option value=""></option>
                                                @foreach ($status as $s)
                                                <option value="{{ $s->nama_status_mahasiswa }}" @if ($val->status &&
                                                    in_array($s->nama_status_mahasiswa, $val->status)) selected
                                                    @endif>
                                                    {{ $s->nama_status_mahasiswa }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Pilih Jenis Kelamin</label>
                                            <select name="jk[]" id="jk" data-placeholder="Pilih Jenis Kelamin..."
                                                class="form-control chosen-select" multiple style="width:350px;"
                                                tabindex="4">
                                                <option value=""></option>
                                                @foreach ($jk as $j)
                                                <option
                                                    value="@if ($j->jenis_kelamin == 'Perempuan') P @elseif ($j->jenis_kelamin == 'Laki-laki')L @endif"
                                                    @php if($j->jenis_kelamin == 'Perempuan'){
                                                    if($val->jk &&
                                                    in_array(str_replace($j->jenis_kelamin,'Perempuan','P'),
                                                    $val->jk)){
                                                    echo 'selected';
                                                    }
                                                    }
                                                    if($j->jenis_kelamin == 'Laki-laki'){
                                                    if($val->jk &&
                                                    in_array(str_replace($j->jenis_kelamin,'Laki-laki','L'),
                                                    $val->jk)){
                                                    echo 'selected';
                                                    }
                                                    } @endphp>
                                                    {{ $j->jenis_kelamin }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Pilih Agama</label>
                                            <select name="agama[]" id="agama" data-placeholder="Pilih Agama..."
                                                class="form-control chosen-select" multiple style="width:350px;"
                                                tabindex="4">
                                                <option value=""></option>
                                                @foreach ($agama as $a)
                                                <option value="{{ $a->id_agama }}" @if ($val->agama &&
                                                    in_array($a->id_agama, $val->agama)) selected @endif>
                                                    {{ $a->nama_agama }}</option>
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
            <div class="col-md-4 pull-right">
                <form method="GET" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control" name="keyword"
                            placeholder="Search by NIM, Nama, Program Studi" value="{{ request()->get('keyword', '') }}">
                        <span class="input-group-btn">
                            <button class="btn btn-default">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <div class="pt-2">
            <table class="table table-bordered table-hover table-responsive" id="table-mahasiswa">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">NIM</th>
                        <th class="text-center">Jenis Kelamin</th>
                        <th class="text-center">Agama</th>
                        <th class="text-center">Total SKS Diambil</th>
                        <th class="text-center">Tanggal Lahir</th>
                        <th class="text-center">Program Studi</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Angkatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mahasiswa as $m => $data)
                    <tr>
                        <td class="text-center">{{ $mahasiswa->firstItem() + $m }}</td>
                        <td><a href="{{ route('admin-univ.detail-mahasiswa', ['id' => $data->id_mahasiswa]) }}">{{
                                $data->nama_mahasiswa }}</a>
                        </td>
                        <td class="text-center">{{ $data->nim }}</td>
                        <td class="text-center">{{ $data->jenis_kelamin }}</td>
                        <td class="text-center">{{ $data->nama_agama }}</td>
                        <td class="text-center">
                            @if (!empty($data->total))
                            {{ $data->total }}
                            @else
                            0
                            @endif
                        </td>
                        <td class="text-center">{{ $data->tanggal_lahir }}</td>
                        <td class="text-center">{{ $data->nama_program_studi }}</td>
                        <td class="text-center">{{ $data->nama_status_mahasiswa }}</td>
                        <td class="text-center">{{ $data->angkatan }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $mahasiswa->withQueryString()->links() !!}

        </div>

        {{-- {{$mahasiswa->onEachSide(5)->links()}} --}}
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

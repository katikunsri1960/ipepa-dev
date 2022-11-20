@extends('layouts.admin-prodi.layout')
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h2>Penugasan Dosen</h2>
    </div>
    <div class="ibox-content p-md">
        <div class="row">
            <div class="col-lg-12">
                <div class="widget yellow-bg no-padding">
                    <div class="p-m">
                        <h3 class="font-bold no-margins">
                            Catatan :
                        </h3>
                        <h5>Mencatat penugasan dosen setiap tahunnya, Data penugasan hanya dapat di ubah pada laman <a href="http://pddikti.kemendikbud.go.id">http://pddikti.kemendikbud.go.id</a></h5>
                    </div>
                </div>
            </div>
        </div>
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
                                        <div class="form-group">
                                            <label>Pilih Tahun Ajaran</label>
                                            <select name="angkatan[]" id="angkatan"
                                                data-placeholder="Pilih Tahun Ajaran..." class="form-control chosen-select"
                                                multiple style="width:350px;" tabindex="4">
                                                <option value=""></option>
                                                @foreach ($angkatan as $ang)
                                                    <option value="{{ $ang->nama_tahun_ajaran }}"
                                                        @php
                                                        if($val->prodi != '' && $val->angkatan == ''){
                                                            if($val->angkatan && in_array($ang->nama_tahun_ajaran, $val->angkatan)){
                                                                echo 'selected';
                                                            }
                                                        }
                                                        if($val->jk != '' && $val->angkatan == ''){
                                                            if($val->angkatan && in_array($ang->nama_tahun_ajaran, $val->angkatan)){
                                                                echo 'selected';
                                                            }
                                                        }
                                                        elseif($val->angkatan == '' && $val->prodi == '' && $val->jk == '' ){
                                                            if($angkatan_aktif[0]['nama_tahun_ajaran'] && in_array($ang->nama_tahun_ajaran,$angkatan_aktif[0])){
                                                                echo 'selected';
                                                            }
                                                        }
                                                        if($val->angkatan != ''|| $val->prodi != '' || $val->jk != ''){
                                                            if($val->angkatan && in_array($ang->nama_tahun_ajaran, $val->angkatan)){
                                                                echo 'selected';
                                                            }
                                                        }
                                                        @endphp>
                                                        {{ $ang->nama_tahun_ajaran }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Pilih Jenis Kelamin</label>
                                            <select name="jk[]" id="jk"
                                                data-placeholder="Pilih Jenis Kelamin..."
                                                class="form-control chosen-select" multiple style="width:350px;"
                                                tabindex="4">
                                                <option value=""></option>
                                                @foreach ($jk as $j)
                                                    <option
                                                        value="@if ($j->jk == 'Perempuan') P @elseif ($j->jk == 'Laki-laki')L @endif"
                                                        @php
                                                        if($j->jk == 'Perempuan'){
                                                            if($val->jk && in_array(str_replace($j->jk,'Perempuan','P'), $val->jk)){
                                                                echo 'selected';
                                                            }
                                                        }
                                                        if($j->jk == 'Laki-laki'){
                                                            if($val->jk && in_array(str_replace($j->jk,'Laki-laki','L'), $val->jk)){
                                                                echo 'selected';
                                                            }
                                                        }
                                                        @endphp>
                                                        {{ $j->jk }}
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
                        <input type="text" class="form-control" name="keyword" placeholder="Search by Nama Dosen or NIDN"
                            value="{{ request()->get('keyword', '') }}"> <span class="input-group-btn">
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
                <p class="pull-right">Halaman ini menampilkan data berdasarakan semester :
                    @if($val->prodi != '' && $val->angkatan == '')
                        {{"-"}}
                    @elseif($val->jk != '' && $val->angkatan == '')
                        {{"-"}}
                    @elseif($val->angkatan == '' && $val->prodi == '' && $val->jk == '' )
                        <span class="badge badge-primary"><i class="fa fa-calendar" aria-hidden="true"></i>   {{ $angkatan_aktif[0]['nama_tahun_ajaran'] }}</span>
                    @elseif($val->angkatan != '' || $val->prodi != '' || $val->jk != '')
                        @foreach ($val->angkatan as $ang)
                            <span class="badge badge-primary"><i class="fa fa-calendar" aria-hidden="true"></i>   {{ $ang }}</span>
                        @endforeach
                    @endif
                </p>
            </div>
        </div>
        <div class="pt-2">
            <table class="table table-bordered table-hover table-responsive" id="table-mahasiswa">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">NIDN / NUP / NIDK</th>
                        <th class="text-center">Jenis Kelamin</th>
                        <th class="text-center">Tahun Ajaran</th>
                        <th class="text-center">Program Studi</th>
                        <th class="text-center">No. Surat Tugas</th>
                        <th class="text-center">Tanggal Surat Tugas</th>
                        <th class="text-center">Homebase?</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dosen as $d => $data)
                    <tr>
                        <td class="text-center">{{$dosen->firstItem() + $d}}</td>
                        <td><a href="{{route('admin-prodi.detail-daftar-penugasan-dosen', ['id' => $data->id_dosen,'tahun' => $data->id_tahun_ajaran,'prodi' => $data->id_prodi])}}" name="req">{{$data->nama_dosen}}</a> </td>
                        <td class="text-center">{{$data->nidn}}</td>
                        <td class="text-center">{{$data->jk}}</td>
                        <td class="text-center">{{$data->nama_tahun_ajaran}}</td>
                        <td class="text-center">{{$data->nama_program_studi}}</td>
                        <td class="text-center">{{$data->nomor_surat_tugas}}</td>
                        <td class="text-center">{{$data->tanggal_surat_tugas}}</td>
                        <td class="text-center">{{$data->a_sp_homebase}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- {{$dosen->getOptions()}} --}}
            {!! $dosen->withQueryString()->links() !!}
        </div>

        {{-- {{$dosen->onEachSide(5)->links()}} --}}
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

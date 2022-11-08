@extends('layouts.admin-prodi.layout')
@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Aktivitas Kuliah Mahasiswa</h5>
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
                                                <label>Pilih Angkatan</label>
                                                <select name="angkatan[]" id="angkatan" data-placeholder="Pilih Angkatan..."
                                                    class="form-control chosen-select" multiple style="width:350px;"
                                                    tabindex="4">
                                                    <option value=""></option>
                                                    @foreach ($angkatan as $ang)
                                                    <option value="{{ $ang->id_tahun_ajaran }}"
                                                        @php
                                                        // if($val->angkatan == ''){
                                                        //     if($angkatan_aktif[0]['id_tahun_ajaran'] && in_array($ang->id_tahun_ajaran,$angkatan_aktif[0])){
                                                        //         echo 'selected';
                                                        //     }
                                                        // }
                                                        if($val->angkatan != ''){
                                                            if($val->angkatan && in_array($ang->id_tahun_ajaran, $val->angkatan)){
                                                                echo 'selected';
                                                            }
                                                        }
                                                        @endphp>
                                                        {{ $ang->id_tahun_ajaran }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Pilih Status Mahasiswa</label>
                                                <select name="status_mahasiswa[]" id="status_mahasiswa"
                                                    data-placeholder="Pilih Status Mahasiswa ..." class="form-control chosen-select"
                                                    multiple style="width:350px;" tabindex="4">
                                                    <option value=""></option>
                                                    @foreach ($status_mahasiswa as $status)
                                                        <option value="{{ $status->nama_status_mahasiswa}}"
                                                            @php
                                                            if($val->status_mahasiswa != ''){
                                                                if($val->status_mahasiswa && in_array($status->nama_status_mahasiswa, $val->status_mahasiswa)){
                                                                    echo 'selected';
                                                                }
                                                            }
                                                            @endphp>
                                                            {{ $status->nama_status_mahasiswa }}
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
            </div><br>
            <div class="row">
                <div class="col-md-12">
                    <p class="pull-right">Halaman ini menampilkan data berdasarakan semester :
                        @if ($val['semester'] != '')
                            @foreach ($val['semester'] as $s)
                                <span class="badge badge-primary"><i class="fa fa-calendar" aria-hidden="true"></i>   {{ $s }}</span>
                            @endforeach
                        @elseif ($val['prodi'] != '' && $val['semester'] = '')
                            @foreach ($val['semester'] as $s)
                            
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
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Semester</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">Status</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">IPS</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">IPK</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">SKS Semester</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle">SKS Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($aktivitas_kuliah_mahasiswa as $no => $data)
                    <tr>
                        <td class="text-center">{{$aktivitas_kuliah_mahasiswa->firstItem() + $no}}</td>
                        <td  class="text-left"> <a href="{{route('admin-prodi.detail-aktivitas-kuliah-mahasiswa', ['id' => $data->id_mahasiswa, 'semester' => $data->id_semester])}}"
                            name="req"> {{$data->nim}}</a> </td>
                        <td class="text-center">{{$data->nama_mahasiswa}}</td>
                        <td class="text-center">{{$data->nama_program_studi}}</td>
                        <td class="text-center">{{$data->angkatan}}</td>
                        <td class="text-center">{{$data->nama_semester}}</td>
                        <td class="text-center">{{$data->nama_status_mahasiswa}}</td>
                        <td class="text-center">{{$data->ips}}</td>
                        <td class="text-center">{{$data->ipk}}</td>
                        <td class="text-center">{{$data->sks_semester}}</td>
                        <td class="text-center">{{$data->sks_total}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $aktivitas_kuliah_mahasiswa->withQueryString()->links() !!}
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

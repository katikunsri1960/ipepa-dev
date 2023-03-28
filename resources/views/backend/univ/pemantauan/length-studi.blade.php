@extends('layouts.admin-univ.layout')
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Pemantauan Length Studi</h5>
    </div>
    <div class="ibox-content p-md">
        <div class="row">
            <form action="{{route('admin-univ.length-studi')}}" method="get">
                <div class="col-lg-3">
                    <button class="btn btn-primary btn-block" type="button" data-toggle="modal"
                    data-target="#modal-filter"><i class="fa-solid fa-filter"></i><span
                        style="margin-left: 6px; margin-right: 6px">Filter</span>
                </button>
                </div>
                
                <div id="modal-filter" class="modal fade" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="input-group">
                                        <select name="start" id="min" class="input form-control" >
                                            <option value="">Pilih Angkatan Awal</option>
                                            @foreach ($angkatan as $item)
                                            <option value="{{ $item }}" @if (request()->has('start') && request('start') == $item) selected @endif>{{ $item }}</option>
                                            @endforeach
                                        </select>
                                        <span class="input-group-addon">to</span>
                                        <select name="end" id="max" class="input form-control" onchange="pushRequired()">
                                            <option value="">Pilih Angkatan Akhir</option>
                                            @foreach ($angkatan as $item)
                                            <option value="{{ $item }}" @if (request()->has('end') && request('end') == $item) selected @endif>{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group" style="margin-top:2rem">
                                        <label for="day">Variabel Tepat Waktu (Hari)</label>
                                        <input type="number" name="day" id="day" class="form-control" value="{{ $day }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="jenjang">Jenjang Studi</label>
                                        <select name="jenjang" id="jenjang" class="form-control">
                                            <option value=""> -- Pilih jenjang -- </option>
                                            @foreach ($jp as $j)
                                                <option value="{{$j->nama_jenjang_pendidikan}}" @if (request()->has('jenjang') && request('jenjang') != '' && request('jenjang') == $j->nama_jenjang_pendidikan) selected @endif>{{$j->nama_jenjang_pendidikan}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button class="btn btn-warning" type="submit">Apply Filter</button>
                                    <a href="{{route('admin-univ.length-studi')}}" class="btn btn-primary">Reset Filter</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row p-sm">
                <div class="col-lg-12">
                    <div class="widget yellow-bg no-padding text-vertical-midle">
                        <div class="p-md">
                            <h4>Halaman ini masih dalam tahap pengembangan!!</h4>
                            <div class="">
                                <h3>Variable yang dinyatakan tepat waktu adalah < {{$day}} Hari.</h3>
                                <p>Untuk mengganti variable, silahkan gunakan menu FILTER.</p>
                            </div>

                            @if (request()->has('start') && request()->has('end') && request('start') != '' && request('end') != '')
                            <div class="">
                                Filter Angkatan : <h2>{{ request('start') }} sampai {{ request('end') }}</h2>
                            </div>
                            @endif

                            <div class="">
                                <h2>Jenjang Pendidikan: {{$jenjang}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div
            <br>
            <div class="col-12 p-sm">
                <canvas id="chart-lulusan"></canvas>
            </div>
        </div>
        <div class="row p-md" style="margin-top: 5rem">
            <table class="table table-bordered table-hover" id="info">
                <thead>
                    <tr>
                        <th class="text-center align-middle">Angkatan</th>
                        <th class="text-center align-middle">Tepat Waktu</th>
                        <th class="text-center align-middle">Tidak Tepat Waktu</th>
                        <th class="text-center align-middle">Data Salah</th>
                        <th class="text-center align-middle">Total Lulus</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $i => $v)
                    <tr>
                        <th class="text-center align-middle">{{ $i }}</th>
                        <td class="text-center align-middle">{{ $v['tepat_waktu'] }}</td>
                        <td class="text-center align-middle">{{ $v['tidak_tepat_waktu'] }}</td>
                        <td class="text-center align-middle">{{ $v['data_salah'] }}</td>
                        <td class="text-center align-middle">{{ $v['tepat_waktu'] + $v['tidak_tepat_waktu'] + $v['data_salah'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@push('css')
<link href="{{ asset('assets/css/plugins/chosen/bootstrap-chosen.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

    function pushRequired() {
        const min = document.getElementById('min').value;
        const max = document.getElementById('max').value;
        if (min | max) {
            document.getElementById('min').required = true;
            document.getElementById('max').required = true;
        } else {
            document.getElementById('day').required = false;
        }
    }
  

    $(document).ready(function () {

        $('#info').DataTable({
            "scrollX": false,
            "scrollY": "300px",
            "scrollCollapse": true,
            "paging": false,
            "searching": true,
            "info": false,
            "ordering": true,
            "columnDefs": [
                { "width": "10%", "targets": 0 }
            ],
            "fixedColumns": true
        });

        const data = {!! $mahasiswa !!};
        const ctx = document.getElementById('chart-lulusan').getContext('2d');

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: Object.keys(data),  // mengambil tahun sebagai label sumbu x
                datasets: [
                    {
                        label: 'Tidak Tepat Waktu',
                        data: Object.values(data).map(year => year.tidak_tepat_waktu),
                        backgroundColor: 'rgba(255,0,0,0.5)',
                        // borderColor: 'rgba(80, 150, 70, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Tepat Waktu',
                        data: Object.values(data).map(year => year.tepat_waktu),
                        backgroundColor: 'rgba(0,255,0,0.5)',
                        // borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Data Salah',
                        data: Object.values(data).map(year => year.data_salah),
                        backgroundColor: 'rgba(0,0,0,0.5)',
                        borderWidth: 1
                    },
                    
                ]},
            options: {
                responsive: true,
                interaction: {
                    intersect: false,
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        stacked: true

                    },
                    x: {
                        stacked: true
                    }

                }
            }
        });


    });



</script>

@endpush

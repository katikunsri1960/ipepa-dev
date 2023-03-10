
@extends('layouts.admin-prodi.layout')
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Dashboard Pemantauan Lulusan</h5>
    </div>
    <div class="ibox-content p-md">
        <div class="row">
            <form action="{{route('admin-prodi.pemantauan-lulusan')}}" method="get">
                <label class="control-label col-lg-3">Filter by Angkatan</label>
                <div class="col-lg-6">
                    <div class="input-group">
                        <select name="start" id="min" class="input form-control" required>
                            <option value="">Pilih Angkatan Awal</option>
                            @foreach ($angkatan as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                        <span class="input-group-addon">to</span>
                        <select name="end" id="max" class="input form-control" required>
                            <option value="">Pilih Angkatan Akhir</option>
                            @foreach ($angkatan as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-primary"> Apply!</button>
                        </span>
                    </div>

                </div>
            </form>
            <br>
            <div class="col-12" style="margin-top: 50px">
                <canvas id="keberhasilanLulus"></canvas>
            </div>
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
    const ctx = document.getElementById('keberhasilanLulus');

        const data = {!! $mahasiswaPerStatus !!};

        for (let year in data) {
            for (let key in data[year]) {
                if (key === 'Putus Studi' || key === 'Mengundurkan diri') {
                    data[year][key.replace(" ", "")] = data[year][key];
                    delete data[year][key];
                }
            }
        }

        var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: Object.keys(data),  // mengambil tahun sebagai label sumbu x
            datasets: [
                {
                    label: 'AKTIF',
                    data: Object.values(data).map(year => year.AKTIF),
                    backgroundColor: 'rgba(255,0,0,0.5)',
                    // borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Lulus',
                    data: Object.values(data).map(year => year.Lulus),
                    backgroundColor: 'rgba(0,255,0,0.5)',
                    // borderColor: 'rgba(80, 150, 70, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Dikeluarkan',
                    data: Object.values(data).map(year => year.Dikeluarkan),
                    backgroundColor: 'rgba(0,0,255,0.5)',
                    // borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Mengundurkan Diri',
                    data: Object.values(data).map(year => year.Mengundurkandiri),
                    backgroundColor: 'rgba(255,255,0,0.5)',
                    // borderColor: 'rgba(90, 110, 200, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Wafat',
                    data: Object.values(data).map(year => year.Wafat),
                    backgroundColor: 'rgba(255,0,255,0.5)',
                    // borderColor: 'rgba(1, 20, 30, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Mutasi',
                    data: Object.values(data).map(year => year.Mutasi),
                    backgroundColor: 'rgba(0,255,255,0.5)',
                    // borderColor: 'rgba(54, 70, 100, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Putus Studi',
                    data: Object.values(data).map(year => year.PutusStudi),
                    backgroundColor: 'rgba(255,127,0,0.5)',
                    // borderColor: 'rgba(100, 70, 243, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Hilang',
                    data: Object.values(data).map(year => year.Hilang),
                    backgroundColor: 'rgba(127,0,255,0.5)',
                    // borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Lainnya',
                    data: Object.values(data).map(year => year.Lainnya),
                    backgroundColor: 'rgba(0, 0, 0, 1)',
                    // borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }
            ]},
        options: {
            responsive: true,
            interaction: {
                intersect: false,
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    stacked: true

                },
                x: {
                    stacked: true
                }

            }
        }
    });

</script>
@endpush

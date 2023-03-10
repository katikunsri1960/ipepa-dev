@extends('layouts.admin-univ.layout')
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Dashboard Pemantauan Lulusan</h5>
    </div>
    <div class="ibox-content p-md">
        <div class="row">
            <br>
            <div class="col-12" style="margin-top: 0px">
                <canvas id="chart-lulusan"></canvas>
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
    $(document).ready(function () {

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

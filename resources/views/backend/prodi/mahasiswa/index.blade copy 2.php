@extends('layouts.admin-prodi.layout')
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-content p-md">
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
                    @foreach($mahasiswa as $m => $data)
                    <tr>
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td><a href="{{route('admin-prodi.detail-mahasiswa', ['id' => $data->id_mahasiswa])}}">{{$data->nama_mahasiswa}}</a> </td>
                        <td class="text-center">{{$data->nim}}</td>
                        <td class="text-center">{{$data->jenis_kelamin}}</td>
                        <td class="text-center">{{$data->nama_agama}}</td>
                        <td class="text-center">{{$data->total_sks}}</td>
                        <td class="text-center">{{$data->tanggal_lahir}}</td>
                        <td class="text-center">{{$data->nama_program_studi}}</td>
                        <td class="text-center">{{$data->nama_status_mahasiswa}}</td>
                        <td class="text-center">
                            @if(strlen($data->id_periode) > 4)
                            {{substr($data->id_periode, 0, 4)}}
                            @else
                            {{$data->id_periode}}
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        $('#table-mahasiswa').DataTable({
            "lengthMenu": [ [10, 25, 50, 100], [10, 25, 50, 100] ],
            "pageLength": 10,
            "order": [
                [0, "asc"]
            ]
        });
    });
</script>
@endpush

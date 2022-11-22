@extends('layouts.admin-prodi.layout')
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5> Aktivitas Perkuliahan Mahasiswa</h5>

        <div class="ibox-content p-md">
            <div class="row">
                <div class="col-lg-12">
                    <div class="widget blue-bg no-padding text-vertical-midle">
                        <div class="p-md">
                            <h4>Digunakan untuk mengelola status keaktifan ( Aktif, Cuti, Non Aktif dll) mahasiswa per periode</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ibox-content">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Mahasiswa <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ $detail[0]->nim}} - {{ $detail[0]->nama_mahasiswa}}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Semester  <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ $detail[0]->nama_semester}}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Status Mahasiswa <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ $detail[0]->nama_status_mahasiswa}}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>IPS (Indeks Prestasi Semester)</label>
                    <input type="name" class="form-control" disabled value="{{ $detail[0]->ips}}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>IPK (Indeks Prestasi Komulatif)</label>
                    <input type="name" class="form-control" disabled value="{{ $detail[0]->ipk}}">
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="form-group">
                    <label>Jumlah SKS Semester</label>
                    <input type="name" class="form-control" disabled value="{{ $detail[0]->sks_semester}}">
                </div>
            </div>
            <div class="col-lg-2">
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-filter"><i class="fa-solid fa-file-lines"></i> <span style="margin-left: 1px; margin-right: 1px">  Tampilkan KRS</span>
                </button>
                <div id="modal-filter" class="modal fade" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">KRS Mahasiswa</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <table class="table table-bordered m-4" id="krsMahasiswa" style="margin-top: 10pt">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Semester</th>
                                                <th class="text-center">Nama MK</th>
                                                <th class="text-center">Nama Mata Kuliah</th>
                                                <th class="text-center">Bobot (sks)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($krs as $data)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $data->semester}}</td>
                                                <td class="text-center">{{ $data->kode_mata_kuliah }}</td>
                                                <td class="text-left">{{ $data->nama_mata_kuliah }}</td>
                                                <td class="text-center">{{ $data->sks_mata_kuliah }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="4" class="text-right"><strong>TOTAL SKS</strong></td>
                                                <td colspan="4" class="text-center"><strong>{{ $sks[0]->jumlah_sks }}</strong></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br>

            <div class="col-lg-6">
                <div class="form-group">
                    <label>Jumlah SKS Total</label>
                    <input type="name" class="form-control" disabled value="{{ $detail[0]->sks_total}}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Biaya Kuliah (semester) <span style="color: red">*</span></label>
                    <input type="name" class="form-control" disabled value="{{ $detail[0]->biaya_kuliah_smt}}">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

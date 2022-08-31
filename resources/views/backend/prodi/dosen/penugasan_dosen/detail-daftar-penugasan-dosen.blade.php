@extends('layouts.admin-prodi.layout')
@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Detail Penugasan Dosen</h5>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="widget yellow-bg no-padding">
                        <div class="p-m">
                            <h3 class="font-bold no-margins">
                                Catatan :
                            </h3>
                            <h5>Mencatat penugasan dosen setiap tahunnya, Data penugasan hanya dapat di ubah pada laman <a style="text-color: white;" href="http://pddikti.kemendikbud.go.id">http://pddikti.kemendikbud.go.id</a></h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table">
                        <tr>
                            <td>Tahun Ajaran</td>
                            <td> : </td>
                            <td>{{ $dosen->nama_tahun_ajaran }}</td>
                        </tr>
                        <tr>
                            <td>Perguruan Tinggi</td>
                            <td> : </td>
                            <td>{{ $dosen->nama_perguruan_tinggi }}</td>
                        </tr>
                        <tr>
                            <td>Dosen</td>
                            <td> : </td>
                            <td>{{ $dosen->nama_dosen }}</td>
                        </tr>
                        <tr>
                            <td>Program Studi</td>
                            <td> : </td>
                            <td>{{ $dosen->nama_program_studi }}</td>
                        </tr>
                        <tr>
                            <td>No. Surat Tugas</td>
                            <td> : </td>
                            <td>{{ $dosen->nomor_surat_tugas }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Surat Tugas</td>
                            <td> : </td>
                            <td>{{ $dosen->tanggal_surat_tugas }}</td>
                        </tr>
                        <tr>
                            <td>TMT Surat Tugas</td>
                            <td> : </td>
                            <td>{{ $dosen->mulai_surat_tugas }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="widget navy-bg p-lg">
                <div class="m-b-md">
                    <h3 class="font-bold no-margins">
                        Keterangan :
                    </h3>
                    <h5>- Fitur ini di gunakan untuk mencatat penugasan dosen di setiap tahun nya</h5>
                </div>
            </div>
        </div>
    </div>
@endsection

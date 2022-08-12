@extends('layouts.admin-univ.layout_profilpt')
@section('content')
            <div class="wrapper wrapper-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="widget lazur-bg p-xl">
                                <h2>Profil Perguruan Tinggi</h2><br>
                                <h2><strong>{{$profil_pt[0]['nama_perguruan_tinggi']}}</strong></h2><br>
                                <table class="table">
                                    <tr>
                                        <td class="col-md-2"><span><h3><i class="fa fa-id-card"></i> Kode PT</h3></span><td>
                                        <td><h3> : </h3></td>
                                        <td class="col-md-10"><h3>{{$profil_pt[0]['kode_perguruan_tinggi']}}</h3></td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-2"><span><h3><i class="fa fa-user"></i> Nama PT</h3></span><td>
                                        <td><h3> : </h3></td>
                                        <td class="col-md-10"><h3>{{$profil_pt[0]['nama_perguruan_tinggi']}}</h3></td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-2"><span><h3><i class="fa fa-phone"></i> Telephone</h3></span><td>
                                        <td><h3> : </h3></td>
                                        <td class="col-md-10"><h3>{{$profil_pt[0]['telepon']}}</h3></td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-2"><span><h3><i class="fa fa-fax"></i> Faximile</h3></span><td>
                                        <td><h3> : </h3></td>
                                        <td class="col-md-10"><h3>{{$profil_pt[0]['faximile']}}</h3></td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-2"><span><h3><i class="fa fa-envelope"></i> Email</h3></span><td>
                                        <td><h3> : </h3></td>
                                        <td class="col-md-10"><h3>{{$profil_pt[0]['email']}}</h3></td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-2"><span><h3><i class="fa fa-link"></i> Website</h3></span><td>
                                        <td><h3> : </h3></td>
                                        <td class="col-md-10"><h3>{{$profil_pt[0]['website']}}</h3></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox">
                                <div class="ibox-content">
                                    <div class="row">
                                    <div class="tabs-container">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a data-toggle="tab" href="#tab-1"> Alamat</a></li>
                                            <li class=""><a data-toggle="tab" href="#tab-2">Informasi PT</a></li>
                                            <li class=""><a data-toggle="tab" href="#tab-3">Akta Pendirian</a></li>
                                            <li class=""><a data-toggle="tab" href="#tab-4">Program Studi</a></li>
                                            <li class=""><a data-toggle="tab" href="#tab-5">Perubahan Perguruan Tinggi</a></li>
                                            <li class=""><a data-toggle="tab" href="#tab-6">Perubahan Program Studi</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div id="tab-1" class="tab-pane active">
                                                <div class="panel-body">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td class="col-md-2">Jalan</td>
                                                                <td> : </td>
                                                                <td class="col-md-10">{{$profil_pt[0]['jalan']}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="col-md-2">Dusun</td>
                                                                <td> : </td>
                                                                <td class="col-md-10">{{$profil_pt[0]['dusun']}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="col-md-2">Kelurahan</td>
                                                                <td> : </td>
                                                                <td class="col-md-10">{{$profil_pt[0]['kelurahan']}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="col-md-2">Kecamatan</td>
                                                                <td> : </td>
                                                                <td class="col-md-10">{{$profil_pt[0]['nama_wilayah']}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="col-md-2">Lintang Bujur</td>
                                                                <td> : </td>
                                                                <td class="col-md-10">{{$profil_pt[0]['lintang_bujur']}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="col-md-2">RT / RW</td>
                                                                <td> : </td>
                                                                <td class="col-md-10">{{$profil_pt[0]['rt_rw']}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="col-md-2">Kode Pos</td>
                                                                <td> : </td>
                                                                <td class="col-md-10">{{$profil_pt[0]['kode_pos']}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div id="tab-2" class="tab-pane">
                                                <div class="panel-body">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td class="col-md-2">Bank</td>
                                                                <td> : </td>
                                                                <td class="col-md-10">{{$profil_pt[0]['bank']}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="col-md-2">Unit Cabang</td>
                                                                <td> : </td>
                                                                <td class="col-md-10">{{$profil_pt[0]['unit_cabang']}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="col-md-2">Nomor Rekening</td>
                                                                <td> : </td>
                                                                <td class="col-md-10">{{$profil_pt[0]['nomor_rekening']}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="col-md-2">MBS</td>
                                                                <td> : </td>
                                                                <td class="col-md-10">{{$profil_pt[0]['mbs']}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="col-md-2">Luas Tanah Milik</td>
                                                                <td> : </td>
                                                                <td class="col-md-10">{{$profil_pt[0]['luas_tanah_milik']}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="col-md-2">Luas Tanah Bukan Milik</td>
                                                                <td> : </td>
                                                                <td class="col-md-10">{{$profil_pt[0]['luas_tanah_bukan_milik']}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div id="tab-3" class="tab-pane">
                                                <div class="panel-body">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td class="col-md-2">No SK Pendirian</td>
                                                                <td> : </td>
                                                                <td class="col-md-10">{{$profil_pt[0]['sk_pendirian']}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="col-md-2">Tanggal SK Pendirian</td>
                                                                <td> : </td>
                                                                <td class="col-md-10">{{$profil_pt[0]['tanggal_sk_pendirian']}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="col-md-2">Status Kepemilikan</td>
                                                                <td> : </td>
                                                                <td class="col-md-10">{{$profil_pt[0]['nama_status_milik']}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="col-md-2">Status Perguruan Tinggi</td>
                                                                <td> : </td>
                                                                <td class="col-md-10">{{$profil_pt[0]['status_perguruan_tinggi']}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="col-md-2">SK Izin Operasional</td>
                                                                <td> : </td>
                                                                <td class="col-md-10">{{$profil_pt[0]['sk_izin_operasional']}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="col-md-2">Tanggal Izin Operasional</td>
                                                                <td> : </td>
                                                                <td class="col-md-10">{{$profil_pt[0]['tanggal_izin_operasional']}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div id="tab-4" class="tab-pane">
                                                <div class="panel-body">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <td>No</td>
                                                                <td>Kode Prodi</td>
                                                                <td>Nama Program Studi</td>
                                                                <td>Status</td>
                                                                <td>Jenjang</td>
                                                                <td>Jumlah Mahasiswa</td>
                                                                <td>Jumlah Dosen</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php $no = 1; @endphp
                                                            @foreach ($data_prodi as $prodi)
                                                            <tr>
                                                                <td>{{$no++}}</td>
                                                                <td>{{$prodi->kode_program_studi}}</td>
                                                                <td>{{$prodi->nama_program_studi}}</td>
                                                                <td>{{$prodi->status}}</td>
                                                                <td>{{$prodi->nama_jenjang_pendidikan}}</td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div id="tab-5" class="tab-pane">
                                                <div class="panel-body">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <td>Lembaga Lama</td>
                                                                <td>Singkatan Lama</td>
                                                                <td>Wilayah Lama</td>
                                                                <td>Lintang Lama</td>
                                                                <td>Lembaga Baru</td>
                                                                <td>Singkatan Baru</td>
                                                                <td>Wilayah Baru</td>
                                                                <td>Lintang Baru</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="text-center" colspan="8">Data Tidak Tersedia</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div id="tab-6" class="tab-pane">
                                                <div class="panel-body">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <td>Prodi Lama</td>
                                                                <td>Singkatan Lama</td>
                                                                <td>Wilayah Lama</td>
                                                                <td>Lintang Lama</td>
                                                                <td>Prodi Baru</td>
                                                                <td>Singkatan Baru</td>
                                                                <td>Wilayah Baru</td>
                                                                <td>Lintang Baru</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="text-center" colspan="8">Data Tidak Tersedia</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection

<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a href="{{route('admin-univ.dashboard-admin-univ')}}"><i class="fa fa-user"></i> | <span
                            class="nav-label"><strong class="font-bold">{{auth()->user()->name}}</strong></span></a>
                </div>
                <div class="logo-element">
                    <a href="{{route('admin-univ.dashboard-admin-univ')}}">UNSRI</a>
                </div>
            </li>
            <li class="{{request()->routeIs('admin-univ.dashboard-admin-univ') ? 'active' : ''}}">
                <a href="{{route('admin-univ.dashboard-admin-univ')}}"><i class="fa fa-th-large"></i> <span
                        class="nav-label">Dashboards</span></a>
            </li>
            <li class="{{request()->routeIs('admin-univ.daya-tampung-peminat') ? 'active' : ''}}">
                <a href="{{route('admin-univ.daya-tampung-peminat')}}"><i class="fa fa-chart-pie"></i> <span
                        class="nav-label">Daya Tampung & Peminat</span></a>
            </li>
            <li
                class="{{request()->routeIs('admin-univ.pemantauan-lulusan') || request()->routeIs('admin-univ.length-studi') ? 'active' : ''}}">
                <a href="#"><i class="fa fa-line-chart"></i> <span class="nav-label">Monev</span><span
                        class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{request()->routeIs('admin-univ.pemantauan-lulusan') ? 'active' : ''}}">
                        <a href="{{route('admin-univ.pemantauan-lulusan')}}">Lulusan</a>
                    </li>
                    <li class="{{request()->routeIs('admin-univ.length-studi')  ? 'active' : ''}}">
                        <a href="{{route('admin-univ.length-studi')}}">Length Studi</a>
                    </li>
                </ul>
            </li>
            <li class="{{request()->routeIs('admin-univ.dosen')
                || request()->routeIs('admin-univ.mahasiswa-asing')
                || request()->routeIs('admin-univ.capaian-pembelajaran')
                || request()->routeIs('admin-univ.regular-transfer')
                || request()->routeIs('admin-univ.kohort-lulusan') ? 'active' : ''}}">
                <a href="#"><i class="fa fa-poll"></i> <span class="nav-label">IPEPA Tahap 1</span><span
                        class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{request()->routeIs('admin-univ.dosen') ? 'active' : ''}}">
                        <a href="{{route('admin-univ.dosen')}}"><i class="fa fa-user-graduate"></i> Dosen</a>
                    </li>
                    <li class="{{request()->routeIs('admin-univ.regular-transfer') ? 'active' : ''}}">
                        <a href="{{route('admin-univ.regular-transfer')}}"><i class="fa fa-graduation-cap"></i> Regular
                            & Transfer</a>
                    </li>
                    <li class="{{request()->routeIs('admin-univ.mahasiswa-asing') ? 'active' : ''}}">
                        <a href="{{route('admin-univ.mahasiswa-asing')}}"><i class="fa fa-flag"></i> Mahasiswa
                            Asing</a>
                    </li>
                    <li class="{{request()->routeIs('admin-univ.capaian-pembelajaran') ? 'active' : ''}}">
                        <a href="{{route('admin-univ.capaian-pembelajaran')}}"><i class="fa fa-marker"></i> IPK
                            Lulusan</a>
                    </li>
                    <li class="{{request()->routeIs('admin-univ.kohort-lulusan') ? 'active' : ''}}">
                        <a href="{{route('admin-univ.kohort-lulusan')}}"><i class="fa fa-line-chart"></i> Kohort
                            Lulusan</a>
                    </li>
                </ul>
            </li>
            <li class="{{request()->routeIs('admin-univ.prestasi-ipepa') ? 'active' : ''}}">
                <a href="#"><i class="fa fa-poll"></i> <span class="nav-label">IPEPA Tahap 2</span><span
                        class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li class="{{request()->routeIs('admin-univ.prestasi-ipepa') ? 'active' : ''}}">
                                <a href="{{route('admin-univ.prestasi-ipepa')}}"><i class="fa fa-user-graduate"></i> Prestasi Mahasiswa</a>
                            </li>
                        </ul>

            </li>
            <li class="{{request()->routeIs('admin-univ.profil-pt') ? 'active' : ''}}">
                <a href="{{route('admin-univ.profil-pt')}}"><i class="fa fa-user-circle"></i> <span
                        class="nav-label">Profil</span></a>
            </li>
            <li
                class="{{request()->routeIs('admin-univ.daftar-mahasiswa') || request()->routeIs('admin-univ.detail-mahasiswa') || request()->routeIs('admin-univ.histori-pendidikan') || request()->routeIs('admin-univ.krs-mahasiswa') || request()->routeIs('admin-univ.histori-nilai') || request()->routeIs('admin-univ.aktivitas-perkuliahan') || request()->routeIs('admin-univ.prestasi-mahasiswa') || request()->routeIs('admin-univ.detail-transkrip-mahasiswa') ? 'active' : ''}}">
                <a href=""><i class="fa fa-graduation-cap"></i> <span class="nav-label">Mahasiswa</span><span
                        class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li
                        class="{{request()->routeIs('admin-univ.daftar-mahasiswa') || request()->routeIs('admin-univ.detail-mahasiswa') || request()->routeIs('admin-univ.histori-pendidikan') || request()->routeIs('admin-univ.krs-mahasiswa') || request()->routeIs('admin-univ.histori-nilai') || request()->routeIs('admin-univ.aktivitas-perkuliahan') || request()->routeIs('admin-univ.prestasi-mahasiswa') || request()->routeIs('admin-univ.detail-transkrip-mahasiswa') ? 'active' : ''}}">
                        <a href="{{route('admin-univ.daftar-mahasiswa')}}">Daftar Mahasiswa</a>
                    </li>
                </ul>
            </li>
            <li
                class="{{request()->routeIs('admin-univ.daftar-dosen') || request()->routeIs('admin-univ.detail-dosen') || request()->routeIs('admin-univ.penugasan-dosen') || request()->routeIs('admin-univ.aktivitas-mengajar-dosen') || request()->routeIs('admin-univ.riwayat-fungsional-dosen') || request()->routeIs('admin-univ.riwayat-pendidikan-dosen') || request()->routeIs('admin-univ.riwayat-sertifikasi-dosen') || request()->routeIs('admin-univ.riwayat-penelitian-dosen') || request()->routeIs('admin-univ.riwayat-kepangkatan-dosen') || request()->routeIs('admin-univ.daftar-penugasan-dosen') || request()->routeIs('admin-univ.detail-daftar-penugasan-dosen') || request()->routeIs('admin-univ.pembimbing-aktivitas-mahasiswa') || request()->routeIs('admin-univ.penguji-aktivitas-mahasiswa') ? 'active' : ''}}">
                <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Dosen</span><span
                        class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li
                        class="{{request()->routeIs('admin-univ.daftar-dosen') || request()->routeIs('admin-univ.detail-dosen') || request()->routeIs('admin-univ.penugasan-dosen') || request()->routeIs('admin-univ.aktivitas-mengajar-dosen') || request()->routeIs('admin-univ.riwayat-fungsional-dosen') || request()->routeIs('admin-univ.riwayat-pendidikan-dosen') || request()->routeIs('admin-univ.riwayat-sertifikasi-dosen') || request()->routeIs('admin-univ.riwayat-penelitian-dosen') || request()->routeIs('admin-univ.riwayat-kepangkatan-dosen') || request()->routeIs('admin-univ.pembimbing-aktivitas-mahasiswa') || request()->routeIs('admin-univ.penguji-aktivitas-mahasiswa') ? 'active' : ''}}">
                        <a href="{{route('admin-univ.daftar-dosen')}}">Dosen</a>
                    </li>
                    <li
                        class="{{request()->routeIs('admin-univ.daftar-penugasan-dosen') || request()->routeIs('admin-univ.detail-daftar-penugasan-dosen')  ? 'active' : ''}}">
                        <a href="{{route('admin-univ.daftar-penugasan-dosen')}}">Penugasan Dosen</a>
                    </li>
                </ul>
            </li>

            <li
                class="{{request()->routeIs('admin-univ.perkuliahan') || request()->routeIs('admin-univ.daftar-mata-kuliah') || request()->routeIs('admin-univ.kampus-merdeka') || request()->routeIs('admin-univ.detail-kampus-merdeka') || request()->routeIs('admin-univ.detail-mata-kuliah') || request()->routeIs('admin-univ.substansi-kuliah') || request()->routeIs('admin-univ.detail-substansi-kuliah') || request()->routeIs('admin-univ.kurikulum') || request()->routeIs('admin-univ.kelas-perkuliahan') || request()->routeIs('admin-univ.detail-kelas-perkuliahan') || request()->routeIs('admin-univ.nilai-perkuliahan') || request()->routeIs('admin-univ.detail-nilai-perkuliahan') || request()->routeIs('admin-univ.aktivitas-kuliah-mahasiswa') || request()->routeIs('admin-univ.detail-aktivitas-kuliah-mahasiswa') || request()->routeIs('admin-univ.aktivitas-mahasiswa')|| request()->routeIs('admin-univ.detail-aktivitas-mahasiswa')  || request()->routeIs('admin-univ.kampus-merdeka') || request()->routeIs('admin-univ.kampus-merdeka') || request()->routeIs('admin-univ.mahasiswa-lulus-do') || request()->routeIs('admin-univ.transkrip-mahasiswa') || request()->routeIs('admin-univ.detail-mahasiswa-lulus-do') || request()->routeIs('admin-univ.detail-kurikulum') || request()->routeIs('admin-univ.cek-transkrip-mahasiswa') ? 'active' : ''}}">
                <a href="#"><i class="fa fa-book"></i> <span class="nav-label">Perkuliahan</span><span
                        class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li
                        class="{{request()->routeIs('admin-univ.daftar-mata-kuliah') || request()->routeIs('admin-univ.detail-mata-kuliah') ? 'active' : ''}}">
                        <a href="{{route('admin-univ.daftar-mata-kuliah')}}">Mata Kuliah</a>
                    </li>
                    <li
                        class="{{request()->routeIs('admin-univ.substansi-kuliah') ||request()->routeIs('admin-univ.detail-substansi-kuliah') ? 'active' : ''}}">
                        <a href="{{route('admin-univ.substansi-kuliah')}}">Substansi Kuliah</a>
                    </li>
                    <li
                        class="{{request()->routeIs('admin-univ.kurikulum') || request()->routeIs('admin-univ.detail-kurikulum') ? 'active' : ''}}">
                        <a href="{{route('admin-univ.kurikulum')}}">Kurikulum</a>
                    </li>
                    <li
                        class="{{request()->routeIs('admin-univ.kelas-perkuliahan') || request()->routeIs('admin-univ.detail-kelas-perkuliahan') ? 'active' : ''}}">
                        <a href="{{route('admin-univ.kelas-perkuliahan')}}">Kelas Perkuliahan</a>
                    </li>
                    <li
                        class="{{request()->routeIs('admin-univ.nilai-perkuliahan') || request()->routeIs('admin-univ.detail-nilai-perkuliahan') ? 'active' : ''}}">
                        <a href="{{route('admin-univ.nilai-perkuliahan')}}">Nilai Perkuliahan</a>
                    </li>
                    <li
                        class="{{request()->routeIs('admin-univ.aktivitas-kuliah-mahasiswa') || request()->routeIs('admin-univ.detail-aktivitas-kuliah-mahasiswa') ? 'active' : ''}}">
                        <a href="{{route('admin-univ.aktivitas-kuliah-mahasiswa')}}">Aktivitas Kuliah Mahasiswa</a>
                    </li>
                    <li
                        class="{{request()->routeIs('admin-univ.aktivitas-mahasiswa') || request()->routeIs('admin-univ.detail-aktivitas-mahasiswa') ? 'active' : ''}}">
                        <a href="{{route('admin-univ.aktivitas-mahasiswa')}}">Aktivitas Mahasiswa</a>
                    </li>
                    <li
                        class="{{request()->routeIs('admin-univ.kampus-merdeka') || request()->routeIs('admin-univ.detail-kampus-merdeka') ? 'active' : ''}}">
                        <a href="{{route('admin-univ.kampus-merdeka')}}">Konversi Kampus Merdeka</a>
                    </li>
                    <li
                        class="{{request()->routeIs('admin-univ.mahasiswa-lulus-do') || request()->routeIs('admin-univ.detail-mahasiswa-lulus-do') ? 'active' : ''}}">
                        <a href="{{route('admin-univ.mahasiswa-lulus-do')}}">Daftar Mahasiswa Lulus / Drop Out</a>
                    </li>
                    {{-- <li class="{{request()->routeIs('admin-univ.cek-transkrip-mahasiswa') ? 'active' : ''}}">
                        <a href="{{route('admin-univ.cek-transkrip-mahasiswa')}}"><i
                                class="fa-solid fa-chalkboard-user"></i> <span>Cek Transkrip Mahasiswa</span></a>
                    </li> --}}
                </ul>
            </li>
            <li
                class="{{request()->routeIs('admin-univ.pelengkap') || request()->routeIs('admin-univ.skala-nilai') || request()->routeIs('admin-univ.periode-perkuliahan') || request()->routeIs('admin-univ.detail-skala-nilai') || request()->routeIs('admin-univ.detail-periode-perkuliahan') ? 'active' : ''}}">
                <a href="#"><i class="fa fa-briefcase"></i> <span class="nav-label">Pelengkap</span><span
                        class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li
                        class="{{request()->routeIs('admin-univ.skala-nilai') || request()->routeIs('admin-univ.detail-skala-nilai') ? 'active' : ''}}">
                        <a href="{{route('admin-univ.skala-nilai')}}">Skala Nilai</a>
                    </li>
                    <li
                        class="{{request()->routeIs('admin-univ.periode-perkuliahan') || request()->routeIs('admin-univ.detail-periode-perkuliahan') ? 'active' : ''}}">
                        <a href="{{route('admin-univ.periode-perkuliahan')}}">Pengaturan Periode Perkuliahan</a>
                    </li>
                </ul>
            </li>
            <li class="{{request()->routeIs('admin-univ.export-data') ? 'active' : ''}}">
                <a href="{{route('admin-univ.export-data')}}"><i class="fa fa-file-excel"></i> <span
                        class="nav-label">Export Data</span></a>
            </li>

            <li
                class="{{request()->routeIs('admin-univ.check-transkrip-simak') || request()->routeIs('admin-univ.check-nilai-simak') ? 'active' : ''}}">
                <a href="#"><i class="fa fa-briefcase"></i> <span class="nav-label">SIMAK Unsri</span><span
                        class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{request()->routeIs('admin-univ.check-transkrip-simak') ? 'active' : ''}}">
                        <a href="{{route('admin-univ.check-transkrip-simak')}}"><i class="fa-solid fa-table-cells"></i>
                            <span class="nav-label">SIMAK Transkrip</span></a>
                    </li>
                    <li class="{{request()->routeIs('admin-univ.check-nilai-simak') ? 'active' : ''}}">
                        <a href="{{route('admin-univ.check-nilai-simak')}}"><i class="fa-solid fa-table-cells"></i>
                            <span class="nav-label">SIMAK Nilai</span></a>
                    </li>
                </ul>
        </ul>
    </div>
</nav>

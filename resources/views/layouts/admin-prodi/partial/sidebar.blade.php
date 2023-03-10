<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a href="{{route('admin-prodi.dashboard-admin-prodi')}}"><i class="fa fa-user"></i> | <span class="nav-label"><strong class="font-bold">{{auth()->user()->name}}</strong></span></a>
                </div>
                <div class="logo-element">
                    <a href="{{route('admin-prodi.dashboard-admin-prodi')}}">{{auth()->user()->name}}</a>
                </div>
            </li>
            <li class="{{request()->routeIs('admin-prodi.dashboard-admin-prodi') ? 'active' : ''}}">
                <a href="{{route('admin-prodi.dashboard-admin-prodi')}}"><i class="fa-solid fa-table-cells"></i> <span class="nav-label">Dashboards</span></a>
            </li>
            <li  class="{{request()->routeIs('admin-prodi.pemantauan-lulusan') || request()->routeIs('admin-prodi.length-studi') ? 'active' : ''}}">
                <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Monev</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{request()->routeIs('admin-prodi.pemantauan-lulusan') ? 'active' : ''}}">
                        <a href="{{route('admin-prodi.pemantauan-lulusan')}}">Lulusan</a>
                    </li>
                    <li class="{{request()->routeIs('admin-prodi.length-studi')  ? 'active' : ''}}">
                        <a href="{{route('admin-prodi.length-studi')}}">Length Studi</a>
                    </li>
                </ul>
            </li>
            {{-- <li class="{{request()->routeIs('admin-prodi.pemantauan-lulusan') ? 'active' : ''}}">
                <a href="{{route('admin-prodi.pemantauan-lulusan')}}"><i class="fa-solid fa-table-cells"></i> <span class="nav-label">Pemantauan Lulusan</span></a> --}}
            <li class="{{request()->routeIs('admin-prodi.profil-pt') ? 'active' : ''}}">
                <a href="{{route('admin-prodi.profil-pt')}}"><i class="fa fa-user-circle"></i> <span class="nav-label">Profil</span></a>
            </li>
            <li  class="{{request()->routeIs('admin-prodi.daftar-mahasiswa') || request()->routeIs('admin-prodi.detail-mahasiswa') || request()->routeIs('admin-prodi.histori-pendidikan') || request()->routeIs('admin-prodi.krs-mahasiswa') || request()->routeIs('admin-prodi.histori-nilai') || request()->routeIs('admin-prodi.aktivitas-perkuliahan') || request()->routeIs('admin-prodi.prestasi-mahasiswa') || request()->routeIs('admin-prodi.transkrip-mahasiswa') ? 'active' : ''}}">
                <a href=""><i class="fa fa-graduation-cap"></i> <span class="nav-label">Mahasiswa</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{request()->routeIs('admin-prodi.daftar-mahasiswa') || request()->routeIs('admin-prodi.detail-mahasiswa') || request()->routeIs('admin-prodi.histori-pendidikan') || request()->routeIs('admin-prodi.krs-mahasiswa') || request()->routeIs('admin-prodi.histori-nilai') || request()->routeIs('admin-prodi.aktivitas-perkuliahan') || request()->routeIs('admin-prodi.prestasi-mahasiswa') || request()->routeIs('admin-prodi.transkrip-mahasiswa') ? 'active' : ''}}">
                        <a href="{{route('admin-prodi.daftar-mahasiswa')}}">Daftar Mahasiswa</a>
                    </li>
                </ul>
            </li>
            <li  class="{{request()->routeIs('admin-prodi.daftar-dosen') || request()->routeIs('admin-prodi.detail-dosen') || request()->routeIs('admin-prodi.penugasan-dosen') || request()->routeIs('admin-prodi.aktivitas-mengajar-dosen') || request()->routeIs('admin-prodi.riwayat-fungsional-dosen') || request()->routeIs('admin-prodi.riwayat-pendidikan-dosen') || request()->routeIs('admin-prodi.riwayat-sertifikasi-dosen') || request()->routeIs('admin-prodi.riwayat-penelitian-dosen') || request()->routeIs('admin-prodi.riwayat-kepangkatan-dosen') || request()->routeIs('admin-prodi.daftar-penugasan-dosen') || request()->routeIs('admin-prodi.detail-daftar-penugasan-dosen') || request()->routeIs('admin-prodi.pembimbing-aktivitas-mahasiswa') || request()->routeIs('admin-prodi.penguji-aktivitas-mahasiswa') ? 'active' : ''}}">
                <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Dosen</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{request()->routeIs('admin-prodi.daftar-dosen') || request()->routeIs('admin-prodi.detail-dosen') || request()->routeIs('admin-prodi.penugasan-dosen') || request()->routeIs('admin-prodi.aktivitas-mengajar-dosen') || request()->routeIs('admin-prodi.riwayat-fungsional-dosen') || request()->routeIs('admin-prodi.riwayat-pendidikan-dosen') || request()->routeIs('admin-prodi.riwayat-sertifikasi-dosen') || request()->routeIs('admin-prodi.riwayat-penelitian-dosen') || request()->routeIs('admin-prodi.riwayat-kepangkatan-dosen') || request()->routeIs('admin-prodi.pembimbing-aktivitas-mahasiswa') || request()->routeIs('admin-prodi.penguji-aktivitas-mahasiswa') ? 'active' : ''}}">
                        <a href="{{route('admin-prodi.daftar-dosen')}}">Dosen</a>
                    </li>
                    <li class="{{request()->routeIs('admin-prodi.daftar-penugasan-dosen') || request()->routeIs('admin-prodi.detail-daftar-penugasan-dosen')  ? 'active' : ''}}">
                        <a href="{{route('admin-prodi.daftar-penugasan-dosen')}}">Penugasan Dosen</a>
                    </li>
                </ul>
            </li>
            <li  class="{{request()->routeIs('admin-prodi.mata-kuliah') || request()->routeIs('admin-prodi.detail-mata-kuliah') || request()->routeIs('admin-prodi.substansi-kuliah')|| request()->routeIs('admin-prodi.detail-substansi-kuliah')
                        || request()->routeIs('admin-prodi.kurikulum') || request()->routeIs('admin-prodi.detail-kurikulum') || request()->routeIs('admin-prodi.kelas-perkuliahan')
                        || request()->routeIs('admin-prodi.detail-kelas-perkuliahan') || request()->routeIs('admin-prodi.nilai-perkuliahan') || request()->routeIs('admin-prodi.detail-nilai-perkuliahan')
                        || request()->routeIs('admin-prodi.aktivitas-kuliah-mahasiswa') || request()->routeIs('admin-prodi.detail-aktivitas-kuliah-mahasiswa') || request()->routeIs('admin-prodi.aktivitas-mahasiswa')
                        || request()->routeIs('admin-prodi.detail-aktivitas-mahasiswa') || request()->routeIs('admin-prodi.mahasiswa-lulus-do') || request()->routeIs('admin-prodi.detail-mahasiswa-lulus-do') ? 'active' : ''}}">
                <a href=""><i class="fa-solid fa-book-open"></i> <span class="nav-label">Perkuliahan</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{request()->routeIs('admin-prodi.mata-kuliah') || request()->routeIs('admin-prodi.detail-mata-kuliah') ? 'active' : ''}}">
                        <a href="{{route('admin-prodi.mata-kuliah')}}">Mata Kuliah</a>
                    </li>
                    <li class="{{request()->routeIs('admin-prodi.substansi-kuliah') || request()->routeIs('admin-prodi.detail-substansi-kuliah')? 'active' : ''}}">
                        <a href="{{route('admin-prodi.substansi-kuliah')}}">Substansi Kuliah</a>
                    </li>
                    <li class="{{request()->routeIs('admin-prodi.kurikulum') || request()->routeIs('admin-prodi.detail-kurikulum') ? 'active' : ''}}">
                        <a href="{{route('admin-prodi.kurikulum')}}">Kurikulum</a>
                    </li>
                    <li class="{{request()->routeIs('admin-prodi.kelas-perkuliahan') || request()->routeIs('admin-prodi.detail-kelas-perkuliahan') ? 'active' : ''}}">
                        <a href="{{route('admin-prodi.kelas-perkuliahan')}}">Kelas Perkuliahan</a>
                    </li>
                    <li class="{{request()->routeIs('admin-prodi.nilai-perkuliahan') || request()->routeIs('admin-prodi.detail-nilai-perkuliahan') ? 'active' : ''}}">
                        <a href="{{route('admin-prodi.nilai-perkuliahan')}}">Nilai Perkuliahan</a>
                    </li>
                    <li class="{{request()->routeIs('admin-prodi.aktivitas-kuliah-mahasiswa') || request()->routeIs('admin-prodi.detail-aktivitas-kuliah-mahasiswa') ? 'active' : ''}}">
                        <a href="{{route('admin-prodi.aktivitas-kuliah-mahasiswa')}}">Aktivitas Kuliah Mahasiswa</a>
                    </li>
                    <li class="{{request()->routeIs('admin-prodi.aktivitas-mahasiswa') || request()->routeIs('admin-prodi.detail-aktivitas-mahasiswa') ? 'active' : ''}}">
                        <a href="{{route('admin-prodi.aktivitas-mahasiswa')}}">Aktivitas Mahasiswa</a>
                    </li>
                    <li class="{{request()->routeIs('admin-prodi.mahasiswa-lulus-do') || request()->routeIs('admin-prodi.detail-mahasiswa-lulus-do') ? 'active' : ''}}">
                        <a href="{{route('admin-prodi.mahasiswa-lulus-do')}}">Daftar Mahasiswa Lulus / Drop Out</a>
                    </li>
                </ul>
            </li>
            <li  class="{{request()->routeIs('admin-prodi.pelengkap') || request()->routeIs('admin-prodi.skala-nilai') || request()->routeIs('admin-prodi.periode-perkuliahan') || request()->routeIs('admin-prodi.detail-skala-nilai') || request()->routeIs('admin-prodi.detail-periode-perkuliahan') ? 'active' : ''}}">
                <a href="#"><i class="fa fa-briefcase"></i> <span class="nav-label">Pelengkap</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{request()->routeIs('admin-prodi.skala-nilai') || request()->routeIs('admin-prodi.detail-skala-nilai') ? 'active' : ''}}">
                        <a href="{{route('admin-prodi.skala-nilai')}}">Skala Nilai</a>
                    </li>
                    <li class="{{request()->routeIs('admin-prodi.periode-perkuliahan') || request()->routeIs('admin-prodi.detail-periode-perkuliahan') ? 'active' : ''}}">
                        <a href="{{route('admin-prodi.periode-perkuliahan')}}">Pengaturan Periode Perkuliahan</a>
                    </li>
                </ul>
            </li>
            <li class="{{request()->routeIs('admin-prodi.export-data') ? 'active' : ''}}">
                <a href="{{route('admin-prodi.export-data')}}"><i class="fa fa-file-excel"></i> <span class="nav-label">Export Data</span></a>
            </li>
        </ul>
    </div>
</nav>

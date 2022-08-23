<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a href=""><i class="fa fa-user"></i> | <span class="nav-label"><strong class="font-bold">{{auth()->user()->name}}</strong></span></a>
                    <!-- <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{auth()->user()->name}}</strong></span>
                    </a> -->
                </div>
                <div class="logo-element">
                    UNSRI
                </div>
            </li>
            <li class="{{request()->routeIs('admin-univ.dashboard-admin-univ') ? 'active' : ''}}">
                <a href="{{route('admin-univ.dashboard-admin-univ')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span></a>
            </li>
            <li class="{{request()->routeIs('admin-univ.profil-pt') ? 'active' : ''}}">
                <a href="{{route('admin-univ.profil-pt')}}"><i class="fa fa-user-circle"></i> <span class="nav-label">Profil</span></a>
            </li>
            <li  class="{{request()->routeIs('admin-univ.daftar-mahasiswa') || request()->routeIs('admin-univ.detail-mahasiswa') ? 'active' : ''}}">
                <a href=""><i class="fa fa-graduation-cap"></i> <span class="nav-label">Mahasiswa</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{request()->routeIs('admin-univ.daftar-mahasiswa') || request()->routeIs('admin-univ.detail-mahasiswa') ? 'active' : ''}}">
                        <a href="{{route('admin-univ.daftar-mahasiswa')}}">Daftar Mahasiswa</a>
                    </li>
                </ul>
            </li>
            <li  class="{{request()->routeIs('admin-univ.dosen') ? 'active' : ''}}">
                <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Dosen</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{request()->routeIs('admin-univ.dosen') ? 'active' : ''}}">
                        <a href="{{route('admin-univ.daftar-mahasiswa')}}">Dosen</a>
                    </li>
                    <li class="{{request()->routeIs('admin-univ.penugasan-dosen') ? 'active' : ''}}">
                        <a href="{{route('admin-univ.daftar-mahasiswa')}}">Penugasan Dosen</a>
                    </li>
                </ul>
            </li>
            <li  class="{{request()->routeIs('admin-univ.perkuliahan') ? 'active' : ''}}">
                <a href="#"><i class="fa fa-book"></i> <span class="nav-label">Perkuliahan</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{request()->routeIs('admin-univ.mata-kuliah') ? 'active' : ''}}">
                        <a href="{{route('admin-univ.daftar-mahasiswa')}}">Mata Kuliah</a>
                    </li>
                    <li class="{{request()->routeIs('admin-univ.substansi-kuliah') ? 'active' : ''}}">
                        <a href="{{route('admin-univ.daftar-mahasiswa')}}">Substansi Kuliah</a>
                    </li>
                    <li class="{{request()->routeIs('admin-univ.kurikulum') ? 'active' : ''}}">
                        <a href="{{route('admin-univ.daftar-mahasiswa')}}">Kurikulum</a>
                    </li>
                    <li class="{{request()->routeIs('admin-univ.kelas-perkuliahan') ? 'active' : ''}}">
                        <a href="{{route('admin-univ.daftar-mahasiswa')}}">Kelas Perkuliahan</a>
                    </li>
                    <li class="{{request()->routeIs('admin-univ.nilai-perkuliahan') ? 'active' : ''}}">
                        <a href="{{route('admin-univ.daftar-mahasiswa')}}">Nilai Perkuliahan</a>
                    </li>
                    <li class="{{request()->routeIs('admin-univ.aktivitas-kuliah-mahasiswa') ? 'active' : ''}}">
                        <a href="{{route('admin-univ.daftar-mahasiswa')}}">Aktivitas Kuliah Mahasiswa</a>
                    </li>
                    <li class="{{request()->routeIs('admin-univ.aktivitas-mahasiswa') ? 'active' : ''}}">
                        <a href="{{route('admin-univ.daftar-mahasiswa')}}">Aktivitas Mahasiswa</a>
                    </li>
                    <li class="{{request()->routeIs('admin-univ.kampus-merdeka') ? 'active' : ''}}">
                        <a href="{{route('admin-univ.daftar-mahasiswa')}}">Konversi Kampus Merdeka</a>
                    </li>
                    <li class="{{request()->routeIs('admin-univ.mahasiswa-lulus-do') ? 'active' : ''}}">
                        <a href="{{route('admin-univ.daftar-mahasiswa')}}">Daftar Mahasiswa Lulus / Drop Out</a>
                    </li>
                    <li class="{{request()->routeIs('admin-univ.transkrip-mahasiswa') ? 'active' : ''}}">
                        <a href="{{route('admin-univ.daftar-mahasiswa')}}">Cek Transkrip Mahasiswa</a>
                    </li>
                </ul>
            </li>
            <li  class="{{request()->routeIs('admin-univ.pelengkap') ? 'active' : ''}}">
                <a href="#"><i class="fa fa-briefcase"></i> <span class="nav-label">Pelengkap</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{request()->routeIs('admin-univ.skala-nilai') ? 'active' : ''}}">
                        <a href="{{route('admin-univ.daftar-mahasiswa')}}">Skala Nilai</a>
                    </li>
                    <li class="{{request()->routeIs('admin-univ.periode-perkuliahan') ? 'active' : ''}}">
                        <a href="{{route('admin-univ.daftar-mahasiswa')}}">Pengaturan Periode Perkuliahan</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

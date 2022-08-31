<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="img/profile_small.jpg" />
                             </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{auth()->user()->name}}</strong>
                             </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="profile.html">Profile</a></li>
                        <li><a href="contacts.html">Contacts</a></li>
                        <li><a href="mailbox.html">Mailbox</a></li>
                        <li class="divider"></li>
                        <li><a href="login.html">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li class="{{request()->routeIs('admin-prodi.dashboard-admin-prodi') ? 'active' : ''}}">
                <a href="{{route('admin-prodi.dashboard-admin-prodi')}}"><i class="fa-solid fa-table-cells"></i> <span class="nav-label">Dashboards</span></a>
            </li>
            <li  class="{{request()->routeIs('admin-prodi.daftar-mahasiswa') ? 'active' : ''}}">
                <a href=""><i class="fa fa-graduation-cap"></i> <span class="nav-label">Mahasiswa</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{request()->routeIs('admin-prodi.daftar-mahasiswa') ? 'active' : ''}}">
                        <a href="{{route('admin-prodi.daftar-mahasiswa')}}">Daftar Mahasiswa</a>
                    </li>
                </ul>
            </li>
            <li  class="{{request()->routeIs('admin-prodi.daftar-dosen') || request()->routeIs('admin-univ.prodi-dosen') || request()->routeIs('admin-prodi.penugasan-dosen') || request()->routeIs('admin-univ.aktivitas-mengajar-dosen') || request()->routeIs('admin-prodi.riwayat-fungsional-dosen') || request()->routeIs('admin-prodi.riwayat-pendidikan-dosen') || request()->routeIs('admin-prodi.riwayat-sertifikasi-dosen') || request()->routeIs('admin-prodi.riwayat-penelitian-dosen') || request()->routeIs('admin-prodi.riwayat-kepangkatan-dosen') || request()->routeIs('admin-prodi.daftar-penugasan-dosen') || request()->routeIs('admin-prodi.detail-daftar-penugasan-dosen') || request()->routeIs('admin-prodi.pembimbing-aktivitas-mahasiswa') || request()->routeIs('admin-prodi.penguji-aktivitas-mahasiswa') ? 'active' : ''}}">
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
            <li  class="{{request()->routeIs('admin-prodi.mata-kuliah') || request()->routeIs('admin-prodi.substansi-kuliah') ? 'active' : ''}}">
                <a href=""><i class="fa-solid fa-book-open"></i> <span class="nav-label">Perkuliahan</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{request()->routeIs('admin-prodi.mata-kuliah') ? 'active' : ''}}">
                        <a href="{{route('admin-prodi.mata-kuliah')}}"><i class="fa-solid fa-chalkboard-user"></i><span>Mata Kuliah</span></a>
                    </li>
                    <li class="{{request()->routeIs('admin-prodi.substansi-kuliah') ? 'active' : ''}}">
                        <a href="{{route('admin-prodi.substansi-kuliah')}}"><i class="fa-solid fa-chalkboard-user"></i><span>Substansi Kuliah</span></a>
                    </li>
                </ul>
            </li>


        </ul>

    </div>
</nav>

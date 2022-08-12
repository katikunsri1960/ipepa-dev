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
                <a href="{{route('admin-prodi.dashboard-admin-prodi')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span></a>
            </li>
            <li  class="{{request()->routeIs('admin-prodi.daftar-mahasiswa') ? 'active' : ''}}">
                <a href=""><i class="fa fa-graduation-cap"></i> <span class="nav-label">Mahasiswa</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{request()->routeIs('admin-prodi.daftar-mahasiswa') ? 'active' : ''}}">
                        <a href="{{route('admin-prodi.daftar-mahasiswa')}}">Daftar Mahasiswa</a>
                    </li>
                </ul>
            </li>
           
 
        </ul>

    </div>
</nav>

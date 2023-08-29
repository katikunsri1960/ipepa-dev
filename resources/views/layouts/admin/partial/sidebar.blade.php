<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a href="{{route('admin.dashboard-admin')}}"><i class="fa fa-user"></i> | <span class="nav-label"><strong class="font-bold">{{auth()->user()->name}}</strong></span></a>
                </div>
                <div class="logo-element">
                    <a href="{{route('admin.dashboard-admin')}}">UNSRI</a>
                </div>
            </li>
            <li class="{{request()->routeIs('admin.dashboard-admin') ? 'active' : ''}}">
                <a href="{{route('admin.dashboard-admin')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span></a>
            </li>
            <li class="{{request()->routeIs('admin.elearning') || request()->routeIs('admin.elearning.*') ? 'active' : ''}}">
                <a href="#"><i class="fa fa-gear"></i> <span class="nav-label">E-Learning</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{request()->routeIs('admin.elearning') ? 'active' : ''}}">
                        <a href="{{route('admin.elearning')}}"><i class="fa fa-user"></i>Create Account</a>
                    </li>
                    <li class="{{request()->routeIs('admin.elearning.delete-akun') ? 'active' : ''}}">
                        <a href="{{route('admin.elearning.delete-akun')}}"><i class="fa fa-trash"></i>Delete Account</a>
                    </li>
                    {{-- <li class="{{request()->routeIs('admin.settings.frontend-configs.*') ? 'active' : ''}}">
                        <a href="{{route('admin.settings.frontend-configs.index')}}">Frontend Configs</a>
                    </li> --}}
                </ul>
            </li>
            <li class="{{request()->routeIs('admin.hitung-transkrip') ? 'active' : ''}}">
                <a href="{{route('admin.hitung-transkrip')}}"><i class="fa fa-medkit"></i> <span class="nav-label">Hitung Transkrip</span></a>
            </li>
            <li class="{{request()->routeIs('admin.sync.index') ? 'active' : ''}}">
                <a href="{{ route('admin.sync.index') }}"><i class="fa fa-refresh"></i> <span class="nav-label">Syncronize Page</span></a>
            </li>
            <li class="{{request()->routeIs('admin.settings.users.*') ||
                        request()->routeIs('admin.settings.api-configs.*') ||
                        request()->routeIs('admin.settings.frontend-configs.*') ? 'active' : ''}}">
                <a href="#"><i class="fa fa-gear"></i> <span class="nav-label">Settings</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{request()->routeIs('admin.settings.users.*') ? 'active' : ''}}">
                        <a href="{{route('admin.settings.users.index')}}"><i class="fa fa-user"></i>Users</a>
                    </li>
                    <li class="{{request()->routeIs('admin.settings.api-configs.*') ? 'active' : ''}}">
                        <a href="{{route('admin.settings.api-configs.index')}}">API Configs</a>
                    </li>
                    {{-- <li class="{{request()->routeIs('admin.settings.frontend-configs.*') ? 'active' : ''}}">
                        <a href="{{route('admin.settings.frontend-configs.index')}}">Frontend Configs</a>
                    </li> --}}
                </ul>
            </li>
        </ul>

    </div>
</nav>

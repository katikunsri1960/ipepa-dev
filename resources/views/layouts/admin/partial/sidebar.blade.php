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
            <li class="{{request()->routeIs('admin.dashboard-admin') ? 'active' : ''}}">
                <a href="{{route('admin.dashboard-admin')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span></a>
            </li>
            <li class="{{request()->routeIs('admin.sync') ? 'active' : ''}}">
                <a href="{{ route('admin.sync.index') }}"><i class="fa fa-refresh"></i> <span class="nav-label">Syncronize Page</span></a>
            </li>
            {{-- <li>
                <a href="layouts.html"><i class="fa fa-diamond"></i> <span class="nav-label">Layouts</span></a>
            </li> --}}
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
                    <li class="{{request()->routeIs('admin.settings.frontend-configs.*') ? 'active' : ''}}">
                        <a href="{{route('admin.settings.frontend-configs.index')}}">Frontend Configs</a>
                    </li>
                </ul>
            </li>
        </ul>

    </div>
</nav>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Dashboard</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Home</a>
            </li>
            @if (request()->routeIs('admin.dashboard-admin'))
                <li class="active">
                    <strong>Dashboard</strong>
                </li>
            @elseif (request()->routeIs('admin.settings.users.*'))
            <li>
                <a href="">Settings</a>
            </li>
            <li class="active">
                <strong>Users</strong>
            </li>
            @elseif (request()->routeIs('admin.settings.api-configs.*'))
            <li>
                <a href="">Settings</a>
            </li>
            <li class="active">
                <strong>Api-Configs</strong>
            </li>
            @endif
            {{-- <li class="active">
                <strong>Dashboard</strong>
            </li> --}}
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>

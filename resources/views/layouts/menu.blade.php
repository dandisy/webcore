<li class="header">DASHBOARD</li>

<li class="treeview">
    <a href="{!! url('home') !!}"><i class="fa fa-area-chart"></i><span>Stats</span></a>
</li>

<li class="header">PUBLISH</li>

<li class="{{ Request::is('pages*') ? 'active' : '' }}">
    <a href="{!! route('pages.index') !!}"><i class="fa fa-sticky-note"></i><span>Pages</span></a>
</li>

<li class="{{ Request::is('components*') ? 'active' : '' }}">
    <a href="{!! route('components.index') !!}"><i class="fa fa-puzzle-piece"></i><span>Components</span></a>
</li>

<li class="header">ARRANGE</li>

<li class="{{ Request::is('menus*') ? 'active' : '' }}">
    <a href="{!! route('menus.index') !!}"><i class="fa fa-bars"></i><span>Menus</span></a>
</li>

<li class="header">MANAGE</li>

<li class="{{ Request::is('assets*') ? 'active' : '' }}">
    <a href="{!! url('assets') !!}"><i class="fa fa-folder-open"></i><span>Assets</span></a>
</li>

<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="fa fa-users"></i><span>Users</span></a>
</li>

<li class="{{ Request::is('profiles*') ? 'active' : '' }}">
    <a href="{!! route('profiles.index') !!}"><i class="fa fa-newspaper-o"></i><span>Profiles</span></a>
</li>

<li class="{{ Request::is('roles*') ? 'active' : '' }}">
    <a href="{!! route('roles.index') !!}"><i class="fa fa-road"></i><span>Roles</span></a>
</li>

<li class="{{ Request::is('permissions*') ? 'active' : '' }}">
    <a href="{!! route('permissions.index') !!}"><i class="fa fa-ticket"></i><span>Permissions</span></a>
</li>

<li class="header">CONFIGURE</li>

<li class="{{ Request::is('settings*') ? 'active' : '' }}">
    <a href="{!! route('settings.index') !!}"><i class="fa fa-cog"></i><span>Settings</span></a>
</li>
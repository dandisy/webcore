@role(['superadministrator','administrator','verificator','user'])
<li class="header">DASHBOARD</li>

<li class="{{ Request::is('dashboard*') ? 'active' : '' }}">>
    <a href="{!! url('dashboard') !!}"><i class="fa fa-area-chart"></i><span>Stats</span></a>
</li>

<li class="header">CONTENTS</li>

<li class="{{ Request::is('pages*') ? 'active' : '' }}">
    <a href="{!! route('admin.pages.index') !!}"><i class="fa fa-file-text"></i><span>Pages</span></a>
</li>

<li class="header">COMPONENTS</li>

<li class="{{ Request::is('posts*') ? 'active' : '' }}">
    <a href="{!! route('admin.posts.index') !!}"><i class="fa fa-clone"></i><span>Posts</span></a>
</li>

<li class="{{ Request::is('banners*') ? 'active' : '' }}">
    <a href="{!! route('admin.banners.index') !!}"><i class="fa fa-file-image-o"></i><span>Banners</span></a>
</li>

<li class="header">ARRANGEMENT</li>

<li class="{{ Request::is('presentations*') ? 'active' : '' }}">
    <a href="{!! route('admin.presentations.index') !!}"><i class="fa fa-newspaper-o"></i><span>Presentations</span></a>
</li>

<li class="header">MANAGEMENT</li>

<li class="{{ Request::is('menu-manager*') ? 'active' : '' }}">
    <a href="{!! url('menu-manager') !!}"><i class="fa fa-bars"></i><span>Menus</span></a>
</li>

<li class="{{ Request::is('assets*') ? 'active' : '' }}">
    <a href="{!! url('assets') !!}"><i class="fa fa-folder-open"></i><span>Assets</span></a>
</li>

<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="fa fa-users"></i><span>Users</span></a>
</li>
@endrole

@role(['superadministrator','administrator'])
<li class="{{ Request::is('roles*') ? 'active' : '' }}">
    <a href="{!! route('roles.index') !!}"><i class="fa fa-road"></i><span>Roles</span></a>
</li>

{{--<li class="{{ Request::is('permissions*') ? 'active' : '' }}">
    <a href="{!! route('permissions.index') !!}"><i class="fa fa-ticket"></i><span>Permissions</span></a>
</li>--}}
@endrole

@role(['superadministrator','administrator'])
<li class="header">CONFIGURATION</li>

<li class="{{ Request::is('settings*') ? 'active' : '' }}">
    <a href="{!! route('settings.index') !!}"><i class="fa fa-cog"></i><span>Settings</span></a>
</li>
@endrole


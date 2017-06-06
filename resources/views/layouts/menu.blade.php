<li class="header">DASHBOARD</li>

<li class="treeview">
    <a href=""><i class="fa fa-edit"></i><span>Dashboard</span></a>
</li>

<li class="header">APPEARENT</li>

<li class="{{ Request::is('menus*') ? 'active' : '' }}">
    <a href="{!! route('menus.index') !!}"><i class="fa fa-edit"></i><span>Menus</span></a>
</li>

<li class="header">MANAGEMENT</li>

<li class="{{ Request::is('assets*') ? 'active' : '' }}">
    <a href="{!! url('assets') !!}"><i class="fa fa-edit"></i><span>Assets</span></a>
</li>




















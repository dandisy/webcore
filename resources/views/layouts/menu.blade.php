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








<li class="{{ Request::is('posts*') ? 'active' : '' }}">
    <a href="{!! route('posts.index') !!}"><i class="fa fa-edit"></i><span>Posts</span></a>
</li>








<li class="{{ Request::is('pages*') ? 'active' : '' }}">
    <a href="{!! route('pages.index') !!}"><i class="fa fa-edit"></i><span>Pages</span></a>
</li>

<li class="{{ Request::is('articles*') ? 'active' : '' }}">
    <a href="{!! route('articles.index') !!}"><i class="fa fa-edit"></i><span>Articles</span></a>
</li>

<li class="{{ Request::is('article2s*') ? 'active' : '' }}">
    <a href="{!! route('article2s.index') !!}"><i class="fa fa-edit"></i><span>Article2s</span></a>
</li>


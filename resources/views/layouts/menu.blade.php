@if(Request::is('analytics*'))
<li><hr class="light-grey-hr mb-10"/></li>
<li class="header navigation-header">
    <span>DASHBOARD</span> 
    <i class="zmdi zmdi-more"></i>
</li>

<li class="{{ Request::is('analytics*') ? 'active' : '' }}">
    <a class="{{ Request::is('analytics*') ? 'active' : '' }}" href="{!! url('analytics') !!}">
        <div class="pull-left">
            <i class="zmdi zmdi-edit mr-20"></i>
            @if(config('webcore.laravel_generator.templates') == 'adminlte-templates')
            <i class="fa fa-area-chart"></i>
            @endif
            <span class="right-nav-text">Analytics</span>
        </div>
        <div class="clearfix"></div>
    </a>
</li>
@endif

@if(Request::is('assets*'))
<li><hr class="light-grey-hr mb-10"/></li>
<li class="header navigation-header">
    <span>MANAGEMENT</span> 
    <i class="zmdi zmdi-more"></i>
</li>

<li class="{{ Request::is('assets*') ? 'active' : '' }}">
    <a href="{!! url('assets') !!}"><i class="fa fa-folder-open"></i><span>Assets</span></a>
</li>
@endif

@role(['superadministrator'])
@if(Request::is('users*') or Request::is('profiles*') or Request::is('roles*') or Request::is('permissions*'))
<li><hr class="light-grey-hr mb-10"/></li>
<li class="header navigation-header">
    <span>MANAGEMENT</span> 
    <i class="zmdi zmdi-more"></i>
</li>

<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a class="{{ Request::is('users*') ? 'active' : '' }}" href="{!! route('users.index') !!}">
        <div class="pull-left">
            <i class="zmdi zmdi-edit mr-20"></i>
            {{--@if(config('webcore.laravel_generator.templates') == 'adminlte-templates')
            <i class="fa fa-users"></i>
            @endif--}}
            <span class="right-nav-text">Users</span>
        </div>
        <div class="clearfix"></div>
    </a>
</li>

<li class="{{ Request::is('profiles*') ? 'active' : '' }}">
    <a class="{{ Request::is('profiles*') ? 'active' : '' }}" href="{!! route('profiles.index') !!}">
        <div class="pull-left">
            <i class="zmdi zmdi-edit mr-20"></i>
            {{--@if(config('webcore.laravel_generator.templates') == 'adminlte-templates')
            <i class="fa fa-edit"></i>
            @endif--}}
            <span class="right-nav-text">Profiles</span>
        </div>
        <div class="clearfix"></div>
    </a>
</li>

<li class="{{ Request::is('roles*') ? 'active' : '' }}">
    <a class="{{ Request::is('roles*') ? 'active' : '' }}" href="{!! route('roles.index') !!}">
        <div class="pull-left">
            <i class="zmdi zmdi-edit mr-20"></i>
            {{--@if(config('webcore.laravel_generator.templates') == 'adminlte-templates')
            <i class="fa fa-road"></i>
            @endif--}}
            <span class="right-nav-text">Roles</span>
        </div>
        <div class="clearfix"></div>
    </a>
</li>

<li class="{{ Request::is('permissions*') ? 'active' : '' }}">
    <a class="{{ Request::is('permissions*') ? 'active' : '' }}" href="{!! route('permissions.index') !!}">
        <div class="pull-left">
            <i class="zmdi zmdi-edit mr-20"></i>
            {{--@if(config('webcore.laravel_generator.templates') == 'adminlte-templates')
            <i class="fa fa-ticket"></i>
            @endif--}}
            <span class="right-nav-text">Permissions</span>
        </div>
        <div class="clearfix"></div>
    </a>
</li>
@endif
@endrole

@role(['superadministrator','administrator'])
@if(Request::is('settings*'))
<li><hr class="light-grey-hr mb-10"/></li>
<li class="header navigation-header">
    <span>CONFIGURATION</span> 
    <i class="zmdi zmdi-more"></i>
</li>

<li class="{{ Request::is('settings*') ? 'active' : '' }}">
    <a href="{!! route('settings.index') !!}"><i class="fa fa-cog"></i><span>Settings</span></a>
</li>
<li class="{{ Request::is('settings*') ? 'active' : '' }}">
    <a class="{{ Request::is('settings*') ? 'active' : '' }}" href="{!! route('settings.index') !!}">
        <div class="pull-left">
            <i class="zmdi zmdi-edit mr-20"></i>
            {{--@if(config('webcore.laravel_generator.templates') == 'adminlte-templates')
            <i class="fa fa-cog"></i>
            @endif--}}
            <span class="right-nav-text">Settings</span>
        </div>
        <div class="clearfix"></div>
    </a>
</li>
@endif
@endrole

{{--@if(
    Request::is('admin/pages*') or
    Request::is('admin/posts*') or
    Request::is('admin/presentations*') or
    Request::is('admin/components*') or
    Request::is('menu-manager*') or
    Request::is('admin/categories*') or
    Request::is('admin/types*') or
    Request::is('admin/businesses*') or
    Request::is('admin/dataSources*') or
    Request::is('admin/dbQueries*') or
    Request::is('admin/apiQueries*') or
    Request::is('admin/dataSets*')
)
<li><hr class="light-grey-hr mb-10"/></li>
<li class="header navigation-header">
    <span>CONTENTS</span> 
    <i class="zmdi zmdi-more"></i>
</li>

<li class="{{ Request::is('admin/pages*') ? 'active' : '' }}">
    <a href="{!! route('admin.pages.index') !!}"><i class="fa fa-square"></i><span>Pages</span></a>
</li>

<li class="{{ Request::is('admin/posts*') ? 'active' : '' }}">
    <a href="{!! route('admin.posts.index') !!}"><i class="fa fa-sticky-note"></i><span>Posts</span></a>
</li>

<li><hr class="light-grey-hr mb-10"/></li>
<li class="header navigation-header">
    <span>LAYOUTS</span> 
    <i class="zmdi zmdi-more"></i>
</li>

<li class="{{ Request::is('admin/presentations*') ? 'active' : '' }}">
    <a href="{!! route('admin.presentations.index') !!}"><i class="fa fa-sitemap"></i><span>Presentations</span></a>
</li>

<li class="{{ Request::is('admin/components*') ? 'active' : '' }}">
    <a href="{!! route('admin.components.index') !!}"><i class="fa fa-paperclip"></i><span>Components</span></a>
</li>

<li><hr class="light-grey-hr mb-10"/></li>
<li class="header navigation-header">
    <span>TAXONOMY</span> 
    <i class="zmdi zmdi-more"></i>
</li>

<li class="{{ Request::is('menu-manager*') ? 'active' : '' }}">
    <a href="{!! url('menu-manager') !!}"><i class="fa fa-bars"></i><span>Menus</span></a>
</li>

<li class="{{ Request::is('admin/categories*') ? 'active' : '' }}">
    <a href="{!! route('admin.categories.index') !!}"><i class="fa fa-tree"></i><span>Category</span></a>
</li>

<li class="{{ Request::is('admin/types*') ? 'active' : '' }}">
    <a href="{!! route('admin.types.index') !!}"><i class="fa fa-ticket"></i><span>Types</span></a>
</li>

<li><hr class="light-grey-hr mb-10"/></li>
<li class="header navigation-header">
    <span>MODULE</span> 
    <i class="zmdi zmdi-more"></i>
</li>

<li class="{{ Request::is('admin/businesses*') ? 'active' : '' }}">
    <a href="{!! route('admin.businesses.index') !!}"><i class="fa fa-magic"></i><span>Businesses</span></a>
</li>

<li class="{{ Request::is('admin/dataSources*') ? 'active' : '' }}">
    <a href="{!! route('admin.dataSources.index') !!}"><i class="fa fa-database"></i><span>Data Sources</span></a>
</li>

<li class="{{ Request::is('admin/dbQueries*') ? 'active' : '' }}">
    <a href="{!! route('admin.dbQueries.index') !!}"><i class="fa fa-inbox"></i><span>Db Queries</span></a>
</li>

<li class="{{ Request::is('admin/apiQueries*') ? 'active' : '' }}">
    <a href="{!! route('admin.apiQueries.index') !!}"><i class="fa fa-inbox"></i><span>Api Queries</span></a>
</li>

<li class="{{ Request::is('admin/dataSets*') ? 'active' : '' }}">
    <a href="{!! route('admin.dataSets.index') !!}"><i class="fa fa-edit"></i><span>Data Sets</span></a>
</li>

<li><hr class="light-grey-hr mb-10"/></li>
<li class="header navigation-header">
    <span>RELATION</span> 
    <i class="zmdi zmdi-more"></i>
</li>

<li class="{{ Request::is('admin/parameters*') ? 'active' : '' }}">
    <a href="{!! route('admin.parameters.index') !!}"><i class="fa fa-adjust"></i><span>Parameters</span></a>
</li>
@endif--}}


{{--<li><hr class="light-grey-hr mb-10"/></li>
<li class="header navigation-header">
    <span>FEATURED</span> 
    <i class="zmdi zmdi-more"></i>
</li>
<li>
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#dropdown_dr_lv1"><div class="pull-left"><i class="zmdi zmdi-filter-list mr-20"></i><span class="right-nav-text">multilevel</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
    <ul id="dropdown_dr_lv1" class="collapse collapse-level-1">
        <li>
            <a href="#">Item level 1</a>
        </li>
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#dropdown_dr_lv2">Dropdown level 2<div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="dropdown_dr_lv2" class="collapse collapse-level-2">
                <li>
                    <a href="#">Item level 2</a>
                </li>
                <li>
                    <a href="#">Item level 2</a>
                </li>
            </ul>
        </li>
    </ul>
</li>--}}


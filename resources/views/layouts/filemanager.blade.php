<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Webcore</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/skins/_all-skins.min.css') }}">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- include Summernote -->
    <link href="{{ asset('vendor/adminlte/plugins/summernote/summernote.css') }}" rel="stylesheet">

    <!-- include Fancybox -->
    <link href="{{ asset('vendor/adminlte/plugins/fancybox/jquery.fancybox.min.css') }}" rel="stylesheet">

    <style>
        .main-header {
            position: fixed;
            width: 100%;
        }
        .main-sidebar {
            position: fixed;
        }
        .content-wrapper {
            margin-top: 50px;
        }
        .sidebar {
            overflow-y: auto;
            height: 92.4vh !important;
        }
    </style>
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    @yield('styles')
    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout" class="skin-red sidebar-mini">
    {{--<nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Webcore
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Home</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>--}}

    <div class="wrapper">
        <!-- Main Header -->
        <header class="main-header">

            <!-- Logo -->
            <a href="{{ url('/dashboard') }}" class="logo">
                <b>Webcore</b>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img src="{{ asset('vendor/adminlte/dist/img/user2-160x160.jpg') }}"
                                     class="user-image" alt="User Image"/>
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs">{!! Auth::user()->name !!}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    <img src="{{ asset('vendor/adminlte/dist/img/user2-160x160.jpg') }}"
                                         class="img-circle" alt="User Image"/>
                                    <p>
                                        {!! Auth::user()->name !!}
                                        <small>Member since {!! Auth::user()->created_at->format('M. Y') !!}</small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{!! url('/logout') !!}" class="btn btn-default btn-flat"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Sign out
                                        </a>
                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Left side column. contains the logo and sidebar -->
        @include('layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- Main Footer -->
        <footer class="main-footer" style="max-height: 100px;text-align: center">
            <strong>Copyright © 2017 <a href="#">Webcore</a>.</strong> All rights reserved.
        </footer>
    </div>

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <!-- Select2 -->
    <script src="{{ asset('vendor/adminlte/plugins/select2/select2.min.js') }}"></script>

    <!-- Summernote -->
    <script src="{{ asset('vendor/adminlte/plugins/summernote/summernote.min.js') }}"></script>

    <!-- Fancybox -->
    <script src="{{ asset('vendor/adminlte/plugins/fancybox/jquery.fancybox.min.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ asset('vendor/adminlte/dist/js/app.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.rte').summernote();

            $('.filemanager').fancybox({
                type : 'iframe'
            });

            $(".select2").select2();
        });

        // filemanager auto run when close fancybox, after select file and then insert image thumbnail
        var OnMessage = function(data){
            $('#' + data.appendId + '-thumb').html('<img src="' + data.thumb + '" style="width:100%">');
            $('input[name="' + data.appendId + '"]').val(data.thumb);
            $.fancybox.close();
        };

        $('#myModalPermissions').on('show.bs.modal', function (e) {
            var content = '';

            $.ajax({
                type: 'get',
                url: '{{ url("api/permissions") }}'
            }).done(function (res) {
                $.each(res.data, function (index, value) {
                    content += '<div class="checkbox col-sm-6"><label><input type="checkbox" name="permission" value="' + value.id + '">' + ' ' + value.display_name + '</label></div>';
                });

                $('#permission-container').html(content);
            });
        });

        $('#myModalRole').on('show.bs.modal', function (e) {
            var content = '';

            $.ajax({
                type: 'get',
                url: '{{ url("api/roles") }}'
            }).done(function (res) {
                $.each(res.data, function (index, value) {
                    content += '<div class="checkbox col-sm-6"><label><input type="radio" name="role" value="' + value.id + '">' + ' ' + value.display_name + '</label></div>';
                });

                $('#role-container').html(content);
            });
        });
    </script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    @yield('scripts')
</body>
</html>

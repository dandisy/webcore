<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <title>Webcore</title>

    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins//font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/skins/_all-skins.min.css') }}">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Date Picker -->
    <link href="{{ asset('vendor/adminlte/plugins/datepicker/datepicker3.css') }}" rel="stylesheet">

    <!-- Tags Input -->
    <link href="{{ asset('vendor/adminlte/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet">

    <!-- include Summernote -->
    <link href="{{ asset('vendor/adminlte/plugins/summernote/summernote.css') }}" rel="stylesheet">

    <!-- Date Time Picker -->
    <link href="{{ asset('vendor/adminlte/plugins/datetimepicker/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">

    <!-- include Fancybox -->
    <link href="{{ asset('vendor/adminlte/plugins/fancybox/jquery.fancybox.min.css') }}" rel="stylesheet">

    <!-- include Fileuploader -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/fileuploader/jquery.fileuploader.css') }}">

    <!-- include Multi-select -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/multi-select/css/multi-select.css') }}">

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
        .file-item {
            margin-top: 15px;
        }
    </style>

    @yield('css')
</head>

<body class="skin-red sidebar-mini">
@if (!Auth::guest())
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
                                        <a href="{{ url('edit-profile') }}" class="btn btn-default btn-flat">Profile</a>
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

        <div class="summernote-filemanager">
            <div id="snfmImage-thumb" style="display:none;width:100%">
                <img src="" alt="" style="width:100%">
            </div>
            <a style="display:none" href="{!! url(config('filemanager.defaultRoute','filemanager').'/dialog?filter=all&appendId=snfmImage') !!}" class="sn-filemanager fancybox.iframe" data-fancybox-type="iframe"></a>
        </div>

        <!-- Main Footer -->
        <footer class="main-footer" style="max-height: 100px;text-align: center">
            <strong>Copyright © 2017 <a href="#">Webcore</a>.</strong> All rights reserved.
        </footer>

    </div>
@else
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{!! url('/admin') !!}">
                    Admin
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{!! url('/home') !!}">Home</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    <li><a href="{!! url('/login') !!}">Login</a></li>
                    <li><a href="{!! url('/register') !!}">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
@endif

    <!-- Javascript -->
    <!-- jQuery 2.2.3 -->
    <script src="{{ asset('vendor/adminlte/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>

    <!-- Bootstrap -->
    <script src="{{ asset('vendor/adminlte/plugins//bootstrap/js/bootstrap.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.2/moment.min.js"></script>

    <!-- Date Picker App -->
    <script src="{{ asset('vendor/adminlte/plugins/datepicker/bootstrap-datepicker.js') }}"></script>

    <!-- Date Time Picker -->
    <script src="{{ asset('vendor/adminlte/plugins/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>

    <!-- Tags Input -->
    <script src="{{ asset('vendor/adminlte/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>

    <!-- Select2 -->
    <script src="{{ asset('vendor/adminlte/plugins/select2/select2.min.js') }}"></script>

    <!-- Summernote -->
    <script src="{{ asset('vendor/adminlte/plugins/summernote/summernote.min.js') }}"></script>

    <!-- Fancybox -->
    <script src="{{ asset('vendor/adminlte/plugins/fancybox/jquery.fancybox.min.js') }}"></script>

    <!-- Fileuploader -->
    <script src="{{ asset('vendor/adminlte/plugins/fileuploader/jquery.fileuploader.min.js') }}"></script>

    <!-- Multi-select -->
    <script src="{{ asset('vendor/adminlte/plugins/multi-select/js/jquery.multi-select.js') }}"></script>

    <!-- Quicksearch -->
    <script src="{{ asset('vendor/adminlte/plugins/quicksearch/jquery.quicksearch.min.js') }}"></script>

    <!-- Input Mask -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.2.6/jquery.inputmask.bundle.min.js"></script>

    <!-- AdminLTE App -->
    <script src="{{ asset('vendor/adminlte/dist/js/app.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // start summernote
            var snfmContext;

            var fileManager = function(context) {
                snfmContext = context;

                var ui = $.summernote.ui;

                // create button
                var button = ui.button({
                    contents: '<i class="fa fa-photo"/>',
                    tooltip: 'File Manager',
                    click: function() {
                        $('.sn-filemanager').trigger('click');
                    }
                });

                return button.render();
            }

            $('.rte').summernote({
                height: 250,
                minHeight: 100,
                maxHeight: 300,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'hr']],
                    ['image', ['fm']],
                    ['video', ['video']],
                    ['misc', ['fullscreen', 'codeview']]
                ],
                buttons: {
                    fm: fileManager
                }
            });

            $('.sn-filemanager').fancybox({
                type : 'iframe',
                afterClose: function() {
                    var snfmImage = $('#snfmImage-thumb').find('img').attr('src');
                    snfmContext.invoke('editor.insertImage', snfmImage, snfmImage.substr(snfmImage.lastIndexOf('/') + 1));
                }
            });
            // end summernote

            $('#dataTableBuilder').wrap('<div class="table-responsive col-md-12"></div>');

            $('.filemanager').fancybox({
                type : 'iframe'
            });

            $(".select2").select2();

            $(".multi-select").multiSelect({
                selectableHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='Search...'>",
                selectionHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='Search...'>",
                afterInit: function(ms){
                    var that = this,
                        $selectableSearch = that.$selectableUl.prev(),
                        $selectionSearch = that.$selectionUl.prev(),
                        selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
                        selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

                    that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                    .on('keydown', function(e){
                        if (e.which === 40){
                            that.$selectableUl.focus();
                            return false;
                        }
                    });

                    that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                    .on('keydown', function(e){
                        if (e.which == 40){
                            that.$selectionUl.focus();
                            return false;
                        }
                    });
                },
                afterSelect: function(){
                    this.qs1.cache();
                    this.qs2.cache();
                },
                afterDeselect: function(){
                    this.qs1.cache();
                    this.qs2.cache();
                }
            });

            $(".date").datepicker({
                format:	'yyyy-mm-dd'
            });

            $(".datetime").datetimepicker({
                format:	'YYYY-MM-DDTHH:mm:ss.XZ'
            });

            $(".currency").inputmask({ alias : "currency", prefix: "", digits: 0 });

            $('#filer_input').fileuploader({
                enableApi: true,
                maxSize: 10,
                extensions: ["jpg", "png", "jpeg"],
                captions: {
                    feedback: 'Upload foto',
                    button: '+ Foto Album'
                },
                showThumbs: true,
                addMore: true,
                allowDuplicates: false,
                onRemove: function (data, el) {
                    albumDeleted.push(data.data.album);
                }
            });

            $(document).on('click', '.file-item .fa-trash', function() {
                $(this).parents('.file-item').remove();
                $('#album-thumb').append('<input type="hidden" name="deleteFiles[]" value="' + $(this).data('identity') + '" />');
            });

            $(document).on('change', 'input[name="title"]', function() {
                $('input[name="slug"]').val(stringToSlug($(this).val()));
            });

            $('.album-manager').on('click', 'button', function(e) {
                e.preventDefault();

                $('#album-thumb').append('' +
                '<div class="file-item">' +
                '<div class="col-md-3 col-sm-3 col-xs-3"><img src="http://img.youtube.com/vi/' + $('#album').val() + '/mqdefault.jpg" style="width:100%"></div>' +
                '<div class="col-md-8" col-sm-8 col-xs-8" style="overflow-x:auto">' + $('#album').val() + '</div>' +
                '<div class="col-md-1" col-sm-1 col-xs-1"><span class="fa fa-trash" style="cursor:pointer;color:red"></span></div>' +
                '<div class="clearfix"></div>' +
                '<input type="hidden" name="files[]" value="' + $('#album').val() + '" />' +
                '</div>');

                $('#album').val('');
            });

            var stringToSlug = function (str) {
                str = str.replace(/^\s+|\s+$/g, ''); // trim
                str = str.toLowerCase();

                // remove accents, swap ñ for n, etc
                var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
                var to   = "aaaaeeeeiiiioooouuuunc------";

                for(var i=0, l=from.length ; i<l ; i++) {
                    str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
                }

                str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                    .replace(/\s+/g, '-') // collapse whitespace and replace by -
                    .replace(/-+/g, '-'); // collapse dashes

                return str;
            }
        });

        // filemanager auto run when close fancybox, after select file and then insert image thumbnail
        var OnMessage = function(data){
            if(data.appendId == 'album') {
                $('#' + data.appendId + '-thumb').append('' +
                '<div class="file-item">' +
                '<div class="col-md-3 col-sm-3 col-xs-3"><img src="' + data.thumb + '" style="width:100%"></div>' +
                '<div class="col-md-8" col-sm-8 col-xs-8" style="overflow-x:auto">' + data.thumb + '</div>' +
                '<div class="col-md-1" col-sm-1 col-xs-1"><span class="fa fa-trash" style="cursor:pointer;color:red"></span></div>' +
                '<div class="clearfix"></div>' +
                '<input type="hidden" name="files[]" value="' + data.thumb + '" />' +
                '</div>');
            } else {
                $('#' + data.appendId + '-thumb').html('<img src="' + data.thumb + '" style="width:100%">');
            }
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

    @yield('scripts')
</body>
</html>

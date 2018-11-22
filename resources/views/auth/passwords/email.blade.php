<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ isset($appName) ? $appName : 'Webcore' }}</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/bootstrap/css/bootstrap.min.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins//font-awesome/css/font-awesome.min.css') }}">

    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/ionicons/v2/css/ionicons.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/AdminLTE.min.css') }}">

    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/iCheck/square/_all.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="{{ asset('vendor/adminlte/plugins/html5shiv/html5shiv.min.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/plugins/respond/respond.min.js') }}"></script>
    <![endif]-->

</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="{{ url('/home') }}">{{ isset($appName) ? $appName : 'Webcore' }}</a>
    </div>

    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Enter Email to reset password</p>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="post" action="{{ url('/password/email') }}">
            {!! csrf_field() !!}

            <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('email'))
                    <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>

            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary pull-right">
                        <i class="fa fa-btn fa-envelope"></i> Send Password Reset Link
                    </button>
                </div>
            </div>

        </form>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<script src="{{ asset('vendor/adminlte/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('vendor/adminlte/dist/js/app.min.js') }}"></script>
</body>
</html>

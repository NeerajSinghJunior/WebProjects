@php $settings = DB::table('admins')->select('site_title', 'site_logo', 'fav_ico')->first(); @endphp 
@extends('adminlte::layouts.auth')

@section('htmlheader_title')
    Password recovery
@endsection

@section('content')

<body class="login-page">
    <div id="app">

        <div class="login-box">
        

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> {{ trans('adminlte_lang::message.someproblems') }}<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="login-box-body row">
            <div class="left col-md-6 col-sm-6 col-xs-12">
                    <a href="{{ url('/home') }}"><img class="login-logo" src="{{$settings->site_logo}}"></a>
                    <h5>Reset Password</h5>
                    <p>Please enter the details to reset to your account.</p>
                    <br><br>
                    <p>Don't have an account?</p>
                    <a class="link" href="{{ url('/register') }}">Create New Account</a>
                </div>

                <div class="right col-md-6 col-sm-6 col-xs-12">


            <email-reset-password-form></email-reset-password-form>
            <br>

            <p>Already have an account? <a href="{{ url('/login') }}">Log in.</a></p><br>
        </div>

        </div><!-- /.login-box-body -->

    </div><!-- /.login-box -->
    </div>

    @include('adminlte::layouts.partials.scripts_auth')

    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
</body>

@endsection

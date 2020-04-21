@extends('adminlte::layouts.auth') @section('htmlheader_title') {{$settings->site_title}} @endsection @section('content')
<script src='https://www.google.com/recaptcha/api.js'></script>
<!-- <script src='https://www.google.com/recaptcha/api.js'></script> -->

<body class="hold-transition login-page">
    <div id="app" v-cloak>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> {{ trans('adminlte_lang::message.someproblems') }}
                <br>
                <br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        <div class="login-box">
           
            <!-- /.login-logo -->
            
            <div class="login-box-body row">

                <div class="left col-md-6 col-sm-6 col-xs-12">

               


                   <!--  <a href="{{ url('/home') }}"><img class="login-logo" src="{{$settings->site_logo}}"></a> -->
                    <h5>Log in to your dashboard</h5>
                    <p>Good things are coming your way</p>
                    <br><br>
                    <!-- <p>Don't have an account?</p>
                    <a class="link" href="{{ url('/register') }}">Create New Account</a> -->
                </div>

                <div class="right col-md-6 col-sm-6 col-xs-12">

                <!-- <login-form name="{{ config('auth.providers.users.field','email') }}"
                    domain="{{ config('auth.defaults.domain','') }}"
                

                    </login-form> -->
                <form method="post">
                    <div id="result" class="alert alert-success text-center" style="display: none;"> Logged in! <i class="fa fa-refresh fa-spin"></i> Entering...</div>
                    <div class="form-group has-feedback">
                        @csrf
                        <input type="email" placeholder="Email" name="email" value="" autofocus="autofocus" class="form-control"> <span class="glyphicon form-control-feedback glyphicon-envelope"></span>
                        <!---->
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" placeholder="Password" name="password" value="" class="form-control"> <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        <!---->
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember me
                                    </label>
                                </div>
                            </div>
                        </div>
                      
                        @if(isset($settings) && $settings->captcha_key != '')
                          
                        <div class="col-md-12 captcha-box">
                            <div name="recaptcha" class="g-recaptcha recaptcha-otr " data-sitekey="{{ $settings->captcha_key }}">
                            </div>
                        </div>
                        @endif
                        <div class="captcha-btm col-md-12">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                            <a href="{{route('oauth_social','google')}}" class="btn btn-primary btn-block btn-social btn-google">Sign In With Google</a>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <br>
                    <div class="col-md-12">
                        <a href="{{ url('/password/reset') }}">{{ trans('adminlte_lang::message.forgotpassword') }}</a>
                        <a class="link pull-right" href="{{ url('/register') }}">Create New Account</a>
                    </div>
                </div>
                </div>
                
            </div>
        </div>
    </div>
    @include('adminlte::layouts.partials.scripts_auth')
</body>
@endsection
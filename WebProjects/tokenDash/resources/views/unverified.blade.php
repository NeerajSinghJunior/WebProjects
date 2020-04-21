@php
    $settings = DB::table('admins')->select('site_title', 'site_logo', 'fav_ico')->first();
@endphp
@extends('vendor.adminlte.layouts.auth')

@section('htmlheader_title')
    Verify Email
@endsection

@section('content')
<body class="hold-transition login-page">
    <div id="app" v-cloak>
        <div class="login-box">
            <div class="login-logo">
                <!-- <a href="{{ url('/home') }}"><b>ICODashcoin</b> ICO</a> -->
                <a href="{{ url('/home') }}"><img src="{{asset($settings->site_logo)}}" width="270"></a>
            </div><!-- /.login-logo -->

            <div class="unverified-box">
                <p class="login-box-msg">Please verify your mail address to proceed.</p>

                <!-- <a href="{{ url('/login') }}">{{ trans('adminlte_lang::message.membership') }}</a><br>
                <a href="{{ url('/password/reset') }}">{{ trans('adminlte_lang::message.forgotpassword') }}</a><br>
                <a href="{{ url('/register') }}" class="text-center">{{ trans('adminlte_lang::message.registermember') }}</a> -->
            </div>
        </div>
    </div>
    @include('adminlte::layouts.partials.scripts_auth')
</body>

@endsection

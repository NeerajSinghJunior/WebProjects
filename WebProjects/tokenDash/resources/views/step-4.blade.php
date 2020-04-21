@extends('layouts.app')

@section('htmlheader_title')
Thank You
@endsection

@section('contentheader_title')
@endsection

@section('styles')
<style type="text/css">
    .box-coin-cover.outer-box {
        position: relative;
        background-size: cover;
        background-position: center center;
    }
    .box-coin-cover.outer-box:before {
        display: block;
        content: " ";
        width: 100%;
        padding-top: 56.25%;/* Aspect ratio 16:9 */
    }
    .box-coin-cover.outer-box > .inner-content {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
    }
</style>
@endsection

@section('main-content')
<section class="content">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
            <h2 class="text-center"><strong>Thank You!!!</strong></h2>
        </div>
        
        <div class="col-md-2 col-sm-2 col-xs-12">
        </div>
        <div class="pad margin no-print col-md-8 col-sm-8 col-xs-12">
            <div class="callout callout-info text-center" style="margin-bottom: 0!important;">
                    <p>- Thank you for purchasing. We will get back to you for verification.</p>
                    <p>We appreciate your interest in our ICO.</p>
                    <p>We will verify your payment and transfer the respective coins to your wallet.</p>
                    <p>Incase of any questions, you can contact us using the 'Contact' link in the footer.</p>
            </div>
        </div>
        <div class="col-md-2 col-sm-2 col-xs-12">
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
            <a href="{{ route('home') }}" class="btn btn-primary"><b>Back to Dashboard</b></a>
            <a href="{{ route('notifications') }}" class="btn btn-primary"><b> Check out all our Notifications </b></a>
            <a href="{{ route('transactions') }}" class="btn btn-primary"><b> Goto transactions </b></a>
        </div>
    </div>
</section>
@endsection

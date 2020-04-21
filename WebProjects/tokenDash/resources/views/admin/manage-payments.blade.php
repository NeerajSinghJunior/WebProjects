@extends('admin.layouts.app') @section('site_tile',auth()->user()->site_title) @section('content')
<style type="text/css">
    .border{
        border: 1px solid grey;
        padding: 25px;
    }
</style>
<div class="page-wrapper">
    <!-- Bread crumb -->
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h3 class="text-primary">Token Delivery Method</h3> 
            <p>Choose a method through which the tokens would be delivered to those who purchase.</p>
        </div>
    </div>

    @include('admin/partials/error') @include('admin/partials/success') @include('admin/partials/session-error')

    <div id="error-div"></div>
    <!-- End Bread crumb -->
    <!-- Container fluid  -->
    <div class="container-fluid">
        <!-- Start Page Content -->
        <form name="cookies" action="{{route('admin.store_payments_methods')}}" action="POST">
           
           
            <input type="hidden" name="_token" value="{{csrf_token()}}">
        

        <div class="checkbox pb-list">
            <span>Choose a Token delivery method</span>
            <br>
            <br>
            
            
            <label class="border">
                <input type="checkbox" name="type[]" value="1" @if($semi==1) checked @endif class="inherit">&nbsp;Semi-Automatic &nbsp;&nbsp; <i class="fa fa-btc"></i>&nbsp;&nbsp;<i class="fa fa-paypal"></i>&nbsp;&nbsp;<i class="fa fa-bank"></i>
                
                <p>Supports bitcoins, altcoins, paypal, bank transfer payment. You will have to manually verify each transaction on the coin request page and then send the tokens from there.</p>
                </label>
            <label class="border">
                <input type="checkbox" @if($automatic==1) checked @endif name="type[]" value="2" class="inherit">&nbsp;Automatic &nbsp;&nbsp; <i class="fa fa-cc-stripe"></i>&nbsp;&nbsp;<i class="fa fa-paypal"></i>
                
                <p>Only supports paypal and stripe, tokens would be sent automatically as soon as the transaction is successfully completed.</p></label>
        </div>
        <br>
        <button type="submit" class="btn btn-success">Submit</button>
</form>
        <!-- End PAge Content -->
    </div>
    <!-- End Container fluid  -->
    <!-- footer -->

    {{-- @include('layouts.partials.footer') --}}
    <!-- End footer -->
</div>
<script>


    </script>
@endsection 
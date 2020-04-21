@extends('admin.layouts.app')
@section('site_tile','ICODash')
@section('content')
<div class="page-wrapper">
    <!-- Bread crumb -->
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h3 class="text-primary">GDPR Settings</h3> </div>
    </div>

    @include('admin/partials/error') @include('admin/partials/success') @include('admin/partials/session-error')

    <div id="error-div"></div>
    <!-- End Bread crumb -->
    <!-- Container fluid  -->
    <div class="container-fluid">
         <div class="row page-inner">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-title">
                        <h4>GDPR Settings</h4>
                        <p>As required by law, GDPR compliance is mandatory for sites to operate in the EU region.</p>
                    </div>
                      <div class="card-body">
                        <div class="basic-form">
                                <!-- Start Page Content -->
                                <form name="cookies" action="{{route('admin.store_cookies')}}" action="POST">
                                    <!-- {{csrf_token()}} -->
                                    <input type="hidden" name="id" value="{{isset($data->id)?$data->id:''}}">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="form-group">
                                    <label>Enter the GDPR legal compliance text that is required by the EU regulation</label>
                                    <textarea name="message" class="form-control" placeholder="GDPR compliance text that will appear on the user side">{{isset($data->message)?$data->message:''}}</textarea>
                                </div>

                                <div class="checkbox pb-list">
                                    {{-- <span>GDPR compliance text that will appear on the user side</span> --}}
                                    <br>
                                    <?php 
                                    $value=isset($data->action)?$data->action:'';
                                    ?>
                                    <label>
                                        <input type="radio" @if($value==1) checked @endif name="action" value="1" class="inherit">&nbsp;Enable
                                        <input type="radio" name="action" value="0" @if($value==0) checked @endif class="inherit">&nbsp;Disable</label>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                     </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
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
@extends('admin.layouts.app')

@section('content')
<div class="page-wrapper">
    <!-- Bread crumb -->
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h3 class="text-primary">Create Token</h3>
        </div>
    </div>
   
    @include('admin/partials/error')
    @include('admin/partials/success')
    <!-- End Bread crumb -->
    <!-- Container fluid  -->
    <div class="container-fluid">
        <!-- Start Page Content -->
        <!-- <div class="row page-inner"> -->
            <!-- <div class="col-12"> -->
               <!--  <div class="card">
                    <div class="card-body" style="height: 580px;"> -->
                        <div class="table-responsive" style="height: 100%;overflow-y: hidden;text-align: center;">       
                        <iframe src="http://assetplatform.net" id="" class="" allowtransparency="true" scrolling="auto" style="width: 81%;height: 580px;overflow: hidden !important;;border:solid 2px #ccc;"></iframe>
                        </div>
                  <!--   </div>
                </div> -->

            <!-- </div> -->
        <!-- </div> -->
        <!-- End PAge Content -->
    </div>
    <!-- End Container fluid  -->
    <!-- footer -->    
    @include('layouts.partials.footer')
    <!-- End footer -->
</div>
@endsection
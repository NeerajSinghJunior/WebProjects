@extends('admin.layouts.app')
@section('site_tile',auth()->user()->site_title)
@section('content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<style type="text/css">
   #tbl_mdl td{
   color: black!important;
   text-align: left;
   align-content: center;
   }
   #tbl_mdl td:nth-child(odd) {background-color: #f2f2f2;}
   .fade-scale {
   transform: scale(0);
   opacity: 0;
   -webkit-transition: all .25s linear;
   -o-transition: all .25s linear;
   transition: all .25s linear;
   }
   .fade-scale.in {
   opacity: 1;
   transform: scale(1);
   }
</style>
<div class="page-wrapper">
<!-- Bread crumb -->
<div class="row page-titles">
   <div class="col-md-12 align-self-center">
      <h3 class="text-primary"> Shareholder voting </h3>
   </div>
</div>
@include('admin/partials/error')
@include('admin/partials/success')
@include('admin/partials/session-error')
<div id="error-div"></div>
<!-- End Bread crumb -->
<!-- Container fluid  -->
<div class="container-fluid">
   <!-- Start Page Content -->
   <div class="row page-inner">
      <div class="col-lg-12">
         <div class="">
            <div class="card">
               <h4 class="card-title">Shareholder voting</h4>
               <p>Get to know what your shareholders/investors think about the next course of action for your company or make important decisions based on their feedback.</p>
               <p>Signup on <a href="https://surveymethods.com/" style="color: #4680ff;font-weight: bold">surveymethods.com</a> and manage all your questions on their admin panel. Here you can add the Credentials and the API to activate Voting panel for the user. Only the latest question will appear on the user side for them to vote.</p>

            <div class="table-responsive m-t-40">
               <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th width="10%">Date</th>
                        <th width="25%">Title</th>
                        <th width="10%">Url</th>
                        <th>Status</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tfoot>
                     <tr>
                        <th>#</th>
                        <th width="10%">Date</th>
                        <th width="20%">Title</th>
                        <th width="10%">Url</th>
                        <th>Status</th>
                        <th>Action</th>
                     </tr>
                  </tfoot>
                  <tbody>
                     @foreach($data as $key => $d)
                     <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $d->date }}</td>
                        <td>{{ $d->survey_title }}</td>
                        <td>{{$d->url}}</td>
                        <td>{{$d->status}}</td>
                        <td>
                           <center>  
                           @if($d->action==1)
                           <a class="label label-primary disabled" ><b style="color: white!important">Enabled</b></a>
                           <br>
                            <a class="label label-danger" href="{{URL('/')}}/admin/enable_survey/{{$d->id}}/0"><b style="color: white!important">Didable Now</b></a>
                           @else
                           <a class="label label-danger disabled"  ><b style="color: white!important">Disabled</b></a>
                           <br>
                            <a class="label label-primary"  href="{{URL('/')}}/admin/enable_survey/{{$d->id}}/1" ><b style="color: white!important">Enable Now</b></a>

                           @endif
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
       </div>
         </div>
      </div>
   </div>
</div>
</div>
 @endsection
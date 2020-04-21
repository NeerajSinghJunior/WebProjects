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
      <h3 class="text-primary"> Shareholder voting Settings </h3>
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
         <div class="card">

             <h4 class="card-title">Shareholder voting</h4>
               <p>Get to know what your shareholders/investors think about the next course of action for your company or make important decisions based on their feedback.</p>
               <p>Signup on <a href="https://surveymethods.com/" style="color: #4680ff;font-weight: bold">surveymethods.com</a> and manage all your questions on their admin panel. Here you can add the Credentials and the API to activate Voting panel for the user. Only the latest question will appear on the user side for them to vote.</p><br>


             <div class="">
            <form name="filter_exp_date" method="post" action="{{route('admin.save_survey_settings')}}">
               <input type="hidden" name="_token" value="{{csrf_token()}}"> 
               <div class="form-group ">
                 LOGIN ID
                  <input type="text"  name="survey_login_id" placeholder="Survey Login id " value="{{$admin->survey_login_id}}" id="from_date_fld"  class="form-control">
               </div>
               <div class="form-group ">
                  API KEY
                  <input type="text"  name="survey_api_key" placeholder="Survey Api Key" value="{{$admin->survey_api_key}}" class="form-control datepicker" id="to_date_fld" value="{{isset($to_date)?$to_date:''}}">
               </div>
               <div class="checkbox pb-list">
                  Enable / Disable
                  <label><input type="radio" name="survey_action" @if($admin->survey_action==1) checked @endif value="1"> Enable </label>
                  <label><input type="radio" name="survey_action" @if($admin->survey_action==0) checked @endif value="0"> Disable </label>
               </div>
               

               <div class="form-group ">
                
                  <button type='submit' class="btn btn-info">Save</button> 
                  
               </div>
               
            </form>

</div>
      </div>
   </div>
</div>
</div>
 @endsection
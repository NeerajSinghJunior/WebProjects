@extends('layouts.app')

@section('htmlheader_title')
Shareholder Voting 
@endsection

@section('contentheader_title')
Shareholder Voting 
@endsection

@section('main-content')
@include('admin/partials/error')
@include('admin/partials/success')
<style type="text/css">


#ScrolledArea {
        width: 100%;
        height:70vh;
        overflow: scroll;
        white-space: nowrap;
        background: #ffff;
    }
</style>




<section class="content">
    <div class="box box-primary">
      
    <div class="box-body">
       <p>Have your say! 
    The holders of the Token Offering would like to invite you to get your opinion on important matters that concern the future of the company. Vote Now.</p>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
            <div class="box box-primary">
            	  @if($data!="")
                
                    <iframe src='{{$data->url}}' id="ScrolledArea" class=""  allowtransparency="true" Scrolling='auto' ></iframe>

                @endif
            </div>
        </div>
        </div>
        </div>
        </div>
</section>

@endsection
@extends('layouts.app')

@section('htmlheader_title')
    Survey List
@endsection

@section('contentheader_title')
    Survey List
   
@endsection
<style type="text/css">
.data-btn {
    position: relative;
    left: 0;
    align-content: center;
    bottom: -82px;

    background-color: #fff;
    color: white;
    text-align: center;
}
.btn-view{
    background-color: #409843!important;
    border-radius: 5px!important;
    padding:4px!important;
    width: 33%!important;
    color: white!important;
    font-weight: bold!important;
   
}
.box_survey{
  display: inline-block;
  min-height: 180px;
  min-width: 320px;
  border-radius: 5px;
  background-color: #fff;
  box-shadow: 0 1px 2px rgba(0,0,0,0.15);
  transition: all 0.3s ease-in-out;
  padding: 10px;
  margin-top: 5px;

}
.box_survey:::after {
  z-index: -1;
  min-height: 180px;
  min-width: 320px;
  opacity: 0;
  border-radius: 5px;
  box-shadow: 0 5px 15px rgba(0,0,0,0.3);
  transition: opacity 0.3s ease-in-out;

}
.btn-view:hover{
    color: white!important;
    font-weight: bold!important;
}

.box_survey:hover {
  transform: scale(1.1, 1.1);
}



</style>
@section('main-content')
    @include('admin/partials/error')
    @include('admin/partials/success')
    <div id="error-div" style="display:none;">
        <div class="alert alert-danger alert-dismissible">
            <ul>
                <li>
                    <p id="error_text"></p>
                </li>
            </ul>
        </div>
    </div>
    <section class="content">
    <div class="row">
            <div class="box box-primary">
                @if(count($data)!=0)
                @foreach($data as $survey)
                <div class="col-md-4 ">
                    <div class="box_survey"  style="">
                        <div class="data">
                            <br>
                            <center><p><b>{{$survey->survey_title}}</b></p></center>
                        </div>
                        <div class="data-btn">
                          <a href="{{URL('/')}}/single_survey/{{$survey->id}}"  class="btn btn-view">View</a> 
                        </div>
                                
                            </p>
                            
                    </div>
               </div>
               @endforeach  
               @else

               <div class="alert flat">
              <center><b>No Survey Found.</b> </center>
        </div>
               @endif
           </div>
       </div>
   </section>

@endsection
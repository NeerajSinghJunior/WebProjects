
<!DOCTYPE html>
<html lang="en">

@section('htmlheader')
    @include('layouts.partials.htmlheader')
@show
<style type="text/css">
  .cookie-btn{
    background-color: transparent;
    padding: 1px 35px;
    border: none;
    /*border: 1px solid white;*/
    border-radius: 5px;
    height: 21px;
}
#cookie-id{
   position: fixed;
  bottom: -70px;
  margin-right: auto;
  margin-left: auto;
  left: 0px;
  right: 0px;
  z-index: 25000;
   width:100%;
   height:125px;
   background-color: rgba(0, 0, 0, 0.7);

}
 #topcorner{
   position:fixed;
  top: 70px;
  z-index: 350;
  right:35px;
  }
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
.active_menu{
  background-color: #46b378!important;
  font-weight: bold;
  color:white;

}
.active_sub_menu{
  color: #46b378 !important;
  font-weight: bold;
}




</style>
<body class="skin-blue sidebar-mini">
<div id="app" v-cloak>
    <div class="wrapper">

    @include('layouts.partials.mainheader')

    @include('layouts.partials.sidebar')
    @include('layouts.message')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    @php
        $steps = DB::table('progress_bar')->where('status', 1)->get();
        $cookies = DB::table('cookies')->first();
        $users = DB::table('users')->where('id',Auth::user()->id)->first();
        if(Session::get('is_cookie')!= 2 && Session::get('is_cookie')=="")
        Session::put('is_cookie',$users->is_accept_cookie);
    
    @endphp
    
    @if(Request::path() != 'dividend_dashboard' && Request::path() != 'dividend_payment' && Request::path() != 'expense')
    <div class="row wizard-progress-outer">
            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                <img src="/images/loader.apng" width="70" height="70" /> <strong class="load-ht" style="color:black!important">TOKEN OFFERING PROGRESS</strong>
             <!--    <h4 class="box-title"><strong>ICO Progress</strong></h4> -->
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="wizard-progress">
                    @foreach($steps as $key => $step)
                    <div class="step {{$step->is_completed ? 'complete': ''}}">
                        {{$step->title}}
                        <div class="node"><span class="tooltip" title="{{$step->hint}}"></span></div>
                        <span class="date">{{$step->progress_bar_date}}</span>
                        @if(Session::get('upcomming_date')==$step->progress_bar_date)
                      Token Price {{ Session::get('upcomming_coin_price')}}
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
        @if(Session::has('notify_message'))
      <div class="alert alert-success" id="topcorner">
    <a href="#" class="close" id="close_alert" aria-label="close" >&times;</a>
    <strong><i class="fa fa-info-circle"></i>  &nbsp;</strong> {{Session::get('notify_message')}} &nbsp;&nbsp;&nbsp;
</div>
@endif
        @include('layouts.partials.contentheader')

        <!-- Main content -->
        <section class="content">
            <!-- Your Page Content Here -->
            @if(Session::get('is_cookie')== 0 && Session::get('is_cookie')!= 2 && $cookies->action==1)
            <div class="transaction-detail-box" id="cookie-id" style="">
                <svg style="width:32px;height:14px;font-size: 30px;" viewBox="0 0 24 24">
                    <path fill="#ffffff" d="M15,4A8,8 0 0,1 23,12A8,8 0 0,1 15,20A8,8 0 0,1 7,12A8,8 0 0,1 15,4M15,18A6,6 0 0,0 21,12A6,6 0 0,0 15,6A6,6 0 0,0 9,12A6,6 0 0,0 15,18M3,12C3,14.61 4.67,16.83 7,17.65V19.74C3.55,18.85 1,15.73 1,12C1,8.27 3.55,5.15 7,4.26V6.35C4.67,7.17 3,9.39 3,12Z"></path>
                </svg>
            <div class="data">
                <!-- <p class="lead">Allow to access cookies? </p> -->
                <p>{{$cookies->message}}  <button style="float:right;margin-right:100px;background-color: #f55151"  value="2" id="deny" class="cookie-btn">Deny</button>
                <button style="float:right;margin-right:20px;background-color: #3cd242" id="allow" value="1" class="cookie-btn">Allow Cookies</button>  </i></b></p> 
               
            </div>
        </div>
        @endif

            @yield('main-content')
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    @include('layouts.partials.footer')

</div><!-- ./wrapper -->
</div>




@section('scripts')
    @include('layouts.partials.scripts')
@show

@yield('extra-scripts')
<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js'></script>
<script src="{{ asset('/adassets/js/lib/bootstrap/js/bootstrap.min.js') }}"></script>
<script type='text/javascript' src='https://unpkg.com/popper.js/dist/umd/popper.min.js'></script>
<script type='text/javascript' src='https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js'></script>
<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.1/js/froala_editor.min.js'></script>

<script src="{{ asset('/js/carousel.js') }}"></script>
<script src="{{ asset('/js/tooltipster.bundle.min.js') }}"></script>

  <script>
        $(document).ready(function() {
            $('.tooltip').tooltipster({
              side: 'bottom',
              theme: 'tooltipster-shadow',
              maxWidth:'300'
            });
            console.log("coming");
            $('.control-sidebar-dark').addClass('display','none !important');  
        });
    </script>
    <script type="text/javascript">
    $('#deny,#allow').click(function(){

        var status=$(this).val();
      var url='{{url("/")}}/update-cookies?status='+status;
        console.log(url);

        $.ajax({
        type:'GET',
        url:url,
        success:function(status) {  
        console.log("Request = ",status); 
        if(status==1){
            $('#cookie-id').hide();
        }else{
            $('#cookie-id').hide();
        }
        },
        error:function(err) {
           // alert('Something went wrong. Please check.')
           }
     });

    });
     $('#close_alert').click(function(){
     var url='{{url("/")}}/update-alert';
        console.log(url);

        $.ajax({
        type:'GET',
        url:url,
        success:function(status) {  
        console.log("Request = ",status); 
        if(status==1){
            $('#topcorner').hide();
        }else{
            $('#topcorner').hide();
        }
        },
        error:function(err) {
           // alert('Something went wrong. Please check.')
           }
     });
   });


    </script>

<script>
    jQuery(document).ready(function($) {
      $('.rio-promos').slick({
        dots: false,
        infinite: true,
        speed: 500,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        arrows: true,
        responsive: [{
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        },
        {
           breakpoint: 400,
           settings: {
              arrows: false,
              slidesToShow: 1,
              slidesToScroll: 1
           }
        }]
    });
});
$(document).ready(function(){

    $('[data-toggle="tooltip"]').tooltip(); 
    
});
</script>
@yield('bottom-scripts')
</body>
</html>

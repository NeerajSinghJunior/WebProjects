@php
    $settings = DB::table('admins')->select('site_title', 'site_logo','transaction_hash', 'contract_abi','contract_address','selling_coin_name', 'contract_network','fav_ico')->first();
    $ABI = str_replace('&quot;','"',$settings->contract_abi);
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <script>
        @if($settings->contract_abi)
        ABI = JSON.parse('{{$ABI}}'.replace(/&quot;/g, '"'));
        console.log(ABI)
        @else
        ABI = [];
        @endif;
        CONTRACT_ADDRESS = '{{$settings->contract_address}}';
        TRANSACTION_HASH = '{{$settings->transaction_hash}}';
        NETWORK = '{{$settings->contract_network}}';
        CONTRACT_NAME = '{{$settings->selling_coin_name}}';
    </script>
    <style>
        .card-val{
                color: #000000 !important;        
                font-size: 35px !important;        
                font-weight: bolder !important;        
                text-align: center !important;   
            }
        .table-responsive {    overflow-x: hidden !important;  }
        div#ui-datepicker-div {
    background-color: white;
    padding: 10px;
    border: 1px solid #ddd;
        width: 200px;
}
a.ui-datepicker-next.ui-corner-all {
    border: 1px solid grey;
    padding: 0px;
    border-radius: 5px;
    padding-left: 8px;
    padding-right: 8px;
    cursor: pointer;
}
a.ui-datepicker-prev.ui-corner-all {
    float: right;
    border: 1px solid grey;
    padding: 0px;
    border-radius: 5px;
    padding-left: 8px;
    padding-right: 8px;
    cursor: pointer;
}
.ui-datepicker-title {
    text-align: center;
    padding-top: 10px;
    padding-bottom: 10px;
}
td.ui-datepicker-current-day {
    background-color: #577bd7;
    text-align: center;
    border-radius: 12px;
}
a.ui-state-default.ui-state-active {
    text-align: center;
    color: white;
}
table.ui-datepicker-calendar {
    width: 100%;
}

    </style>
    <script src="{{ asset('test/app.js') }}"></script>


    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->

      <script src="{{ asset('js/jquery.min.js')}}"></script>
      <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.datetimepicker.min.css')}}"/>
    <script src="{{ asset('js/jquery.datetimepicker.js')}}"></script>

        <!-- <link href="{{ asset('/adassets/css/datepicker.css') }}"> -->
    <link rel="icon" href="{{asset('storage/'.$settings->fav_ico)}}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{asset('storage/'.$settings->fav_ico)}}" type="image/x-icon" />
    <title>@yield('site_tile', $settings->site_title)</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('/adassets/css/lib/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('/adassets/css/helper.css') }}" rel="stylesheet">
    <link href="{{ asset('/adassets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.loading.css') }}">
<!--
      <link href="{{ asset('css/pickadate.css') }}">
       <link href="{{ asset('css/jquery-ui.css') }}">-->



    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesnt work if you view the page via file:** -->
    <!--[if lt IE 9]>
    <script src="https:**oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https:**oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<style type="text/css">
::-webkit-input-placeholder { 
  color: #b8c2c7!important;

}
::-moz-placeholder { 
  color: #b8c2c7!important;
}
:-ms-input-placeholder {
  color: #b8c2c7!important;
}
:-moz-placeholder { 
  color: #b8c2c7!important;
}
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}

</style>
</head>

<body id ="loading_id" class="fix-header fix-sidebar"     style="margin-top: -23px;">
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>

    <div class="preloader" id="loader" style="display:block">
        <label>Loading ..</label>
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>

    <!-- Main wrapper  -->
    <div id="main-wrapper">
        <!-- header header  -->
        <div class="header">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- Logo -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="home.html">
                        <!-- Logo text -->
                        {{--<span>{{ config('app.name') }}</span>--}}

                        <span> <a href="#"><img src="{{asset($settings->site_logo)}}" width="200"></a></span>


                    </a>
                </div>
                <!-- End Logo -->
                <div class="navbar-collapse">
                    <!-- toggle and nav items -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted  " href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <!-- <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted  " href="javascript:void(0)"><i class="ti-menu"></i></a> </li> -->
                    </ul>
                    <!-- User profile and search -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- Profile -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>
                            <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                                <ul class="dropdown-user">
                                    <li><a href="{{ route('admin.account') }}"><i class="ti-user"></i> Account</a></li>
                                    <li>
                                        <a href="{{ url('admin/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fa fa-power-off"></i> Logout
                                        </a>
                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                            <input type="submit" value="logout" style="display: none;">
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div><br>
        <!-- End header header -->
        <!-- Left Sidebar  -->
        <div class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        {{-- <li class="nav-label">Home</li> --}}
                        <li>
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="fa fa-tachometer"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                          <li>
                            <a href="{{ route('admin.createToken') }}">
                                <i class="fa fa-ticket"></i>
                                <span> Create Token</span>
                            </a>
                        </li> 
                        <li>
                                <a href="{{ route('admin.home') }}">
                                    <i class="fa fa-btc"></i>
                                    <span>Token Requests</span>
                                </a>
                            </li>
                        <li>
                            <a href="{{ route('admin.user') }}">
                                <i class="fa fa-users"></i>
                                <span>Users</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.viewAllProgressBar') }}">
                                <i class='fa fa-barcode'></i> 
                                <span>Token Offering Status Bar</span>
                            </a>
                        </li>
                        <li>
                            <li>
                                <a href="#">
                                   <i class="fa fa-bar-chart"></i>
                                    Marketing suite &nbsp;&nbsp;&nbsp;<i class="fa fa-sort-desc" aria-hidden="true" style="margin-left: 75px;margin-top: -8px;"></i>
                                </a>
                                <ul class="menu-content">
                                    
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-envelope-o"></i>
                                            Mail Campaigns&nbsp;&nbsp;&nbsp;<i class="fa fa-sort-desc" aria-hidden="true" style="margin-left: 57px;margin-top: -8px;"></i>
                                        </a>
                                        <ul class="menu-content">
                                            <li>
                                                <a href="{{ route('admin.mail_events') }}">
                                                    <i class="fa fa-envelope"></i>
                                                    <span>Mail Campaigns</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('admin.mail') }}">
                                                    <i class="fa fa-inbox"></i>
                                                    <span>New Mail Campaign</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('admin.draft_mails') }}">
                                                    <i class="fa fa-bell"></i>
                                                    <span>Draft Mails</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                   <li>
                                        <a href="#">
                                            <i class="fa fa-comments"></i>
                                            SMS Campaigns&nbsp;&nbsp;&nbsp;<i class="fa fa-sort-desc" aria-hidden="true" style="margin-left: 57px;margin-top: -8px;"></i>
                                        </a>
                                        <ul class="menu-content">
                                            <li>
                                                <a href="{{ route('admin.sms_events') }}">
                                                    <i class="fa fa-send"></i>
                                                    <span>SMS Campaigns</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('admin.message') }}">
                                                    <i class="fa fa-commenting"></i>
                                                    <span>New SMS Campaign</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    
                                </ul>
                            </li>
                        </li>

                         <li>
                            <li>
                                <a href="#">
                                   <i class="fa fa-usd"></i>
                                    Income/Expense Ledger &nbsp;&nbsp;&nbsp;<i class="fa fa-sort-desc" aria-hidden="true" style="margin-left: 25px;margin-top: -8px;"></i>
                                </a>
                                <ul class="menu-content">
                                    
                                            <li>
                                                <a href="{{ route('admin.add_expense') }}">
                                                    <i class="fa fa-plus"></i>
                                                    <span>Add Expense</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('admin.expense') }}">
                                                    <i class="fa fa-money"></i>
                                                    <span>Expense & Income </span>
                                                </a>
                                            </li>
                                   
                                    
                                </ul>
                            </li>
                        </li>

                        <li>
                            <li>
                                <a href="#">
                                   <i class="fa fa-check"></i>
                                    Shareholder Voting &nbsp;&nbsp;&nbsp;<i class="fa fa-sort-desc" aria-hidden="true" style="margin-left: 53px;margin-top: -8px;"></i>
                                </a>
                                <ul class="menu-content">
                                    
                                            <!-- <li>
                                                <a href="{{ route('admin.survey_list') }}">
                                                    <i class="fa fa-list"></i>
                                                    <span>Voting List</span>
                                                </a>
                                            </li> -->
                                            <li>
                                                <a href="{{ route('admin.survey_settings') }}">
                                                    <i class="fa fa-gear"></i>
                                                    <span>Voting Settings </span>
                                                </a>
                                            </li>
                                   
                                    
                                </ul>
                            </li>
                        </li>

                        <!-- <li>
                             <a href="#" style="color:#007bff">
                            <i class='fa fa-barcode'></i> 
                            <span>Marketing suite</span>
                            </a>
                        </li>
                        <li>
                             <a href="#" style="color:#007bff">
                            <i class='fa fa-barcode'></i><span>Email Campaigns</span>
                            </a> 
                        </li>     -->                            
                       <li><a href="{{ route('admin.notifications') }}">
                                <i class="fa fa-bell"></i>
                                <span>Notifications</span>
                            </a></li> 
                       {{--  <li> 
                            <a href="{{ route('admin.draft_mails') }}">
                                <i class="fa fa-inbox"></i>
                                <span>Draft Mails</span>
                            </a>
                        </li> --}}
                        <!-- <li>
                            <a href="#" style="color:#007bff">
                                <i class='fa fa-barcode'></i>
                                <span>SMS Campaigns Status</span>
                            </a>
                        </li>   --> 
                        
                       
                        <li>
                            <a href="{{ route('admin.show_cookies_page') }}">
                                <i class="fa fa-signal"></i>
                                <span>GDPR settings</span>
                            </a>
                        </li>
                        <li> 
                            <a href="{{ route('admin.account') }}">
                                <i class="fa fa-gear"></i>
                                <span>System settings</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.manage-payments-type') }}">
                                <i class="fa fa-database"></i>
                                <span>Token delivery method</span>
                            </a>
                        </li>
                          

                        <li>
                            <a href="{{ route('admin.viewAllCms') }}">
                                <i class="fa fa-bars"></i>
                                <span> Footer Menu link</span>
                            </a>
                        </li>
                         <li>
                            <a href="{{ route('admin.viewReferrals') }}">
                                <i class="fa fa-retweet"></i>
                                <span> Referrals</span>
                            </a>
                        </li>
                        <li> 
                            <a href="#">
                                <i class="fa fa-percent"></i>
                                <span>Dividends</span>
                            </a>
                            <ul class="menu-content">
                                <li>
                                    <a href="{{ route('admin.dividendSettings') }}">
                                        <i class="fa fa-bar-chart"></i>
                                        <span>Dashboard</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.DividendPayouts') }}">
                                        <i class="fa fa-money"></i>
                                        <span>Dividend Payouts</span>
                                    </a>
                                </li>
                                {{-- <li>
                                    <a href="{{ route('admin.BankCodeMaster') }}">
                                        <i class="fa fa-gear"></i>
                                        <span>Bank Code Master</span>
                                    </a>
                                </li>  --}}                               
                            </ul>
                        </li>
                      
                      <!--   <li>
                            <a href="{{ route('admin.addon') }}">
                                <i class="fa fa-puzzle-piece"></i>
                                <span> Add-ons</span>
                            </a>
                        </li> -->
                        <li>
                            <a href="{{ route('admin.logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                <i class='fa fa-sign-out'></i>
                                <span>Logout</span>
                            </a>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                        
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </div>
        <!-- End Left Sidebar  -->
        <!-- Page wrapper  -->
        @yield('content')
        <!-- End Page wrapper  -->
    </div>
    <!-- End Wrapper -->
    <!-- All Jquery -->
    <script src="{{ asset('/adassets/js/lib/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/adassets/js/lib/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('/adassets/js/lib/bootstrap/js/popper.min.js') }}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('/adassets/js/jquery.slimscroll.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('/adassets/js/sidebarmenu.js') }}"></script>
    <!--stickey kit -->
    <script src="{{ asset('/adassets/js/lib/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('/adassets/js/custom.min.js') }}"></script>
    <script src="{{ asset('/adassets/js/lib/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('/adassets/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/adassets/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('/adassets/js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js') }}"></script>
    <script src="{{ asset('/adassets/js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('/adassets/js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('/adassets/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('/adassets/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('/adassets/js/lib/datatables/datatables-init.js') }}"></script>
    <script src="{{ asset('/js/jquery.loading.js') }}"></script>
    <script type="text/javascript">
         $( document ).ready(function() {
            $('.control-sidebar control-sidebar-dark').hide();
        }); 
    </script>
   

     <!-- <script src="{{ asset('/js/picker.js') }}"></script>
     <script src="{{ asset('/js/picker.date.js') }}"></script>
     <script src="{{ asset('/js/pick-a-datetime.js') }}"></script> -->

     {{--  <script src="{{ asset('/js/jquery.js') }}"></script> --}}
     <script src="{{ asset('/js/jquery-ui.js') }}"></script>
 
@yield('extra-scripts')

</body>

</html>
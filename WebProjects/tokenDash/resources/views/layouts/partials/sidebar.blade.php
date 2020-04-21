<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (!Auth::guest())
           {{--  <div class="user-panel">
                <div class="pull-left image">
                    <!-- <img src="{{asset('storage/'.Auth::user()->profile_picture)}}" class="img-circle" alt="User Image" /> -->
                    <div class="user-sidebar-img" style="background-image: url({{asset('storage/'.Auth::user()->profile_picture)}})"></div>
                </div>
               <div class="pull-left info">
                    
                    <!-- Status -->

                     <p>Balance : <b style="color:#fff" id="balance"></b></p>  

                </div>
            </div>--}}
        @endif
        @php
$settings = DB::table('settings')->where('param','expense_report_show_to_investor')->first();
@endphp
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
           
            <!-- Optionally, you can add icons to the links -->
            <li  class="{{ Request::is( 'home') ? 'active_menu' : '' }}"><a href="{{ url('home') }}"><i class='fa fa-dashboard'></i> <span>Dashboard</span></a></li>
            <li class="{{ Request::is( 'account') ? 'active_menu' : '' }}"><a href="{{ url('account') }}"><i class='fa fa-user'></i> <span>Account</span></a></li>
            <li class="{{ Request::is( 'viewKYCDetails') ? 'active_menu' : '' }}"><a href="{{ route('view_kyc_details') }}"><i class='fa fa-barcode'></i> <span>KYC / AML</span></a></li>
            @if(SURVEY_ACTION==1 )
            <li class="{{ Request::is( 'survey') ? 'active_menu' : '' }}"><a href="{{ url('survey') }}"><i class='fa fa-check'></i> <span>Shareholder Voting</span> @if(Session::get('survey_notify_count')!=0)<span style="float: right;" class="badge badge-light">{{Session::get('survey_notify_count')}}</span> @endif</a></li>
            @endif
            <li class="{{ Request::is( 'notifications') ? 'active_menu' : '' }}"><a href="{{ url('notifications') }}"><i class='fa fa-bell'></i> <span>Notification</span></a></li>
            <li class="{{ Request::is( 'transactions') ? 'active_menu' : '' }}"><a href="{{ url('transactions') }}"><i class='fa fa-money'></i> <span>Transactions</span></a></li>
            <li><a style="cursor:pointer;"><i class='fa fa-handshake-o'></i> <span style="width: 25px;">Investor Relations</span><i class='fa fa-caret-down' style="float: right;"></i></a></li>
            @if($settings->value==1)
             <li class="{{ Request::is( 'expense') ? 'active_menu' : '' }}"><a href="{{ url('expense') }}"><i class='fa fa-suitcase'></i><span style="width: 25px;">Company's Income/Expense</span></a></li>
            @endif

             <!-- <li class="dropdown-li">
                <a onclick="javascript:$('.dropdown-ul1').slideToggle('slow');" style="cursor:pointer;"><i class='fa fa-handshake-o'></i> <span style="width: 25px;">Investor Relations</span><i class='fa fa-caret-down' style="float: right;"></i></a>
                <ul class="dropdown-ul1" @if(Request::is( 'expense') ) style="display: block;background: #1e291f;padding: 10px 5px;" @else style="background: #344635;padding: 10px 5px;" @endif>
                     @if($settings->value==1)
                     <li style="padding: 10px 5px;list-style: none;"><a class="{{ Request::is( 'expense') ? 'active_sub_menu' : '' }}" href="{{ url('expense') }}"><i class='fa fa-suitcase'></i><span style="width: 25px;"> Income/Expense</span></a></li>
                    @endif
                </ul>

                <ul class="dropdown-ul1" style="background: #344635;list-style: none;">
                    <li style="padding: 10px 5px;list-style: none;"><a class=""><i class='fa fa-suitcase'></i><span style="width: 25px;"> Income/Expense</span><i class='fa fa-caret-down' style="float: right;width: 20px;"></i></a></li>
                     @if($settings->value==1)
                        <li style="padding: 10px 5px;list-style: none;" class="{{ Request::is( 'expense') ? '' : '' }}"><a href="{{ url('expense') }}"><i class='fa fa-money'></i> <span style="width: 25px;">Income/Expense Report</span></a></li>
                    @endif
                    @if(DIVIDEND_ACTIVE==1)
                        <li class="dropdown-li" style="padding: 10px 5px;">
                            <a onclick="javascript:$('.dropdown-ul').slideToggle('slow');" style="cursor:pointer;list-style:none !important;padding: 10px 5px;"><i class='fa fa-percent'></i> <span style="width: 25px;">Dividend</span><i class='fa fa-caret-down' style="float: right;width: 20px;"></i></a>

                            <ul class="dropdown-ul" @if(Request::is( 'dividend_dashboard') || Request::is('dividend_payment')) style="display: block;background: #1e291f;padding: 10px 5px;" @else style="background: #344635;padding: 10px 5px;" @endif>
                    
                                <li style="padding: 10px 5px;list-style: none;"><a class="{{ Request::is( 'dividend_dashboard') ? 'active_sub_menu' : '' }}" href="{{ url('dividend_dashboard') }}"><i class='fa fa-bar-chart'></i><span style="width: 25px;"> Dashboard</span></a></li>
                    
                                <li style="padding: 10px 5px;list-style: none;"><a class="{{ Request::is( 'dividend_payment') ? 'active_sub_menu' : '' }}" href="{{ url('dividend_payment') }}"><i class='fa fa-usd'></i><span style="width: 25px;"> Payment History</span></a></li>

                            </ul>
                        </li>
                    @endif
                </ul>
                </li> -->
                 @if(DIVIDEND_ACTIVE==1)
                 <li><a style="cursor:pointer;"><i class='fa fa-percent'></i> <span style="width: 25px;">Dividend</span><i class='fa fa-caret-down' style="float: right;width: 20px;"></i></a></li>
                 <li class="{{ Request::is( 'dividend_dashboard') ? 'active_menu' : '' }}"><a href="{{ url('dividend_dashboard') }}"><i class='fa fa-bar-chart'></i><span style="width: 25px;"> Dashboard</span></a></li>
                 <li class="{{ Request::is( 'dividend_payment') ? 'active_menu' : '' }}"><a href="{{ url('dividend_payment') }}"><i class='fa fa-usd'></i><span style="width: 25px;"> Payment History</span></a></li>
                 @endif
               
           <!--      @if(DIVIDEND_ACTIVE==1)
                  <li class="dropdown-li" style="padding: 10px 5px;">
                            <a onclick="javascript:$('.dropdown-ul').slideToggle('slow');" style="cursor:pointer;list-style:none !important;padding: 10px 5px;"><i class='fa fa-percent'></i> <span style="width: 25px;">Dividend</span><i class='fa fa-caret-down' style="float: right;width: 20px;"></i></a>

                            <ul class="dropdown-ul" @if(Request::is( 'dividend_dashboard') || Request::is('dividend_payment')) style="display: block;background: #1e291f;padding: 10px 5px;" @else style="background: #344635;padding: 10px 5px;" @endif>
                    
                                <li style="padding: 10px 5px;list-style: none;"><a class="{{ Request::is( 'dividend_dashboard') ? 'active_sub_menu' : '' }}" href="{{ url('dividend_dashboard') }}"><i class='fa fa-bar-chart'></i><span style="width: 25px;"> Dashboard</span></a></li>
                    
                                <li style="padding: 10px 5px;list-style: none;"><a class="{{ Request::is( 'dividend_payment') ? 'active_sub_menu' : '' }}" href="{{ url('dividend_payment') }}"><i class='fa fa-usd'></i><span style="width: 25px;"> Payment History</span></a></li>

                            </ul>
                        </li>
                    @endif -->
                

            
            {{-- <li><a href="{{ url('analytics') }}"><i class='fa fa-bar-chart'></i> <span>My Analytics</span></a></li> --}}
            {{-- <li><a href="{{ url('message') }}"><i class='fa fa-inbox'></i> <span>Message Sending</span></a></li> --}}
            <!-- <li><a href="{{ url('addon') }}"><i class='fa fa-money'></i> <span>Addons</span></a></li> -->
            <li>
                <a href="{{ url('logout') }}"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    <i class='fa fa-sign-out'></i> <span>Logout</span>
                </a>
            </li>
        </ul><!-- /.sidebar-menu -->
        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </section>
    <!-- /.sidebar -->
</aside>

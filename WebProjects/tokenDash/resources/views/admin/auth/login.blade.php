@php
$settings = DB::table('admins')->select('site_title', 'site_logo', 'fav_ico','google2fa_on')->first();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <title>{{$settings->site_title}}</title>
    <!-- Bootstrap Core CSS -->
    <link href="/admin/css/materialize.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/admin/css/materialize.css" rel="stylesheet">
    <link href="/admin/css/style.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesnt work if you view the page via file:** -->
    <!--[if lt IE 9]>
    <script src="https:**oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https:**oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header fix-sidebar">
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <!-- Main wrapper  -->



    <div class="flex-view">
        <div class="log-left">
          <div class="box-inner">
            <p class="flow-text">Token Offering ADMIN PANEL</p><br/>
            <p>
                Run and manage your Initial Token Offering from this admin panel. You will be able to control every aspect of token from here. 


            </p>
            <p>&copy;&nbsp;  copyright 2018. All Rights Reserved.</p>
        </div>
    </div>
    <div class="log-right">
        <div class="box-inner">
            <img src="{{asset($settings->site_logo)}}" class="img-responsive"/>
            <!-- <h5 class="primary">Login to Admin panel</h5> -->
            <h5 class="secondary f-s-17">Sign in to continue.</h5>
            <form action="{{ route('admin.login') }}" method="POST">
                  {{ csrf_field() }}
              <div class="input-field">
                <input type="email" name="email"  value="{{old('email')}}" placeholder="Email">
            </div>
            <div class="input-field">
                <input type="password" type="password"  value="{{old('password')}}"  name="password" class="form-control" placeholder="Password">
            </div>  

                        @if($settings->google2fa_on)
                                <div class="input-field">
                                    <label>Google Authenticator Code</label>
                                    <input type="password"   value="{{old('otp')}}" name="otp"  placeholder="OTP">
                                </div>
                                @endif


            <!-- <div class="checkbox"> <label>
                <input name="remember" type="checkbox"  class="filled-in dt-checkboxes" style="display: block!important;"> Remember Me
            </label>
        </div> -->

        <div class="input-field">
            <button type="submit" class="btn">Sign in</button>
        </div>
    </form>
    
</div>
</div>
</div>



<!-- End Wrapper -->
<!-- All Jquery -->
<script src="/adassets/js/lib/jquery/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="/adassets/js/lib/bootstrap/js/popper.min.js"></script>
<script src="/adassets/js/lib/bootstrap/js/bootstrap.min.js"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="/adassets/js/jquery.slimscroll.js"></script>
<!--Menu sidebar -->
<script src="/adassets/js/sidebarmenu.js"></script>
<!--stickey kit -->
<script src="/adassets/js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
<!--Custom JavaScript -->
<script src="/adassets/js/custom.min.js"></script>

</body>
</html>
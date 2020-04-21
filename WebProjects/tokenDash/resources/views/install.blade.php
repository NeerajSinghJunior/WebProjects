<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="colorlib.com">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TokenDash 10 Minute Installer | Setup your TokenDash Installation in minutes easily.</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ URL::asset('installation-steps/fonts/material-icon/css/material-design-iconic-font.min.css')}}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ URL::asset('installation-steps/css/style.css')}}">
<style>
    .splash-screen-otr .header{
        position: static;
    }
    .splash-body{
        display: block;
    }
    .acknowledge-otr{
        max-width: 1200px;
        margin: auto;
        position: relative;
    }
  .error_message
    {
        color: red;
        font-style: italic;
        font-size: 12px;
        font-weight: normal;
    }
</style>
</head>
<body class="splash-body">
 
    <div id="content__bg"></div>
     <div class="splas-main">
    <div class="splash-screen-otr">
        <div class="header">
            <div class="container">
                <span>Bit<span class="red-color">E</span>xchange</span>
                <ul class="list-unstyled">
                    <li><a href="https://bitexchange.systems/sto-script-software/" target="_blank">About </a></li>
                    <li><a href="https://bitexchange.systems/help/viewforum.php?f=61" target="_blank">Installation help</a></li>
                    <li><a href="https://www.messenger.com/t/194868894428597" target="_blank" > Contact us </a></li>
                </ul>
            </div>
        </div>
            <div class="container ">
                <div class="main-hero">
                    <div class="hero-main-one">
                        <h1>TokenDash <span>®</span><br/> 10 Minute Installer </h1>
                        <p class="lead">Setup TokenDash ® quickly in minutes using this installation wizard. 
                        </p>
                        <a href="https://www.messenger.com/t/194868894428597" target="_blank" class="btn theme-outline">Need help Setting up? Contact Us</a>
                    </div>
                    <div class="hero-main-two">
                        <p><b>CHECKLIST</b></p>
                        <p>Make sure you have this information on hand, before proceeding.</p>
                        <p><b>* ERC 20 Add-on API URL</b></p>
                        <p>
                            ERC20 Module from BitExchange allows you to Install your Custom ERC-20 tokens to easily manage them. Install this first before installing the Dashboard.<br/>
                            ERC 20 Add-on included with the TokenDash Package.<br/>
                            <a href="https://bitexchange.systems/help/viewtopic.php?f=47&t=240" target="_blank">https://bitexchange.systems/help/viewtopic.php?f=47&t=240</a>
                        </p>
                        <p>
                            <b>* Mailgun API key</b> <br/>
                            Mailgun API is required to send Transactional emails to the users who have signed up on your platform. <br/>
                            <a href="https://www.mailgun.com/email-api" target="_blank">https://www.mailgun.com/email-api</a>
                        </p>
                        <p>
                            <b>* Etherscan API</b> <br/>
                            Etherscan API is required to show the transaction statuses once the tokens have been sent to the users. <br/>
                            <a href="https://etherscan.io/apis" target="_blank">https://etherscan.io/apis</a>
                        </p>
                        <p>
                            <b>* LiveChat Inc</b> <br/>
                            Chat with to your Investors answer any questions they may have before investing.  <br/>
                            <span class="brown-text">Offer: $10 Free credit included with the link below</span> <br/>
                            <a href="https://lc.chat/zSkRt" target="_blank">https://lc.chat/zSkRt</a>
                        </p>
                    </div>
                </div>
            </div>
            
    </div>
    </div>
    <div style="margin-bottom: 0px;text-align:center !important;">
         
                <label for="" style="text-align:right !important;">
                    <span class="error_message" id="error_3" ></span>                                  
                </label>
                                              
        </div> 
    <p class="acknowledge-otr">
        <span>
        <input type="checkbox" name="terms" id="terms" value=""> 
        I AGREE to the terms and conditions of BitExchange and will use the software in 
            total legal compliance in all supported countries. 
        </span>
            <a href="#" class="btn pull-right theme-outline highlight-bg" onclick="javascript:form_validation();">Start Installation</a>
    </p><br><br><br>
     
    <!-- JS -->
    <script src="{{ URL::asset('installation-steps/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ URL::asset('installation-steps/vendor/jquery-validation/dist/jquery.validate.min.js')}}"></script>
    <script src="{{ URL::asset('installation-steps/vendor/jquery-validation/dist/additional-methods.min.js')}}"></script>
    <script src="{{ URL::asset('installation-steps/vendor/jquery-steps/jquery.steps.min.js')}}"></script>
    <script src="{{ URL::asset('installation-steps/js/main.js')}}"></script>
    <script src="{{ URL::asset('installation-steps/js/particles.min.js')}}"></script>
    <script src="{{ URL::asset('installation-steps/js/app.js')}}"></script>

    <script>
function form_validation() 
{ 
    //var terms = document.getElementById('terms').value;
    if(document.getElementById("terms").checked == true)
    {
        
        window.location='{{url('/')}}/db/configure';
    }
    else
    {
        $('#error_3').fadeIn().html('Please accept the terms and conditions').delay(1500).fadeOut('slow');
    }
}
    </script>
</body>
</html>
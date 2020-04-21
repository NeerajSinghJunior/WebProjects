<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="colorlib.com">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TokenDash Installer | Setup your TokenDash easily in minutes.</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ URL::asset('installation-steps/fonts/material-icon/css/material-design-iconic-font.min.css')}}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ URL::asset('installation-steps/css/style.css')}}">
        <style>
        .main {
            padding-bottom: 0px;
            padding-top: 0px;
        }
        input[type="text"], #site, #base, #base1, #base2, #base3 {
            margin-bottom: 7px;
        }
        .site_url,.site_url1,.data_host,.data_user,.data_pass,.data_name{
            display: none;
            color: #E91E63;
            font-size: 14px;
            font-weight: 600;
        }
        span.db_details {
            display: none;
            text-align: center;
            color: #E91E63;
            font-size: 14px;
            font-weight: 600;
        }
        .mail_diver,.mail_host,.mail_port,.mail_username,.mail_password,.mailgun_domain,.mailgun_secret{
            display: none;
            color: #E91E63;
            font-size: 14px;
            font-weight: 600;
        }
        .base_3 {
            top: -25px !important;
        }
        .fieldset2, .fieldset3, .fieldset4, .fieldset5, .fieldset6{
            display: none;
        }
        span.step-current {
            position: relative;
            float: right;
        }
        .actions.clearfix {
             display: none; 
        }
        .actions ul li:first-child a {
            background: #fff;
            color: #999;
        }

        #btn-action ul li .previous {
            background: #fff;
            color: #999;
        }
        #btn-action ul li .next , #btn-action ul li .previous {
            width: 140px;
            height: 50px;
            color: #fff;
            font-family: 'Montserrat';
            font-size: 13px;
            font-weight: bold;
            background: #30aabc;
            align-items: center;
            -moz-align-items: center;
            -webkit-align-items: center;
            -o-align-items: center;
            -ms-align-items: center;
            justify-content: center;
            -moz-justify-content: center;
            -webkit-justify-content: center;
            -o-justify-content: center;
            -ms-justify-content: center;
            text-decoration: none;
            border-color: #30aabc;
            background-color: #30aabc;
            display: -webkit-flex;
            padding-top: 0px;
            cursor: pointer;
        }
        #btn-action ul li .next:active, #btn-action ul li .previous:active {
            border-style: none;
        }
        div#btn-action li {
            list-style-type: none;
            float: right;
            margin-right: 20px;
        }
        .popup_tip{
            top: -20px !important;
        }
        .btn_finish{
            display: none !important;
        }
    </style>
</head>

<body class="steup-body">

    <div class="main">
<br><br>
        <div class="container" style="width: 1320px !important;">
            <div class="signup-content">
                <div class="signup-desc">
                    <div class="signup-desc-content">
                        <h2>Bit<span class="red-text">E</span>xchange</h2>
                        <p class="title">TokenDash Installation</p>
                        <p class="desc mb2em">
                            Here you can setup your product by entering few details.
                        </p>
                       <input type="hidden" name="selected" id="selected" value="1">

                       <div class="timeline">
                            <div class="timecontent desc" id="server-requirements">
                                Server Requirements
                            </div>
                            <div class="timecontent " id="database-credentials">
                                Database Credentials
                            </div>
                            <div class="timecontent" id="mail-credentials">
                                Mail Credentials
                            </div>
                            <div class="timecontent" id="twilio-credentials">
                                Set up Twilio Credentials
                            </div>
                            <div class="timecontent" id="recaptcha" value="Send">
                                Set up Google ReCaptcha
                            </div>
                        </div>
                    </div>
                </div>
                <div class="signup-form-conent">
                    <form method="post" id="signup-form" action="{{url('/')}}/db/setup" class="signup-form" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <h3></h3>
                        <fieldset class="fieldset1">
                            <span class="step-current">Step 1 / 6</span>
                            <h4 class="step-caption">Server Requirements</h4>
                            <ul class="list-unstyled">
                                <li>
                                    <?php
                                        $phpver=(float)phpversion();
                                        if($phpver>='7.1.3') {
                                        ?>
                                        <input type="hidden" name="" class="php_ver" value="1">
                                    <svg style="width:20px;height:20px;position:relative;top:5px;right:5px;" viewBox="0 0 24 24">
                                        <path fill="#8bc34a" d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M11,16.5L6.5,12L7.91,10.59L11,13.67L16.59,8.09L18,9.5L11,16.5Z" />
                                    </svg>
                                <?php }else {?>
                                    <input type="hidden" name="" class="php_ver" value="0">
                                    <svg style="width:20px;height:20px;position:relative;top:5px;right:5px;" viewBox="0 0 24 24">
                                        <path fill="#d82518" d="M12,2C17.53,2 22,6.47 22,12C22,17.53 17.53,22 12,22C6.47,22 2,17.53 2,12C2,6.47 6.47,2 12,2M15.59,7L12,10.59L8.41,7L7,8.41L10.59,12L7,15.59L8.41,17L12,13.41L15.59,17L17,15.59L13.41,12L17,8.41L15.59,7Z" />
                                    </svg>
                                <?php } ?>
                                    PHP >= 7.2
                                </li>
<!--                                 <li>
                                    <svg style="width:20px;height:20px;position:relative;top:5px;right:5px;" viewBox="0 0 24 24">
                                        <path fill="#d82518" d="M12,2C17.53,2 22,6.47 22,12C22,17.53 17.53,22 12,22C6.47,22 2,17.53 2,12C2,6.47 6.47,2 12,2M15.59,7L12,10.59L8.41,7L7,8.41L10.59,12L7,15.59L8.41,17L12,13.41L15.59,17L17,15.59L13.41,12L17,8.41L15.59,7Z" />
                                    </svg>
                                    php-cli&nbsp; <a href="https://bitexchange.systems/help/viewtopic.php?f=62&t=283#p633" target="_blank" class="pull-right">Learn how to install this module here</a>
                                </li> -->
                                <li>
                                    <?php if(function_exists('curl_version')) { ?>
                                        <input type="hidden" name="" class="php_curl" value="1">
                                        <svg style="width:20px;height:20px;position:relative;top:5px;right:5px;" viewBox="0 0 24 24">
                                        <path fill="#8bc34a" d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M11,16.5L6.5,12L7.91,10.59L11,13.67L16.59,8.09L18,9.5L11,16.5Z" />
                                    </svg>
                                    php-curl
                                    <?php } else{ ?>
                                        <input type="hidden" name="" class="php_curl" value="0">
                                        <svg style="width:20px;height:20px;position:relative;top:5px;right:5px;" viewBox="0 0 24 24">
                                        <path fill="#d82518" d="M12,2C17.53,2 22,6.47 22,12C22,17.53 17.53,22 12,22C6.47,22 2,17.53 2,12C2,6.47 6.47,2 12,2M15.59,7L12,10.59L8.41,7L7,8.41L10.59,12L7,15.59L8.41,17L12,13.41L15.59,17L17,15.59L13.41,12L17,8.41L15.59,7Z" />
                                    </svg>
                                    php-curl&nbsp; <a href="https://bitexchange.systems/help/viewtopic.php?f=62&t=284" target="_blank" class="pull-right">Learn how to install this module here</a>
                                   <?php } ?>
                                </li>
                                <li>
                                     <?php if(extension_loaded('gd')) { ?>
                                        <input type="hidden" name="" class="php_gd" value="1">
                                        <svg style="width:20px;height:20px;position:relative;top:5px;right:5px;" viewBox="0 0 24 24">
                                        <path fill="#8bc34a" d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M11,16.5L6.5,12L7.91,10.59L11,13.67L16.59,8.09L18,9.5L11,16.5Z" />
                                    </svg>
                                    php-gd
                                    <?php } else{ ?>
                                        <input type="hidden" name="" class="php_gd" value="0">
                                        <svg style="width:20px;height:20px;position:relative;top:5px;right:5px;" viewBox="0 0 24 24">
                                        <path fill="#d82518" d="M12,2C17.53,2 22,6.47 22,12C22,17.53 17.53,22 12,22C6.47,22 2,17.53 2,12C2,6.47 6.47,2 12,2M15.59,7L12,10.59L8.41,7L7,8.41L10.59,12L7,15.59L8.41,17L12,13.41L15.59,17L17,15.59L13.41,12L17,8.41L15.59,7Z" />
                                    </svg>
                                     php-gd&nbsp; <a href="https://bitexchange.systems/help/viewtopic.php?f=62&t=285" target="_blank" class="pull-right">Learn how to install this module here</a>
                                   <?php } ?>
                                </li>
                                <li>
                                    <?php if(extension_loaded('mysqli')) { ?>
                                        <input type="hidden" name="" class="php_mysql" value="1">
                                        <svg style="width:20px;height:20px;position:relative;top:5px;right:5px;" viewBox="0 0 24 24">
                                        <path fill="#8bc34a" d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M11,16.5L6.5,12L7.91,10.59L11,13.67L16.59,8.09L18,9.5L11,16.5Z" />
                                    </svg>
                                    php-mysql
                                    <?php } else{ ?>
                                        <input type="hidden" name="" class="php_mysql" value="0">
                                        <svg style="width:20px;height:20px;position:relative;top:5px;right:5px;" viewBox="0 0 24 24">
                                        <path fill="#d82518" d="M12,2C17.53,2 22,6.47 22,12C22,17.53 17.53,22 12,22C6.47,22 2,17.53 2,12C2,6.47 6.47,2 12,2M15.59,7L12,10.59L8.41,7L7,8.41L10.59,12L7,15.59L8.41,17L12,13.41L15.59,17L17,15.59L13.41,12L17,8.41L15.59,7Z" />
                                    </svg>
                                      php-mysql&nbsp; <a href="https://bitexchange.systems/help/viewtopic.php?f=62&t=286" target="_blank" class="pull-right">Learn how to install this module here</a>
                                   <?php } ?>                                   
                                </li>
                                <li>
                                    <?php if(extension_loaded('mbstring')) { ?>
                                         <input type="hidden" name="" class="php_mbstring" value="1">
                                        <svg style="width:20px;height:20px;position:relative;top:5px;right:5px;" viewBox="0 0 24 24">
                                        <path fill="#8bc34a" d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M11,16.5L6.5,12L7.91,10.59L11,13.67L16.59,8.09L18,9.5L11,16.5Z" />
                                    </svg>
                                    php-mbstring
                                    <?php } else{ ?>
                                         <input type="hidden" name="" class="php_mbstring" value="0">
                                        <svg style="width:20px;height:20px;position:relative;top:5px;right:5px;" viewBox="0 0 24 24">
                                        <path fill="#d82518" d="M12,2C17.53,2 22,6.47 22,12C22,17.53 17.53,22 12,22C6.47,22 2,17.53 2,12C2,6.47 6.47,2 12,2M15.59,7L12,10.59L8.41,7L7,8.41L10.59,12L7,15.59L8.41,17L12,13.41L15.59,17L17,15.59L13.41,12L17,8.41L15.59,7Z" />
                                    </svg>
                                      php-mbstring&nbsp; <a href="https://bitexchange.systems/help/viewtopic.php?f=62&t=287" target="_blank" class="pull-right">Learn how to install this module here</a>
                                   <?php } ?>  
                                </li>
                                <li>
                                    <?php
                        $output = shell_exec('mysql -V'); 
                        preg_match('@[0-9]+\.[0-9]+\.[0-9]+@', $output, $version); 
                        if($version[0]>='5.7') { ?>
                            <input type="hidden" name="" class="mysql_ver" value="1">
                             <svg style="width:20px;height:20px;position:relative;top:5px;right:5px;" viewBox="0 0 24 24">
                                        <path fill="#8bc34a" d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M11,16.5L6.5,12L7.91,10.59L11,13.67L16.59,8.09L18,9.5L11,16.5Z" />
                                    </svg>
                                    MySql - 5.7
                            <?php } else { ?>
                                <input type="hidden" name="" class="mysql_ver" value="0">
                                <svg style="width:20px;height:20px;position:relative;top:5px;right:5px;" viewBox="0 0 24 24">
                                        <path fill="#d82518" d="M12,2C17.53,2 22,6.47 22,12C22,17.53 17.53,22 12,22C6.47,22 2,17.53 2,12C2,6.47 6.47,2 12,2M15.59,7L12,10.59L8.41,7L7,8.41L10.59,12L7,15.59L8.41,17L12,13.41L15.59,17L17,15.59L13.41,12L17,8.41L15.59,7Z" />
                                    </svg>
                                      MySql - 5.7
                            <?php } ?>
                                    
                                </li>
                              <!--   <li>

                                    <svg style="width:20px;height:20px;position:relative;top:5px;right:5px;" viewBox="0 0 24 24">
                                        <path fill="#8bc34a" d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M11,16.5L6.5,12L7.91,10.59L11,13.67L16.59,8.09L18,9.5L11,16.5Z" />
                                    </svg>
                                    Composer
                                </li> -->
                            </ul><br>
                            <p class="title">Thumbs, everything looks good!</p>
                            <p>Let's get your TokenDash setup and running. Please Continue. </p>
                             <div id="btn-action">
                                <ul>
                                    <li>
                                        <a class="next btn_next2">Next</a>
                                    </li>
                                </ul>
                            </div>
                        </fieldset>
    
                        <h3></h3>
                        <fieldset class="fieldset2">
                            <span class="step-current">Step 2 / 6</span>
                            <h4 class="step-caption">Enter the Database Credentials</h4>                            
                                <span class="db_details">Create an MYSQL database using the PhpMyAdmin panel and enter the credentials of the database below. <a href="https://bitexchange.systems/help/viewtopic.php?f=62&t=291" target="_blank">Learn more</a></span>
                            <div class="form-group">
                                <input type="text" id="site" pattern="https?://.+" name="app_url" placeholder="http://domainname.com" required />
                                <label for="">Site URL</label>
                                <span class="popup-otr">
                                <a href="#" class="pull-right popuptext">
                                    <i class="zmdi zmdi-help-outline"></i>
                                </a>
                                <div id="popup">The domain under which this script will be installed.
                                    Ex.<a href="https://yoursite.com/" target="_blank" rel="nofollow">yourdomain.com</a>
                                </div> 
                                </span>
                                <span class="site_url">Enter Site URL</span>
                                <span class="site_url1">Enter Valid Site URL (http://127.0.0.1)</span>
                            </div>
                            <div class="form-group">
                                <input type="text" id="base" name="host" placeholder="127.0.0.1" value="127.0.0.1" required/>
                                <label for="">Database Hostname</label>
                                <span class="popup-otr">
                                <a href="#" class="pull-right popuptext">
                                    <i class="zmdi zmdi-help-outline"></i>
                                </a>
                                <div id="popup">The URL where the database is hosted, check your server's control panel for the details. </div> 
                                </span>
                                <span class="data_host">Enter Database Hostname</span>
                            </div>
                            <div class="form-group">
                                <input type="text" id="base_1" name="username" value="root" placeholder="Database Username" required/>
                                <label for="">Database Username</label>
                                <span class="popup-otr">
                                <a href="#" class="pull-right popuptext">
                                    <i class="zmdi zmdi-help-outline"></i>
                                </a>
                                <div id="popup">Please create a database separately and provide the username for it here.</div> 
                                </span>
                                 <span class="data_user">Enter Database Username</span>
                            </div>
                            <div class="form-group">
                                <input type="text" id="base_2" name="password" value="xchange123" placeholder="Database Password" required/>
                                <label for="">Database Password</label>
                                <span class="popup-otr">
                                <a href="#" class="pull-right popuptext">
                                    <i class="zmdi zmdi-help-outline"></i>
                                </a>
                                <div id="popup">Please provide the password for the database that you had created. </div> 
                                </span>
                                 <span class="data_pass">Enter Database Password</span>
                            </div>
                            <div class="form-group">
                                <input type="text" id="base_3" name="db" value="ico" placeholder="Database Name" required/>
                                <label for="">Database Name</label>
                                <span class="popup-otr">
                                <a href="#" class="pull-right popuptext">
                                    <i class="zmdi zmdi-help-outline"></i>
                                </a>
                                <div id="popup" class="popup_tip">Please provide the name of the database that you had created.</div> 
                                </span>
                                <span class="data_name">Enter Database Name</span>
                            </div>
                             <div id="btn-action">
                                <ul>
                                    <li>
                                        <a class="next btn_next3">Next</a>
                                    </li>
                                    <li>
                                        <a class="previous btn_previous1">Previous</a>
                                    </li>
                                </ul>
                            </div>
                        </fieldset>
    
                        <h3></h3>
                        <fieldset class="fieldset3">
                            <span class="step-current">Step 3 / 6</span>
                            <h4 class="step-caption">Update Mail Credentials</h4>
                            <p class="mb2em">Configure the SMTP & Mailgun credentials to send TokenDash system emails (Account creation, purchase) and email campaigns right from your Admin Dashboard. Double check and verify all the details before proceeding. </p>
                            <div class="form-group">
                                <input type="text" id="mail1" name="mail_driver" value="mailgun" placeholder="Mail Driver" required/>
                                <label for="">Mail Driver</label>
                                <span class="popup-otr">
                                <a href="#" class="pull-right popuptext">
                                    <i class="zmdi zmdi-help-outline"></i>
                                </a>
                                <div id="popup">
                                    The mail service which you plan to use. For now, only mailgun is supported. 
                                    <!-- <a href="https://bitexchange.systems/help/viewtopic.php?f=62&t=289&p=639#p639" target="_blank" rel="nofollow">Learn More</a> -->
                                </div> 
                                </span>
                                <span class="mail_diver">Enter Mail Driver</span>
                            </div>
                            <div class="form-group">
                                <input type="text" id="mail2" name="mail_host" value="smtp.mailgun.org" placeholder="Mail Host" required/>
                                <label for="">Mail Host</label>
                                <span class="popup-otr">
                                <a href="#" class="pull-right popuptext">
                                    <i class="zmdi zmdi-help-outline"></i>
                                </a>
                                <div id="popup">
                                SMTP mail host for this installation. 
                                 <!-- <a href="https://bitexchange.systems/help/viewtopic.php?f=62&t=290#p640" target="_blank" rel="nofollow">Learn More</a> -->
                                </div> 
                                </span>
                                <span class="mail_host">Enter Mail Host</span>
                            </div>
                            <div class="form-group">
                                <input type="text" id="mail3" name="mail_port" value="587" placeholder="Mail Port" required/>
                                <label for="">Mail Port</label>
                                <span class="popup-otr">
                                <a href="#" class="pull-right popuptext">
                                    <i class="zmdi zmdi-help-outline"></i>
                                </a>
                                <div id="popup"> <a href="https://bitexchange.systems/help/viewtopic.php?f=62&t=290#p640" target="_blank" rel="nofollow">Learn More</a></div> 
                                </span>
                                <span class="mail_port">Enter Mail Port</span>
                            </div>
                            <div class="form-group">
                                <input type="text" id="mail4" name="mail_username" placeholder="Mail Username" required/>
                                <label for="">Mail Username</label>
                                <span class="popup-otr">
                                <a href="#" class="pull-right popuptext">
                                    <i class="zmdi zmdi-help-outline"></i>
                                </a>
                                <div id="popup">
                                    Username of your mail service
                                 <a href="https://bitexchange.systems/help/viewtopic.php?f=62&t=290#p640" target="_blank" rel="nofollow">Learn More</a>
                                </div> 
                                </span>
                                 <span class="mail_username">Enter Mail Username</span>
                            </div>
                            <div class="form-group">
                                <input type="text" id="mail5" name="mail_password" placeholder="Mail Password" required/>
                                <label for="">Mail Password</label><span class="popup-otr">
                                <a href="#" class="pull-right popuptext">
                                    <i class="zmdi zmdi-help-outline"></i>
                                </a>
                                <div id="popup">
                                Password of your mail service 
                                    <a href="https://bitexchange.systems/help/viewtopic.php?f=62&t=290#p640" target="_blank" rel="nofollow">Learn More</a></div> 
                                </span>
                                <span class="mail_password">Enter Mail Password</span>
                            </div>
                            <div class="form-group">
                                <input type="text" id="mail6" name="mailgun_domain" placeholder="MailGun Domain" required/>
                                <label for="">MailGun Domain</label>
                                <span class="popup-otr">
                                <a href="#" class="pull-right popuptext">
                                    <i class="zmdi zmdi-help-outline"></i>
                                </a>
                                <div id="popup"> 
                                    
                                <a href="https://bitexchange.systems/help/viewtopic.php?f=62&t=290#p640" target="_blank" rel="nofollow">Learn More</a></div> 
                                </span>
                                <span class="mailgun_domain">Enter MailGun Domain</span>
                            </div>
                            <div class="form-group">
                                <input type="text" id="mail7" name="mailgun_secret" placeholder="MailGun Secret" required/>
                                <label for="">MailGun Secret </label>
                                <span class="popup-otr">
                                <a href="#" class="pull-right popuptext">
                                    <i class="zmdi zmdi-help-outline"></i>
                                </a>
                                <div id="popup"> <a href="https://bitexchange.systems/help/viewtopic.php?f=62&t=290#p640" target="_blank" rel="nofollow">Learn More</a></div> 
                                </span>
                                <span class="mailgun_secret">Enter Mailgun Secret</span>
                            </div>
                             <div id="btn-action">
                                <ul>
                                    <li>
                                        <a class="next btn_next4">Next</a>
                                    </li>
                                    <li>
                                        <a class="previous btn_previous2">Previous</a>
                                    </li>
                                </ul>
                            </div>
                        </fieldset>
    
                        <h3></h3>
                        <fieldset class="fieldset4">
                            <span class="step-current">Step 4 / 5</span>
                           <h4 class="step-caption">Set up Twilio Credentials</h4>
                           <p class="mb2em">Configure the SMS credentials to send SMS Campaigns through the TokenDash installation. 
                                Learn how to get Twilio Credentials <a href="https://www.twilio.com/console" rel="nofollow" target="_blank">here</a>.
                                 Don't have an account, <a href="http://twilio.com/try-twilio" rel="nofollow" target="_blank">signup now</a></p>
                            <div class="form-group">
                                <input type="text" id="twilio_account_sid" name="twilio_account_sid" placeholder="Twilio Account Sid" required value=" " />
                                <label for="">Twilio Account Sid :</label>
                            </div>
                            <div class="form-group">
                                <input type="text" id="twilio_auth_token" name="twilio_auth_token" placeholder="Twilio Auth Token" required value=" " />
                                <label for="">Twilio Auth Token :</label>
                            </div>
                            <div class="form-group">
                                <input type="text" id="twilio_phone_number" name="twilio_phone_number" placeholder="Twilio Phone Number" required value=" "  />
                                <label for="">Twilio Phone Number :</label>
                            </div>
                             <div id="btn-action">
                                <ul>
                                    <li>
                                        <a class="next btn_next5">Next</a>
                                    </li>
                                    <li>
                                        <a class="previous btn_previous3">Previous</a>
                                    </li>
                                </ul>
                            </div>
                        </fieldset>
                        <h3></h3>
                        <fieldset class="fieldset5">
                            <span class="step-current">Step 5 / 6</span>
                            <h4 class="step-caption">Set up Google Signin</h4>
                            <p class="mb2em">Configure Google signup to your Token Offering Dashboard. <br/>
                                    Learn how to get the Client Id, Client secret key <a href="https://medium.com/@thomashellstrom/use-google-as-login-in-your-web-app-with-oauth2-352f6c7f10e6" target="_blank">here</a>
                            </p>
                            <div class="form-group">
                                <input type="text" id="google_client_id" name="google_client_id" placeholder="Google Client Id" required value=" "/>
                                <label for="">Google Client Id :</label>
                            </div>
                            <div class="form-group">
                                <input type="text" id="google_client_secret" name="google_client_secret" placeholder="Google Client Secret" required value=" "/>
                                <label for="">Google Client Secret :</label>
                            </div>
                            <div class="form-group">
                                <input type="text" id="google_redirect_url" name="google_redirect_url" placeholder="Google Redirect URL" required value=" "/>
                                <label for="">Google Redirect URL :</label>
                            </div>
                             <div id="btn-action">
                                <ul>
                                    <li>
                                        <a type="submit" class="next btn_next6">Install</a>
                                    </li>
                                    <li>
                                        <a class="previous btn_previous4">Previous</a>
                                    </li>
                                </ul>
                            </div>
                        </fieldset>
                        <h3></h3>
                        <fieldset class="loader-ani fieldset6" id="">
                            <span class="step-current">Step 6 / 6</span>
                            <div class="content-otr">
                                    <div class="inner">
                                            <div class="text">
                                                <h4>Please wait while we install and setup TokenDash script.</h4>
                                                 Please <b class="text-success">DONT</b> Refresh this page or Hit the <b class="text-success">BACK</b> button.</div>
                                            <div class="loader"></div>
                                            <div class="delayedShowOne delay-text">
                                                    <svg style="width:20px;height:20px;position:relative;top:5px;" viewBox="0 0 24 24">
                                                        <path fill="#8bc34a" d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M11,16.5L6.5,12L7.91,10.59L11,13.67L16.59,8.09L18,9.5L11,16.5Z" />
                                                    </svg>
                                                    Setting up the Environment
                                            </div>
                                            <div class="delayedShowTwo delay-text">
                                                    <svg style="width:20px;height:20px;position:relative;top:5px;" viewBox="0 0 24 24">
                                                        <path fill="#8bc34a" d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M11,16.5L6.5,12L7.91,10.59L11,13.67L16.59,8.09L18,9.5L11,16.5Z" />
                                                    </svg>
                                                    Configuring Database
                                            </div>
                                            <div class="delayedShowThree delay-text">
                                                    <svg style="width:20px;height:20px;position:relative;top:5px;" viewBox="0 0 24 24">
                                                        <path fill="#8bc34a" d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M11,16.5L6.5,12L7.91,10.59L11,13.67L16.59,8.09L18,9.5L11,16.5Z" />
                                                    </svg>
                                                    Configuring SMTP & Mailgun
                                            </div>
                                            <div class="delayedShowFour delay-text">
                                                    <svg style="width:20px;height:20px;position:relative;top:5px;" viewBox="0 0 24 24">
                                                        <path fill="#8bc34a" d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M11,16.5L6.5,12L7.91,10.59L11,13.67L16.59,8.09L18,9.5L11,16.5Z" />
                                                    </svg>
                                                    Configuring Twilio
                                            </div>
                                            <div class="delayedShowFive delay-text">
                                                    <svg style="width:20px;height:20px;position:relative;top:5px;" viewBox="0 0 24 24">
                                                        <path fill="#8bc34a" d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M11,16.5L6.5,12L7.91,10.59L11,13.67L16.59,8.09L18,9.5L11,16.5Z" />
                                                    </svg>
                                                    Configuring Google Sigin
                                            </div>
                                            <div class="delayedShowSix delay-text">
                                                    <svg style="width:20px;height:20px;position:relative;top:5px;" viewBox="0 0 24 24">
                                                        <path fill="#8bc34a" d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M11,16.5L6.5,12L7.91,10.59L11,13.67L16.59,8.09L18,9.5L11,16.5Z" />
                                                    </svg>
                                                    Great! You're all set.
                                            </div>
                                    </div>
                                </div>
                                 <div id="btn-action">
                                <ul>
                                    <li>
                                        <input type="submit" class="next btn_finish" value="Finish">
                                    </li>
                                </ul>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <!-- JS -->
    <script src="{{ URL::asset('installation-steps/vendor/jquery/jquery.min.js')}}"></script>
    <!-- <script src="{{ URL::asset('installation-steps/vendor/jquery-validation/dist/jquery.validate.min.js')}}"></script>
    <script src="{{ URL::asset('installation-steps/vendor/jquery-validation/dist/additional-methods.min.js')}}"></script> -->
    <script src="{{ URL::asset('installation-steps/vendor/jquery-steps/jquery.steps.min.js')}}"></script>
    <!-- <script src="{{ URL::asset('installation-steps/js/main.js')}}"></script> -->

<script>
   







    // $(document).on("click", ".btn_next2", function(){
        $('.btn_next2').click(function(event){
        // alert();
        var step1_text1 = $('.php_ver').val();
        // var step1_text2 = $('.php_mcrypt').val();
        // var step1_text3 = $('.php_cli').val();
        var step1_text4 = $('.php_curl').val();
        var step1_text5 = $('.php_gd').val();
        var step1_text6 = $('.php_mysql').val();
        var step1_text7 = $('.php_mbstring').val();
        var step1_text8 = $('.mysql_ver').val();
        // var step1_text9 = $('.composer').val();

        // if (step1_text2 == '0') {$(".php_mcrypt_s").css('display','block');}
        // if (step1_text3 == '0') {$(".php_cli_s").css('display','block');}
        if (step1_text4 == '0') {$(".php_curl_s").css('display','block');}
        if (step1_text5 == '0') {$(".php_gd_s").css('display','block');}
        if (step1_text6 == '0') {$(".php_mysql_s").css('display','block');}
        if (step1_text7 == '0') {$(".php_mbstring_s").css('display','block');}
        if (step1_text1 == 1 &&  step1_text4 == 1 && step1_text5 == 1 && step1_text6 == 1 && step1_text7 == 1 && step1_text8 == 1 ) {
            $(".fieldset1").css('display','none');
            $("#database-credentials").addClass('desc');
            $(".fieldset2").css('display','block');
            $('#site').val(window.location.origin);
        }
    });

        
    $('.btn_next3').click(function(event){
    var url = window.location.origin; 
    var text1 = $('#site').val();
    // alert(text1);
    var text2 = $('#base').val();
    var text3 = $('#base_1').val();
    var text4 = document.getElementById('base_2').value;
    text4 = text4.replace("#", "%23");
    text4 = text4.replace("&", "%26");
    var text5 = $('#base_3').val();

    if(text1 == '' || text1 != url){
            // alert('First text error');
            if (text1 == '') {
                $(".site_url1").css('display','none');
                $(".site_url").css('display','block');
            }else{
                if (text1 != url) {
                    // alert(url);
                    $(".site_url").css('display','none');
                    $(".site_url1").css('display','block');
                }
            }
                        
    }else{
        if(text2 == ''){
            // alert('Second text error');
            $(".site_url").css('display','none');
            $(".site_url1").css('display','none');
            $(".data_host").css('display','block');
            
        }else{
            if(text3 == ''){
                // alert('Third text error');
                $(".data_host").css('display','none');
                $(".data_user").css('display','block');
                
            }else{
                if(text4 == ''){
                    // alert('Fourth text error');
                    $(".data_user").css('display','none');
                    $(".data_pass").css('display','block');
                    
                }else{
                     if(text5 == ''){
                        // alert('Five text error');
                        $(".data_pass").css('display','none');
                        $(".data_name").css('display','block');
                        
                    }else{
                        $(".site_url").css('display','none');
                        $(".site_url1").css('display','none');
                        $(".data_host").css('display','none');
                        $(".data_user").css('display','none');
                        $(".data_pass").css('display','none');
                        $(".data_name").css('display','none');
                        $(".db_details").css('display','none');

                        //   Data Base Connection Check Start

                            console.log('data');
                            var url = window.location.origin; 
                            var api_url = url+"/config_db_check.php?host="+text2+"&username="+text3+"&password="+text4+"&db_name="+text5;
                            $.ajax({
                                        type: "GET",
                                        url: api_url,
                                        dataType:'json',
                                        success: function(data){
                                            console.log(data.Data[0].status);
                                            var status = data.Data[0].status;
                                            console.log(status);
                                            if (status == true) {
                                                $(".db_details").css('display','none');
                                                $(".fieldset2").css('display','none');
                                                $("#mail-credentials").addClass('desc');
                                                $(".fieldset3").css('display','block');
                                            }else{
                                                $(".db_details").css('display','block');
                                            }
                                        }
                        })

                        //   Data Base Connection Check End
                        // $(".fieldset2").css('display','none');
                        // $("#mail-credentials").addClass('desc');
                        // $(".fieldset3").css('display','block');
        
                    }

                }

            }
       
        }
    }
    
});
 $('.btn_next4').click(function(event){
    var text1 = $('#mail1').val();
    // alert(text1);
    var text2 = $('#mail2').val();
    var text3 = $('#mail3').val();
    var text4 = $('#mail4').val();
    var text5 = $('#mail5').val();
    var text6 = $('#mail6').val();
    var text7 = $('#mail7').val();

    if(text1 == ''){
            // alert('First text error');
            $(".mail_diver").css('display','block');
            
    }else{
        if(text2 == ''){
            // alert('Second text error');
            $(".mail_diver").css('display','none');
            $(".mail_host").css('display','block');
            
        }else{
            if(text3 == ''){
                // alert('Third text error');
                $(".mail_host").css('display','none');
                $(".mail_port").css('display','block');
                
            }else{
                if(text4 == ''){
                    // alert('Fourth text error');
                    $(".mail_port").css('display','none');
                    $(".mail_username").css('display','block');
                    
                }else{
                     if(text5 == ''){
                        // alert('Five text error');
                        $(".mail_username").css('display','none');
                        $(".mail_password").css('display','block');
                        
                    }else{

                     if(text6 == ''){
                        // alert('Five text error');
                        $(".mail_password").css('display','none');
                        $(".mailgun_domain").css('display','block');
                        
                    }else{

                     if(text7 == ''){
                        // alert('Five text error');
                        $(".mailgun_domain").css('display','none');
                        $(".mailgun_secret").css('display','block');
                        
                    }else{
                        $(".mail_diver").css('display','none');
                        $(".mail_host").css('display','none');
                        $(".mail_port").css('display','none');
                        $(".mail_username").css('display','none');
                        $(".mail_password").css('display','none');
                        $(".mailgun_domain").css('display','none');
                        $(".mailgun_secret").css('display','none');                        
                        
                        $(".fieldset3").css('display','none');
                        $("#twilio-credentials").addClass('desc');
                        $(".fieldset4").css('display','block');

                        
                    }
                        
                    }
                        
                    }

                }

            }
       
        }
    }
    
});

$('.btn_next5').click(function(event){
    $(".fieldset4").css('display','none');
    $("#recaptcha").addClass('desc');
    $(".fieldset5").css('display','block');
});

$('.btn_next6').click(function(event){
    $(".fieldset5").css('display','none');
    $("#recaptcha").addClass('desc');
    $(".fieldset6").css('display','block');
    // $(".btn_finish").attr('href', 'javascript:void(0)');
    $(".btn_finish").css('cursor','no-drop');
    $("#selected").val(5);
    $(document).ready(function() {
        setTimeout(function() {
       // $(".btn_finish").attr('href', '#finish');btn_finish
       $(".btn_finish").trigger('click');
       $(".btn_finish").css('cursor','pointer');
       
  }, 18000);
});

});

$('.btn_previous1').click(function(event){
    $(".fieldset2").css('display','none');
    $("#database-credentials").removeClass('desc');
    $("#server-requirements").addClass('desc');
    $(".fieldset1").css('display','block');
});
$('.btn_previous2').click(function(event){
    $(".fieldset3").css('display','none');
    $("#database-credentials").addClass('desc');
    $("#mail-credentials").removeClass('desc');
    $(".fieldset2").css('display','block');
});
$('.btn_previous3').click(function(event){
    $(".fieldset4").css('display','none');
    $("#mail-credentials").addClass('desc');
    $("#twilio-credentials").removeClass('desc');
    $(".fieldset3").css('display','block');
});
$('.btn_previous4').click(function(event){
    $(".fieldset5").css('display','none');
    $("#twilio-credentials").addClass('desc');
    $("#recaptcha").removeClass('desc');
    $(".fieldset4").css('display','block');
});

</script>

</body>

</html>
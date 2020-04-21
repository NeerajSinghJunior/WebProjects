
<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7 "> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie10 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie10 lt-ie9"> <![endif]-->
<!--[if IE 9]><html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>

    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <title>{{$settings->site_title}}</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Favicons -->
    <link rel="shortcut icon" href="{{$settings->fav_ico}}">

    <!-- FONTS -->
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:100,300,400,400italic,700'>
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Patua+One:100,300,400,400italic,700'>
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:100,300,400,400italic,700,700italic'>
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Lato:100,300,400'>

    <!-- CSS -->
    <link rel='stylesheet' href='css/global.css'>
    <link rel='stylesheet' href='css/structure.css'>
    <link rel='stylesheet' href='css/wallet.css'>
    <link rel='stylesheet' href='css/custom.css'>

    <!-- Revolution Slider -->
    <link rel="stylesheet" href="css/settings.css">

    <link rel='stylesheet' href='css/style-demo.css'>

</head>

<body class="template-slider color-custom style-simple layout-full-width nice-scroll-on button-flat no-content-padding header-classic minimalist-header-no sticky-header sticky-tb-color ab-show subheader-both-center menu-line-below menuo-right footer-copy-center mobile-tb-left mobile-mini-ml-lc mobile-header-mini tr-menu">
<div id="Wrapper">
    <div id="Header_wrapper">
        <header id="Header">
            <!-- <div id="Action_bar">
                <div class="container">
                    <div class="column one">
                        <ul class="contact_details">
                            <li class="slogan">
                                Have any questions?
                            </li>
                            <li class="phone">
                                <i class="icon-phone"></i><a href="tel:+61383766284">+61 383 766 284</a>
                            </li>
                            <li class="mail">
                                <i class="icon-mail-line"></i><a href="mailto:noreply@envato.com">noreply@envato.com</a>
                            </li>
                        </ul>
                        <ul class="social"></ul>
                    </div>
                </div>
            </div> -->
            <div class="header_placeholder"></div>
            <div id="Top_bar">
                <div class="container">
                    <div class="column one">
                        <div class="top_bar_left clearfix">
                            <div class="logo">
                                <a id="logo" href="#">
                                    <img class="logo-main scale-with-grid" src="{{$settings->site_logo}}" alt="wallet" />

                                    <!-- <img class="logo-sticky scale-with-grid" src="images/wallet.png" alt="wallet" /> -->
                                    <img class="logo-sticky scale-with-grid" src="{{$settings->site_logo}}" alt="wallet"/>
                                    
                                    <img class="logo-mobile scale-with-grid" src="{{$settings->site_logo}}" alt="wallet" />
                                    {{--<p class="footer-logo" style="margin-top:0;">COWRIE<span>COIN</span></p>--}}
                                </a>
                            </div>
                            <div class="menu_wrapper">
                                <nav id="menu" class="menu-main-menu-container">
                                    <ul id="menu-main-menu" class="menu">
                                        <li class="current_page_item">
                                            <a href="#"><span>HOME</span></a>
                                        </li>
                                        <li>
                                            <a href="#Content"><span>WHY COWRIECOIN?</span></a>
                                        </li>
                                        <li>
                                            <a href="#whitepaper"><span>READ WHITEPAPER</span></a>
                                        </li>
                                        <li>
                                            <a href="{{ route('login') }}"><span>LOGIN</span></a>
                                        </li>
                                        <li>
                                            <a href="{{ route('register') }}"><span>REGISTER</span></a>
                                        </li>
                                        <!--<li>
                                            <a target="_blank" href="http://bit.ly/1M6lijQ"><span><span style="padding: 0px; color:#316BEE;">BUY NOW</span></span></a>
                                        </li> -->
                                    </ul>
                                </nav><a class="responsive-menu-toggle" href="#"><i class="icon-menu-fine"></i></a>
                            </div>
                            <div class="secondary_menu_wrapper"></div>
                            <div class="banner_wrapper"></div>
                            <div class="search_wrapper">
                                <form method="get" id="searchform" action="#">
                                    <i class="icon_search icon-search-fine"></i><a href="#" class="icon_close"><i class="icon-cancel-fine"></i></a>
                                    <input type="text" class="field" name="s" id="s" placeholder="Enter your search" />
                                    <input type="submit" class="submit" value="" style="display:none;" />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mfn-main-slider" id="mfn-rev-slider">
                <div id="rev_slider_1_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" style="margin:0px auto;background-color:transparent;padding:0px;margin-top:0px;margin-bottom:0px;">
                    <div id="rev_slider_1_1" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.2.6">
                        <ul>
                            <li data-index="rs-1" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="300" data-rotate="0" data-saveperformance="off" data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                                <img src="img/home_wallet_slider_bg.jpg" alt="" title="home_wallet_slider_bg" width="1920" height="830" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                                <div class="tp-caption   tp-resizeme" id="slide-1-layer-1" data-x="right" data-hoffset="-40" data-y="bottom" data-voffset="-10" data-width="['none','none','none','none']" data-height="['none','none','none','none']" data-transform_idle="o:1;" data-transform_in="opacity:0;s:1500;e:Power2.easeInOut;" data-transform_out="opacity:0;s:300;" data-start="500" data-responsive_offset="on" style="z-index: 5;"><img src="img/home_wallet_slider_pic.png" alt="" width="815" height="702" data-ww="815px" data-hh="702px" data-no-retina>
                                </div>
                                <div class="tp-caption mfnrs_wallet_large_light   tp-resizeme" id="slide-1-layer-4" data-x="40" data-y="center" data-voffset="-60" data-width="['auto']" data-height="['auto']" data-transform_idle="o:1;" data-transform_in="y:50px;opacity:0;s:1500;e:Power3.easeOut;" data-transform_out="opacity:0;s:300;" data-start="900" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 6; white-space: nowrap;">
                                    Cross-Border lending &amp;
                                    <br> payments made easy.

                                </div>
                                <a class="tp-caption   tp-resizeme" href="#" target="_self" id="slide-1-layer-2" data-x="40" data-y="center" data-voffset="100" data-width="['none','none','none','none']" data-height="['none','none','none','none']" data-transform_idle="o:1;" data-transform_in="opacity:0;s:1500;e:Power2.easeInOut;" data-transform_out="opacity:0;s:300;" data-start="900" data-actions='' data-responsive_offset="on" style="z-index: 7;"><span style="display: inline-block;margin: 0 10px 5px;background: #3d6ee0;color: #fff !important;text-decoration: none !important;padding: 1em 2em;font-weight: 700;text-transform: uppercase;letter-spacing: 1px;">read whitepaper<span>  </a>
                                <!--  <a class="tp-caption   tp-resizeme" href="#" target="_self" id="slide-1-layer-3" data-x="255" data-y="center" data-voffset="100" data-width="['none','none','none','none']" data-height="['none','none','none','none']" data-transform_idle="o:1;" data-transform_in="opacity:0;s:1500;e:Power2.easeInOut;" data-transform_out="opacity:0;s:300;" data-start="900" data-actions='' data-responsive_offset="on" style="z-index: 8;"><img src="images/home_wallet_button2.png" alt="" width="213" height="65" data-ww="213px" data-hh="65px" data-no-retina> </a>  -->

                            </li>
                        </ul>
                        <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
                    </div>

                </div>
            </div>
        </header>
    </div>
    <div id="Content">
        <div class="content_wrapper clearfix">
            <div class="sections_group">
                <div class="entry-content" itemprop="mainContentOfPage">
                    <div class="section mcb-section" style="padding-top:0px; padding-bottom:3em; background-color:#f0f1f3">
                        <div class="section_wrapper mcb-section-inner">
                            <div class="wrap mcb-wrap one  valign-top clearfix" style="padding:60px 20px 30px; background-color:#fff; margin-top:-50px">
                                <div class="mcb-wrap-inner">
                                    <div class="column mcb-column one column_column ">
                                        <div class="column_attr clearfix align_center" style=" padding:0 12%;">
                                            <h2>Why Invest in CowrieCoin?</h2>
                                            <!-- <h6>Aenean augue eu quam. Maecenas pretium, ipsum ullamcorper ac, felis. Pellentesque habitant morbi tristique mauris vehicula sit amet erat. Sed et luctus augue imperdiet tincidunt</h6> -->
                                        </div>
                                    </div>
                                    <div class="column mcb-column one-third column_icon_box ">
                                        <div class="icon_box icon_position_top no_border">
                                            <a  href="content/wallet/our-services.html">
                                                <div class="image_wrapper">
                                                    <img src="img/home_wallet_iconbox1.png" class="scale-with-grid" alt="home_wallet_iconbox1" width="60" height="60" />
                                                    <!-- <svg enable-background="new 0 0 128 128" height="60px" id="Layer_1" version="1.1" viewBox="0 0 128 128" width="128px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M94.894,25.925  C86.682,17.14,74.99,11.652,62.019,11.652c-0.002,0-0.004,0-0.005,0c-0.002,0-0.002,0-0.005,0c-12.973,0-24.663,5.488-32.875,14.273  c-7.444,7.959-12.022,18.991-12.115,30.727c1.281-0.701,2.928-1.5,4.49-1.5c1.65,0,3.172,0.724,4.5,1.5  c1.327-0.771,2.857-1.5,4.5-1.5c1.65,0,3.172,0.724,4.5,1.5c1.327-0.771,2.857-1.5,4.5-1.5c1.229,0,3.434,1.052,4.5,1.5  c1.081-0.461,3.251-1.5,4.5-1.5c1.187,0,3.465,1.081,4.5,1.5c0.017-0.006,0.08-0.012,0.117-0.018  c1.418-0.932,2.56-1.482,4.383-1.482c0.856,0,1.647,0.173,2.396,0.45v29.529c0,0,0,0.004,0,0.006v6.326  c0,5.633-3.938,10.195-8.795,10.195c-4.642,0-8.432-4.172-8.76-9.457h-5.063v0.154c0,0.152,0.022,0.299,0.059,0.443  c0.587,8.225,6.521,14.691,13.768,14.691c7.244,0,13.179-6.467,13.766-14.691c0.037-0.145,0.059-0.291,0.059-0.443v-7.225v-6.834  V55.355c0.505-0.125,1.028-0.203,1.582-0.203c1.822,0,2.965,0.551,4.382,1.482c0.038,0.006,0.102,0.012,0.117,0.018  c1.036-0.419,3.314-1.5,4.5-1.5c1.25,0,3.42,1.039,4.5,1.5c1.066-0.448,3.272-1.5,4.5-1.5c1.644,0,3.174,0.729,4.5,1.5  c1.329-0.776,2.851-1.5,4.5-1.5c1.644,0,3.174,0.729,4.5,1.5c1.329-0.776,2.851-1.5,4.5-1.5c1.563,0,3.209,0.799,4.491,1.5  C106.915,44.917,102.338,33.884,94.894,25.925z" fill="none" stroke="#3d6ee0" stroke-miterlimit="10" stroke-width="2"/></svg> -->
                                                </div>
                                                <div class="desc_wrapper">
                                                    <h5 class="title">Cross-Border Insurance</h5>
                                                    <div class="desc">
                                                        Flexible and comprehensive insurance policy for anyone around the world.
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="column mcb-column one-third column_icon_box ">
                                        <div class="icon_box icon_position_top no_border">
                                            <a  href="content/wallet/our-services.html">
                                                <div class="image_wrapper">
                                                    <!-- <img src="images/home_wallet_iconbox2.png" class="scale-with-grid" alt="home_wallet_iconbox2" width="60" height="60" /> -->
                                                    <svg height="60px" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality;  clip-rule:evenodd" version="1.0" viewBox="0 0 47000 63658" width="47px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#3d6ee0"><defs></defs><g id="Layer_x0020_1"><path class="fil0" d="M27404 15174l-2 -1 -12 0 -13 -1 -1 0 -15 -1 -8 -1 -6 0 -59 -1 -7576 0 -59 1 -5 0 -9 1 -15 1 -14 1 -11 0 -4 1c-269,28 -512,149 -693,327l-5 5c-204,208 -332,495 -332,809 0,315 128,602 332,809l5 5c182,179 424,300 693,327l4 1 11 0 14 1 15 1 9 1 5 0 59 1 7576 0 59 -1 6 0 8 -1 15 -1 1 0 13 -1 12 0 2 -1c269,-28 511,-147 693,-327l5 -5c204,-208 332,-495 332,-809 0,-315 -128,-602 -332,-809l-5 -5c-182,-179 -424,-300 -693,-327zm-4899 10781c0,-549 446,-995 995,-995 549,0 995,446 995,995l0 2818c914,49 1825,201 2693,461 2851,856 5247,2869 5921,6243 107,538 -243,1062 -781,1169 -538,107 -1062,-243 -1169,-781 -508,-2542 -2346,-4070 -4537,-4727 -683,-204 -1400,-328 -2126,-374l0 9520c1004,6 2038,81 3178,428 1255,381 2520,1069 3412,2270 717,967 1180,2240 1180,3912 0,2613 -1617,4574 -3910,5733 -1155,583 -2487,963 -3859,1110l0 2903c0,549 -446,995 -995,995 -549,0 -995,-446 -995,-995l0 -2850c-914,-49 -1825,-200 -2693,-459 -2850,-856 -5246,-2870 -5921,-6243 -107,-538 243,-1062 781,-1169 538,-107 1062,243 1169,781 510,2542 2346,4070 4537,4727 683,203 1400,328 2126,374l0 -9517c-1004,-7 -2038,-82 -3178,-430 -2294,-700 -4591,-2358 -4591,-6182 0,-2614 1617,-4574 3911,-5733 1154,-583 2486,-965 3858,-1111l0 -2871zm1990 16310l0 9470c1066,-136 2085,-436 2966,-881 1649,-834 2813,-2196 2813,-3962 0,-1205 -307,-2089 -782,-2730 -598,-806 -1493,-1282 -2394,-1555 -887,-270 -1749,-335 -2602,-342zm-1990 -1965l0 -9471c-1064,136 -2084,436 -2965,881 -1651,834 -2814,2195 -2814,3962 0,2652 1590,3802 3177,4286 888,270 1749,335 2602,343zm4013 -27122c23,-66 53,-128 89,-187l4165 -8327c-1644,529 -3724,1082 -4840,-873 -1028,-1800 -2428,-1801 -2432,-1801 -4,0 -1404,1 -2432,1801 -1116,1955 -3197,1402 -4840,873l4205 8408 46 106 6040 0zm-8105 284l-4655 -9307c-94,-153 -149,-332 -149,-524 0,-959 503,-1318 1362,-1318 452,0 985,175 1599,374 1024,334 2399,781 2774,125 1605,-2810 4149,-2811 4157,-2811 7,0 2552,1 4157,2811 375,657 1749,209 2774,-125 613,-199 1148,-374 1599,-374 859,0 1362,359 1362,1318l-5 0c0,149 -33,301 -105,443l-4695 9388c341,157 650,374 913,636l5 5 26 27 5 5c549,566 889,1335 889,2180 0,859 -354,1644 -920,2212l-5 5 -27 26 -5 5c-68,66 -141,129 -214,189 5354,3540 25038,18172 14876,36106 -1973,3481 -4971,5755 -8599,7117 -3539,1331 -7675,1786 -12031,1664 -4356,122 -8493,-332 -12031,-1664 -3628,-1362 -6626,-3636 -8599,-7117 -10161,-17934 9520,-32566 14874,-36106 -86,-69 -168,-142 -246,-220l-5 -5 -26 -27 -5 -5c-549,-566 -889,-1337 -889,-2180 0,-861 354,-1644 920,-2212l5 -5 27 -26 5 -5c256,-249 555,-455 882,-605zm8304 5989l-6432 0c-82,92 -180,167 -290,222 -1303,778 -25848,15763 -15400,34204 1723,3042 4367,5036 7574,6241 3288,1236 7181,1657 11304,1538l54 0c4124,119 8016,-302 11304,-1538 3207,-1204 5851,-3199 7574,-6241 10717,-18913 -15383,-34194 -15457,-34238 -88,-52 -166,-116 -231,-188z"/></g></svg>
                                                </div>
                                                <div class="desc_wrapper">
                                                    <h5 class="title">Cross-Border Money Lending</h5>
                                                    <div class="desc">
                                                        Money lending services available for those who are in the low-income group
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="column mcb-column one-third column_icon_box ">
                                        <div class="icon_box icon_position_top no_border">
                                            <a  href="content/wallet/our-services.html">
                                                <div class="image_wrapper">
                                                    <svg height="60px" fill="#3d6ee0" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; clip-rule:evenodd" version="1.0" viewBox="0 0 9662 9661" width="64px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><defs></defs><g id="Layer_x0020_1"><path class="fil0" d="M4378 906c122,0 246,5 369,16 92,8 185,19 277,32 53,-65 110,-127 170,-187 473,-473 1128,-767 1851,-767 722,0 1377,293 1850,767l1 1c474,474 767,1128 767,1850 0,723 -293,1377 -767,1851 -60,60 -122,117 -188,171 14,93 25,185 32,277 10,123 16,245 16,367 0,1209 -490,2304 -1282,3096 -792,792 -1887,1282 -3096,1282 -1209,0 -2304,-490 -3096,-1282 -792,-792 -1282,-1887 -1282,-3096 0,-1209 490,-2304 1282,-3096 792,-792 1887,-1282 3096,-1282zm2868 2774l0 630c0,83 -67,150 -150,150 -83,0 -150,-67 -150,-150l0 -622c-57,-7 -114,-18 -169,-35 -254,-76 -468,-257 -529,-560 -16,-81 37,-161 118,-177 81,-16 161,37 177,118 35,177 165,283 320,330 86,26 180,34 272,26 91,-8 178,-31 251,-68 111,-56 189,-145 189,-259 0,-81 -20,-140 -49,-180 -38,-51 -98,-83 -158,-101 -89,-27 -179,-25 -269,-24 -114,2 -228,4 -362,-37l0 0c-102,-31 -206,-85 -285,-176 -81,-93 -136,-220 -136,-392 0,-242 147,-422 356,-527 83,-42 177,-72 274,-89l0 -624c0,-83 68,-151 151,-151 83,0 151,68 151,151l0 616c57,7 114,18 168,35 254,76 468,257 529,560 16,81 -37,161 -118,177 -81,16 -161,-37 -177,-118 -35,-177 -165,-283 -320,-330 -86,-26 -180,-34 -272,-26 -91,8 -178,31 -251,68 -111,56 -189,145 -189,258 0,91 24,152 61,194 38,43 92,70 147,87l1 0 0 0c89,27 180,26 269,24 113,-2 227,-4 361,37 114,35 230,98 313,209 66,90 110,207 110,359 0,242 -147,422 -356,527 -84,42 -178,72 -275,89zm-2089 -2402l-1 1 -14 21 -1 1 -3 4 -13 19 -1 2 -7 10 -3 5 -4 6 -3 4 -3 5 -3 5 -3 5 -2 3 -1 2 -27 42 -2 3c-77,127 -143,263 -195,405l0 0c-47,129 -83,263 -107,402l-2 12 0 2 -4 29 -1 5 -3 24 0 1 -2 11 -2 12 -1 6 -1 6 -1 12 -1 11 0 1 -3 24 0 5 -1 7 -1 12 -1 10 0 2 -1 12 -1 12 0 4 -1 8 -1 12 -1 9 0 3 -1 12 -1 12 0 2 -1 10 -1 12 0 8 0 4 -1 12 0 12 0 1 0 11 0 12 0 7 0 6 0 12 0 12 0 17 0 13 0 4 0 17 0 9 0 8 1 17 0 5 0 12 1 17 0 1 1 15 1 14 0 3 1 17 1 10 1 6 1 17 1 6 1 10 2 16 0 2 1 14 2 15 0 1 2 16 1 11 1 5 2 16 1 7 1 9 2 16 1 4 2 12 3 16 3 16 2 12 1 4 3 16 2 9 1 7 3 16 1 5 6 27 0 1 3 15 3 13 1 2 4 16 2 10 1 6 4 16 2 6 2 10 4 16 1 2 4 13 4 14 0 1 4 16 3 11 16 51 1 4 4 12 5 15 0 0 19 53 2 7 17 45 1 1 5 14 5 12 1 2 6 15 4 9 2 6 6 15 2 6 4 9 6 14 1 2 6 12 6 13 0 1 7 14 5 10 2 4 0 0c4,6 7,13 10,21l0 0 5 11 5 11 2 3 4 7 5 10 4 7 1 3 11 21 1 1c17,31 34,61 52,91l4 6 9 14 6 9 0 1 6 10 13 20 6 10 4 7 2 3 6 10 7 10 1 1 16 23 4 6 27 38 1 2 6 8 7 9 4 5 3 4 14 18 1 1 7 9 7 9 2 2 5 7 7 9 5 6 2 3 7 9 7 9 0 0 7 9 7 9 3 3 5 6 8 9 6 7 2 2 8 9 8 9 1 1 7 7 8 9 4 4 4 4 8 9 7 7 1 1 8 9 8 8 2 2 14 15 5 5 3 3 8 8 8 8 1 1c418,419 997,677 1637,677l12 0 12 0 6 0 7 0 12 0 11 0 1 0 12 0 12 -1 4 0 8 0 12 -1 10 -1 2 0 12 -1 12 -1 3 0 9 -1 12 -1 8 -1 4 0 12 -1 12 -1 2 0 10 -1 19 -2 5 0 24 -3 1 0 29 -3 6 -1c519,-67 984,-307 1337,-659 419,-419 678,-998 678,-1637 0,-640 -259,-1219 -678,-1638 -419,-419 -998,-678 -1638,-678 -639,0 -1218,259 -1637,678 -92,92 -176,191 -251,297zm3273 3562c-267,167 -567,287 -888,349l-1 0 -12 2 -52 9 0 0 -13 2 -26 4 -13 2 -27 4 -13 2 -5 1 -8 1 -13 2 -11 1 -2 0 -13 1 -13 1 -4 1 -9 1 -14 1 -10 1 -3 0 -14 1 -13 1 -3 0 -10 1 -14 1 -9 1 -4 0 -14 1 -14 1 -2 0 -12 1 -14 1 -8 0 -5 0 -14 1 -14 0 -1 0 -13 0 -14 0 -7 0 -6 0 -14 0 -14 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -1 0 -1 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -4 0 -2 0 -4 0 -2 0 -4 0 -2 0 -4 0 -2 0 -2 0 -2 0 -2 0 -1 0 -1 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0c4,500 -65,1000 -209,1481l1483 0c167,-445 258,-927 258,-1430 0,-117 -5,-232 -14,-343l-1 -6 0 -5 -1 -6 -6 -65 -1 -5 -1 -6 -1 -5 -1 -4zm-3830 -1287l-1 -3 -1 -2 -1 -2 -1 -3 -1 -3 -1 -3 -1 -3 -1 -3 -2 -6 -1 -3 -1 -2 0 -1 -11 -29 0 0 -14 -43 -1 -3 -1 -3 -1 -3 -1 -3 -1 -3 -1 -2 0 -1 -1 -3 -1 -3 -1 -3 -1 -3 -1 -3 -1 -3 -1 -3 -1 -3 -1 -3 0 -1 -1 -3 -1 -3 -1 -3 -1 -3 -1 -3 -1 -3 -2 -7 -1 -3 0 0 -1 -3 -1 -3 -1 -3 -1 -3 -1 -3 -1 -3 -1 -3 0 210 70 0zm-70 -1658c36,-126 81,-247 135,-365 -39,-26 -79,-52 -119,-77l0 0 -16 -10 0 451zm277 -632l18 -29 -4 -1 -5 -1 -5 -1 -6 -1 -54 -5 57 37zm1807 5754c-84,226 -185,447 -302,660 -361,653 -883,1231 -1564,1667 979,-88 1858,-521 2514,-1177 332,-332 607,-720 809,-1150l-1456 0zm-2083 2109c664,-412 1171,-966 1518,-1594 92,-167 173,-339 243,-515l-1762 0 0 2109zm1870 -2411c156,-488 230,-1001 222,-1512l-6 -1 -19 -3 -13 -2 -13 -2 -19 -4 -6 -1 -26 -5 -25 -5 -6 -1 -19 -4 -13 -3 -13 -3 -19 -5 -6 -2 -25 -6 -25 -7 -6 -2 -19 -5 -12 -4 -12 -4 -19 -5 -6 -2 -25 -7 -24 -8 -6 -2 -18 -6 -24 -8 -18 -6 -6 -2 -24 -9 -24 -9 -6 -2 -18 -7 -12 -5 -12 -5 -18 -7 -6 -2 -24 -10 -23 -10 -6 -2 -17 -8 -12 -5 -12 -5 -17 -8 -6 -3 -23 -11 -23 -11 -6 -3 -17 -9 -11 -6 -11 -6 -17 -9 -6 -3 -22 -12 -44 -25 -11 -6 -11 -6 -16 -9 -6 -3 -22 -13 0 0 -22 -13 -5 -3 -16 -10 -11 -7 -11 -7 -16 -10 -5 -4 -21 -14 0 0 -21 -14 -5 -4 -16 -11 -10 -7 -10 -7 -15 -11 -5 -4 -20 -15 -20 -15 -5 -4 -15 -12 -10 -8 -10 -8 -15 -12 -5 -4 -19 -16 0 0 -19 -16 -5 -4 -14 -12 -9 -8 -10 -8 -14 -12 -5 -4 -19 -17 -19 -17 -5 -4 -14 -13 -9 -9 -9 -9 -14 -13 -4 -4 -18 -18 0 0 0 0 -8 -9 -8 -8 -5 -5 -3 -3 -8 -9 -8 -9 -2 -2 -6 -7 -8 -9 -7 -7 -1 -1 -8 -9 -8 -9 -4 -4 -4 -4 -8 -9 -8 -9 -1 -1 -7 -8 -8 -9 -6 -7 -2 -2 -8 -9 -8 -9 -3 -3 -5 -6 -8 -9 -8 -9 -7 -9 -8 -9 -5 -6 -3 -3 -7 -9 -7 -9 -2 -2 -6 -7 -7 -9 -6 -8 -1 -1 -7 -9 -7 -10 -4 -5 -4 -5 -7 -10 -7 -10 -1 -1 -6 -9 -7 -10 -5 -7 -2 -2 -7 -10 -7 -10 -2 -4 -4 -6 -7 -10 -7 -10 0 0 -7 -10 -7 -10 -4 -6 -2 -4 -7 -10 -6 -10 -2 -2 -5 -8 -6 -10 -6 -9 -1 -1 -6 -10 -6 -10 -3 -5 -3 -5 -6 -10 -6 -10 -1 -1 -5 -9 -6 -11 -4 -8 -1 -3 -6 -11 -6 -11 -6 -11 -6 -11 -6 -11 -6 -11 -209 0 0 2859 1870 0zm-2172 -5271c-677,415 -1190,978 -1538,1618 -87,160 -163,324 -230,492l1767 0 0 -2110zm-1875 2412c-145,457 -217,935 -218,1414 -1,489 74,978 223,1446l1870 0 0 -2859 -1875 0zm113 3161c63,159 135,314 217,466 349,648 864,1221 1545,1643l0 -2109 -1761 0zm1544 2327c-699,-448 -1230,-1045 -1592,-1719 -106,-197 -197,-400 -274,-608l-1456 0c202,430 477,818 809,1150 656,656 1535,1089 2513,1177zm-1967 -2629c-140,-469 -209,-958 -209,-1446 1,-477 69,-955 204,-1414l-1478 0c-167,445 -258,927 -258,1430 0,503 91,985 258,1430l1482 0zm96 -3161c80,-218 176,-430 287,-636 361,-664 889,-1252 1580,-1691 -977,88 -1854,521 -2510,1176 -332,332 -607,720 -809,1150l1450 0z"/></g></svg>
                                                </div>

                                                <div class="desc_wrapper">
                                                    <h5 class="title">Cross-Border Payment</h5>
                                                    <div class="desc">
                                                        Pay anyone, anytime fast and easy across the world.
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="column mcb-column one column_divider ">
                                        <hr class="no_line" />
                                    </div>
                                    <div class="column mcb-column one-third column_icon_box ">
                                        <div class="icon_box icon_position_top no_border">
                                            <a  href="content/wallet/our-services.html">
                                                <div class="image_wrapper">
                                                    <!--  <img src="images/home_wallet_iconbox4.png" class="scale-with-grid" alt="home_wallet_iconbox4" width="60" height="60" /> -->
                                                    <svg height="60px" fill="#3d6ee0" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; clip-rule:evenodd" version="1.0" viewBox="0 0 9662 9661" width="60px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><defs></defs><g id="Layer_x0020_1"><path class="fil0" d="M4378 906c122,0 246,5 369,16 92,8 185,19 277,32 53,-65 110,-127 170,-187 473,-473 1128,-767 1851,-767 722,0 1377,293 1850,767l1 1c474,474 767,1128 767,1850 0,723 -293,1377 -767,1851 -60,60 -122,117 -188,171 14,93 25,185 32,277 10,123 16,245 16,367 0,1209 -490,2304 -1282,3096 -792,792 -1887,1282 -3096,1282 -1209,0 -2304,-490 -3096,-1282 -792,-792 -1282,-1887 -1282,-3096 0,-1209 490,-2304 1282,-3096 792,-792 1887,-1282 3096,-1282zm2868 2774l0 630c0,83 -67,150 -150,150 -83,0 -150,-67 -150,-150l0 -622c-57,-7 -114,-18 -169,-35 -254,-76 -468,-257 -529,-560 -16,-81 37,-161 118,-177 81,-16 161,37 177,118 35,177 165,283 320,330 86,26 180,34 272,26 91,-8 178,-31 251,-68 111,-56 189,-145 189,-259 0,-81 -20,-140 -49,-180 -38,-51 -98,-83 -158,-101 -89,-27 -179,-25 -269,-24 -114,2 -228,4 -362,-37l0 0c-102,-31 -206,-85 -285,-176 -81,-93 -136,-220 -136,-392 0,-242 147,-422 356,-527 83,-42 177,-72 274,-89l0 -624c0,-83 68,-151 151,-151 83,0 151,68 151,151l0 616c57,7 114,18 168,35 254,76 468,257 529,560 16,81 -37,161 -118,177 -81,16 -161,-37 -177,-118 -35,-177 -165,-283 -320,-330 -86,-26 -180,-34 -272,-26 -91,8 -178,31 -251,68 -111,56 -189,145 -189,258 0,91 24,152 61,194 38,43 92,70 147,87l1 0 0 0c89,27 180,26 269,24 113,-2 227,-4 361,37 114,35 230,98 313,209 66,90 110,207 110,359 0,242 -147,422 -356,527 -84,42 -178,72 -275,89zm-2089 -2402l-1 1 -14 21 -1 1 -3 4 -13 19 -1 2 -7 10 -3 5 -4 6 -3 4 -3 5 -3 5 -3 5 -2 3 -1 2 -27 42 -2 3c-77,127 -143,263 -195,405l0 0c-47,129 -83,263 -107,402l-2 12 0 2 -4 29 -1 5 -3 24 0 1 -2 11 -2 12 -1 6 -1 6 -1 12 -1 11 0 1 -3 24 0 5 -1 7 -1 12 -1 10 0 2 -1 12 -1 12 0 4 -1 8 -1 12 -1 9 0 3 -1 12 -1 12 0 2 -1 10 -1 12 0 8 0 4 -1 12 0 12 0 1 0 11 0 12 0 7 0 6 0 12 0 12 0 17 0 13 0 4 0 17 0 9 0 8 1 17 0 5 0 12 1 17 0 1 1 15 1 14 0 3 1 17 1 10 1 6 1 17 1 6 1 10 2 16 0 2 1 14 2 15 0 1 2 16 1 11 1 5 2 16 1 7 1 9 2 16 1 4 2 12 3 16 3 16 2 12 1 4 3 16 2 9 1 7 3 16 1 5 6 27 0 1 3 15 3 13 1 2 4 16 2 10 1 6 4 16 2 6 2 10 4 16 1 2 4 13 4 14 0 1 4 16 3 11 16 51 1 4 4 12 5 15 0 0 19 53 2 7 17 45 1 1 5 14 5 12 1 2 6 15 4 9 2 6 6 15 2 6 4 9 6 14 1 2 6 12 6 13 0 1 7 14 5 10 2 4 0 0c4,6 7,13 10,21l0 0 5 11 5 11 2 3 4 7 5 10 4 7 1 3 11 21 1 1c17,31 34,61 52,91l4 6 9 14 6 9 0 1 6 10 13 20 6 10 4 7 2 3 6 10 7 10 1 1 16 23 4 6 27 38 1 2 6 8 7 9 4 5 3 4 14 18 1 1 7 9 7 9 2 2 5 7 7 9 5 6 2 3 7 9 7 9 0 0 7 9 7 9 3 3 5 6 8 9 6 7 2 2 8 9 8 9 1 1 7 7 8 9 4 4 4 4 8 9 7 7 1 1 8 9 8 8 2 2 14 15 5 5 3 3 8 8 8 8 1 1c418,419 997,677 1637,677l12 0 12 0 6 0 7 0 12 0 11 0 1 0 12 0 12 -1 4 0 8 0 12 -1 10 -1 2 0 12 -1 12 -1 3 0 9 -1 12 -1 8 -1 4 0 12 -1 12 -1 2 0 10 -1 19 -2 5 0 24 -3 1 0 29 -3 6 -1c519,-67 984,-307 1337,-659 419,-419 678,-998 678,-1637 0,-640 -259,-1219 -678,-1638 -419,-419 -998,-678 -1638,-678 -639,0 -1218,259 -1637,678 -92,92 -176,191 -251,297zm3273 3562c-267,167 -567,287 -888,349l-1 0 -12 2 -52 9 0 0 -13 2 -26 4 -13 2 -27 4 -13 2 -5 1 -8 1 -13 2 -11 1 -2 0 -13 1 -13 1 -4 1 -9 1 -14 1 -10 1 -3 0 -14 1 -13 1 -3 0 -10 1 -14 1 -9 1 -4 0 -14 1 -14 1 -2 0 -12 1 -14 1 -8 0 -5 0 -14 1 -14 0 -1 0 -13 0 -14 0 -7 0 -6 0 -14 0 -14 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -1 0 -1 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -4 0 -2 0 -4 0 -2 0 -4 0 -2 0 -4 0 -2 0 -2 0 -2 0 -2 0 -1 0 -1 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0 -2 0c4,500 -65,1000 -209,1481l1483 0c167,-445 258,-927 258,-1430 0,-117 -5,-232 -14,-343l-1 -6 0 -5 -1 -6 -6 -65 -1 -5 -1 -6 -1 -5 -1 -4zm-3830 -1287l-1 -3 -1 -2 -1 -2 -1 -3 -1 -3 -1 -3 -1 -3 -1 -3 -2 -6 -1 -3 -1 -2 0 -1 -11 -29 0 0 -14 -43 -1 -3 -1 -3 -1 -3 -1 -3 -1 -3 -1 -2 0 -1 -1 -3 -1 -3 -1 -3 -1 -3 -1 -3 -1 -3 -1 -3 -1 -3 -1 -3 0 -1 -1 -3 -1 -3 -1 -3 -1 -3 -1 -3 -1 -3 -2 -7 -1 -3 0 0 -1 -3 -1 -3 -1 -3 -1 -3 -1 -3 -1 -3 -1 -3 0 210 70 0zm-70 -1658c36,-126 81,-247 135,-365 -39,-26 -79,-52 -119,-77l0 0 -16 -10 0 451zm277 -632l18 -29 -4 -1 -5 -1 -5 -1 -6 -1 -54 -5 57 37zm1807 5754c-84,226 -185,447 -302,660 -361,653 -883,1231 -1564,1667 979,-88 1858,-521 2514,-1177 332,-332 607,-720 809,-1150l-1456 0zm-2083 2109c664,-412 1171,-966 1518,-1594 92,-167 173,-339 243,-515l-1762 0 0 2109zm1870 -2411c156,-488 230,-1001 222,-1512l-6 -1 -19 -3 -13 -2 -13 -2 -19 -4 -6 -1 -26 -5 -25 -5 -6 -1 -19 -4 -13 -3 -13 -3 -19 -5 -6 -2 -25 -6 -25 -7 -6 -2 -19 -5 -12 -4 -12 -4 -19 -5 -6 -2 -25 -7 -24 -8 -6 -2 -18 -6 -24 -8 -18 -6 -6 -2 -24 -9 -24 -9 -6 -2 -18 -7 -12 -5 -12 -5 -18 -7 -6 -2 -24 -10 -23 -10 -6 -2 -17 -8 -12 -5 -12 -5 -17 -8 -6 -3 -23 -11 -23 -11 -6 -3 -17 -9 -11 -6 -11 -6 -17 -9 -6 -3 -22 -12 -44 -25 -11 -6 -11 -6 -16 -9 -6 -3 -22 -13 0 0 -22 -13 -5 -3 -16 -10 -11 -7 -11 -7 -16 -10 -5 -4 -21 -14 0 0 -21 -14 -5 -4 -16 -11 -10 -7 -10 -7 -15 -11 -5 -4 -20 -15 -20 -15 -5 -4 -15 -12 -10 -8 -10 -8 -15 -12 -5 -4 -19 -16 0 0 -19 -16 -5 -4 -14 -12 -9 -8 -10 -8 -14 -12 -5 -4 -19 -17 -19 -17 -5 -4 -14 -13 -9 -9 -9 -9 -14 -13 -4 -4 -18 -18 0 0 0 0 -8 -9 -8 -8 -5 -5 -3 -3 -8 -9 -8 -9 -2 -2 -6 -7 -8 -9 -7 -7 -1 -1 -8 -9 -8 -9 -4 -4 -4 -4 -8 -9 -8 -9 -1 -1 -7 -8 -8 -9 -6 -7 -2 -2 -8 -9 -8 -9 -3 -3 -5 -6 -8 -9 -8 -9 -7 -9 -8 -9 -5 -6 -3 -3 -7 -9 -7 -9 -2 -2 -6 -7 -7 -9 -6 -8 -1 -1 -7 -9 -7 -10 -4 -5 -4 -5 -7 -10 -7 -10 -1 -1 -6 -9 -7 -10 -5 -7 -2 -2 -7 -10 -7 -10 -2 -4 -4 -6 -7 -10 -7 -10 0 0 -7 -10 -7 -10 -4 -6 -2 -4 -7 -10 -6 -10 -2 -2 -5 -8 -6 -10 -6 -9 -1 -1 -6 -10 -6 -10 -3 -5 -3 -5 -6 -10 -6 -10 -1 -1 -5 -9 -6 -11 -4 -8 -1 -3 -6 -11 -6 -11 -6 -11 -6 -11 -6 -11 -6 -11 -209 0 0 2859 1870 0zm-2172 -5271c-677,415 -1190,978 -1538,1618 -87,160 -163,324 -230,492l1767 0 0 -2110zm-1875 2412c-145,457 -217,935 -218,1414 -1,489 74,978 223,1446l1870 0 0 -2859 -1875 0zm113 3161c63,159 135,314 217,466 349,648 864,1221 1545,1643l0 -2109 -1761 0zm1544 2327c-699,-448 -1230,-1045 -1592,-1719 -106,-197 -197,-400 -274,-608l-1456 0c202,430 477,818 809,1150 656,656 1535,1089 2513,1177zm-1967 -2629c-140,-469 -209,-958 -209,-1446 1,-477 69,-955 204,-1414l-1478 0c-167,445 -258,927 -258,1430 0,503 91,985 258,1430l1482 0zm96 -3161c80,-218 176,-430 287,-636 361,-664 889,-1252 1580,-1691 -977,88 -1854,521 -2510,1176 -332,332 -607,720 -809,1150l1450 0z"/></g></svg>
                                                </div>
                                                <div class="desc_wrapper">
                                                    <h5 class="title">Highly Scalable global payments platform. </h5>
                                                    <div class="desc">
                                                        Based on Blockchain the platform is scalable and faster.
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="column mcb-column one-third column_icon_box ">
                                        <div class="icon_box icon_position_top no_border">
                                            <a  href="content/wallet/our-services.html">
                                                <div class="image_wrapper"><!-- <img src="images/home_wallet_iconbox5.png" class="scale-with-grid" alt="home_wallet_iconbox5" width="60" height="60" /> -->
                                                    <svg style="height:60px;"" id="Layer_1_1_" style="enable-background:new 0 0 64 64;" version="1.1" viewBox="0 0 64 64" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="M53,57V40c0-2.757-2.243-5-5-5h-2v-2.842c0-1.229-0.343-2.4-0.927-3.431   c1.315-0.317,2.313-0.803,2.374-0.833l1.397-0.699l-1.22-0.977C43.08,22.584,43,17.053,43,16.997l-0.051,0   C42.979,16.668,43,16.337,43,16V9c0-2.757-2.243-5-5-5h-0.465L37.02,3.227C36.09,1.832,34.535,1,32.859,1H30c-4.963,0-9,4.037-9,9   v6c0,0.338,0.021,0.67,0.051,1H21c0,0.056-0.053,5.562-4.625,9.219l-1.22,0.977l1.397,0.699c0.061,0.03,1.059,0.515,2.374,0.833   C18.343,29.758,18,30.929,18,32.158V35h-2c-2.757,0-5,2.243-5,5v17H6v3c0,1.654,1.346,3,3,3h46c1.654,0,3-1.346,3-3v-3H53z    M37.414,35l1.803-1.803l-0.807-1.613l2.912-0.971l-1.376-3.44l0.81,0.304C42.696,28.204,44,30.085,44,32.158V35H37.414z    M29.414,35l-2.197-2.197l1.193-2.387l-3.088-1.029l1.266-3.164l0.698-0.262L30.573,35H29.414z M41,16h-2.184   c-0.414-1.161-1.514-2-2.816-2s-2.402,0.839-2.816,2h-2.369c-0.414-1.161-1.514-2-2.816-2s-2.402,0.839-2.816,2H23v-1.382   l1.336-0.668C25.579,13.328,26.971,13,28.36,13h3.823c1.387,0,2.729-0.406,3.883-1.176l0.82-0.547   c1.153,1.008,2.586,1.597,4.113,1.701V16z M37,17c0,0.552-0.448,1-1,1s-1-0.448-1-1s0.448-1,1-1S37,16.448,37,17z M29,17   c0,0.552-0.448,1-1,1s-1-0.448-1-1s0.448-1,1-1S29,16.448,29,17z M25.184,18c0.414,1.161,1.514,2,2.816,2s2.402-0.839,2.816-2   h2.369c0.414,1.161,1.514,2,2.816,2s2.402-0.839,2.816-2h1.953c-0.913,4.002-4.494,7-8.768,7s-7.855-2.998-8.768-7H25.184z    M34.298,26.754L32,33.075l-2.298-6.32C30.444,26.913,31.212,27,32,27S33.556,26.913,34.298,26.754z M36.714,25.961l0.698,0.262   l1.266,3.164l-3.088,1.029l1.193,2.387L34.586,35h-1.159L36.714,25.961z M45.122,26.649c-0.441,0.133-0.949,0.25-1.471,0.309   c-0.635-0.571-1.366-1.045-2.193-1.355l-2.517-0.944l-0.012-0.031l-0.034,0.013l-0.075-0.028c1.209-0.959,2.212-2.165,2.932-3.544   C42.326,22.799,43.337,24.831,45.122,26.649z M30,3h2.859c1.005,0,1.938,0.499,2.496,1.336L36.465,6H38c1.654,0,3,1.346,3,3v1.953   c-1.151-0.111-2.223-0.59-3.051-1.417l-0.822-0.822l-2.17,1.447C34.133,10.71,33.174,11,32.184,11H28.36   c-1.698,0-3.399,0.401-4.919,1.161L23,12.382V10C23,6.141,26.141,3,30,3z M22.248,21.07c0.72,1.379,1.722,2.584,2.932,3.544   l-0.075,0.028l-0.034-0.013l-0.012,0.031l-2.516,0.944c-0.827,0.31-1.558,0.784-2.194,1.355c-0.522-0.059-1.031-0.176-1.471-0.309   C20.663,24.831,21.674,22.799,22.248,21.07z M20,32.158c0-2.073,1.304-3.954,3.245-4.682l0.808-0.303l-1.376,3.44l2.912,0.971   l-0.807,1.613L26.586,35H20V32.158z M13,40c0-1.654,1.346-3,3-3h32c1.654,0,3,1.346,3,3v17H13V40z M56,60c0,0.552-0.448,1-1,1H9   c-0.552,0-1-0.448-1-1v-1h48V60z" style="fill:#3d6ee0;"/><path d="M32,43c-2.757,0-5,2.243-5,5s2.243,5,5,5s5-2.243,5-5S34.757,43,32,43z M32,51c-1.654,0-3-1.346-3-3   s1.346-3,3-3s3,1.346,3,3S33.654,51,32,51z" style="fill:#3d6ee0;"/></g></svg>
                                                </div>
                                                <div class="desc_wrapper">
                                                    <h5 class="title">Micro Lending to Women</h5>
                                                    <div class="desc">
                                                        Helping Women entrepreneurs achieve their dreams through micro lending.
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="column mcb-column one-third column_icon_box ">
                                        <div class="icon_box icon_position_top no_border">
                                            <a  href="content/wallet/our-services.html">
                                                <div class="image_wrapper">
                                                    <!-- <img src="images/home_wallet_iconbox6.png" class="scale-with-grid" alt="home_wallet_iconbox6" width="60" height="60" /> -->
                                                    <svg enable-background="new 0 0 70 70" id="Layer_1" version="1.1" viewBox="0 0 70 70" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  style="height:60px;"><g><path d="M62.6357422,53.3662109c-0.0039063,0-0.0078125,0-0.0107422,0   c-0.4150391-0.0058594-0.7451172-0.3466797-0.7392578-0.7607422l0.4990234-33.2841797   c0.0224609-1.5146484-0.0380859-3.2060547-1.0439453-4.0869141c-0.8115234-0.7128906-2.0888672-0.7763672-3.4375-0.7822266   l-23.8652344-0.0908203c-3.5449219-0.0136719-7.0029297-0.0771484-10.3466797-0.1386719   c-3.3232422-0.0615234-6.7587891-0.125-10.2753906-0.1386719c-1.9121094,0.0097656-3.6962891,0.0761719-4.8398438,1.1503906   c-1.2890625,1.2099609-1.3486328,3.2939453-1.2978516,5.3242188c0.1044922,4.1972656,0.140625,8.4941406,0.1748047,12.6503906   C7.5068359,39.5820313,7.5625,46.1708984,7.8652344,52.578125c0.0195313,0.4130859-0.2998047,0.7646484-0.7138672,0.7841797   c-0.375,0.0341797-0.7646484-0.2988281-0.7841797-0.7138672C6.0625,46.2128906,6.0068359,39.6083984,5.9541016,33.2216797   c-0.0351563-4.1494141-0.0712891-8.4414063-0.1757813-12.6259766c-0.0556641-2.2666016,0.0302734-4.8212891,1.7705078-6.4550781   c1.5458984-1.4511719,3.7451172-1.5449219,5.8730469-1.5566406c3.5273438,0.0136719,6.96875,0.0771484,10.296875,0.1386719   c3.3388672,0.0615234,6.7910156,0.125,10.3251953,0.1386719l23.8652344,0.0908203   c1.2431641,0.0048828,3.1201172,0.0136719,4.4208984,1.1542969c1.4863281,1.3027344,1.5820313,3.3867188,1.5546875,5.2373047   l-0.4990234,33.2832031C63.3798828,53.0380859,63.0449219,53.3662109,62.6357422,53.3662109z" fill="#3d6ee0"/><path d="M8.3222656,58.0742188c-0.6943359,0-1.5009766-0.0244141-2.2861328-0.3125   C4.9384766,57.3613281,4.1669922,56.4941406,4.0234375,55.5c-0.2041016-1.4013672,0.8330078-2.5478516,1.8818359-3.0195313   c0.921875-0.4130859,1.9023438-0.4472656,2.75-0.4472656l0.3662109,0.0019531l52.5341797,0.4501953   c0.7607422,0.0058594,1.7080078,0.0126953,2.5634766,0.4160156c1.0839844,0.5087891,1.7226563,1.5839844,1.5537109,2.6132813   c-0.2216797,1.3583984-1.6015625,2.1474609-3.7861328,2.1650391L8.3222656,58.0742188z M8.6552734,53.5332031   c-0.6923828,0-1.484375,0.0244141-2.1357422,0.3164063c-0.5546875,0.2490234-1.0986328,0.8369141-1.0117188,1.4355469   c0.0722656,0.5009766,0.5761719,0.8974609,1.0439453,1.0683594c0.5546875,0.203125,1.2050781,0.2207031,1.7705078,0.2207031   l0.3115234-0.0019531L61.875,56.1796875c1.0498047-0.0078125,2.2099609-0.2509766,2.3173828-0.9082031   c0.0644531-0.3945313-0.3105469-0.8242188-0.7119141-1.0126953c-0.5576172-0.2626953-1.2587891-0.2685547-1.9375-0.2734375   L8.6552734,53.5332031z" fill="#3d6ee0"/><path d="M18.9492188,53.4648438c-0.3164063,0-0.6103516-0.2021484-0.7138672-0.5185547   c-0.1972656-0.6103516-0.1621094-1.2207031-0.1308594-1.7597656c0.0097656-0.1660156,0.0195313-0.3320313,0.0214844-0.4960938   c0.0078125-0.5673828-0.1318359-0.9951172-0.3740234-1.1455078c-0.2128906-0.1318359-0.6025391-0.1230469-0.9169922-0.1142578   L13.1875,49.5136719c-0.4052734,0.0087891-0.7841797,0.0292969-0.9794922,0.1835938   c-0.1806641,0.1425781-0.2841797,0.4873047-0.2832031,0.9462891c0.0009766,0.1572266,0.0097656,0.3164063,0.0185547,0.4755859   c0.0224609,0.4189453,0.0488281,0.8935547-0.0585938,1.3779297c-0.0888672,0.4042969-0.4902344,0.6582031-0.8945313,0.5703125   c-0.4042969-0.0898438-0.6591797-0.4902344-0.5703125-0.8945313c0.0625-0.2841797,0.0449219-0.6181641,0.0253906-0.9716797   c-0.0097656-0.1855469-0.0195313-0.3701172-0.0205078-0.5537109c-0.0019531-0.9492188,0.2929688-1.6845703,0.8535156-2.1269531   c0.6054688-0.4794922,1.3701172-0.4960938,1.875-0.5068359l3.6474609-0.0830078   c0.4863281-0.0107422,1.1503906-0.0263672,1.7412109,0.3388672c0.7148438,0.4433594,1.1005859,1.3105469,1.0839844,2.4414063   c-0.0029297,0.1855469-0.0126953,0.3730469-0.0234375,0.5615234c-0.0263672,0.4472656-0.0507813,0.8691406,0.0605469,1.2109375   c0.1269531,0.3945313-0.0888672,0.8173828-0.4824219,0.9453125C19.1035156,53.453125,19.0253906,53.4648438,18.9492188,53.4648438z   " fill="#3d6ee0"/><path d="M12.8574219,28.0429688c-0.0039063,0-0.0087891,0-0.0126953,0   c-0.4140625-0.0078125-0.7441406-0.3486328-0.7373047-0.7626953l0.1474609-8.4189453   c0.0078125-0.4091797,0.3417969-0.7363281,0.75-0.7363281c0.0039063,0,0.0087891,0,0.0136719,0   c0.4140625,0.0078125,0.7431641,0.3496094,0.7363281,0.7636719l-0.1474609,8.4169922   C13.6005859,27.7158203,13.265625,28.0429688,12.8574219,28.0429688z" fill="#3d6ee0"/><path d="M31.2851563,28.3701172c-0.3740234,0-0.6972656-0.2792969-0.7431641-0.6591797   c-0.3554688-2.9160156-0.4736328-5.8847656-0.3496094-8.8222656c0.0175781-0.4140625,0.359375-0.7529297,0.7802734-0.7177734   c0.4140625,0.0166016,0.7353516,0.3662109,0.7177734,0.7802734c-0.1201172,2.8574219-0.0058594,5.7431641,0.3398438,8.578125   c0.0507813,0.4111328-0.2421875,0.7851563-0.6533203,0.8349609C31.3457031,28.3681641,31.3154297,28.3701172,31.2851563,28.3701172   z" fill="#3d6ee0"/><path d="M22.0117188,27.1640625c-0.3974609,0-0.7294922-0.3134766-0.7480469-0.7148438l-0.3193359-6.7900391   c-0.0195313-0.4140625,0.2998047-0.7646484,0.7138672-0.7841797c0.3886719-0.0263672,0.765625,0.2998047,0.7841797,0.7138672   l0.3193359,6.7900391c0.0195313,0.4140625-0.2998047,0.7646484-0.7138672,0.7841797   C22.0361328,27.1640625,22.0244141,27.1640625,22.0117188,27.1640625z" fill="#3d6ee0"/><path d="M22.6914063,23.8535156c-1.2597656,0-2.5224609-0.0654297-3.7734375-0.1972656   c-0.4121094-0.0439453-0.7109375-0.4121094-0.6679688-0.8242188c0.0439453-0.4121094,0.4208984-0.7128906,0.8242188-0.6679688   c1.9912109,0.2089844,4.0078125,0.2441406,5.9970703,0.1074219c0.4091797-0.0195313,0.7714844,0.2832031,0.7998047,0.6962891   c0.0292969,0.4130859-0.2832031,0.7714844-0.6962891,0.7998047C24.3505859,23.8251953,23.5214844,23.8535156,22.6914063,23.8535156   z" fill="#3d6ee0"/><path d="M36.875,21.640625c-0.3984375,0-0.7304688-0.3144531-0.7480469-0.7177734   c-0.0185547-0.4140625,0.3027344-0.7636719,0.7167969-0.78125l6.2900391-0.2724609   c0.3779297-0.0419922,0.7626953,0.3017578,0.78125,0.7167969c0.0185547,0.4140625-0.3027344,0.7636719-0.7167969,0.78125   l-6.2900391,0.2724609C36.8974609,21.640625,36.8867188,21.640625,36.875,21.640625z" fill="#3d6ee0"/><path d="M36.3291016,26.0615234c-0.3583984,0-0.6757813-0.2578125-0.7382813-0.6240234   c-0.0693359-0.4082031,0.2050781-0.7958984,0.6132813-0.8652344c2.4628906-0.4208984,4.9775391-0.5380859,7.4755859-0.3525391   c0.4130859,0.03125,0.7226563,0.390625,0.6923828,0.8037109s-0.3876953,0.7226563-0.8037109,0.6923828   c-2.3769531-0.1787109-4.7675781-0.0644531-7.1123047,0.3349609   C36.4130859,26.0585938,36.3710938,26.0615234,36.3291016,26.0615234z" fill="#3d6ee0"/></g></svg>
                                                </div>
                                                <div class="desc_wrapper">
                                                    <h5 class="title">Giving back to Education</h5>
                                                    <div class="desc">
                                                        Contributing to the education of children in the lower income group.
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="section mcb-section full-width" style="padding-top:90px; padding-bottom:0px; background-color:#f0f1f3; background-image:url(images/home_wallet_bgsection1.png); background-repeat:repeat-x; background-position:center bottom;">
                        <div class="section_wrapper mcb-section-inner">
                            <div class="wrap mcb-wrap one  column-margin-0px valign-top clearfix">
                                <div class="mcb-wrap-inner">
                                    <div class="column mcb-column one column_column ">
                                        <div class="column_attr clearfix align_center" style=" padding:0 12%;">
                                            <h2>Change is possible with Blockchain</h2>
                                            <h6>Bringing the power of blockchain to the common man.</h6>
                                        </div>
                                    </div>
                                    <div class="column mcb-column one column_divider ">
                                        <hr class="no_line" style="margin: 0 auto 40px;" />
                                    </div>
                                    <div class="column mcb-column one column_image ">
                                        <div class="image_frame image_item scale-with-grid aligncenter no_border hover-disable">
                                            <div class="image_wrapper">
                                                    <div class="mask"></div><img class="scale-with-grid" src="images/child.png" alt="home_wallet_pic1"  />
                                                <div class="image_links ">
                                                    <a href="content/wallet/contact-us.html" class="link"><i class="icon-link"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="section mcb-section  section-border-bottom " style="padding-top:110px; padding-bottom:60px;">
                        <div class="section_wrapper mcb-section-inner">
                            <div class="wrap mcb-wrap one  valign-top clearfix">
                                <div class="mcb-wrap-inner">
                                    <div class="column mcb-column one column_column ">
                                        <div class="column_attr clearfix align_center">
                                            <h2>News and articles</h2>
                                        </div>
                                    </div>
                                    <div class="column mcb-column one column_blog_slider ">
                                        <div class="blog_slider clearfix  flat hide-arrows">
                                            <div class="blog_slider_header">
                                                <a class="button button_js slider_prev" href="#"><span class="button_icon"><i class="icon-left-open-big"></i></span></a><a class="button button_js slider_next" href="#"><span class="button_icon"><i class="icon-right-open-big"></i></span></a>
                                            </div>
                                            <ul class="blog_slider_ul">
                                                <li class="post-2277 post  format-standard has-post-thumbnail  category-events tag-video ">
                                                    <div class="item_wrapper">
                                                        <div class="image_frame scale-with-grid">
                                                            <div class="image_wrapper">
                                                                <a href="content/wallet/item.html"><img width="960" height="750" src="images/home_wallet_blog1-960x750.jpg" class="scale-with-grid wp-post-image" alt="home_wallet_blog1" />
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="date_label">
                                                            May 8, 2014
                                                        </div>
                                                        <div class="desc">
                                                            <h4><a href="content/wallet/item.html">Vestibulum commodo volutpat laoreet</a></h4>
                                                            <hr class="hr_color" />
                                                            <a href="content/wallet/item.html" class="button button_left button_js"><span class="button_icon"><i class="icon-layout"></i></span><span class="button_label">Read more</span></a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="post-2279 post  format-standard has-post-thumbnail  category-events tag-motion tag-video">
                                                    <div class="item_wrapper">
                                                        <div class="image_frame scale-with-grid">
                                                            <div class="image_wrapper">
                                                                <a href="content/wallet/item.html"><img width="960" height="750" src="images/home_wallet_blog2-960x750.jpg" class="scale-with-grid wp-post-image" alt="home_wallet_blog2" />
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="date_label">
                                                            May 7, 2014
                                                        </div>
                                                        <div class="desc">
                                                            <h4><a href="content/wallet/item.html">Quisque lorem tortor fringilla sed vesti bulum</a></h4>
                                                            <hr class="hr_color" />
                                                            <a href="content/wallet/item.html" class="button button_left button_js"><span class="button_icon"><i class="icon-layout"></i></span><span class="button_label">Read more</span></a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="post-2281 post  format-standard has-post-thumbnail  category-events ">
                                                    <div class="item_wrapper">
                                                        <div class="image_frame scale-with-grid">
                                                            <div class="image_wrapper">
                                                                <a href="content/wallet/item.html"><img width="960" height="750" src="images/home_wallet_blog3-960x750.jpg" class="scale-with-grid wp-post-image" alt="home_wallet_blog3" />
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="date_label">
                                                            May 6, 2014
                                                        </div>
                                                        <div class="desc">
                                                            <h4><a href="content/wallet/item.html">Vivamus sit amet metus sem imperdiet</a></h4>
                                                            <hr class="hr_color" />
                                                            <a href="content/wallet/item.html" class="button button_left button_js"><span class="button_icon"><i class="icon-layout"></i></span><span class="button_label">Read more</span></a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="post-2283 post  format-standard has-post-thumbnail  category-events tag-design">
                                                    <div class="item_wrapper">
                                                        <div class="image_frame scale-with-grid">
                                                            <div class="image_wrapper">
                                                                <a href="content/wallet/item.html"><img width="960" height="750" src="images/home_wallet_blog4-960x750.jpg" class="scale-with-grid wp-post-image" alt="home_wallet_blog4" />
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="date_label">
                                                            May 5, 2014
                                                        </div>
                                                        <div class="desc">
                                                            <h4><a href="content/wallet/item.html">Aenean gravida vitae lorem fermentum</a></h4>
                                                            <hr class="hr_color" />
                                                            <a href="content/wallet/item.html" class="button button_left button_js"><span class="button_icon"><i class="icon-layout"></i></span><span class="button_label">Read more</span></a>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="slider_pagination"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="section mcb-section" style="padding-top:110px; padding-bottom:60px;">
                        <div class="section_wrapper mcb-section-inner">
                            <div class="wrap mcb-wrap one  valign-top clearfix">
                                <div class="mcb-wrap-inner">
                                    <div class="column mcb-column one column_column ">
                                        <div class="column_attr clearfix align_center" style=" padding:0 12%;">
                                            <h2>Clients and partners</h2>
                                            <h6>Vestibulum dapibus, mauris nec malesuada fames ac turpis velit, rhoncus eu, luctus et interdum adipiscing wisi. Aliquam erat ac ipsum. Integer aliquam purus. Quisque lorem tortor fringilla sed.</h6>
                                        </div>
                                    </div>
                                    <div class="column mcb-column one column_clients ">
                                        <ul class="clients clearfix  clients_tiles">
                                            <li style="width:16.667%">
                                                <div class="client_wrapper">
                                                    <a target="_blank" href="#" title="Client 1">
                                                        <div class="gs-wrapper"><img width="145" height="75" src="images/home_wallet_client_1-145x75.png" class="scale-with-grid wp-post-image" alt="home_wallet_client_1" />
                                                        </div>
                                                    </a>
                                                </div>
                                            </li>
                                            <li style="width:16.667%">
                                                <div class="client_wrapper">
                                                    <a target="_blank" href="#" title="Client 2">
                                                        <div class="gs-wrapper"><img width="145" height="75" src="images/home_wallet_client_2-145x75.png" class="scale-with-grid wp-post-image" alt="home_wallet_client_2" />
                                                        </div>
                                                    </a>
                                                </div>
                                            </li>
                                            <li style="width:16.667%">
                                                <div class="client_wrapper">
                                                    <a target="_blank" href="#" title="Client 3">
                                                        <div class="gs-wrapper"><img width="145" height="75" src="images/home_wallet_client_3-145x75.png" class="scale-with-grid wp-post-image" alt="home_wallet_client_3" />
                                                        </div>
                                                    </a>
                                                </div>
                                            </li>
                                            <li style="width:16.667%">
                                                <div class="client_wrapper">
                                                    <a target="_blank" href="#" title="Client 4">
                                                        <div class="gs-wrapper"><img width="145" height="75" src="images/home_wallet_client_4-145x75.png" class="scale-with-grid wp-post-image" alt="home_wallet_client_4" />
                                                        </div>
                                                    </a>
                                                </div>
                                            </li>
                                            <li style="width:16.667%">
                                                <div class="client_wrapper">
                                                    <a target="_blank" href="#" title="Client 5">
                                                        <div class="gs-wrapper"><img width="145" height="75" src="images/home_wallet_client_5-145x75.png" class="scale-with-grid wp-post-image" alt="home_wallet_client_5" />
                                                        </div>
                                                    </a>
                                                </div>
                                            </li>
                                            <li style="width:16.667%">
                                                <div class="client_wrapper">
                                                    <a target="_blank" href="#" title="Client 6">
                                                        <div class="gs-wrapper"><img width="145" height="75" src="images/home_wallet_client_6-145x75.png" class="scale-with-grid wp-post-image" alt="home_wallet_client_6" />
                                                        </div>
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="section mcb-section" style="padding-top:110px; padding-bottom:0px;" data-parallax="3d" id="whitepaper"><img class="mfn-parallax" src="img/home_wallet_bgsection2.jpg" alt="">
                        <div class="section_wrapper mcb-section-inner">
                            <div class="wrap mcb-wrap one  column-margin-0px valign-top clearfix">
                                <div class="mcb-wrap-inner">
                                    <div class="column mcb-column one column_column ">
                                        <div class="column_attr clearfix align_center" style=" padding:0 12%;">
                                            <h1 style="color: #fff;">Read the Cowriecoin Whitepaper</h1>
                                            <h6 style="color: #fff;">Read Our Whitepaper to understand and know more about what we do.</h6>
                                            <hr class="no_line" style="margin: 0 auto 45px;" />
                                            <!--  <a style="margin: 0 10px 5px;" href="#"><img src="images/home_wallet_button1.png" alt="">
                                             </a> -->
                                            <a class="white-paper" href="#">
                                                Read Whitepaper
                                            </a>
                                        </div>
                                    </div>
                                    <div class="column mcb-column one column_divider ">
                                        <hr class="no_line" style="margin: 0 auto 50px;" />
                                    </div>
                                    <div class="column mcb-column one column_image ">
                                        <div class="image_frame image_item no_link scale-with-grid aligncenter no_border">
                                            <div class="image_wrapper"><img class="scale-with-grid" src="img/home_wallet_slider_pic2.png" alt="home_wallet_slider_pic2" width="698" height="337" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <footer id="Footer" class="clearfix">
        <div class="widgets_wrapper" style="padding:50px 0;">
            <div class="container">
                <div class="column one-fifth">
                    <aside class="widget widget_text">
                        <div class="textwidget">
                            <div class="image_frame image_item no_link scale-with-grid alignnone no_border">
                                <div class="image_wrapper">
                                    <!-- <img class="scale-with-grid" src="images/wallet.png" alt="wallet" width="147" height="30" /> -->
                                    <!-- <p class="footer-logo">COWRIE<span>COIN</span></p> -->
                                    <a href="{{ url('/home') }}"><img src="{{ asset('adassets/images/cowrie_coin_logo.png') }}" width="150"></a>
                                </div>
                            </div>
                            <hr class="no_line" style="margin: 0 auto 20px;" />
                            <p style="margin-right: 5%; font-size: 13px;">
                                A Startup that is building the next generation global financial infrastructure through blockchain technology.
                            </p>
                        </div>
                    </aside>
                </div>
                <!--<div class="column one-fifth">
                    <aside class="widget widget_text">
                        <div class="textwidget">
                            <h6 style="border-bottom: 1px solid #464862; padding-bottom: 10px; ">Shortcut links</h6>
                            <ul style="line-height: 40px;">
                                <li>
                                    <a href="#">Aliquam</a>
                                </li>
                                <li>
                                    <a href="#">Nulla imperdiet</a>
                                </li>
                                <li>
                                    <a href="#">Quisque</a>
                                </li>
                                <li>
                                    <a href="#">Etiam commodo</a>
                                </li>
                                <li>
                                    <a href="#">Morbi</a>
                                </li>
                            </ul>
                        </div>
                    </aside>
                </div>
                <div class="column one-fifth">
                    <aside class="widget widget_text">
                        <div class="textwidget">
                            <h6 style="border-bottom: 1px solid #464862; padding-bottom: 10px; ">Our mission</h6>
                            <ul style="line-height: 40px;">
                                <li>
                                    <a href="#">Curabitur</a>
                                </li>
                                <li>
                                    <a href="#">Donec ligula</a>
                                </li>
                                <li>
                                    <a href="#">Vestibulum</a>
                                </li>
                            </ul>
                        </div>
                    </aside>
                </div>
                <div class="column one-fifth">
                    <aside id="text-6" class="widget widget_text">
                        <div class="textwidget">
                            <h6 style="border-bottom: 1px solid #464862; padding-bottom: 10px; ">About us</h6>
                            <ul style="line-height: 40px;">
                                <li>
                                    <a href="#">Vivamus</a>
                                </li>
                                <li>
                                    <a href="#">Etiam commodo</a>
                                </li>
                                <li>
                                    <a href="#">Morbi</a>
                                </li>
                                <li>
                                    <a href="#">Mauris</a>
                                </li>
                            </ul>
                        </div>
                    </aside>
                </div> -->
                <div class="column one-fifth" style="float:right">
                    <aside id="text-7" class="widget widget_text">
                        <div class="textwidget">
                            <h6 style="border-bottom: 1px solid #464862; padding-bottom: 10px; ">Get in touch</h6>
                            <p style="font-size: 24px; line-height: 34px;">
                                <a style="color: #fff;" href="#"><i class="icon-facebook-circled"></i></a><a style="color: #fff;" href="#"><i class="icon-gplus-circled"></i></a><a style="color: #fff;" href="#"><i class="icon-twitter-circled"></i></a><a style="color: #fff;" href="#"><i class="icon-pinterest-circled"></i></a><a style="color: #fff;" href="#"><i class="icon-linkedin-circled"></i></a>
                            </p>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
        <div class="footer_copy">
            <div class="container">
                <div class="column one">
                    <div class="copyright">
                        &copy; 2018 Cowriecoin all rights reserved.
                    </div>
                    <ul class="social"></ul>
                </div>
            </div>
        </div>
    </footer>
</div>

<!-- JS -->
<script src="js/jquery-2.1.4.min.js"></script>
<script>
    $(document).ready(function(){
        // Add smooth scrolling to all links
        $("a").on('click', function(event) {

            // Make sure this.hash has a value before overriding default behavior
            if (this.hash !== "") {
                // Prevent default anchor click behavior
                event.preventDefault();

                // Store hash
                var hash = this.hash;

                // Using jQuery's animate() method to add smooth page scroll
                // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 800, function(){

                    // Add hash (#) to URL when done scrolling (default click behavior)
                    window.location.hash = hash;
                });
            } // End if
        });
    });
</script>
<script src="js/mfn.menu.js"></script>
<script src="js/jquery.plugins.js"></script>
<script src="js/jquery.jplayer.min.js"></script>
<script src="js/animations.js"></script>
<script src="js/translate3d.js"></script>
<script src="js/scripts.js"></script>

<script src="js/jquery.themepunch.tools.min.js"></script>
<script src="js/jquery.themepunch.revolution.min.js"></script>
<script src="js/revolution.extension.video.min.js"></script>
<script src="js/revolution.extension.slideanims.min.js"></script>
<script src="js/revolution.extension.actions.min.js"></script>
<script src="js/revolution.extension.layeranimation.min.js"></script>
<script src="js/revolution.extension.kenburn.min.js"></script>
<script src="js/revolution.extension.navigation.min.js"></script>
<script src="js/revolution.extension.migration.min.js"></script>
<script src="js/revolution.extension.parallax.min.js"></script>

<script>
    var tpj = jQuery;
    var revapi1;
    tpj(document).ready(function() {
        if (tpj("#rev_slider_1_1").revolution == undefined) {
            revslider_showDoubleJqueryError("#rev_slider_1_1");
        } else {
            revapi1 = tpj("#rev_slider_1_1").show().revolution({
                sliderType: "hero",
                sliderLayout: "auto",
                dottedOverlay: "none",
                delay: 9000,
                navigation: {},
                visibilityLevels: [1240, 1024, 778, 480],
                gridwidth: 1240,
                gridheight: 770,
                lazyType: "none",
                shadow: 0,
                spinner: "spinner2",
                autoHeight: "off",
                disableProgressBar: "on",
                hideThumbsOnMobile: "off",
                hideSliderAtLimit: 0,
                hideCaptionAtLimit: 0,
                hideAllCaptionAtLilmit: 0,
                debugMode: false,
                fallbacks: {
                    simplifyAll: "off",
                    disableFocusListener: false,
                }
            });
        }
    });
    /*]]>*/
</script>

<script id="mfn-dnmc-retina-js">
    jQuery(window).load(function() {
        var retina = window.devicePixelRatio > 1 ? true : false;
        if (retina) {
            var retinaEl = jQuery("#logo img.logo-main");
            var retinaLogoW = retinaEl.width();
            var retinaLogoH = retinaEl.height();
            retinaEl.attr("src", "adassets/images/cowrie_coin_logo.png").width(retinaLogoW).height(retinaLogoH);
            var stickyEl = jQuery("#logo img.logo-sticky");
            var stickyLogoW = stickyEl.width();
            var stickyLogoH = stickyEl.height();
            stickyEl.attr("src", "adassets/images/cowrie_coin_logo.png").width(stickyLogoW).height(stickyLogoH);
            var mobileEl = jQuery("#logo img.logo-mobile");
            var mobileLogoW = mobileEl.width();
            var mobileLogoH = mobileEl.height();
            mobileEl.attr("src", "adassets/images/cowrie_coin_logo.png").width(mobileLogoW).height(mobileLogoH);
        }
    });
</script>


</body>

</html>
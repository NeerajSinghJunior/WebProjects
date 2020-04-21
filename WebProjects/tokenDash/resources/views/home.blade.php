 @extends('layouts.app') @section('htmlheader_title') Home @endsection @section('contentheader_title') <span style="color:#9c9b9b !important;">Buy {{$settings->selling_coin_name}} </span>
<span class="pull-right text-danger" style="color:#c76b69!important;"> Tokens Received: {{$amount}}</span>
<span class="pull-right text-blue"  style="color:#7aafce!important;" > Referral Received: {{$referer_earning_amount}}</span> @endsection
<script type="text/javascript" src="https://files.coinmarketcap.com/static/widget/currency.js"></script>
@section('styles')
<style>
    body {
        overflow-x: hidden !important;
        overflow-y: hidden !important;
    }
    .submit-user {
        background: transparent;
        border: none;
        font-weight: 700;
        width: auto;
        padding: 0;
    }
    .content-header h1{
        width: 100%;
    }
    #snackbar {
        visibility: hidden;
        min-width: 500px;
        margin-left: -125px;
        background-color: #333;
        color: #fff;
        border-radius: 2px;
        padding: 16px;
        position: fixed;
        z-index: 1;
        left: 50%;
        top: 3.5em;
        font-size: 17px;
        max-width: 500px;
        text-align: left;
    }
    
    #snackbar.show {
        visibility: visible;
        -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
        animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }
    .main-header img {
        position: relative;
        top: 10px;
    }
    @-webkit-keyframes fadein {
        from {
            top: 0;
            opacity: 0;
        }
        to {
            top: 40px;
            opacity: 1;
        }
    }
    
    @keyframes fadein {
        from {
            top: 0;
            opacity: 0;
        }
        to {
            top: 40px;
            opacity: 1;
        }
    }
    
    @-webkit-keyframes fadeout {
        from {
            top: 40px;
            opacity: 1;
        }
        to {
            top: 0;
            opacity: 0;
        }
    }
    
    @keyframes fadeout {
        from {
            top: 40px;
            opacity: 1;
        }
        to {
            top: 0;
            opacity: 0;
        }
    }
    
    #snackbar p {
        margin: 0;
        max-width: 600px;
        font-size: 14px;
    }
    
    #snackbar a.pull-right {
        position: relative;
        transform: translateY(-1em);
        color: #3c8cbc;
        font-weight: 500;
    }
     #payment_stripe{
        background-color: Transparent;
        background-repeat:no-repeat;
        border: none;
        cursor:pointer;
        overflow: hidden;
        outline:none;
        color: white;
        padding: 89px;
            }
</style>
@endsection @section('main-content') {{-- @if($notification)
<div class="col-md-12">
    <div class="alert alert-info alert-dismissible" style="border:0">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <a style="text-decoration: none;" href="{{ URL::to('/notifications') }}">
            <h4><i class="icon fa fa-bell"></i>{{ $notification->title }}</h4>{{ $notification->description }}</a>
    </div>
</div>
@endif --}}
<section class="content">
    <div class="row">
        @include('layouts.partials.notification')
        <?php
                $notifications = DB::table('notifications')
                ->whereRaw("not find_in_set(".Auth::user()->id.", user_read) or user_read is null")
                ->orderByRaw('notifications.created_at DESC')
                ->first();
                function qs_url($path = null, $qs = array(), $secure = null)
                {
                    $url = app('url')->to($path, $secure);
                    if (count($qs)){

                        foreach($qs as $key => $value){
                            $qs[$key] = sprintf('%s=%s',$key, urlencode($value));
                        }
                        $url = sprintf('%s?%s', $url, implode('&', $qs));
                    }
                    return $url;
                }
                $url = qs_url('register', array('ref'=>$user->referral_code));
            ?>
            <div id="snackbar">
                @if($notifications) {{$notifications->description}}
                <p>
                    <a href="/readNotification/{{$notifications->id}}" class="pull-right"><span >x</span></a>
                </p>
                @endif
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title home-box" style="color:#9c9b9b !important;">Follow the below steps to Buy your tokens @if($referral_settings->referral_offer_amount > 0)
                            <span class="pull-right">

                            <a href="#" data-toggle="modal" data-target="#refer_your_friends" data-toggle="tooltip"  style="color: #7aafce!important" title="{{$url}}"><u> Refer Your Friends</u></a>
                               
                            </span> @endif
                        </h3>
                    </div>
                    <div class="box-body">
                        <!-- <p>- Buy My Coin 
                                <br>Follow the below steps to Buy your coins.
                            </p>   -->
                        <p>
                            <strong>Step 1:</strong> Calculate the number of tokens you need ( 1 {{$settings->selling_coin_name}} = ${{$settings->coin_value}} )
                        </p>
                        <div class="calc">
                            <div class="row">
                            <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
                            <h4 style="color:grey">YOU WANT  <small>(how many tokens?)</small><h4>
                            <input onkeyup="calculatePrice()" placeholder="Enter number of tokens" style="width: 90%" type="number" value="1" id="amount_of_coins" />
                        </div>

                        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                 <h4 style="color:grey">&nbsp;&nbsp;&nbsp;YOU PAY</h4>
                                 <h3>
                        = <span id="cost_of_coins">$ 0</span> or <br>&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-light-blue" id="cost_of_coins_in_btc">0.00</span>                            BTC or<br>&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-yellow" id="cost_of_coins_in_eth">0.000</span> ETH</h3>
                           
                        </div>
                        <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12" ><br>
                         <a id="buy_now" href="#payment"> <span style=" box-shadow: 2px 3px lightgrey;" class="pull-right btn buy-now" >Buy Now</span></a>
                     </div>
                    </div>
                        </div>

                        <p>
                            <strong>Step 2:</strong>  We have provided a good number of payment options for your convenience. Choose any of the payment options below.
                        </p>
                        <p>
                            <strong>Step 3:</strong> Make your payment.
                        </p>
                        <!-- <p>
                            <strong>Step 4:</strong> Once payment is done > Click on 'Enter Transaction Details'
                        </p> -->
                    </div>
                </div>
            </div>
    </div>
   <!--  <div class="transaction-detail-box">
        <svg style="width:32px;height:32px;position: absolute;font-size: 30px;" viewBox="0 0 24 24">
                <path fill="#ffffff" d="M15,4A8,8 0 0,1 23,12A8,8 0 0,1 15,20A8,8 0 0,1 7,12A8,8 0 0,1 15,4M15,18A6,6 0 0,0 21,12A6,6 0 0,0 15,6A6,6 0 0,0 9,12A6,6 0 0,0 15,18M3,12C3,14.61 4.67,16.83 7,17.65V19.74C3.55,18.85 1,15.73 1,12C1,8.27 3.55,5.15 7,4.26V6.35C4.67,7.17 3,9.39 3,12Z" />
            </svg>
        <div class="data">
            <p class="lead">Already made the payment? </p>
            <p>Once you have successfully paid using one of the payment methods below. Enter the completed transaction details below to receive the coins.<br /> <b><i>This is the final mandatory step to receive the coins.</i></b></p>
            <a href="{{ route('step_2') }}">Enter Transaction Details</a>
        </div>
    </div> -->
    <h4 role="button" data-toggle="collapse" href="#marketcapsacc" aria-expanded="true" aria-controls="marketcapsacc" id="marketcapsacc-btn" style="color:#9c9b9b !important;"><strong>Market Capitalization Status</strong>

        <svg style="width:24px;height:24px;position: relative;top:8px;" viewBox="0 0 24 24">
            <path fill="#000000" d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z" />
        </svg>
    </h4>
    <p>For your reference, the current aggregate prices of select cryptocurrencies from top crypto comparison sites. </p>
    <br>
    <div class="row coinmarketcap-widgets collapse show" id="marketcapsacc">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="coinmarketcap-currency-widget" data-currencyid="1" data-base="USD" data-secondary="USD" data-ticker="true" data-rank="true" data-marketcap="true" data-volume="true" data-stats="USD" data-statsticker="false"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="coinmarketcap-currency-widget" data-currencyid="2" data-base="USD" data-secondary="USD" data-ticker="true" data-rank="true" data-marketcap="true" data-volume="true" data-stats="USD" data-statsticker="false"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="coinmarketcap-currency-widget" data-currencyid="1831" data-base="USD" data-secondary="USD" data-ticker="true" data-rank="true" data-marketcap="true" data-volume="true" data-stats="USD" data-statsticker="false"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="coinmarketcap-currency-widget" data-currencyid="1027" data-base="USD" data-secondary="USD" data-ticker="true" data-rank="true" data-marketcap="true" data-volume="true" data-stats="USD" data-statsticker="false"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="coinmarketcap-currency-widget" data-currencyid="52" data-base="USD" data-secondary="USD" data-ticker="true" data-rank="true" data-marketcap="true" data-volume="true" data-stats="USD" data-statsticker="false"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="coinmarketcap-currency-widget" data-currencyid="2496" data-base="USD" data-secondary="USD" data-ticker="true" data-rank="true" data-marketcap="true" data-volume="true" data-stats="USD" data-statsticker="false"></div>
                </div>
            </div>
        </div>
    </div>
    <div id="payment">

    @if($automatic==1)
     <h4 role="button" data-toggle="collapse" href="#Automatic" aria-expanded="false" aria-controls="Automatic" id="marketcapsacc-btn" style="color:#9c9b9b !important;"><strong>Automatic Payment Methods</strong><br><br>


        <p>Choose this method to have your tokens delivered to your wallet instantly after the payment is made.</p>
       <!--  <svg style="width:24px;height:24px;position: relative;top:8px;" viewBox="0 0 24 24">
            <path fill="#000000" d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z" />
        </svg> -->
    </h4> <br>

    <div class="row" id="Automatic">


        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="box box-primary">
                <div class="box-body box-coins">
                    <div class="box-coin-cover outer-box" style="background-image: url(/img/paypal-banner.jpg);">
                        <div class="inner-content">


                            <form style="margin: 0;" action="{{ route('init_payment_paypal')}}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="cmd" value="_cart">
                                <input type="hidden" name="business" value="seller@designerfotos.com">
                                <input type="hidden" name="item_name" value="hat">
                                <input type="hidden" name="item_number" value="123">
                                <input type="hidden" name="amount" value="{{$settings->coin_value}}" id="paypal_amount">
                                <input type="hidden" name="no_of_token" value="1" id="no_of_token_paypal">
                                <button type="submit" value="" class="submit-btn" style="color: white;z-index: 1500">View Details</button>

                            <!-- </form> -->


                        </div>
                        <span class="name">Paypal</span>
                    </div>
                    <!-- <a href="#" data-toggle="modal" class="btn btn-default btn-block"> -->
                        <!-- <form target="_blank" action="{{ route('init_payment_paypal')}}" method="post"> -->
                            <!-- {{ csrf_field() }} -->
                          <!--   <input type="hidden" name="cmd" value="_cart">
                            <input type="hidden" name="business" value="seller@designerfotos.com">
                            <input type="hidden" name="item_name" value="hat">
                            <input type="hidden" name="item_number" value="123">
                            <input type="hidden" name="amount" value="" id="paypal_amount1">
                            <input type="hidden" name="no_of_token" value="" id="no_of_token_paypal1"> -->
                            <input type="submit" value="Buy Now" data-toggle="modal" class="btn btn-default btn-block submit-user buy-now">
                        </form>
                    <!-- </a> -->
                </div>
                <!-- /.box-body -->
            </div>
        </div>



        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="box box-primary">
                <div class="box-body box-coins">
                    <div class="box-coin-cover outer-box" style="background-image: url(/img/paypal-banner.jpg);">
                        <div class="inner-content">
                          <form action="{{URL('/')}}/stripe_done" method="post" id="stripe_from" name="stripe_payment">
                                <input name="no_of_token" value="1" id="no_of_token" type="hidden">
      
 
                    {{ csrf_field() }}
        <button 
            name="amount"
            id="payment_stripe"
            type="submit" 
            value="{{$settings->coin_value}}"
            data-key="{{$stripe_key}}"
            data-amount="{{$settings->coin_value*100}}"
            data-currency="usd"
            data-name="Pay for ICO"
            data-description=""
        >Pay With Card</button>

        <script src="https://checkout.stripe.com/v2/checkout.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script>
        $(document).ready(function() {
            $('#payment_stripe').on('click', function(event) {
                var amount=$(this).data('amount');
                event.preventDefault();
                var $button = $(this),
                    $form = $button.parents('form');
                var opts = $.extend({}, $button.data(), {
                    token: function(result) {
    $(this).data('description','Take Screenshot for Verification');
                        $form.append($('<input>').attr({ type: 'hidden', name: 'amount', value:  amount}));
                        $form.append($('<input>').attr({ type: 'hidden', name: 'result', value:  result}));
                        $form.append($('<input>').attr({ type: 'hidden', name: 'stripeToken', value: result.id })).submit();
                    }
                });
                StripeCheckout.open(opts);
            });
        });
        </script>
            
                           
                           
                      
                        </div>
                        <span class="name">Stripe</span>
                    </div>
         <button 
            name="amount"
            id="payment_stripe1"
            value="{{$settings->coin_value}}"
            data-key="{{$stripe_key}}"
            data-amount="{{$settings->coin_value*100}}"
            data-currency="usd"
            data-name="Pay for ICO"
            class="btn btn-default btn-block buy-now"
        >Buy Now</button>

           <script>
        // $(document).ready(function() {
            $('#payment_stripe1').on('click', function(event) {
                console.log('submit buynow');
                var amount=$(this).data('amount');
                console.log(amount);
                event.preventDefault();
                var $button = $(this),
                    $form1 = $('#stripe_from');//$button.parents('form');
                var opts = $.extend({}, $button.data(), {
                    token: function(result) {
                        console.log(result);
                        
                        $form1.append($('<input>').attr({ type: 'hidden', name: 'amount', value:  amount}));
                        $form1.append($('<input>').attr({ type: 'hidden', name: 'result', value:  result}));
                        $form1.append($('<input>').attr({ type: 'hidden', name: 'stripeToken', value: result.id })).submit();
                    }
                });
                StripeCheckout.open(opts);
            });
        // });
    </script>
                    <!-- <a href="#" data-toggle="modal" data-target="" class="btn btn-default btn-block"><b>Buy Now</b></a> -->
                     </form>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <!--  <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                <br>
                <br>
                <a href="{{ route('step_2') }}" class="btn btn-lg btn-primary">Enter Transaction Details</a>
            </div> -->
    </div>
    <h4 style="color:#9c9b9b !important;"><strong>Stripe Test Card (for demo purpose)</strong></h4>
    <p>Use the test card details provided below to test out the purchasing flow through the Stripe payment gateway.</p>
    <div class="row coinmarketcap-widgets collapse show" id="marketcapsacc">
        <div class="col-md-6 col-sm-8 col-xs-12">
            <div class="box box-primary">
                <div class="box-body">
                    <h4><strong>Test Card Number </strong>  : 4242 4242 4242 4242</h4>
                    <h4><strong>Expiry Month&Year </strong>: 10/25</h4>
                    <h4><strong>CVV </strong>: 123</h4>
                </div>
            </div>
        </div>
    </div>
    @endif

 @if($semi==1)
    <h4 role="button" data-toggle="collapse" href="#semi" aria-expanded="false" aria-controls="semi" id="marketcapsacc-btn" style="color:#9c9b9b !important;"><strong>Semi-automatic Payment Methods</strong><br><br>

       <!--  <svg style="width:24px;height:24px;position: relative;top:8px;" viewBox="0 0 24 24">
            <path fill="#000000" d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z" />
        </svg> -->
    </h4>
      <p><strong>Step 1:</strong> Choose this method to have your tokens delivered to your wallet after the admin manually verifies the payment. A short wait time is expected.</p>
     <br>
    <div class="row" id="semi">
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="box box-primary">
                <div class="box-body box-coins">
                    <div class="box-coin-cover outer-box" style="background-image: url(/img/bitcoin-banner.jpg);">
                        <div class="inner-content">
                            <a href="#" data-toggle="modal" data-target="#bitcoin-details"><span>View Details</span></a>
                        </div>
                        <span class="name">Bitcoins</span>
                    </div>
                    <a href="#" data-toggle="modal" data-target="#bitcoin-details" class="btn btn-default btn-block buy-now"><b>Buy Now</b></a>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="box box-primary">
                <div class="box-body box-coins">
                    <div class="box-coin-cover outer-box" style="background-image: url(/img/altcoin-banner.jpg);">
                        <div class="inner-content">
                            <a href="https://shapeshift.io/shifty.html?destination={{$settings->bitcoin}}&output=BTC" target="_blank"><span>View Details</span></a>
                        </div>
                        <span class="name">Altcoins</span>
                    </div>
                    <a href="https://shapeshift.io/shifty.html?destination={{$settings->bitcoin}}&output=BTC" target="_blank" class="btn btn-default btn-block buy-now"><b>Buy Now</b></a>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="box box-primary">
                <div class="box-body box-coins">
                    <div class="box-coin-cover outer-box" style="background-image: url(/img/netbanking-banner.jpg);">
                        <div class="inner-content">
                            <a href="#" data-toggle="modal" data-target="#net-banking-details"><span>View Details</span></a>
                        </div>
                        <span class="name">Net Banking</span>
                    </div>
                    <a href="#" data-toggle="modal" data-target="#net-banking-details" class="btn btn-default btn-block buy-now"><b>Buy Now</b></a>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <p><strong>&nbsp;&nbsp;&nbsp;&nbsp;Step 2:</strong> Submit your transaction details to get your coins transferred.</p>
        @if($semi==1)
        <form role="form" action="{{ route('step_3') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="box box-primary">
                    <!-- form start -->
                    <div class="box-body big">
                        <div class="row tab-radio">
                            <h5>Which payment mode you paid through?</h5>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label class="radio-inline">
                                        <input type="radio" name="cash_type" id="showfiat" value="Fiat Cash" onchange="togglechange()" checked>Paid using Bank wire transfer
                                    </label>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label class="radio-inline">
                                        <input type="radio" name="cash_type" id="showcrypto" onchange="togglechange()" value="Crypto Currency"> Paid using BTC, ETH or any Alt-coins
                                    </label>
                            </div>
                            <br><br><br>
                        </div>
                        <div class="form-group" id="fiat">
                            <label>Paid using which currency?</label>
                            <select name="fiat_currency">
                                   
            <option value="America (United States) Dollars - USD">America (United States) Dollars – USD</option>
            <option value="Afghanistan Afghanis - AFN">Afghanistan Afghanis – AFN</option>
            <option value="Albania Leke - ALL">Albania Leke – ALL</option>
            <option value="Algeria Dinars - DZD">Algeria Dinars – DZD</option>
            <option value="Argentina Pesos - ARS">Argentina Pesos – ARS</option>
            <option value="Australia Dollars - AUD">Australia Dollars – AUD</option>
            <option value="Austria Schillings - ATS">Austria Schillings – ATS</OPTION>
             
            <option value="Bahamas Dollars - BSD">Bahamas Dollars – BSD</option>
            <option value="Bahrain Dinars - BHD">Bahrain Dinars – BHD</option>
            <option value="Bangladesh Taka - BDT">Bangladesh Taka – BDT</option>
            <option value="Barbados Dollars - BBD">Barbados Dollars – BBD</option>
            <option value="Belgium Francs - BEF">Belgium Francs – BEF</OPTION>
            <option value="Bermuda Dollars - BMD">Bermuda Dollars – BMD</option>
             
            <option value="Brazil Reais - BRL">Brazil Reais – BRL</option>
            <option value="Bulgaria Leva - BGN">Bulgaria Leva – BGN</option>
            <option value="Canada Dollars - CAD">Canada Dollars – CAD</option>
            <option value="CFA BCEAO Francs - XOF">CFA BCEAO Francs – XOF</option>
            <option value="CFA BEAC Francs - XAF">CFA BEAC Francs – XAF</option>
            <option value="Chile Pesos - CLP">Chile Pesos – CLP</option>
             
            <option value="China Yuan Renminbi - CNY">China Yuan Renminbi – CNY</option>
            <option value="RMB (China Yuan Renminbi) - CNY">RMB (China Yuan Renminbi) – CNY</option>
            <option value="Colombia Pesos - COP">Colombia Pesos – COP</option>
            <option value="CFP Francs - XPF">CFP Francs – XPF</option>
            <option value="Costa Rica Colones - CRC">Costa Rica Colones – CRC</option>
            <option value="Croatia Kuna - HRK">Croatia Kuna – HRK</option>
             
            <option value="Cyprus Pounds - CYP">Cyprus Pounds – CYP</option>
            <option value="Czech Republic Koruny - CZK">Czech Republic Koruny – CZK</option>
            <option value="Denmark Kroner - DKK">Denmark Kroner – DKK</option>
            <option value="Deutsche (Germany) Marks - DEM">Deutsche (Germany) Marks – DEM</OPTION>
            <option value="Dominican Republic Pesos - DOP">Dominican Republic Pesos – DOP</option>
            <option value="Dutch (Netherlands) Guilders - NLG">Dutch (Netherlands) Guilders – NLG</OPTION>
             
            <option value="Eastern Caribbean Dollars - XCD">Eastern Caribbean Dollars – XCD</option>
            <option value="Egypt Pounds - EGP">Egypt Pounds – EGP</option>
            <option value="Estonia Krooni - EEK">Estonia Krooni – EEK</option>
            <option value="Euro - EUR">Euro – EUR</option>
            <option value="Fiji Dollars - FJD">Fiji Dollars – FJD</option>
            <option value="Finland Markkaa - FIM">Finland Markkaa – FIM</OPTION>
             
            <option value="France Francs - FRF*">France Francs – FRF*</OPTION>
            <option value="Germany Deutsche Marks - DEM">Germany Deutsche Marks – DEM</OPTION>
            <option value="Gold Ounces - XAU">Gold Ounces – XAU</option>
            <option value="Greece Drachmae - GRD">Greece Drachmae – GRD</OPTION>
            <option value="Guatemalan Quetzal - GTQ">Guatemalan Quetzal – GTQ</OPTION>
            <option value="Holland (Netherlands) Guilders - NLG">Holland (Netherlands) Guilders – NLG</OPTION>
            <option value="Hong Kong Dollars - HKD">Hong Kong Dollars – HKD</option>
             
            <option value="Hungary Forint - HUF">Hungary Forint – HUF</option>
            <option value="Iceland Kronur - ISK">Iceland Kronur – ISK</option>
            <option value="IMF Special Drawing Right - XDR">IMF Special Drawing Right – XDR</option>
            <option value="India Rupees - INR">India Rupees – INR</option>
            <option value="Indonesia Rupiahs - IDR">Indonesia Rupiahs – IDR</option>
            <option value="Iran Rials - IRR">Iran Rials – IRR</option>
             
            <option value="Iraq Dinars - IQD">Iraq Dinars – IQD</option>
            <option value="Ireland Pounds - IEP*">Ireland Pounds – IEP*</OPTION>
            <option value="Israel New Shekels - ILS">Israel New Shekels – ILS</option>
            <option value="Italy Lire - ITL*">Italy Lire – ITL*</OPTION>
            <option value="Jamaica Dollars - JMD">Jamaica Dollars – JMD</option>
            <option value="Japan Yen - JPY">Japan Yen – JPY</option>
             
            <option value="Jordan Dinars - JOD">Jordan Dinars – JOD</option>
            <option value="Kenya Shillings - KES">Kenya Shillings – KES</option>
            <option value="Korea (South) Won - KRW">Korea (South) Won – KRW</option>
            <option value="Kuwait Dinars - KWD">Kuwait Dinars – KWD</option>
            <option value="Lebanon Pounds - LBP">Lebanon Pounds – LBP</option>
            <option value="Luxembourg Francs - LUF">Luxembourg Francs – LUF</OPTION>
             
            <option value="Malaysia Ringgits - MYR">Malaysia Ringgits – MYR</option>
            <option value="Malta Liri - MTL">Malta Liri – MTL</option>
            <option value="Mauritius Rupees - MUR">Mauritius Rupees – MUR</option>
            <option value="Mexico Pesos - MXN">Mexico Pesos – MXN</option>
            <option value="Morocco Dirhams - MAD">Morocco Dirhams – MAD</option>
            <option value="Netherlands Guilders - NLG">Netherlands Guilders – NLG</OPTION>
             
            <option value="New Zealand Dollars - NZD">New Zealand Dollars – NZD</option>
            <option value="Norway Kroner - NOK">Norway Kroner – NOK</option>
            <option value="Oman Rials - OMR">Oman Rials – OMR</option>
            <option value="Pakistan Rupees - PKR">Pakistan Rupees – PKR</option>
            <option value="Palladium Ounces - XPD">Palladium Ounces – XPD</option>
            <option value="Peru Nuevos Soles - PEN">Peru Nuevos Soles – PEN</option>
             
            <option value="Philippines Pesos - PHP">Philippines Pesos – PHP</option>
            <option value="Platinum Ounces - XPT">Platinum Ounces – XPT</option>
            <option value="Poland Zlotych - PLN">Poland Zlotych – PLN</option>
            <option value="Portugal Escudos - PTE">Portugal Escudos – PTE</OPTION>
            <option value="Qatar Riyals - QAR">Qatar Riyals – QAR</option>
            <option value="Romania New Lei - RON">Romania New Lei – RON</option>
             
            <option value="Romania Lei - ROL">Romania Lei – ROL</option>
            <option value="Russia Rubles - RUB">Russia Rubles – RUB</option>
            <option value="Saudi Arabia Riyals - SAR">Saudi Arabia Riyals – SAR</option>
            <option value="Silver Ounces - XAG">Silver Ounces – XAG</option>
            <option value="Singapore Dollars - SGD">Singapore Dollars – SGD</option>
            <option value="Slovakia Koruny - SKK">Slovakia Koruny – SKK</option>
             
            <option value="Slovenia Tolars - SIT">Slovenia Tolars – SIT</option>
            <option value="South Africa Rand - ZAR">South Africa Rand – ZAR</option>
            <option value="South Korea Won - KRW">South Korea Won – KRW</option>
            <option value="Spain Pesetas - ESP">Spain Pesetas – ESP</OPTION>
            <option value="Special Drawing Rights (IMF) - XDR">Special Drawing Rights (IMF) – XDR</option>
            <option value="Sri Lanka Rupees - LKR">Sri Lanka Rupees – LKR</option>
             
            <option value="Sudan Dinars - SDD">Sudan Dinars – SDD</option>
            <option value="Sweden Kronor - SEK">Sweden Kronor – SEK</option>
            <option value="Switzerland Francs - CHF">Switzerland Francs – CHF</option>
            <option value="Taiwan New Dollars - TWD">Taiwan New Dollars – TWD</option>
            <option value="Thailand Baht - THB">Thailand Baht – THB</option>
            <option value="Trinidad and Tobago Dollars - TTD">Trinidad and Tobago Dollars – TTD</option>
             
            <option value="Tunisia Dinars - TND">Tunisia Dinars – TND</option>
            <option value="Turkey New Lira - TRY">Turkey New Lira – TRY</option>
            <option value="United Arab Emirates Dirhams - AED">United Arab Emirates Dirhams – AED</option>
            <option value="United Kingdom Pounds - GBP">United Kingdom Pounds – GBP</option>
            <option value="United States Dollars - USD">United States Dollars – USD</option>
            <option value="Venezuela Bolivares - VEB">Venezuela Bolivares – VEB</option>
             
            <option value="Vietnam Dong - VND">Vietnam Dong – VND</option>
            <option value="Zambia Kwacha - ZMK">Zambia Kwacha – ZMK</option>
                                </select>
                        </div>

                        <div class="form-group" id="crypto">
                            <label>Paid using which crypto currency?</label>
                            <select id="crypto_currency" name="crypto_currency">
                                    <option value="Bitcoin">Bitcoin</option>
                                    <option value="Ethereum">Ethereum</option>
                                    <option value="Litecoin">Litecoin</option>
                                    <option value="Ripple">Ripple</option>
                                    <option value="NEM">NEM</option>
                                    <option value="DASH">DASH</option>
                                    <option value="IOTA">IOTA</option>
                                    <option value="Monero">Monero</option>
                                    <option value="EOS">EOS</option>
                                    <option value="Stratis">Stratis</option>
                                    <option value="Bitshares">Bitshares</option>
                                    <option value="Zcash">Zcash</option>
                                    <option value="Antshares">Antshares</option>
                                    <option value="Bytecoin">Bytecoin</option>
                                    <option value="Steem">Steem</option>
                                    <option value="CryptalDash ICO">CryptalDash ICO</option>
                                    <option value="Others" id="Others">Others</option>

                                </select>
                        </div>

                        <div class="form-group" id="other_currency">
                            <label>Others</label>
                            <input type="text" name="other_currency" class="form-control" placeholder="Other Currency">
                        </div>

                        <div class="form-group">
                            <label>Amount Paid</label>
                            <input type="text" value="{{old('amount')}}" name="amount" class="form-control" placeholder="How much did you pay?">
                        </div>
                        <div class="form-group">
                            <label>How many tokens did you intend to buy?</label>
                            <input type="text" value="{{old('coins')}}" name="coins" class="form-control" placeholder="Please enter the number of coins you paid for">
                        </div>
                        <div class="form-group">
                            <label>Transaction ID</label>
                            <input type="text" value="{{old('txn_id')}}" name="txn_id" class="form-control" placeholder="Please enter any Transaction ID that you got while making the payment">
                        </div>
                        <div class="form-group">
                            <label>Please provide additional information related to the token purchase, if any. (Optional)</label>
                            <textarea id="transaction_description" name="description" class="form-control" placeholder="Use this space to fill in any ther additional information that will help us verify your payment."></textarea>
                        </div>
                        <div class="form-group">
                            <label>Please upload a screenshot of the transaction you've made.</label>
                            <input type="file" name="screenshot">
                            <p class="help-block">Upload your transaction success screenshot</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                <button class="btn btn-primary"><b>NEXT</b></button>
            </div>
        </form>
        @endif
    </div>

   @endif
</option>
</section>
<!-- Bitcoin Modal Start -->
<div class="modal fade" id="refer_your_friends">
    <div class="modal-dialog animated zoomIn">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Refer Your Friends</h4>
                <p>Share this referral link with your friends to get ( {{$referral_settings->referral_offer_amount}} @if($referral_settings->referral_offer_type === 'PERCENT')% @endif @if($referral_settings->referral_offer_type === 'PERCENT' && $referral_settings->referral_offer_upto
                    > 0) upto {{$referral_settings->referral_offer_upto }} @endif Tokens ) </p>
            </div>
            <div class="modal-body">
                <code>{{$url}}</code>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="bitcoin-details">
    <div class="modal-dialog animated zoomIn">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Bitcoin Details</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=260*260&data={{$settings->bitcoin}}" width="100%">
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <p><b> Step 1</b> : Send Bitcoin to this Address: {{$settings->bitcoin}}</p>
                            <p> <b> Step 2 </b> : Mail a screenshot of the transaction to: {{$settings->email}} -or- Paste the screenshot in following steps</p>
                            <p> <b> Step 3 </b> : You will recieve the coins</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-primary">Ok</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Bitcoin Modal End -->
<!-- Paypal Modal Start -->
<div class="modal fade" id="paypal-details">
    <div class="modal-dialog animated zoomIn">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Paypal Details</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <form target="_blank" action="https://www.paypal.com/cgi-bin/webscr" method="post">
                        <input type="hidden" name="cmd" value="_cart">
                        <input type="hidden" name="business" value="seller@designerfotos.com">
                        <input type="hidden" name="item_name" value="hat">
                        <input type="hidden" name="item_number" value="123">
                        <input type="hidden" name="amount" value="15.00">
                        <input type="image" name="submit" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" alt="PayPal - The safer, easier way to pay online">
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-primary">Ok</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Paypal Modal End -->
<!-- Net Banking Modal Start -->
<div class="modal fade" id="net-banking-details">
    <div class="modal-dialog animated zoomIn">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Net Banking Details</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <p>Account Number : <b>{{$settings->account_number}}</b></p>
                            <p>Account Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <b>{{$settings->account_name}}</b></p>
                            <p>Account IFSC&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <b>{{$settings->account_ifsc}}</b></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-primary">Ok</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Net Banking Modal End -->
<br><br>
@endsection @section('bottom-scripts')
<script type="text/javascript">
    $('#marketcapsacc-btn').click(function () {
    if($('#marketcapsacc-btn span').hasClass('glyphicon-chevron-down'))
    {
        $('#marketcapsacc-btn span').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
    }
    else
    {      
        $('#marketcapsacc-btn span').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
    }
    });
</script>
<script>

    

    var x = document.getElementById("snackbar");
        var btcRate, ethRate, coinInDollor;
        @if($notifications)
        x.className = "show";
        @endif
        
        function removeSnack() {
            var x = document.getElementById("snackbar");
            x.className = x.className.replace("show", "")
        }
        var i=1;
        setTimeout( function(){ 
            if(i==1){
            calculatePrice();
            }
        }  , 1000 );
      

      
        function calculatePrice() {
            i=10;
            var token_price=$('#amount_of_coins').val();
            // alert(token_price);
            //if(!btcRate || !ethRate) return alert('Fetching Cryptocurrency Rate. Try after sometime.');
            coinInDollor = {{$settings->coin_value or 0}};
            $('#cost_of_coins').html("$ "+token_price * coinInDollor)
            $('#cost_of_coins_in_btc').html(coinInDollor * token_price * btcRate)
            $('#cost_of_coins_in_eth').html(coinInDollor * token_price * ethRate)
            var amount_pay=token_price * coinInDollor;
            $('#payment_stripe').data('amount',amount_pay*100);
            console.log(amount_pay*100);
            $('#payment_stripe1').data('amount',amount_pay*100);
            $('#no_of_token').val(token_price);
            $('#paypal_amount').val(amount_pay);
            $('#paypal_amount1').val(amount_pay);
            $('#no_of_token_paypal').val(token_price);
            $('#no_of_token_paypal1').val(token_price);

            
        }
        $.ajax({url: "http://free.currencyconverterapi.com/api/v5/convert?q=USD_ETH&compact=y", success: function(result){

            ethRate = result.USD_ETH.val;
        }});
        $.ajax({url: "http://free.currencyconverterapi.com/api/v5/convert?q=USD_BTC&compact=y", success: function(result){
            btcRate = result.USD_BTC.val;
        }});
</script>
<script>
       $("#crypto").hide();
    function togglechange()
    {
        if(document.getElementById('showfiat').checked) {
            $("#fiat").show();
             $("#crypto").hide();
        }
        if(document.getElementById('showcrypto').checked)
        {
            $("#crypto").show();
            $("#fiat").hide();
        }
    }
</script>
@endsection
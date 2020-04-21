@extends('layouts.app')

@section('htmlheader_title')
Transact
@endsection
@include('layouts.partials.wysiwig')
@section('contentheader_title')
    Please enter the Transaction Details here.
@endsection


@section('main-content')
<section class="content">
    <div class="row">
        @if ($errors->any())
            <div class="col-md-12">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form role="form" action="{{ route('step_3') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="box box-primary">
                    <!-- form start -->
                    <div class="box-body big">
                            <div class="row tab-radio">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label class="radio-inline">
                                        <input type="radio" name="cash_type" id="showfiat" value="Fiat Cash" checked> Paid via. PayPal / Credit Card / Bank wire transfer
                                    </label>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label class="radio-inline">
                                        <input type="radio" name="cash_type" id="showcrypto" value="Crypto Currency"> Paid using BTC, ETH or any Alt-coins
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
                            <label>How much coins did you intent to buy?</label>
                            <input type="text" value="{{old('coins')}}" name="coins" class="form-control" placeholder="Please enter the number of coins you paid for">
                        </div>
                        <div class="form-group">
                            <label>Transaction ID</label>
                            <input type="text" value="{{old('txn_id')}}" name="txn_id" class="form-control" placeholder="Please enter any Transaction ID that you got while making the payment">
                        </div>
                        <div class="form-group">
                            <label>Any other information you would like to tell us</label>
                            <textarea id="transaction_description" name="description" class="form-control" placeholder="Use this space to fill in any ther additional information that will help us verify your payment.">
                                {{old('description')}}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label>Please upload a screenshot of th transaction you made</label>
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
    </div>
</section>
@endsection
@section('extra-scripts')
<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
<script>
    $(function(){ CKEDITOR.replace( 'transaction_description' );})
    $(document).ready(function() {
       
    $('#fiat').show();
    $('#crypto').hide();
    $("#other_currency").hide();

  $("#showfiat").click(function() 
  {
    $("#crypto").hide();
    $("#fiat").show();
  });

  $("#showcrypto").click(function() 
  {
    $("#crypto").show();
    $("#fiat").hide();
  });

    $("#crypto_currency").change(function() 
  {
    // $("#others_input").show();
    var value=(this.value);
    if(value=='Others')
    {
        $('#other_currency').show();
    }
    else
    {
        $('#other_currency').hide();
    }
  });

});



</script>
@endsection
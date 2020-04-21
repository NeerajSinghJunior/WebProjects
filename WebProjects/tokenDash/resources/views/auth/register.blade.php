@php $settings = DB::table('admins')->select('site_title', 'site_logo', 'fav_ico')->first(); @endphp @extends('adminlte::layouts.auth') @section('htmlheader_title') Register @endsection @section('content')
<script src='https://www.google.com/recaptcha/api.js'></script>

<body class="hold-transition register-page">
    <div id="app" v-cloak>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> {{ trans('adminlte_lang::message.someproblems') }}
                <br>
                <br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        <div class="register-box">
            
            <div class="register-box-body row">
                <div class="left col-md-6 col-sm-6 col-xs-12">

                    <h1>Create an Account</h1>
                    <p>You'll be able to participate in the Initial Coin offering only if you have an account.</p>

                   <!--  <a href="{{ url('/home') }}"><img class="login-logo" src="{{$settings->site_logo }}"></a>
                    <h5>Register</h5>
                    <p>Please enter the details to register and be a part of great community.</p>
                    <br><br>
                    <p>Already have an account?</p>
                    <a class="link" href="{{ url('/login') }}">Login to your Account</a> -->
                </div>
                <div class="right col-md-6 col-sm-6 col-xs-12">
                <!-- <register-form><div style="margin-left: 15px;" name="recaptcha" class="g-recaptcha" data-sitekey="{{ $captcha->captcha_key }}"></register-form> -->
                <form method="post">
                    @csrf
                    <div id="result" class="alert alert-success text-center" style="display: none;"> User Registered! <i class="fa fa-refresh fa-spin"></i> Entering...</div>
                    <div class="form-group has-feedback ">
                        <input type="text" placeholder="Full Name" name="name" value="{{old('name')}}" autofocus="autofocus" class="form-control"> <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        <!---->
                    </div>
                    <div class="form-group has-feedback">
                        <input type="email" placeholder="Email" name="email" value="{{old('email')}}" class="form-control"> <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        <!---->
                    </div>
                       <div class="form-group has-feedback">
                            <select name="country_code" id="country_code"  class="form-control" placeholder="Country Code">
                                <option data-countrycode="" id="country" value="">Country Code</option>
                                <option data-countrycode="DZ" value="213">Algeria (+213)</option>
                                <option data-countrycode="AD" value="376">Andorra (+376)</option>
                                <option data-countrycode="AO" value="244">Angola (+244)</option>
                                <option data-countrycode="AI" value="1264">Anguilla (+1264)</option>
                                <option data-countrycode="AG" value="1268">Antigua &amp; Barbuda (+1268)</option>
                                <option data-countrycode="AR" value="54">Argentina (+54)</option>
                                <option data-countrycode="AM" value="374">Armenia (+374)</option>
                                <option data-countrycode="AW" value="297">Aruba (+297)</option>
                                <option data-countrycode="AU" value="61">Australia (+61)</option>
                                <option data-countrycode="AT" value="43">Austria (+43)</option>
                                <option data-countrycode="AZ" value="994">Azerbaijan (+994)</option>
                                <option data-countrycode="BS" value="1242">Bahamas (+1242)</option>
                                <option data-countrycode="BH" value="973">Bahrain (+973)</option>
                                <option data-countrycode="BD" value="880">Bangladesh (+880)</option>
                                <option data-countrycode="BB" value="1246">Barbados (+1246)</option>
                                <option data-countrycode="BY" value="375">Belarus (+375)</option>
                                <option data-countrycode="BE" value="32">Belgium (+32)</option>
                                <option data-countrycode="BZ" value="501">Belize (+501)</option>
                                <option data-countrycode="BJ" value="229">Benin (+229)</option>
                                <option data-countrycode="BM" value="1441">Bermuda (+1441)</option>
                                <option data-countrycode="BT" value="975">Bhutan (+975)</option>
                                <option data-countrycode="BO" value="591">Bolivia (+591)</option>
                                <option data-countrycode="BA" value="387">Bosnia Herzegovina (+387)</option>
                                <option data-countrycode="BW" value="267">Botswana (+267)</option>
                                <option data-countrycode="BR" value="55">Brazil (+55)</option>
                                <option data-countrycode="BN" value="673">Brunei (+673)</option>
                                <option data-countrycode="BG" value="359">Bulgaria (+359)</option>
                                <option data-countrycode="BF" value="226">Burkina Faso (+226)</option>
                                <option data-countrycode="BI" value="257">Burundi (+257)</option>
                                <option data-countrycode="KH" value="855">Cambodia (+855)</option>
                                <option data-countrycode="CM" value="237">Cameroon (+237)</option>
                                <option data-countrycode="CA" value="1">Canada (+1)</option>
                                <option data-countrycode="CV" value="238">Cape Verde Islands (+238)</option>
                                <option data-countrycode="KY" value="1345">Cayman Islands (+1345)</option>
                                <option data-countrycode="CF" value="236">Central African Republic (+236)</option>
                                <option data-countrycode="CL" value="56">Chile (+56)</option>
                                <option data-countrycode="CN" value="86">China (+86)</option>
                                <option data-countrycode="CO" value="57">Colombia (+57)</option>
                                <option data-countrycode="KM" value="269">Comoros (+269)</option>
                                <option data-countrycode="CG" value="242">Congo (+242)</option>
                                <option data-countrycode="CK" value="682">Cook Islands (+682)</option>
                                <option data-countrycode="CR" value="506">Costa Rica (+506)</option>
                                <option data-countrycode="HR" value="385">Croatia (+385)</option>
                                <option data-countrycode="CU" value="53">Cuba (+53)</option>
                                <option data-countrycode="CY" value="90392">Cyprus North (+90392)</option>
                                <option data-countrycode="CY" value="357">Cyprus South (+357)</option>
                                <option data-countrycode="CZ" value="42">Czech Republic (+42)</option>
                                <option data-countrycode="DK" value="45">Denmark (+45)</option>
                                <option data-countrycode="DJ" value="253">Djibouti (+253)</option>
                                <option data-countrycode="DM" value="1809">Dominica (+1809)</option>
                                <option data-countrycode="DO" value="1809">Dominican Republic (+1809)</option>
                                <option data-countrycode="EC" value="593">Ecuador (+593)</option>
                                <option data-countrycode="EG" value="20">Egypt (+20)</option>
                                <option data-countrycode="SV" value="503">El Salvador (+503)</option>
                                <option data-countrycode="GQ" value="240">Equatorial Guinea (+240)</option>
                                <option data-countrycode="ER" value="291">Eritrea (+291)</option>
                                <option data-countrycode="EE" value="372">Estonia (+372)</option>
                                <option data-countrycode="ET" value="251">Ethiopia (+251)</option>
                                <option data-countrycode="FK" value="500">Falkland Islands (+500)</option>
                                <option data-countrycode="FO" value="298">Faroe Islands (+298)</option>
                                <option data-countrycode="FJ" value="679">Fiji (+679)</option>
                                <option data-countrycode="FI" value="358">Finland (+358)</option>
                                <option data-countrycode="FR" value="33">France (+33)</option>
                                <option data-countrycode="GF" value="594">French Guiana (+594)</option>
                                <option data-countrycode="PF" value="689">French Polynesia (+689)</option>
                                <option data-countrycode="GA" value="241">Gabon (+241)</option>
                                <option data-countrycode="GM" value="220">Gambia (+220)</option>
                                <option data-countrycode="GE" value="7880">Georgia (+7880)</option>
                                <option data-countrycode="DE" value="49">Germany (+49)</option>
                                <option data-countrycode="GH" value="233">Ghana (+233)</option>
                                <option data-countrycode="GI" value="350">Gibraltar (+350)</option>
                                <option data-countrycode="GR" value="30">Greece (+30)</option>
                                <option data-countrycode="GL" value="299">Greenland (+299)</option>
                                <option data-countrycode="GD" value="1473">Grenada (+1473)</option>
                                <option data-countrycode="GP" value="590">Guadeloupe (+590)</option>
                                <option data-countrycode="GU" value="671">Guam (+671)</option>
                                <option data-countrycode="GT" value="502">Guatemala (+502)</option>
                                <option data-countrycode="GN" value="224">Guinea (+224)</option>
                                <option data-countrycode="GW" value="245">Guinea - Bissau (+245)</option>
                                <option data-countrycode="GY" value="592">Guyana (+592)</option>
                                <option data-countrycode="HT" value="509">Haiti (+509)</option>
                                <option data-countrycode="HN" value="504">Honduras (+504)</option>
                                <option data-countrycode="HK" value="852">Hong Kong (+852)</option>
                                <option data-countrycode="HU" value="36">Hungary (+36)</option>
                                <option data-countrycode="IS" value="354">Iceland (+354)</option>
                                <option data-countrycode="IN" value="91">India (+91)</option>
                                <option data-countrycode="ID" value="62">Indonesia (+62)</option>
                                <option data-countrycode="IR" value="98">Iran (+98)</option>
                                <option data-countrycode="IQ" value="964">Iraq (+964)</option>
                                <option data-countrycode="IE" value="353">Ireland (+353)</option>
                                <option data-countrycode="IL" value="972">Israel (+972)</option>
                                <option data-countrycode="IT" value="39">Italy (+39)</option>
                                <option data-countrycode="JM" value="1876">Jamaica (+1876)</option>
                                <option data-countrycode="JP" value="81">Japan (+81)</option>
                                <option data-countrycode="JO" value="962">Jordan (+962)</option>
                                <option data-countrycode="KZ" value="7">Kazakhstan (+7)</option>
                                <option data-countrycode="KE" value="254">Kenya (+254)</option>
                                <option data-countrycode="KI" value="686">Kiribati (+686)</option>
                                <option data-countrycode="KP" value="850">Korea North (+850)</option>
                                <option data-countrycode="KR" value="82">Korea South (+82)</option>
                                <option data-countrycode="KW" value="965">Kuwait (+965)</option>
                                <option data-countrycode="KG" value="996">Kyrgyzstan (+996)</option>
                                <option data-countrycode="LA" value="856">Laos (+856)</option>
                                <option data-countrycode="LV" value="371">Latvia (+371)</option>
                                <option data-countrycode="LB" value="961">Lebanon (+961)</option>
                                <option data-countrycode="LS" value="266">Lesotho (+266)</option>
                                <option data-countrycode="LR" value="231">Liberia (+231)</option>
                                <option data-countrycode="LY" value="218">Libya (+218)</option>
                                <option data-countrycode="LI" value="417">Liechtenstein (+417)</option>
                                <option data-countrycode="LT" value="370">Lithuania (+370)</option>
                                <option data-countrycode="LU" value="352">Luxembourg (+352)</option>
                                <option data-countrycode="MO" value="853">Macao (+853)</option>
                                <option data-countrycode="MK" value="389">Macedonia (+389)</option>
                                <option data-countrycode="MG" value="261">Madagascar (+261)</option>
                                <option data-countrycode="MW" value="265">Malawi (+265)</option>
                                <option data-countrycode="MY" value="60">Malaysia (+60)</option>
                                <option data-countrycode="MV" value="960">Maldives (+960)</option>
                                <option data-countrycode="ML" value="223">Mali (+223)</option>
                                <option data-countrycode="MT" value="356">Malta (+356)</option>
                                <option data-countrycode="MH" value="692">Marshall Islands (+692)</option>
                                <option data-countrycode="MQ" value="596">Martinique (+596)</option>
                                <option data-countrycode="MR" value="222">Mauritania (+222)</option>
                                <option data-countrycode="YT" value="269">Mayotte (+269)</option>
                                <option data-countrycode="MX" value="52">Mexico (+52)</option>
                                <option data-countrycode="FM" value="691">Micronesia (+691)</option>
                                <option data-countrycode="MD" value="373">Moldova (+373)</option>
                                <option data-countrycode="MC" value="377">Monaco (+377)</option>
                                <option data-countrycode="MN" value="976">Mongolia (+976)</option>
                                <option data-countrycode="MS" value="1664">Montserrat (+1664)</option>
                                <option data-countrycode="MA" value="212">Morocco (+212)</option>
                                <option data-countrycode="MZ" value="258">Mozambique (+258)</option>
                                <option data-countrycode="MN" value="95">Myanmar (+95)</option>
                                <option data-countrycode="NA" value="264">Namibia (+264)</option>
                                <option data-countrycode="NR" value="674">Nauru (+674)</option>
                                <option data-countrycode="NP" value="977">Nepal (+977)</option>
                                <option data-countrycode="NL" value="31">Netherlands (+31)</option>
                                <option data-countrycode="NC" value="687">New Caledonia (+687)</option>
                                <option data-countrycode="NZ" value="64">New Zealand (+64)</option>
                                <option data-countrycode="NI" value="505">Nicaragua (+505)</option>
                                <option data-countrycode="NE" value="227">Niger (+227)</option>
                                <option data-countrycode="NG" value="234">Nigeria (+234)</option>
                                <option data-countrycode="NU" value="683">Niue (+683)</option>
                                <option data-countrycode="NF" value="672">Norfolk Islands (+672)</option>
                                <option data-countrycode="NP" value="670">Northern Marianas (+670)</option>
                                <option data-countrycode="NO" value="47">Norway (+47)</option>
                                <option data-countrycode="OM" value="968">Oman (+968)</option>
                                <option data-countrycode="PW" value="680">Palau (+680)</option>
                                <option data-countrycode="PA" value="507">Panama (+507)</option>
                                <option data-countrycode="PG" value="675">Papua New Guinea (+675)</option>
                                <option data-countrycode="PY" value="595">Paraguay (+595)</option>
                                <option data-countrycode="PE" value="51">Peru (+51)</option>
                                <option data-countrycode="PH" value="63">Philippines (+63)</option>
                                <option data-countrycode="PL" value="48">Poland (+48)</option>
                                <option data-countrycode="PT" value="351">Portugal (+351)</option>
                                <option data-countrycode="PR" value="1787">Puerto Rico (+1787)</option>
                                <option data-countrycode="QA" value="974">Qatar (+974)</option>
                                <option data-countrycode="RE" value="262">Reunion (+262)</option>
                                <option data-countrycode="RO" value="40">Romania (+40)</option>
                                <option data-countrycode="RU" value="7">Russia (+7)</option>
                                <option data-countrycode="RW" value="250">Rwanda (+250)</option>
                                <option data-countrycode="SM" value="378">San Marino (+378)</option>
                                <option data-countrycode="ST" value="239">Sao Tome &amp; Principe (+239)</option>
                                <option data-countrycode="SA" value="966">Saudi Arabia (+966)</option>
                                <option data-countrycode="SN" value="221">Senegal (+221)</option>
                                <option data-countrycode="CS" value="381">Serbia (+381)</option>
                                <option data-countrycode="SC" value="248">Seychelles (+248)</option>
                                <option data-countrycode="SL" value="232">Sierra Leone (+232)</option>
                                <option data-countrycode="SG" value="65">Singapore (+65)</option>
                                <option data-countrycode="SK" value="421">Slovak Republic (+421)</option>
                                <option data-countrycode="SI" value="386">Slovenia (+386)</option>
                                <option data-countrycode="SB" value="677">Solomon Islands (+677)</option>
                                <option data-countrycode="SO" value="252">Somalia (+252)</option>
                                <option data-countrycode="ZA" value="27">South Africa (+27)</option>
                                <option data-countrycode="ES" value="34">Spain (+34)</option>
                                <option data-countrycode="LK" value="94">Sri Lanka (+94)</option>
                                <option data-countrycode="SH" value="290">St. Helena (+290)</option>
                                <option data-countrycode="KN" value="1869">St. Kitts (+1869)</option>
                                <option data-countrycode="SC" value="1758">St. Lucia (+1758)</option>
                                <option data-countrycode="SD" value="249">Sudan (+249)</option>
                                <option data-countrycode="SR" value="597">Suriname (+597)</option>
                                <option data-countrycode="SZ" value="268">Swaziland (+268)</option>
                                <option data-countrycode="SE" value="46">Sweden (+46)</option>
                                <option data-countrycode="CH" value="41">Switzerland (+41)</option>
                                <option data-countrycode="SI" value="963">Syria (+963)</option>
                                <option data-countrycode="TW" value="886">Taiwan (+886)</option>
                                <option data-countrycode="TJ" value="7">Tajikstan (+7)</option>
                                <option data-countrycode="TH" value="66">Thailand (+66)</option>
                                <option data-countrycode="TG" value="228">Togo (+228)</option>
                                <option data-countrycode="TO" value="676">Tonga (+676)</option>
                                <option data-countrycode="TT" value="1868">Trinidad &amp; Tobago (+1868)</option>
                                <option data-countrycode="TN" value="216">Tunisia (+216)</option>
                                <option data-countrycode="TR" value="90">Turkey (+90)</option>
                                <option data-countrycode="TM" value="7">Turkmenistan (+7)</option>
                                <option data-countrycode="TM" value="993">Turkmenistan (+993)</option>
                                <option data-countrycode="TC" value="1649">Turks &amp; Caicos Islands (+1649)</option>
                                <option data-countrycode="TV" value="688">Tuvalu (+688)</option>
                                <option data-countrycode="UG" value="256">Uganda (+256)</option>
                                <!-- <option data-countryCode="GB" value="44">UK (+44)</option> -->
                                <option data-countrycode="UA" value="380">Ukraine (+380)</option>
                                <option data-countrycode="AE" value="971">United Arab Emirates (+971)</option>
                                <option data-countrycode="UY" value="598">Uruguay (+598)</option>
                                <!-- <option data-countryCode="US" value="1">USA (+1)</option> -->
                                <option data-countrycode="UZ" value="7">Uzbekistan (+7)</option>
                                <option data-countrycode="VU" value="678">Vanuatu (+678)</option>
                                <option data-countrycode="VA" value="379">Vatican City (+379)</option>
                                <option data-countrycode="VE" value="58">Venezuela (+58)</option>
                                <option data-countrycode="VN" value="84">Vietnam (+84)</option>
                                <option data-countrycode="VG" value="84">Virgin Islands - British (+1284)</option>
                                <option data-countrycode="VI" value="84">Virgin Islands - US (+1340)</option>
                                <option data-countrycode="WF" value="681">Wallis &amp; Futuna (+681)</option>
                                <option data-countrycode="YE" value="969">Yemen (North)(+969)</option>
                                <option data-countrycode="YE" value="967">Yemen (South)(+967)</option>
                                <option data-countrycode="ZM" value="260">Zambia (+260)</option>
                                <option data-countrycode="ZW" value="263">Zimbabwe (+263)</option>
                        </select>
                    </div>


                 <div class="form-group has-feedback">
                            <select name="country" id="country"  class="form-control" placeholder="Country">
                                <option data-countrycode="" disabled selected>Country
                                </option>
                                <option data-countrycode="DZ" value="Algeria">Algeria
                                </option>
                                <option data-countrycode="AD" value="Andorra">Andorra
                                </option>
                                <option data-countrycode="AO" value="Angola">Angola
                                </option>
                                <option data-countrycode="AI" value="Anguilla">Anguilla
                                </option>
                                <option data-countrycode="AG" value="Antigua &amp; Barbuda">Antigua &amp; Barbuda
                                </option>
                                <option data-countrycode="AR" value="Argentina">Argentina
                                </option>
                                <option data-countrycode="AM" value="Armenia">Armenia
                                </option>
                                <option data-countrycode="AW" value="Aruba">Aruba
                                </option>
                                <option data-countrycode="AU" value="Australia">Australia
                                </option>
                                <option data-countrycode="AT" value="Austria">Austria
                                </option>
                                <option data-countrycode="AZ" value="Azerbaijan">Azerbaijan
                                </option>
                                <option data-countrycode="BS" value="Bahamas">Bahamas
                                </option>
                                <option data-countrycode="BH" value="Bahrain">Bahrain
                                </option>
                                <option data-countrycode="BD" value="Bangladesh">Bangladesh
                                </option>
                                <option data-countrycode="BB" value="Barbados">Barbados
                                </option>
                                <option data-countrycode="BY" value="Belarus">Belarus
                                </option>
                                <option data-countrycode="BE" value="Belgium">Belgium
                                </option>
                                <option data-countrycode="BZ" value="Belize">Belize
                                </option>
                                <option data-countrycode="BJ" value="Benin">Benin
                                </option>
                                <option data-countrycode="BM" value="Bermuda">Bermuda
                                </option>
                                <option data-countrycode="BT" value="Bhutan">Bhutan
                                </option>
                                <option data-countrycode="BO" value="Bolivia">Bolivia
                                </option>
                                <option data-countrycode="BA" value="Bosnia Herzegovina">Bosnia Herzegovina
                                </option>
                                <option data-countrycode="BW" value="Botswana">Botswana
                                </option>
                                <option data-countrycode="BR" value="Brazil">Brazil
                                </option>
                                <option data-countrycode="BN" value="Brunei">Brunei
                                </option>
                                <option data-countrycode="BG" value="Bulgaria">Bulgaria
                                </option>
                                <option data-countrycode="BF" value="Burkina Faso">Burkina Faso
                                </option>
                                <option data-countrycode="BI" value="Burundi">Burundi
                                </option>
                                <option data-countrycode="KH" value="Cambodia">Cambodia
                                </option>
                                <option data-countrycode="CM" value="Cameroon">Cameroon
                                </option>
                                <option data-countrycode="CA" value="Canada">Canada
                                </option>
                                <option data-countrycode="CV" value="Cape Verde Islands">Cape Verde Islands
                                </option>
                                <option data-countrycode="KY" value="Cayman Islands">Cayman Islands
                                </option>
                                <option data-countrycode="CF" value="Central African Republic">Central African Republic
                                </option>
                                <option data-countrycode="CL" value="Chile">Chile
                                </option>
                                <option data-countrycode="CN" value="China">China
                                </option>
                                <option data-countrycode="CO" value="Colombia">Colombia
                                </option>
                                <option data-countrycode="KM" value="Comoros">Comoros
                                </option>
                                <option data-countrycode="CG" value="Congo">Congo
                                </option>
                                <option data-countrycode="CK" value="Cook Islands">Cook Islands
                                </option>
                                <option data-countrycode="CR" value="Costa Rica">Costa Rica
                                </option>
                                <option data-countrycode="HR" value="Croatia">Croatia
                                </option>
                                <option data-countrycode="CU" value="Cuba">Cuba
                                </option>
                                <option data-countrycode="CY" value="Cyprus North">Cyprus North
                                </option>
                                <option data-countrycode="CY" value="Cyprus South">Cyprus South
                                </option>
                                <option data-countrycode="CZ" value="Czech Republic">Czech Republic
                                </option>
                                <option data-countrycode="DK" value="Denmark">Denmark
                                </option>
                                <option data-countrycode="DJ" value="Djibouti">Djibouti
                                </option>
                                <option data-countrycode="DM" value="Dominica">Dominica
                                </option>
                                <option data-countrycode="DO" value="Dominican Republic">Dominican Republic
                                </option>
                                <option data-countrycode="EC" value="Ecuador">Ecuador
                                </option>
                                <option data-countrycode="EG" value="Egypt">Egypt
                                </option>
                                <option data-countrycode="SV" value="El Salvador">El Salvador
                                </option>
                                <option data-countrycode="GQ" value="Equatorial Guinea">Equatorial Guinea
                                </option>
                                <option data-countrycode="ER" value="Eritrea">Eritrea
                                </option>
                                <option data-countrycode="EE" value="Estonia">Estonia
                                </option>
                                <option data-countrycode="ET" value="Ethiopia">Ethiopia
                                </option>
                                <option data-countrycode="FK" value="Falkland Islands">Falkland Islands
                                </option>
                                <option data-countrycode="FO" value="Faroe Islands">Faroe Islands
                                </option>
                                <option data-countrycode="FJ" value="Fiji">Fiji
                                </option>
                                <option data-countrycode="FI" value="Finland">Finland
                                </option>
                                <option data-countrycode="FR" value="France">France
                                </option>
                                <option data-countrycode="GF" value="French Guiana">French Guiana
                                </option>
                                <option data-countrycode="PF" value="French Polynesia">French Polynesia
                                </option>
                                <option data-countrycode="GA" value="Gabon">Gabon
                                </option>
                                <option data-countrycode="GM" value="Gambia">Gambia
                                </option>
                                <option data-countrycode="GE" value="Georgia">Georgia
                                </option>
                                <option data-countrycode="DE" value="Germany">Germany
                                </option>
                                <option data-countrycode="GH" value="Ghana">Ghana
                                </option>
                                <option data-countrycode="GI" value="Gibraltar">Gibraltar
                                </option>
                                <option data-countrycode="GR" value="Greece">Greece
                                </option>
                                <option data-countrycode="GL" value="Greenland">Greenland
                                </option>
                                <option data-countrycode="GD" value="Grenada">Grenada
                                </option>
                                <option data-countrycode="GP" value="Guadeloupe">Guadeloupe
                                </option>
                                <option data-countrycode="GU" value="Guam">Guam
                                </option>
                                <option data-countrycode="GT" value="Guatemala">Guatemala
                                </option>
                                <option data-countrycode="GN" value="Guinea">Guinea
                                </option>
                                <option data-countrycode="GW" value="Guinea - Bissau">Guinea - Bissau
                                </option>
                                <option data-countrycode="GY" value="Guyana">Guyana
                                </option>
                                <option data-countrycode="HT" value="Haiti">Haiti
                                </option>
                                <option data-countrycode="HN" value="Honduras">Honduras
                                </option>
                                <option data-countrycode="HK" value="Hong Kong">Hong Kong
                                </option>
                                <option data-countrycode="HU" value="Hungary">Hungary
                                </option>
                                <option data-countrycode="IS" value="Iceland">Iceland
                                </option>
                                <option data-countrycode="IN" value="India">India
                                </option>
                                <option data-countrycode="ID" value="Indonesia">Indonesia
                                </option>
                                <option data-countrycode="IR" value="Iran">Iran
                                </option>
                                <option data-countrycode="IQ" value="Iraq">Iraq
                                </option>
                                <option data-countrycode="IE" value="Ireland">Ireland
                                </option>
                                <option data-countrycode="IL" value="Israel">Israel
                                </option>
                                <option data-countrycode="IT" value="Italy">Italy
                                </option>
                                <option data-countrycode="JM" value="Jamaica">Jamaica
                                </option>
                                <option data-countrycode="JP" value="Japan">Japan
                                </option>
                                <option data-countrycode="JO" value="Jordan">Jordan
                                </option>
                                <option data-countrycode="KZ" value="Kazakhstan">Kazakhstan
                                </option>
                                <option data-countrycode="KE" value="Kenya">Kenya
                                </option>
                                <option data-countrycode="KI" value="Kiribati">Kiribati
                                </option>
                                <option data-countrycode="KP" value="Korea North">Korea North
                                </option>
                                <option data-countrycode="KR" value="Korea South">Korea South
                                </option>
                                <option data-countrycode="KW" value="Kuwait">Kuwait
                                </option>
                                <option data-countrycode="KG" value="Kyrgyzstan">Kyrgyzstan
                                </option>
                                <option data-countrycode="LA" value="Laos">Laos
                                </option>
                                <option data-countrycode="LV" value="Latvia">Latvia
                                </option>
                                <option data-countrycode="LB" value="Lebanon">Lebanon
                                </option>
                                <option data-countrycode="LS" value="Lesotho">Lesotho
                                </option>
                                <option data-countrycode="LR" value="Liberia">Liberia
                                </option>
                                <option data-countrycode="LY" value="Libya">Libya
                                </option>
                                <option data-countrycode="LI" value="Liechtenstein">Liechtenstein
                                </option>
                                <option data-countrycode="LT" value="Lithuania">Lithuania
                                </option>
                                <option data-countrycode="LU" value="Luxembourg">Luxembourg
                                </option>
                                <option data-countrycode="MO" value="Macao">Macao
                                </option>
                                <option data-countrycode="MK" value="Macedonia">Macedonia
                                </option>
                                <option data-countrycode="MG" value="Madagascar">Madagascar
                                </option>
                                <option data-countrycode="MW" value="Malawi">Malawi
                                </option>
                                <option data-countrycode="MY" value="Malaysia">Malaysia
                                </option>
                                <option data-countrycode="MV" value="Maldives">Maldives
                                </option>
                                <option data-countrycode="ML" value="Mali">Mali
                                </option>
                                <option data-countrycode="MT" value="Malta">Malta
                                </option>
                                <option data-countrycode="MH" value="Marshall Islands">Marshall Islands
                                </option>
                                <option data-countrycode="MQ" value="Martinique">Martinique
                                </option>
                                <option data-countrycode="MR" value="Mauritania">Mauritania
                                </option>
                                <option data-countrycode="YT" value="Mayotte">Mayotte
                                </option>
                                <option data-countrycode="MX" value="Mexico">Mexico
                                </option>
                                <option data-countrycode="FM" value="Micronesia">Micronesia
                                </option>
                                <option data-countrycode="MD" value="Moldova">Moldova
                                </option>
                                <option data-countrycode="MC" value="Monaco">Monaco
                                </option>
                                <option data-countrycode="MN" value="Mongolia">Mongolia
                                </option>
                                <option data-countrycode="MS" value="Montserrat">Montserrat
                                </option>
                                <option data-countrycode="MA" value="Morocco">Morocco
                                </option>
                                <option data-countrycode="MZ" value="Mozambique">Mozambique
                                </option>
                                <option data-countrycode="MN" value="Myanmar">Myanmar
                                </option>
                                <option data-countrycode="NA" value="Namibia">Namibia
                                </option>
                                <option data-countrycode="NR" value="Nauru">Nauru
                                </option>
                                <option data-countrycode="NP" value="Nepal">Nepal
                                </option>
                                <option data-countrycode="NL" value="Netherlands">Netherlands
                                </option>
                                <option data-countrycode="NC" value="New Caledonia">New Caledonia
                                </option>
                                <option data-countrycode="NZ" value="New Zealand">New Zealand
                                </option>
                                <option data-countrycode="NI" value="Nicaragua">Nicaragua
                                </option>
                                <option data-countrycode="NE" value="Niger">Niger
                                </option>
                                <option data-countrycode="NG" value="Nigeria">Nigeria
                                </option>
                                <option data-countrycode="NU" value="Niue">Niue
                                </option>
                                <option data-countrycode="NF" value="Norfolk Islands">Norfolk Islands
                                </option>
                                <option data-countrycode="NP" value="Northern Marianas">Northern Marianas
                                </option>
                                <option data-countrycode="NO" value="Norway">Norway
                                </option>
                                <option data-countrycode="OM" value="Oman">Oman
                                </option>
                                <option data-countrycode="PW" value="Palau">Palau
                                </option>
                                <option data-countrycode="PA" value="Panama">Panama
                                </option>
                                <option data-countrycode="PG" value="Papua New Guinea">Papua New Guinea
                                </option>
                                <option data-countrycode="PY" value="Paraguay">Paraguay
                                </option>
                                <option data-countrycode="PE" value="Peru">Peru
                                </option>
                                <option data-countrycode="PH" value="Philippines">Philippines
                                </option>
                                <option data-countrycode="PL" value="Poland">Poland
                                </option>
                                <option data-countrycode="PT" value="Portugal">Portugal
                                </option>
                                <option data-countrycode="PR" value="Puerto Rico">Puerto Rico
                                </option>
                                <option data-countrycode="QA" value="Qatar">Qatar
                                </option>
                                <option data-countrycode="RE" value="Reunion">Reunion
                                </option>
                                <option data-countrycode="RO" value="Romania">Romania
                                </option>
                                <option data-countrycode="RU" value="Russia">Russia
                                </option>
                                <option data-countrycode="RW" value="Rwanda">Rwanda
                                </option>
                                <option data-countrycode="SM" value="San Marino">San Marino
                                </option>
                                <option data-countrycode="ST" value="Sao Tome &amp; Principe">Sao Tome &amp; Principe
                                </option>
                                <option data-countrycode="SA" value="Saudi Arabia">Saudi Arabia
                                </option>
                                <option data-countrycode="SN" value="Senegal">Senegal
                                </option>
                                <option data-countrycode="CS" value="Serbia">Serbia
                                </option>
                                <option data-countrycode="SC" value="Seychelles">Seychelles
                                </option>
                                <option data-countrycode="SL" value="Sierra Leone">Sierra Leone
                                </option>
                                <option data-countrycode="SG" value="Singapore">Singapore
                                </option>
                                <option data-countrycode="SK" value="Slovak Republic">Slovak Republic
                                </option>
                                <option data-countrycode="SI" value="Slovenia">Slovenia
                                </option>
                                <option data-countrycode="SB" value="Solomon Islands">Solomon Islands
                                </option>
                                <option data-countrycode="SO" value="Somalia">Somalia
                                </option>
                                <option data-countrycode="ZA" value="South Africa">South Africa
                                </option>
                                <option data-countrycode="ES" value="Spain">Spain
                                </option>
                                <option data-countrycode="LK" value="Sri Lanka">Sri Lanka
                                </option>
                                <option data-countrycode="SH" value="St. Helena">St. Helena
                                </option>
                                <option data-countrycode="KN" value="St. Kitts">St. Kitts
                                </option>
                                <option data-countrycode="SC" value="St. Lucia">St. Lucia
                                </option>
                                <option data-countrycode="SD" value="Sudan">Sudan
                                </option>
                                <option data-countrycode="SR" value="Suriname">Suriname
                                </option>
                                <option data-countrycode="SZ" value="Swaziland">Swaziland
                                </option>
                                <option data-countrycode="SE" value="Sweden">Sweden
                                </option>
                                <option data-countrycode="CH" value="Switzerland">Switzerland
                                </option>
                                <option data-countrycode="SI" value="Syria">Syria
                                </option>
                                <option data-countrycode="TW" value="Taiwan">Taiwan
                                </option>
                                <option data-countrycode="TJ" value="Tajikstan">Tajikstan
                                </option>
                                <option data-countrycode="TH" value="Thailand">Thailand
                                </option>
                                <option data-countrycode="TG" value="Togo">Togo
                                </option>
                                <option data-countrycode="TO" value="Tonga">Tonga
                                </option>
                                <option data-countrycode="TT" value="Trinidad &amp; Tobago">Trinidad &amp; Tobago
                                </option>
                                <option data-countrycode="TN" value="Tunisia">Tunisia
                                </option>
                                <option data-countrycode="TR" value="Turkey">Turkey
                                </option>
                                <option data-countrycode="TM" value="Turkmenistan">Turkmenistan
                                </option>
                                <option data-countrycode="TM" value="Turkmenistan">Turkmenistan
                                </option>
                                <option data-countrycode="TC" value="Turks &amp; Caicos Islands">Turks &amp; Caicos Islands
                                </option>
                                <option data-countrycode="TV" value="Tuvalu">Tuvalu
                                </option>
                                <option data-countrycode="UG" value="Uganda">Uganda
                                </option>
                                <option data-countryCode="GB" UK ="44">UK 
                                </option>
                                <option data-countrycode="UA" value="Ukraine">Ukraine
                                </option>
                                <option data-countrycode="AE" value="United Arab Emirates">United Arab Emirates
                                </option>
                                <option data-countrycode="UY" value="Uruguay">Uruguay
                                </option>
                                <option data-countryCode="US" USA ="1">USA 
                                </option>
                                <option data-countrycode="UZ" value="Uzbekistan">Uzbekistan
                                </option>
                                <option data-countrycode="VU" value="Vanuatu">Vanuatu
                                </option>
                                <option data-countrycode="VA" value="Vatican City">Vatican City
                                </option>
                                <option data-countrycode="VE" value="Venezuela">Venezuela
                                </option>
                                <option data-countrycode="VN" value="Vietnam">Vietnam
                                </option>
                                <option data-countrycode="VG" value="Virgin Islands - British">Virgin Islands - British
                                </option>
                                <option data-countrycode="VI" value="Virgin Islands - US">Virgin Islands - US
                                </option>
                                <option data-countrycode="WF" value="Wallis &amp; Futuna">Wallis &amp; Futuna
                                </option>
                                <option data-countrycode="YE" value="Yemen (North">Yemen (North
                                </option>
                                <option data-countrycode="YE" value="Yemen (South">Yemen (South
                                </option>
                                <option data-countrycode="ZM" value="Zambia">Zambia
                                </option>
                                <option data-countrycode="ZW" value="Zimbabwe">Zimbabwe
                                </option>
                        </select></div>

                    <div class="form-group has-feedback ">
                        <input type="tel" placeholder="Phone" name="phone" value="{{old('phone')}}"autofocus="autofocus" class="form-control"> <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                        <!---->
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" placeholder="Password" name="password" value="" class="form-control"> <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        <!---->
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" placeholder="Retype password" value="" name="password_confirmation" class="form-control">
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" placeholder="Wallet address" value="" name="ether" class="form-control">
                    </div>
                    <div class="form-group has-feedback">
                        <input type="hidden" value="{{request()->ref}}" name="referred_by" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="terms"> <a href="#" class="" data-toggle="modal" data-target="#termsModal">Terms and conditions</a>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 captcha-box">
                            <div name="recaptcha" class="g-recaptcha recaptcha-otr " data-sitekey="{{ $captcha->captcha_key }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                            <a href="{{route('oauth_social','google')}}" class="btn btn-primary btn-block btn-social btn-google">Sign Up With Google</a>
                        </div>
                        <div class="col-md-12">
                            <p style="margin-top: 15px;"> <a class="link pull-right" href="{{ url('/login') }}">Already have account?</a></p> 
                        </div>
                </form>
                </div>
                </div>
            </div>
        </div>
        @include('adminlte::layouts.partials.scripts_auth') @include('adminlte::auth.terms')
</body>
@endsection
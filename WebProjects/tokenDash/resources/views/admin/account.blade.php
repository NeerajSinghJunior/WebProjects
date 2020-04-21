@extends('admin.layouts.app')
@section('site_tile',auth()->user()->site_title)
@section('content')
<div class="page-wrapper">
<!-- Bread crumb -->
<div class="row page-titles">
   <div class="col-md-12 align-self-center">
      <h3 class="text-primary">Account Setting</h3>
   </div>
</div>
@include('admin/partials/error')
@include('admin/partials/success')
@include('admin/partials/session-error')
<div id="error-div"></div>
<!-- End Bread crumb -->
<!-- Container fluid  -->
<div class="container-fluid">
   <!-- Start Page Content -->
   <div class="row page-inner">
      <div class="col-lg-6">
         <div class="card">
            <div class="card-title">
               <h4>Captcha Configuration</h4>
               <p>Prevent automatic Bot signups on your site. Powered by Captcha.</p>
            </div>
            <div class="card-body">
               <div class="basic-form">
                  <form role="form" action="{{ url('admin/change_captcha') }}" method="POST">
                     {{ csrf_field() }}
                     <div class="form-group">
                        <label>Captcha Key</label>
                        <input type="text"  name="captcha_key" class="form-control" placeholder="Enter captcha key" @if(auth()->guard('admin')->user()->captcha_key) value="{{ auth()->guard('admin')->user()->captcha_key  }}"@endif>
                     </div>
                     <div class="form-group">
                        <label>Captcha Public Key</label>
                        <input type="text"  name="public_key" class="form-control" placeholder="Enter public key" @if(auth()->guard('admin')->user()->recaptcha_public_key) value="{{ auth()->guard('admin')->user()->recaptcha_public_key  }}"@endif>
                     </div>
                     <button type="submit" id="save-button" class="btn btn-success">Save</button>
                  </form>
               </div>
            </div>
         </div>
         <div class="card">
            <div class="card-title">
               <h4>Google Authenticator</h4>
            </div>
            <div class="card-body">
               <form role="form" action="{{ route('admin.google2fa') }}" method="POST" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="basic-form">
                     <label>Google Authenticator Image</label>
                     <img src="{{$QR_Image}}" height="250" width="250"/>
                  </div>
                  {{-- 
                  <div class="basic-form checkbox  acc-chk">
                     <label>
                     <input type="checkbox" @if(auth()->user()->google2fa_on) checked="true" @endif name="google2fa_on" value="on" style="width:auto;margin-right:5px;"/>
                     </label>Turn Google Authenticator On?
                  </div>
                  --}}
                  <div class="basic-form checkbox acc-chk">
                     <label>
                     <input type="checkbox" @if(auth()->user()->google2fa_on) checked="true" @endif name="google2fa_on" value="on"  style="width:auto;margin-right:5px;"> Turn Google Authenticator On?
                     </label>
                  </div>
                  <button type="submit" class="btn btn-success">Save</button>
               </form>
            </div>
         </div>
      </div>
      <div class="col-lg-6">
         <div class="card">
            <div class="card-title">
               <h4>Site Details</h4>
               <p>Configure the basic details about your token dashboard</p>
            </div>
            <div class="card-body">
               <div class="basic-form">
                  <form role="form" action="{{ url('admin/account') }}" method="POST" enctype="multipart/form-data">
                     {{ csrf_field() }}
                     <div class="form-group">
                        <label>Administrator Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Name" value="{{ auth()->user()->name }}">
                     </div>
                     <div class="form-group">
                        <label>Email address</label>
                        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ auth()->user()->email }}">
                     </div>
                     <div class="form-group">
                        <label>Site Title</label>
                        <input type="text" name="site_title" class="form-control" placeholder="Site Title" value="{{ auth()->user()->site_title }}">
                     </div>
                     <div class="form-group">
                        <label>Token Launch Countdown Timer</label>
                        <input type="date" name="date_to_be_launched" class="form-control" placeholder="Date to be launched" value="{{ auth()->user()->date_to_be_launched }}">
                     </div>
                     <div class="form-group">
                        <label>White Paper</label>
                        <input type="file" name="white_paper" class="form-control" placeholder="White Paper">
                        Click <a href="{{auth()->user()->white_paper}}" target="_blank">Here</a> to view.
                     </div>
                     <div class="form-group">
                        <label>Site Logo(200*34)</label>
                        <input type="file"  name="site_logo" />
                        <div class="text-center">
                           <span class="img-otr" style="position: relative;display:inline-block;">
                           <img src="{{auth()->user()->site_logo}}" width="80" />
                           </span>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Fav Token(32*32)</label>
                        <input type="file" name="fav_ico" />
                        <div class="text-center">
                           <span style="position: relative;display:inline-block;">
                           <img src="{{auth()->user()->fav_ico}}" width="32"/>
                           </span>
                        </div>
                     </div>
                     <button type="submit" class="btn btn-success">Save</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-6">
         <div class="card">
            <div class="card-title">
               <h4>Default Token Price</h4>
               <p>Default price of your token. This price will be overridden if you have set anyother price in the Token Status bar.</p>
            </div>
            <div class="card-body">
               <form role="form" action="{{ url('admin/updateDefaultCoin') }}" method="POST" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="basic-form">
                     <label>Token Price</label>
                  </div>
                  <div class="basic-form checkbox acc-chk">
                     <label>
                     <input type="text" name="default_token_price" value="{{ auth()->user()->default_token_price }}"  class="form-control"> 
                     </label>
                  </div>
                  <button type="submit" class="btn btn-success">Save</button>
               </form>
            </div>
         </div>
         <div class="card">
            <div class="card-title">
               <h4>Change Password</h4>
               <p>For added security, regularly change your admin password.</p>
            </div>
            <div class="card-body">
               <div class="basic-form">
                  <form role="form" action="{{ url('admin/account/password') }}" method="POST">
                     {{ csrf_field() }}
                     <div class="form-group">
                        <label>Old Password</label>
                        <input type="password" name="password_old" class="form-control" placeholder="Old Password">
                     </div>
                     <div class="form-group">
                        <label>New Password</label>
                        <input type="password" name="password" class="form-control" placeholder="New Password">
                     </div>
                     <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                     </div>
                     <button type="submit" class="btn btn-success">Change</button>
                  </form>
               </div>
            </div>
         </div>
         <div class="card">
            <div class="card-title">
               <h4>Stripe</h4>
               <p>Add your Stripe API Key and secret</p>
            </div>
            <div class="card-body">
               <div class="basic-form">
                  <form role="form" action="{{ url('admin/updateStripe') }}" method="POST">
                     {{ csrf_field() }}
                     <div class="form-group">
                        <label>PK Key</label>
                        <input type="text" name="pk_key" class="form-control" value="{{$pk_key->value}}" >
                     </div>
                     <div class="form-group">
                        <label>SK Key</label>
                        <input type="text" name="sk_key" class="form-control" value="{{$sk_key->value}}" >
                     </div>
                     <button type="submit" class="btn btn-success">Update Stripe</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-6">
         <div class="card">
            <div class="card-title">
               <h4>Wallet Configuration</h4>
               <p>Master wallet from which all the Tokens will be sent, make sure this is correct otherwise the tokens won't be sent automatically or manually.</p>
            </div>
            <div class="card-body">
               <div class="basic-form">
                  <form role="form" action="{{ url('admin/admin_wallet') }}" method="POST">
                     {{ csrf_field() }}
                     <div class="form-group">
                        <label>Wallet Balance {{$tokenAmount}}</label>
                     </div>
                      <div class="form-group">
                        <label>Wallet Address</label>
                        <input type="text" id="ether" name="ether" class="form-control" placeholder="Enter Wallet Address" value="{{ old('ether',auth()->guard('admin')->user()->ether) }}">
                     </div>
                      <div class="form-group">
                        <label>Private key</label>
                        <input type="text" id="private_key" name="private_key" class="form-control" placeholder="Enter Private key" value="{{ old('private_key',auth()->guard('admin')->user()->private_key) }}">
                     </div>
                     <div class="form-group">
                        <label>Contract Address</label>
                        <input type="text" id="contract_address" name="contract_address" class="form-control" placeholder="Enter Contract Address" value="{{ old('contract_address',auth()->guard('admin')->user()->contract_address) }}">
                     </div>
                     <div class="form-group">
                        <label>Contract Network</label>
                        <select class="form-control" name="contract_network">
                        <option @if(auth()->guard('admin')->user()->contract_network === "1") selected @endif value="1">Main Network</option>
                        <option @if(auth()->guard('admin')->user()->contract_network === "2") selected @endif  value="2">Morden Network</option>
                        <option @if(auth()->guard('admin')->user()->contract_network === "3") selected @endif  value="3">Ropsten Network</option>
                        <option  @if(auth()->guard('admin')->user()->contract_network === "4") selected @endif value="4">Rinkeby Network</option>
                        </select>
                     </div>
                     <div class="form-group">
                        <label>Contract ABI</label>
                        <textarea name="contract_abi" class="form-control" >{{old('contract_abi',auth()->guard('admin')->user()->contract_abi)}}</textarea>
                     </div>
                     <div class="form-group">
                        <label>Contract Name</label>
                        <input type="text" name="selling_coin_name" class="form-control" value="{{old('selling_coin_name',auth()->guard('admin')->user()->selling_coin_name)}}" placeholder="Contract Name" >
                     </div>
                     <div class="form-group">
                        <label>Transaction Hash</label>
                        <input type="text" name="transaction_hash" class="form-control" value="{{old('transaction_hash',auth()->guard('admin')->user()->transaction_hash)}}" placeholder="Transaction Hash">
                     </div>
                     <div class="form-group">
                        <label>Total No. Of Tokens</label>
                        <input type="number" name="total_supply" class="form-control"  value="{{old('total_supply',auth()->guard('admin')->user()->total_supply)}}">
                     </div>
                     <div class="form-group">
                        <label>Token Value($)</label>
                        <input type="number" name="coin_value"  value="{{old('coin_value',auth()->guard('admin')->user()->coin_value)}}" class="form-control" placeholder="Token Value($)" >
                     </div>
                     <div class="form-group">
                        <label>Bitcoin Address</label>
                        <input type="text" value="{{old('bitcoin',auth()->guard('admin')->user()->bitcoin)}}"id="ether" name="bitcoin" class="form-control" placeholder="Enter Wallet Address">
                     </div>
                     <button type="submit" id="save-button" class="btn btn-success">Save</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <!-- /# column -->
      <div class="col-lg-6">
         <div class="card">
            <div class="card-title">
               <h4>Paypal</h4>
               <p>Add your Paypal Merchant API key and secret.</p>
            </div>
            <div class="card-body">
               <div class="basic-form">
                  <form role="form" action="{{ url('admin/updatePaypal') }}" method="POST">
                     {{ csrf_field() }}
                     <div class="form-group">
                        <label>Client Id</label>
                        <input type="text" name="client_id" class="form-control" value="{{$client_id->value}}" >
                     </div>
                     <div class="form-group">
                        <label>Secret</label>
                        <input type="text" name="secret" class="form-control" value="{{$secret->value}}" >
                     </div>
                     <div class="form-group">
                        <label>Mode</label>
                        <select class="form-control" name="mode" >
                           <option value="sandbox">Sandbox</option>
                           <option value="live">Live</option>
                        </select>
                     </div>
                     <button type="submit" class="btn btn-success">Update Paypal</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <!-- /# column -->
      <div class="col-lg-6">
         <div class="card">
            <div class="card-title">
               <h4>Bank Details</h4>
               <a href="{{ route('admin.BankCodeMaster') }}" style="float: right;color: #007bff;font-size: 14px;text-transform: uppercase;">Add Bank Code</a>
            </div>
            <div class="card-body">
            <span class="btn btn-xs btn-success right" id="add_bank" style="float:right;">Add More Bank</span>
               <div class="basic-form">
                  <form role="form" action="{{ url('admin/account/update_bank_details') }}" method="POST">
                     {{ csrf_field() }}
                     @if(count($AdminBankDetails)!=0)
                     <?php $count=0; ?>
                     @foreach($AdminBankDetails as $adminbank)
                     <div>
                     <input type="hidden" name="id[]" value="{{$adminbank->id}}">
                     <div class="form-group">
                        <label>Account Name</label>
                        <input type="text" name="account_name[]" class="form-control" value="{{ $adminbank->account_name  }}" placeholder="Account Name">
                     </div>
                     <div class="form-group">
                        <label>Account Number</label>
                        <input type="text" name="account_number[]" class="form-control" value="{{ $adminbank->account_number  }}" placeholder="Account Number">
                     </div>
                     <div class="form-group">
                        <label>Bank Code & Code Value</label>
                        <select class="form-control" name="bank_code[]" style="width: 49%;display:inline;float: left;">
                          <option>Select Bank Code</option>
                          @foreach($BankCodeMaster as $key=>$BankCode)
                          <option value="{{$BankCode->id}}" @if($adminbank->bank_code==$BankCode->id) selected @endif>{{$BankCode->bank_code}}</option>
                          @endforeach
                        </select>
                        <input type="text" name="account_ifsc[]" class="form-control col-md-6" placeholder="Enter the Bank Code" value="{{ $adminbank->account_ifsc  }}" style="width: 49%;display:inline;float: right;">
                     </div>
                     <div class="form-group">                        
                        <label><input type="checkbox" name="default_flag[]" @if($adminbank->default_flag==1) checked @endif class="" value="1" style="width:5%;">&nbsp;Show in payment details</label>
                     </div>
                     @if($count>0)
                     <div class="form-group" style="margin-right: 45%;"><span class="btn btn-danger close" style="">X</span><br></div>
                     @endif
                     </div>
                     <?php $count++; ?>
                     @endforeach
                     @else
                     <div>
                     <input type="hidden" name="id[]" value="0">
                     <div class="form-group">
                        <label>Account Name</label>
                        <input type="text" name="account_name[]" class="form-control" value="{{ auth()->guard('admin')->user()->account_name  }}" placeholder="Account Name">
                     </div>
                     <div class="form-group">
                        <label>Account Number</label>
                        <input type="text" name="account_number[]" class="form-control" value="{{ auth()->guard('admin')->user()->account_number  }}" placeholder="Account Number">
                     </div>
                     <div class="form-group">
                        <label>Bank Code & Code Value</label>
                        <select class="form-control" name="bank_code[]" style="width: 49%;display:inline;float: left;">
                          <option>Select Bank Code</option>
                          @foreach($BankCodeMaster as $key=>$BankCode)
                          <option value="{{$BankCode->id}}" @if(auth()->user()->bank_code==$BankCode->id) selected @endif>{{$BankCode->bank_code}}</option>
                          @endforeach
                        </select>
                        <input type="text" name="account_ifsc[]" class="form-control col-md-6" placeholder="Enter the Bank Code" value="{{ auth()->guard('admin')->user()->account_ifsc  }}" style="width: 49%;display:inline;float: right;">
                     </div>
                     <div class="form-group">                        
                        <label><input type="checkbox" name="default_flag[]" class="" value="1" style="width:5%;">&nbsp;Show in payment details</label>
                     </div>
                     </div>
                     @endif
                     <div id="clone_div_bank"></div>
                     <button type="submit" class="btn btn-success">Update</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-6">
         <div class="card">
            <div class="card-title">
               <h4>Footer Scripts</h4>
               <p>The script codes you add here would be placed in the footer tag.</p>
            </div>
            <div class="card-body">
               <div class="basic-form">
                  <form role="form" action="{{ url('admin/updateScripts') }}" method="POST">
                     {{ csrf_field() }}
                     <div class="form-group">
                        <label>Chat Script</label>
                        <textarea rows="5" name="chat_script" id=""class="form-control">{{auth()->guard('admin')->user()->chat_script}}</textarea>
                     </div>
                     <div class="form-group">
                        <label>Analytics Script</label>
                        <textarea rows="5" name="analytics_script" id=""  class="form-control">{{auth()->guard('admin')->user()->analytics_script}}</textarea>
                     </div>
                     <button type="submit" class="btn btn-success">Update Scripts</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-6">
         <div class="card">
            <div class="card-title">
               <h4>Update Tax Percentages </h4>
               <p>Add the Tax types and percentages that will appear in the Expense and Income section.</p>
               <span  class="btn btn-xs btn-success right" id="add_tax" style="float:right">Add More Tax</span>
            </div>
            <div class="card-body">
               <div class="basic-form">
                  <form role="form" action="{{ url('admin/tax_update') }}" method="POST" >
                     {{ csrf_field() }}
                     <div>
                        @if(count($tax)!=0)
                        @foreach($tax as $t)
                        <input type="hidden" name="id[]" value="{{$t->id}}">
                        <div class="row">
                           <div class="form-group col-md-5" style="float: left">
                              <label>Tax type</label>
                              <input type="text" name="type[]" value="{{$t->type}}" placeholder="Tax type Ex: GST"  class="form-control">
                           </div>
                           <div class="form-group col-md-5" style="float: left">
                              <label>Value (%)</label>
                              <input type="number" name="value[]" value="{{$t->value}}" placeholder="Tax percentage Ex: 20"   class="form-control">
                           </div>
                           <div class="form-group col-md-2" style="float: right;">
                                 <span  class="btn btn-danger" style="float:right;margin-top: 35px;"><i class="fa fa-trash"></i></span>
                           </div>
                        </div>
                       
                        @endforeach
                        @else
                        <div class="row">
                           <input type="hidden" name="id[]" value="0">
                           <div class="form-group col-md-5" style="float: left">
                              <label>Tax type</label>
                              <input type="text" name="type[]"  placeholder="Tax type Ex: GST"  class="form-control">
                           </div>
                           <div class="form-group col-md-5" style="float: left">
                              <label>Value (%)</label>
                              <input type="number" name="value[]"  placeholder="Tax percentage Ex: 20"   class="form-control">
                           </div>
                           <div class="form-group col-md-2" style="float: right;">
                                 <span  class="btn btn-danger" style="float:right;margin-top: 35px;"><i class="fa fa-trash"></i></span>
                           </div>
                        </div>
                       
                        @endif
                     </div>
                     <div id="clone_div"></div>
                     <button type="submit" class="btn btn-success">Update Tax</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-6">
         <div class="card">
            <div class="card-title">
               <h4>Payment Modes</h4>
               <p>Add a payment mode that will display under the 'Add Expense' section.</p>
               <span  class="btn btn-xs btn-success right" id="add_payment" style="float:right">Add More Payment Modes</span>
            </div>
            <div class="card-body">
               <div class="basic-form">
                  <form role="form" action="{{ url('admin/add_payment_type') }}" method="POST">
                     {{ csrf_field() }}
                     @if(count($payment_types)!=0)
                        @foreach($payment_types as $pay)
                        <div class="row">
                           <div class="form-group col-md-10">
                              <input type="hidden" name="id[]" value="{{$pay->id}}" style="float: left">
                              <label>Payment Type</label>
                              <input type="text" name="payment_type[]" class="form-control" value="{{$pay->payment_type}}" placeholder="Payment Type">
                           </div>
                           <div class="form-group col-md-2">
                              <span  class="btn btn-danger right"  style="float:right;margin-top: 35px;"><i class="fa fa-trash"></i></span>
                           </div>
                        </div>
                        @endforeach
                     @else
                     <div class="row">
                           <div class="form-group col-md-10">
                              <input type="hidden" name="id[]" value="0" style="float: left">
                              <label>Payment Type</label>
                              <input type="text" name="payment_type[]" class="form-control"  placeholder="Payment Type">
                           </div>
                           <div class="form-group col-md-2">
                              <span  class="btn btn-danger right"  style="float:right;margin-top: 35px;"><i class="fa fa-trash"></i></span>
                           </div>
                     </div>
                     @endif
                     <div id="payment_div"></div>
                     <button type="submit" class="btn btn-success">Save</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <!-- End PAge Content -->
   </div>
   <!-- End Container fluid  -->
   <!-- footer -->
   {{-- @include('layouts.partials.footer') --}}
   <!-- End footer -->
</div>
@endsection
@section('extra-scripts')
<script>
   var i=1;
   $('#add_tax').on('click',function(){
       i++;
       // $("#clone_div").clone().val('').insertAfter("#clone_div");
       $("#clone_div").append('<div class="row" ><input type="hidden" name="id[]" value="0"><div class="form-group col-md-5" style="float: left"><label>Tax type</label><input type="text" name="type[]"  placeholder="Tax type Ex: GST"  class="form-control"></div><div class="form-group col-md-5" style="float: left"><label>Value (%)</label><input type="number" name="value[]"  placeholder="Tax percentage Ex: 20"   class="form-control"></div><div class="form-group col-md-2" style="float: right;"><span  class="btn btn-danger close"   style="float:right;margin-top: 35px;">X</span></div></div>');
   });
    
    var j=1;
   $('#add_payment').on('click',function(){
       j++;
      $("#payment_div").append('<div class="row" ><div class="form-group col-md-10"><input type="hidden" name="id[]" value="0" style="float: left"><label>Payment Type</label><input type="text" name="payment_type[]" class="form-control"  placeholder="Payment Type"></div><div class="form-group col-md-2"><span   class="btn btn-danger right close"   style="float:right;margin-top: 35px;">X</span></div></div>');
   });

  
   $(document.body).on('click', '.close', function()  {
     $(this).parent().parent().remove();
   });

   function clear_tax(id){
      $("#tax"+id).remove();
   }
   
   $('#save-button').on('click',function (e) {
   
       var walletAddress = $('#ether').val();
   
       var a =  App.validateWalletAddress(walletAddress);
   
       if(a){
   
           return true;
   
       }else {
   
           e.preventDefault();
   
           $('#error-div').html('<div class="alert alert-danger alert-dismissible" >' +
               '<ul>' +
               '' +
               '                <li>' +
               '' +
               '                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
               '' +
               '                        <p> Invalid wallet address </p>' +
               '                    ' +
               '                </li>' +
               '' +
               '            </ul>' +
               '' +
               '' +
               '        </div>');
   
   
   
   
       }
   
   });

var b=1;
$('#add_bank').on('click',function(){
 b++;
 // $('#clone_div_bank').clone().appendTo('#clone_div_bank1');
 $("#clone_div_bank").append('<div><input type="hidden" name="id[]" value="0"><div class="form-group"><label>Account Name</label><input type="text" name="account_name[]" class="form-control" value="" placeholder="Account Name"></div><div class="form-group"><label>Account Number</label><input type="text" name="account_number[]" class="form-control" value="" placeholder="Account Number"></div><div class="form-group"><label>Bank Code & Code Value</label><select class="form-control" name="bank_code[]" style="width: 49%;display:inline;float: left;"><option>Select Bank Code</option>@foreach($BankCodeMaster as $key=>$BankCode)<option value="{{$BankCode->id}}" >{{$BankCode->bank_code}}</option>@endforeach</select><input type="text" name="account_ifsc[]" class="form-control col-md-6" placeholder="Enter the Bank Code" value="" style="width: 49%;display:inline;float: right;"></div><div class="form-group"><label><input type="checkbox" name="default_flag[]" class="" value="1" style="width:5%;">&nbsp;Show in payment details</label></div><div class="form-group" style="margin-right: 45%;"><span class="btn btn-danger close" style="">X</span><br></div></div>');
});  
   
   
</script>
@endsection
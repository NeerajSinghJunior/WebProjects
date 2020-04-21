@extends('layouts.app')

@section('htmlheader_title')
Wallet Details
@endsection

@section('contentheader_title')
  Your Wallet address to deposit the coins.
@endsection

@section('main-content')
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
{{--    @if(session('error'))--}}
<div id="error-div" style="display:none;">
  <div class="col-md-12">
    <div class="alert alert-danger alert-dismissible">
        <ul>
            <li>
                <p id="error_text"></p>
            </li>
        </ul>
    </div>
  </div>
</div>
        {{--@endif--}}

<section class="content">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Important: Please read the below instruction carefully.</h3>
                    <p>In this screen you will be entering the wallet address to deposit your coins.</p>
                </div>
               
                <div class="box-body">
                  <form id="form-id" role="form" action="{{ route('step_4') }}" method="POST">
                    
                    <p>In which Wallet would you like to recieve your coins?</p>
                    <div>
                      <label class="radio-inline">
                      <input type="radio" value="ether" name="wallet_type" checked>
                      Etherium Wallet ( recommended )</label>
                    </div>
                        {{ csrf_field() }}
                        <p class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label>Etherium Wallet ID</label>
                                <input type="text" id="ether" name="ether" class="form-control" placeholder="Enter Wallet Address" @if(auth()->user()->ether) value="{{ auth()->user()->ether  }}"@endif>
                                <input type="hidden" id="txn_id" name="txn_id" value="{{ $transaction->id }}">
                            </div>
                          </p>
                        <p>
                          Dont have an Ethereum wallet address? <i>( Click 
                          <a href="#"  data-toggle="modal" data-target="#step1">HERE</a> 
                          to Learn how to create an Etherium wallet using MetaMask. ) </i>
                        </p>
                        @if(false)
                        <div>
                            <label class="radio-inline"><input type="radio" value="others" name="wallet_type">
                            Other Wallet</label>
                        </div>
                        <p class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label>Wallet Name</label>
                                <input type="text" id="wallet_o_name" name="wallet_name" class="form-control" placeholder="Please enter the name of the wallet " @if(auth()->user()->wallet_address) value="{{ auth()->user()->wallet_address  }}"@endif>
                            </div>
                            <div class="form-group">
                                <label>Wallet Address</label>
                                <input type="text" id="wallet_o_address"  name="wallet_address" class="form-control" placeholder="Please enter the wallet address here " @if(auth()->user()->wallet_name) value="{{ auth()->user()->wallet_name  }}"@endif>
                            </div>
                          </p>
                          @endif
                          <p>
                            Important:
                          </p>
                          <p>   
                            - Please double check the wallet address you entered above.
                          </p>
                          <p>
                            - If the wallet address is wrong, your coins can be lost forever.
                          </p>
                        <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                            <button id="next-button" class="btn btn-primary"><b>NEXT</b></button>
                        </div>

                    </form>
                </div>
                <br>
            </div>
        </div>
    </div>

    <!-- Modal -->
<div class="modal fade" id="step1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width:600px; ">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>How to create a ethereum wallet ID using metamask</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Steps to get your Ether Wallet address</p>
        
        <p>For this quick tutorial, we use myetherwallet.com  and MetaMask as a reference to show how you can get an Etherium Wallet address easily. It is NOT mandatory that you use these particular services, You can use any Etherium Wallet as per your convenience. </p>
        
        <p><b>Step 1:</b> If you haven't created an Ether wallet yet, go to an Ether Wallet creation site like https://myetherwallet.com or any other site.</p>
        
        <p><b>Step 2:</b> Follow the instructions shown on MyEtherWallet.com to create your wallet. Save the JSON Private Key file and save your Private key securely. Do NOT Share it with anyone.</p>
        
        <p><b> Step 3: </b> Choose a way to access your wallet, Install Meta Mask. Follow the instruction present there and connect to Meta Mask. </p>
        
        <p><b> Step 4: </b> Once Meta Mask is connected, Click on View wallet on the MyEtherWallet Website this should display your Ether Address.</p>
        
        <p><b> Step 5:</b> Copy the address and paste it in the Etherium Wallet address input field below. </p>
        
        <p>If you used any other coins to purchase the Coin, Enter the name of the Wallet for example: Bitcoin Wallet and it's address that was used to send it.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>



</section>
@endsection
@section('scripts')

    @parent

    <script>
      $('#next-button').on('click',function (e) {
        $('#error-div').hide();
        var walletAddress = $('#ether').val().trim();
        var txn_id = $('#txn_id').val();
        var wallet_o_address = $('#wallet_o_address').val() && $('#wallet_o_address').val().trim();
        var wallet_o_name = $('#wallet_o_name').val() && $('#wallet_o_name').val().trim();
        console.log(walletAddress, wallet_o_address, wallet_o_name);
        if(!walletAddress && (!wallet_o_address || !wallet_o_name) ) {
          $('#error-div').show();
          $('#error_text').html('Fill either wallet address or other wallet details');
          e.preventDefault();
          return false;
        }
        else if(walletAddress){
          var a =  App.validateWalletAddress(walletAddress);
          if(a) return true;
          else {
            $('#error_text').html('Invalid wallet address');
            e.preventDefault();
          }
        }
        else  return true;
       
      });
    </script>

    @endsection



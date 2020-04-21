@extends('layouts.app')

@section('htmlheader_title')
    Account
@endsection

@section('contentheader_title')
    Account Details
@endsection

@section('main-content')
    @include('admin/partials/error')
    @include('admin/partials/success')
    <div id="error-div" style="display:none;">
        <div class="alert alert-danger alert-dismissible">
            <ul>
                <li>
                    <p id="error_text"></p>
                </li>
            </ul>
        </div>
    </div>
    <section class="content">
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="box box-primary">
                <form role="form" action="{{ url('account') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="box-body acc-bb-a">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter the First Name" value="{{ auth()->user()->name }}">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter the Email" value="{{ auth()->user()->email }}">
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" name="phone" class="form-control" placeholder="Enter the Phone Number" value="{{ auth()->user()->phone }}">
                        </div>

                        <div class="form-group">
                            <label>Profile Picture</label>
                            <input type="file" name="profile_picture" >
                        </div>
                        <div class="form-group">
                           <img src="{{ auth()->user()->profile_picture }}" alt="" width="100px" height="100px">
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-block btn-sm">Save</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="box box-primary">
                <form role="form" action="{{ url('account/password') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="box-body acc-bb-a">
                        <div class="form-group">
                            <label>Old Password</label>
                            <input type="password" name="password_old" class="form-control" placeholder="Enter The Old Password">
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter The New Password">
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Enter The Confirm Password">
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-block btn-sm">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="box box-primary">
                <form role="form" action="{{ URL::to('update_wallet_address') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="box-body acc-bb-b">
                        <div class="form-group">
                            <label>Wallet Address</label>
                            <input type="text" id="ether" name="ether" class="form-control" placeholder="Enter Wallet Address" @if(auth()->user()->ether) value="{{ auth()->user()->ether  }}"@endif>
                        </div>
                        @if(false)
                        <div class="form-group">
                            <label>Other Wallet Name</label>
                            <input type="text" id="wallet_o_name" name="wallet_name" class="form-control" placeholder="Please enter the name of the wallet " @if(auth()->user()->wallet_address) value="{{ auth()->user()->wallet_address  }}"@endif>
                        </div>
                        <div class="form-group">
                            <label>Other Wallet Address</label>
                            <input type="text" id="wallet_o_address"  name="wallet_address" class="form-control" placeholder="Please enter the wallet address here " @if(auth()->user()->wallet_name) value="{{ auth()->user()->wallet_name  }}"@endif>
                        </div>
                        @endif
                    </div>
                    <div class="box-footer">
                        <button id="save-button" type="submit" class="btn btn-primary btn-block btn-sm">Save</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="box box-primary acc-bb-b">
                <form role="form" action="{{ route('update_kyc_details') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="box-body">
                            <p>We are required to collect your KYC & AML documents for verification purposes. Thank you for the cooperation.</p>
                    <div class="form-group">
                        <label>Address Proof - {{auth()->user()->address_proof?'Uploaded':'Not Uploaded'}}</label>
                        @if(auth()->user()->address_proof)
                            <p>Click <a target="_blank" href="{{asset(auth()->user()->address_proof)}}">HERE</a> to view</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Id Proof -  {{auth()->user()->id_proof?'Uploaded':'Not Uploaded'}}</label>
                        @if(auth()->user()->id_proof)
                            <p>Click <a target="_blank" href="{{asset(auth()->user()->id_proof)}}">HERE</a> to view</p>
                        @endif
                        
                    </div>
                    <div class="form-group">
                        <label>Photo Proof - {{auth()->user()->photo_proof?'Uploaded':'Not Uploaded'}}</label>
                        @if(auth()->user()->photo_proof)
                            <p>Click <a target="_blank" href="{{asset(auth()->user()->photo_proof)}}">HERE</a> to view</p>
                        @endif
                    </div>
                </div>
                    <div class="box-footer">
                        <a id="save-button"  href="{{route('view_kyc_details')}}" class="btn btn-primary btn-block btn-sm">Upload KYC Details</a>
                    </div>
                </form>
            </div>
        </div>
    
    
        </div>

        <div class="row">
        
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="box box-primary">
                <form role="form" action="{{ url('bank_account_update') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label>Name of the Bank</label>
                            <input type="text" name="bankname" class="form-control" placeholder="Enter the Bank Name" value="{{ auth()->user()->bankname }}">
                        </div>
                        <div class="form-group">
                            <label>Bank Account Number</label>
                            <input type="number" name="account_number" class="form-control" placeholder="Enter Account Number" value="{{ auth()->user()->account_number }}">
                        </div>
                        <div class="form-group">
                            <label>Bank Code</label>
                            <select class="form-control" name="bank_code" style="width: 49%;display:inline;float: left;">
                                <option>Select Bank Code</option>
                                @foreach($BankCodeMaster as $key=>$BankCode)
                                <option value="{{$BankCode->id}}" @if(auth()->user()->bank_code==$BankCode->id) selected @endif>{{$BankCode->bank_code}}</option>
                                @endforeach
                                {{-- <option value="1" @if(auth()->user()->bank_code==1) selected @endif>MICR Code</option>
                                <option value="2" @if(auth()->user()->bank_code==2) selected @endif>IFSC Code</option> --}}
                            </select>
                            <input type="text" name="bankcodevalue" class="form-control col-md-6" placeholder="Enter the Bank Code" value="{{ auth()->user()->bankcodevalue }}" style="width: 49%;display:inline;float: right;">
                        </div>                        
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-block btn-sm">Save</button>
                    </div>
                </form>
            </div>
        </div>

        </div>
</section>
@endsection

@section('scripts')
    <script>
    $('#save-button').on('click',function (e) {
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


@extends('layouts.app')

@section('htmlheader_title')
    Account
@endsection

@section('contentheader_title')
   Stripe Card Details
@endsection

@section('main-content')
    @include('admin/partials/error')
    @include('admin/partials/success')
    <style type="text/css">
        #payment_stripe{
            background-color: Transparent;
    background-repeat:no-repeat;
    border: none;
    cursor:pointer;
    overflow: hidden;
    outline:none;
        }
    </style>
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

        <form action="{{URL('/')}}/stripe_done" method="post" name="stripe_payment">
        <noscript>You must <a href="http://www.enable-javascript.com" target="_blank">enable JavaScript</a> in your web browser in order to pay via Stripe.</noscript>
 
                    {{ csrf_field() }}
        <input 
            id="payment_stripe"
            type="submit" 
            value="Pay with Card"
            data-key="pk_test_ljUlljjxQC5fWtk4RB32FfYK"
            data-amount="500"
            data-currency="USD"
            data-name="Example Company Inc"
            data-description="Stripe payment for $5"
        />

        <script src="https://checkout.stripe.com/v2/checkout.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script>
        $(document).ready(function() {
            $(':submit').on('click', function(event) {
                event.preventDefault();
                var $button = $(this),
                    $form = $button.parents('form');
                var opts = $.extend({}, $button.data(), {
                    token: function(result) {
                        $form.append($('<input>').attr({ type: 'hidden', name: 'stripeToken', value: result.id })).submit();
                    }
                });
                StripeCheckout.open(opts);
            });
        });
        </script>
</form>

        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="box box-primary">
                <form role="form" action="{{ url('account') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="box-body acc-bb-a">
                        <div class="form-group">
                            <label>Card Number</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter the First Name" value="">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter the Email" value="">
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" name="phone" class="form-control" placeholder="Enter the Phone Number" value="">
                        </div>

                        <div class="form-group">
                            <label>Profile Picture</label>
                            <input type="file" name="profile_picture" >
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

<!-- @section('scripts')
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

@endsection -->


@extends('admin.layouts.app')
@section('site_tile',auth()->user()->site_title)
@section('content')
<style>
    .modal-dialog {
        transform: none !important;
        top: 0;
    }
    .img{
        height:236px;
        width:470px;
    }
    .modal p{
        font-size: 14px;
        color:#000;
    }
</style>
<section class="content">
    
<div class="page-wrapper">
    <!-- Bread crumb -->
    <div class="row page-titles">
        <div class="col-md-9 align-self-center">
            <h3 class="text-primary">Transaction Details</h3>
        </div>

         <div class="col-md-3 align-self-center">
            <h5 class="text-primary">Payment Type:&nbsp;@if($Txn->pay_type!=1)<span class="label" style="background-color:#344635 ">
                {{ $Txn->pay_type==1?'Semi-Automatic': 'Automatic'}}</span>@endif @if($Txn->pay_type==1)<span class="label" style="background-color: #F39C04;">{{ $Txn->pay_type==1?'Semi-Automatic': 'Automatic'}}</span>@endif </h5>
        </div>
        
    </div>
    @include('admin/partials/error')
@include('admin/partials/success')
    <!-- End Bread crumb -->
    <!-- Container fluid  -->
    <div class="container-fluid">
        <!-- Start Page Content -->
        <div class="row page-inner">
            <!-- /# column -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-title">
                        <h4>Transaction Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <p>Balance : <b style="color:#99abb4" id="balance">{{$tokenAmount}}</b></p>
                            <h6>Amount Paid</h6>
                            <p>{{ $Txn->amount }}</p>
                            <h6>Payment Mode</h6>
                            @if($Txn->currency!='Others')
                             <p>{{$Txn->currency}}</p>
                            @else
                                {{$Txn->others}}
                            @endif
                            <h6>Coins intended to buy</h6>
                            <p>{{ $Txn->coins }}</p>
                            <h6>Transaction ID</h6>
                            <p>{{ $Txn->txn_id }}</p>
                            <h6>Description</h6>
                            <p>{!! $Txn->description !!}</p>
                            @if($Txn->pay_type==1)
                              <br>
                            <h6>Screenshot</h6>
                                <a href="{{$Txn->screenshot}}" target="_blank"><u>view screenshot</u><br><br>
                                    {{-- <img src="{{$Txn->screenshot}}" class="img-responsive radius" width="300" height="300"> --}}
                                </a>
                                  
                                @endif

                               
                            <h6>Payment Type</h6>
                            {{ $Txn->pay_type==1?'Semi-Automatic': 'Automatic'}}
                        </div>
                    </div>
                </div>
                <div class="card">
                        <div class="card-title">
                            <h4 class="u-d-card">User Details
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <h6>Name</h6>
                                <p>{{ $Txn->user->name }}</p>
                                <h6>Email</h6>
                                <p>{{ $Txn->user->email }}</p>
                                <h6>Phone</h6>
                                <p>{{ $Txn->user->phone }}</p>
                               <!--  <h6>Instruction</h6>
                                <p> 
                                    <a href="#" id="leave" data-target="#basicModal"  data-toggle="modal">
                                        <u>View list</u>
                                    </a>
                                </p> -->
                            </div>
                        </div>
                    </div>
            </div>

            <div class="col-lg-6">
            <div  class="card">
                <div class="card-body">
                  <div class="basic-form" @if($Txn->new_transaction_id) style="display: none;" @endif>
                            <div class="form-group">
                        <label>Number Of Coins</label>
                        <input type="text" name="no_of_coins" value="{{ $Txn->coins }}" id="no_of_coins" style="width:100%;" disabled>
                            </div>
                       
                    </div>

                    @if(!$Txn->new_transaction_id)
                    <div class="basic-form">
                        <form role="form" action="{{ url('admin/txn/complete', $Txn->id) }}" method="POST">
                            {{ csrf_field() }}
                           <!--  <div class="form-group">
                                <label>Trasaction Id</label>
                                <input type="text" name="new_transaction_id" class="form-control" placeholder="Trasaction Id" >
                            </div> -->
                            <button type="submit" class="btn btn-success btn-block">Make Transaction Complete</button>
                        </form>    
                    </div>
                    @endif
                    <div class="basic-form">
                        <h6>Transaction status</h6>
                            @if($Txn->new_transaction_id) <a style= "margin-bottom: 0" style="margin-bottom: 0" href="https://ropsten.etherscan.io/tx/{{ $Txn->new_transaction_id }}" target="_blank">{{ $Txn->new_transaction_id }}</a> @else
                        <p style="margin-bottom: 0"> Payment Not Done</p>  @endif
                    </div>
                </div>
            </div>
            <div class="card">
                    <div class="card-title">
                        <h4>Wallet Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <h6>Ethereum Wallet ID</h6>
                            <p>{{ $user->ether }}</p>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-lg-6"> --}}
                 {{-- <div class="card">
                    <div class="card-title">
                        <a  id="leave" href="#"  data-toggle="modal" data-target="#basicModal">
                          <u>Instruction</u>
                        </a>
                        <br><br>
                    </div>
                </div> --}}
            


                
<!-- <div id="hide_modal"> -->

<!-- <div> -->
    {{-- </div> --}}
    </div>
    <!--modal-->
    <div class="modal fade" id="basicModal" role="dialog" aria-labelledby="basicModal" aria-hidden="true" >
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width:600px;">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">How to send coin using metamask </h4>
            </div>
                <div class="modal-body">
                        <div class="carousel-content">
                            <div class="item active-item">
                                <p>
                                    <b>Step 1</b>.<br> Go to <a href="https://metamask.io/" target="_blank"><font color="blue"> MetaMask.io</font></a> and access the MetaMask Chrome extension as shown below.
                                </p> 
                                <iframe style="width:100%; height:400px;" src="https://www.youtube.com/embed/6Gf_kRE4MJU?ecver=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                <p>
                                    <img class="logo-main scale-with-grid" src="/adassets/metamask/step1.png" alt="step1" style="width:100%;"/>
                                </p>
                                <p>
                                    Note: There are many phishing scams around MetaMask, so be careful and bookmark the MetaMask wallet official link and never forget to check for secure https connection.
                                </p>
                            </div>
                            <div class="item closed-item">
                                <p> <b>Step 2</b>.<br> Now install the chrome extension and click on "Add extension".</p>
                                <p><img class="logo-main scale-with-grid" src="/adassets/metamask/step2.png" alt="step2" style="width:100%;"/></p>
                            </div>
                            <div class="item closed-item">
                                <p> <b>Step 3</b>.<br> Now, you can see the added chrome extension that shows the "privacy notice" where you need to "Accept".</p>

                                <p><img class="logo-main scale-with-grid" src="/adassets/metamask/step3.png" alt="step3" style="width:100%;"/><br>
                                <br></p>
                
                            </div>
                            <div class="item closed-item">
                                    <p> <b>Step 4</b>.<br> After accepting the "privacy notice", it will prompt you to accept "Terms Of Use".</p>

                                    <p><img class="logo-main scale-with-grid" src="/adassets/metamask/step4.png" alt="step4" style="width:50%; margin-left: 25%;"/></p>
                
                            </div>
                            <div class="item closed-item">
                                    <p> <b>Step 5</b>.<br> Now set up the password and create your wallet by clicking "Create". Remember, this password is for encryption so create a strong one.</p>

                                    <p><img class="logo-main scale-with-grid" src="/adassets/metamask/step5.png" alt="step5" style="width:50%; margin-left: 25%;"/></p>
                
                            </div>
                            <div class="item closed-item">
                                    <p> <b>Step 6</b>.<br> The seed words will be shown that you need to copy somewhere offline and store in a secure manner. Note: I have shown you these 12 words here but they are not to be shown to anyone.</p>

                                    <p><img class="logo-main scale-with-grid" src="/adassets/metamask/step6.png" alt="step6"    style="width:50%; margin-left: 25%;"/></p>
                
                            </div>
                            <div class="item closed-item">
                                    <p> <b>Step 7</b>.<br> Once you have copied, click on "I’ve Copied It Somewhere Safe" and you will see this home screen of the wallet. This marks the completion of installation of MetaMask wallet.</p>

                                    <p><img class="logo-main scale-with-grid" src="/adassets/metamask/step7.png" alt="step7"  style="width:50%; margin-left: 25%;"/></p>
                            </div>
                            <button class="next btn btn-primary pull-right">Next</button>
                            <button class="previous btn btn-primary pull-right">Previous</button>
                        </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="close_modal" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                
            </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <!-- /# column -->
        </div>
        <!-- End PAge Content -->
    </div>







    <!-- End Container fluid  -->
    <!-- footer -->    
    @include('layouts.partials.footer')
    <!-- End footer -->
</div>


</section>

@endsection


@section('extra-scripts')
<script>
    $(document).ready(function () {

        $('#pay_now').click(function () {
            App.sendCoinGeneric($('#no_of_coins').val(),"{{ $Txn->ether }}");
        });

    });
    App.start("{{  Auth::user()->ether }}");
</script>

<script type="text/javascript">

$('#close_modal').click(function() {
    $('#basicModal').hide();
    $(".modal-backdrop.show").css("opacity","0");
    $(".modal-backdrop").remove();
});
</script>
<script>
        $('.next,.previous').click(function() {
            var content = $(this).parent('.carousel-content');
            var totalItem = content.find('.item').length;
            var activeItem = content.find('.item.active-item');
            if($(this).hasClass('next') && activeItem.next('.item').length) {
                activeItem.removeClass('active-item').addClass('closed-item');
                activeItem.next().addClass('active-item').removeClass('closed-item');
            }
            if($(this).hasClass('previous') && activeItem.prev('.item').length) {
                activeItem.removeClass('active-item').addClass('closed-item');
                activeItem.prev().addClass('active-item').removeClass('closed-item');
            }
        });
    </script>
@endsection



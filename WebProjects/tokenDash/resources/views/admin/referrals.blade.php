@extends('admin.layouts.app') 
@section('site_tile',auth()->user()->site_title)
@section('content')
<div class="page-wrapper">
    <!-- Bread crumb -->
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h3 class="text-primary">Notifications</h3> </div>
    </div>
    <!-- End Bread crumb -->
    <!-- Container fluid  -->
    <div class="container-fluid">
        <!-- Start Page Content -->
        <div class="row page-inner">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-title">
                        <h4>Referral Settings</h4>
                    </div>
                    @include('admin/partials/error')
                    @include('admin/partials/success')
                    <div class="card-body">
                        <div class="basic-form">
                            <form role="form"   action="{{route('admin.updateReferral')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <h4 style="font-weight: bold">Offer Type</h4>
                                    <p>Choose whether the referral will be calculated as a percentage or a flat amount. If you choose percentage, the (%) number you specify in the offer amount will be calculated as a percentage. 
For example, When a person who uses a referral link, purchases some tokens, you would get 10% of it. If you want to cap the max number of tokens you can enter how much a user can get.</p>
                                    <select class="form-control" name="referral_offer_type">
                                        <option @if($refSettings->referral_offer_type ==="PERCENT") selected @endif value="PERCENT">Percentage</option>
                                        <option @if($refSettings->referral_offer_type ==="FLAT") selected @endif  value="FLAT">Flat</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Offer Amount</label>
                                    <input class="form-control" type="number" value="{{old('referral_offer_amount', $refSettings->referral_offer_amount)}}" name="referral_offer_amount" />
                                </div>
                                <div class="form-group">
                                    <label>Offer Upto amount</label>
                                    <input class="form-control" type="number" value="{{old('referral_offer_upto', $refSettings->referral_offer_upto)}}" name="referral_offer_upto" />
                                </div>
                                <button type="submit" class="btn btn-success">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-title">
                        <h4>Referrals</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                             @include('admin.partials.table-heading')
                            <input type="hidden" id="export_columns" value="0,1,2,3,4,5,6"/>
                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Referrer</th>
                                        <th>User</th>
                                        <th>Bought Amount</th>
                                        <th>Referer Earning Amount</th>
                                        <th>Ethr. Txn. ID.</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Referrer</th>
                                        <th>User</th>
                                        <th>Bought Amount</th>
                                        <th>Referer Earning Amount</th>
                                        <th>Ethr. Txn. ID.</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                @foreach($referrals as $key => $referral)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $referral->referrer_name }}</td>
                                        <td>{{ $referral->user_name }}
                                        <td>{{ $referral->user_bought_amount }}</td>
                                        <td>{{ $referral->referer_earning_amount }}</td>
                                        <td>
                                            @if($referral->status !== 'COMPLETED')
                                            <form method="POST" action="{{route('admin.updateReferralTxn')}}">
                                                @csrf
                                            <input name="txn_id_ether" type="text" class="" style="width: 200px;    border-radius: 4px;border: 1px solid #ddd;"/>
                                            <input type="hidden" name="referral_id" value="{{$referral->referral_id}}"/>
                                            <button type="submit" class="btn btn-success">Update</button>
                                            </form>
                                            @else
                                                {{$referral->txn_id_ether}}
                                            @endif
                                        </td>
                                        <td>{{ $referral->status }}</td>
                                        <td>
                                            @if($referral->status !== 'COMPLETED')
                                            <a class="btn btn-primary" href="javascript:void(0)" class="pay_now" data-coin="{{ $referral->referer_earning_amount }}" data-address="{{ $referral->referrer_address }}">
                                                Pay Now</a>
                                                @else Paid @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>


            </div>
            <!-- /# column -->

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
    $(document).ready(function () {

        $('.pay_now').click(function () {
            {{--  App.sendCoinGeneric($('#no_of_coins').val(),"{{ $Txn->ether }}");  --}}
            console.log(String($(this).data('coin')), $(this).data('address'));
             App.sendCoinGeneric(parseInt($(this).data('coin')), $(this).data('address'));
        });

    });
    App.start("{{  Auth::user()->ether }}");
</script>
@endsection

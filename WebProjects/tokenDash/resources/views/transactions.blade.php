@extends('layouts.app')

@section('htmlheader_title')
Transaction Details
@endsection
@section('contentheader_title')
    Transaction Details
<style type="text/css">
    img {  
  position: relative;
}

/* style this to fit your needs */
/* and remove [alt] to apply to all images*/
img[alt]:after {  
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: #fff;
  font-family: 'Helvetica';
  font-weight: 300;
  line-height: 2;  
  text-align: center;
  content: attr(alt);
}
</style>

<span class="pull-right text-danger">Tokens Received: {{$amount}}</span>
<span class="pull-right text-blue">Referral Received: {{$referer_earning_amount}}</span>
@endsection


@section('main-content')

@include('layouts.partials.notification')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Here you can see the transaction details you have submited</h3>
    </div>
    <div class="box-body big">
    <table class="table table-bordered">
            <thead>
                <tr>
                    <td>S.No.</td>
                    <td>Transaction Id</td>
                    <td>Amount Sent</td>
                    <td>Equivalent Token</td>
                    <td>Payment Type</td>
                    <td>Screen Shot</td>
                    <td>Status</td>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $key => $transaction)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $transaction->txn_id }}</td>
                        <td>{{ $transaction->amount }}</td>
                        <td>{{ $transaction->coins }}</td>
                        <td>{{ $transaction->pay_mode }}</td>
                        <td class="text-center">
                            <!-- {{asset('storage/'.$transaction->screenshot)}} -->
                            <img  width="50" height="50" src="{{$transaction->screenshot}}" class="screenshot-img img-responsive radius" alt="">
                            <!-- <img src="https://adamsbooks.co.za/wp-content/uploads/2018/01/Sorry-Image-Not-Available-78.png" alt="" style="width: 100px"> -->
                        </td>
                        <td>{{ $transaction->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
     $(document).ready(function(){
        $('.image[src=""]').hide();
        $('.image:not([src=""])').show();
    });
    </Script>
@endsection
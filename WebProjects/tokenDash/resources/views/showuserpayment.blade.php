@extends('layouts.app') 
@section('htmlheader_title') 
Payment Details 
@endsection 
@section('contentheader_title') 
Dividend Details 
@endsection 
@section('main-content')
<div class="col-md-12 sub-title-head">
    <p>Here you can see detailed payment history</p>
</div>
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
    @include('admin/partials/error') @include('admin/partials/success')
    <div class="row">
    
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="box box-primary">
            	<div class="box-body">

            	<table class="user-show" width="100%" style="border:solid 1px #ccc;" cellpadding="5"  cellspacing="5">
            		<tr>
            			<th style="border:solid 1px #ccc;padding: 5px;">01.</th>
            			<td style="border:solid 1px #ccc;padding: 5px;">Electronic Credit Reference No. / Advice No.</td>
            			<td style="border:solid 1px #ccc;padding: 5px;">{{$payment->id}}</td>
            		</tr>
            		<tr>
            			<th style="border:solid 1px #ccc;padding: 5px;">02.</th>
            			<td style="border:solid 1px #ccc;padding: 5px;">Folio No. / DPID & Client ID No.</td>
            			<td style="border:solid 1px #ccc;padding: 5px;">{{$user->id}}</td>
            		</tr>
            		<tr>
            			<th style="border:solid 1px #ccc;padding: 5px;">03.</th>
            			<td style="border:solid 1px #ccc;padding: 5px;">Name of Shareholder</td>
            			<td style="border:solid 1px #ccc;padding: 5px;">{{$user->name}}</td>
            		</tr>
            		<tr>
            			<th style="border:solid 1px #ccc;padding: 5px;">04.</th>
            			<td style="border:solid 1px #ccc;padding: 5px;">No of Equity shares held as on 22nd September, 2018 (Record Date)</td>
            			<td style="border:solid 1px #ccc;padding: 5px;">Nil</td>
            		</tr>
            		<tr>
            			<th style="border:solid 1px #ccc;padding: 5px;">05.</th>
            			<td style="border:solid 1px #ccc;padding: 5px;">Dividend Per Share (Rs)</td>
            			<td style="border:solid 1px #ccc;padding: 5px;">$ {{$settings->dividend_amt}}</td>
            		</tr>
            		<tr>
            			<th style="border:solid 1px #ccc;padding: 5px;">06.</th>
            			<td style="border:solid 1px #ccc;padding: 5px;">Dividend Amount(Rs)</td>
            			<td style="border:solid 1px #ccc;padding: 5px;">$ {{$payment->term_amt}}</td>
            		</tr>
            		<tr>
            			<th style="border:solid 1px #ccc;padding: 5px;">07.</th>
            			<td style="border:solid 1px #ccc;padding: 5px;">Name of the Bank</td>
            			<td style="border:solid 1px #ccc;padding: 5px;">{{$payment->bank_name}}</td>
            		</tr>
            		<tr>
            			<th style="border:solid 1px #ccc;padding: 5px;">08.</th>
            			<td style="border:solid 1px #ccc;padding: 5px;">Bank Account No.</td>
            			<td style="border:solid 1px #ccc;padding: 5px;">{{$payment->account_number}}</td>
            		</tr>
            		<tr>
            			<th style="border:solid 1px #ccc;padding: 5px;">09.</th>
            			<td style="border:solid 1px #ccc;padding: 5px;">{{$payment->bankcodename}} Code</td>
            			<td style="border:solid 1px #ccc;padding: 5px;">{{$payment->account_ifsc}}</td>
            		</tr>
            		<tr>
            			<th style="border:solid 1px #ccc;padding: 5px;">10.</th>
            			<td style="border:solid 1px #ccc;padding: 5px;">Date of credit</td>
            			<td style="border:solid 1px #ccc;padding: 5px;">{{$payment->payment_date}}</td>
            		</tr>
            		<tr>
            			<th style="border:solid 1px #ccc;padding: 5px;">11.</th>
            			<td style="border:solid 1px #ccc;padding: 5px;">Mode of remittance</td>
            			<td style="border:solid 1px #ccc;padding: 5px;">Bank transfer</td>
            		</tr>
            		<tr>
	                    <td colspan="3" style="border:solid 1px #ccc;padding: 5px;">
	                        <a href="{{ url('dividend_payment') }}" class="btn btn-sm btn-info pull-right">Go Back</a>
	                    </td>
	                </tr>            		
            	</table>

            	</div>
            </div>
        </div>
    </div>
</section>
@endsection
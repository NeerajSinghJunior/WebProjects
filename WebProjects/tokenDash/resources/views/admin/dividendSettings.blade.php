@extends('admin.layouts.app')
@section('site_tile',auth()->user()->site_title)
@section('content')
<script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
<script src="https://cdn.ckeditor.com/[version.number]/[distribution]/ckeditor.js"></script>
<div class="page-wrapper">
   <div class="row page-titles">
      <div class="col-md-12 align-self-center">
         <h3 class="text-primary">Dividend Setting</h3>
      </div>
   </div>
   @include('admin/partials/error')
   @include('admin/partials/success')
   @include('admin/partials/session-error')
   <div id="error-div"></div>
   <div class="container-fluid">

      <div class="row page-inner">
         <div class="col-lg-12">
            {{-- Dashboard Configuration --}}
            <div class="card">
               <div class="card-title">
                  <h4>Dividend configurations</h4>
               </div>
               <div class="card-body">
                  <div class="basic-form">
                     <form role="form" action="{{ url('admin/update_dividend_settings') }}" method="POST">
                        {{ csrf_field() }}

                        <div class="checkbox pb-list">
                           <label><b>Enable Dividends Payouts</b></label>
                           <label>
                             <input type="radio" @if($settings->status==1) checked @endif name="viewdashboard" value="1" class="inherit">&nbsp;Enable
                             <input type="radio" name="viewdashboard" value="0" @if($settings->status==0) checked @endif class="inherit">&nbsp;Disable
                          </label>                        
                       </div>

                       <div class="form-group">
                        <br>
                        <label><b>Dividend Note to Investors</b></label>
                        <p>Make your Token lucrative to invest in by offering dividends to your investors. Let your investor's know what your vision for the token and payment structure in a way that appeals to them.</p>                     
                        <textarea name="note" class="form-control" placeholder="Message">@if(isset($settings->note)) {{$settings->note}} @endif</textarea>
                        <script>
                          CKEDITOR.replace( 'note' );
                       </script>
                    </div>
                    <button type="submit" id="save-button" class="btn btn-success">Update</button>
                 </form>
              </div>
           </div>
        </div>
        {{-- End of Dashboard Configuration --}}

        {{-- Dividend Structure Settings --}}
            <div class="card">
               <div class="card-title">
                  <h4>Dividend Structure Settings</h4>
               </div>
               <div class="card-body">
                  <div class="basic-form">
                     <form role="form" action="{{ url('admin/update_dividend_structure_settings') }}" method="POST">
                        {{ csrf_field() }}

                        <div class="checkbox pb-list">
                           <label><b>Dividend Type</b></label>
                           <p>You can configure the type of dividend that will be paid to the investors. Currently this Dashboard will have option to choose between Cash and token dividend.</p>
                           <select class="form-control" name="dividend_type">
                              <option>Select your dividend type</option>
                              <option value="Cash" @if($settings->dividend_type=='Cash') selected @endif>Cash</option>
                              <option value="Tokens" @if($settings->dividend_type=='Tokens') selected @endif>Tokens</option>
                           </select>
                       </div>

                       <br>
                       <div class="form-group">
                        <label><b>Payment Schedule</b></label> 
                        <p>Your investors will get paid on a pre-fixed date for owning your Security Tokens. You can set payment schedule ( Ex: Quarterly ie. 4 times per year )</p>
                        <select class="form-control" name="payment_schedule">
                           <option>Select Payment Schedule</option>
                           <option value="Quarterly" @if($settings->payment_schedule=='Quarterly') selected @endif>Quarterly ( 4 times a year )</option>
                           <option value="Half yearly" @if($settings->payment_schedule=='Half yearly') selected @endif>Half yearly ( 2 times a year )</option>
                        </select>                                               
                       </div>

                       <br>
                       <div class="form-group">
                        <label><b>Dividend amount per Security token to pay</b></label> 
                        <p>You can set the Dividend amount ( Ex: an annual dividend of 10 cents per Security Token. Which means you will need to pay one-fourth of 10 cents each quarter ie. 2.5 cents per share holder for each token he holds ). Based on your configuration, the list of payees will show up each quarter. You can send out the dividend to respective investors on a click.</p>
                        <input type="text" class="form-control" name="dividend_amt" value="{{$settings->dividend_amt}}"/>
                       </div>

                       <br>
                       <div class="form-group">
                        <label><b>Eligibility Criteria</b></label> 
                        <p>You can set the eligibility criteria on who can receive dividends for the Security tokens they hold. You will be able to set the period between which the dividends will be paid for the security tokens held by each investor. Using this feature the ‘cum-divident trading period’ -and- the ‘ex-divident date’ can be set. Those who have purchased the security tokens prior or during the cum-divident trading period, and held it on the ex-divident date will be eligible for dividend for the respective tokens.</p>
                        <label><b>Cum-Dividend Trading Period</b></label>
                       </div>

                       <div class="form-group">
                          <label><b>From Date</b></label>
                          <input type="text" name="from_date" id="from_date_fld" class="form-control" autocomplete="off" value="{{$settings->from_date}}">
                          <label><b>To Date</b></label>
                          <input type="text" name="to_date" id="to_date_fld" class="form-control" autocomplete="off" value="{{$settings->to_date}}">
                       </div>

                       <br>
                       <div class="form-group">
                        <label><b>Ex-Dividend Date</b></label>                         
                        <input type="text" name="ex_dividend_date" id="ex_dividend_date" class="form-control" autocomplete="off" value="{{$settings->ex_dividend_date}}">
                       </div>

                    <button type="submit" id="save-button" class="btn btn-success">Update</button>
                 </form>
              </div>
           </div>
        </div>
        {{-- End of Dividend Structure Settings --}}
     </div>
  </div>

</div>
<script type="text/javascript">
$('#from_date_fld').datetimepicker({
closeOnDateSelect:true,
format:'d-m-Y',
timepicker:false,
// minDate:new Date(), //yesterday is minimum date
});

$('#to_date_fld').datetimepicker({
closeOnDateSelect:true,
format:'d-m-Y',
timepicker:false,
// minDate:new Date(), //yesterday is minimum date
});

$('#ex_dividend_date').datetimepicker({
closeOnDateSelect:true,
format:'d-m-Y',
timepicker:false,
// minDate:new Date(), //yesterday is minimum date
});
</script>
@endsection
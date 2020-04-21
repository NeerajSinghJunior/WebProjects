@extends('admin.layouts.app')
@section('site_tile',auth()->user()->site_title)
@section('content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<div class="page-wrapper">
<!-- Bread crumb -->
<div class="row page-titles">
   <div class="col-md-12 align-self-center">
      <h3 class="text-primary">{{isset($data->amount)?'Edit Expense':'Add Expense'}} <span style="float:right; padding: 5px;color: #389032; font-size: 22px;font-weight: bold">
         Net amount : <b>$</b><span id="net_amount_text"> {{isset($data->amount)?$data->amount+$data->tax_amount:'0'}} </span>
         </span>
      </h3>
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
      <div class="col-lg-12">
         <div class="card-body">
            <div class="basic-form">
               <form role="form" action="{{ route('admin.store_expense') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                  {{ csrf_field() }}
                  <input type="hidden"  name="id" value="{{isset($data->id)?$data->id:''}}" id=""class="form-control">
                  <input type="hidden" id="net_amount" name="amount" value="{{isset($data->amount)?$data->amount+$data->tax_amount:'0'}}" id=""class="form-control">
                  <div class="form-group col-md-4" style="float:left">
                     <label>Payee Name</label>
                     <input type="text"  name="payee_name" id="payee_name" value="{{isset($data->customer_name)?$data->customer_name:''}}" class="form-control" autocomplete="off">
                  </div>
                  <div class="form-group col-md-4" style="float:left">
                     <label>Amount Paid ($)</label>
                     <input type="number" min='0' name="amount" id="amount" value="{{isset($data->amount)?$data->amount:'0'}}" id=""class="form-control" autocomplete="off">
                  </div>
                  <div class="form-group col-md-4" style="float:left">
                     <label>Payment date</label>
                     <input type="text"  name="date" id="datetimepicker3"  class="form-control" value="{{isset($data->date)?$data->date:''}}" autocomplete="off">
                  </div>
                  <div class="form-group col-md-4" style="float:left">
                     <label>Payment Type</label>
                     <select  name="pay_type" value="" id="pay_type" class="form-control">
                        <option selected="" >Select Payment type</option>
                        @foreach($payment_types as $pay)
                          <option  value="{{$pay->payment_type}}">{{$pay->payment_type}}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="form-group col-md-4" style="float:left">
                     <label>Tax Type</label>
                     <select  name="tax_type"  id="tax_type" class="form-control">
                        <option selected="" disabled>Select Tax type</option>
                        <option  value="1">Inclusive of Tax</option>
                        <option  value="2">Exclusive of Tax</option>
                     </select>
                  </div>
                  <div class="form-group col-md-4" style="float:left">
                     <label>Tax</label>
                     <select  name="tax"  id="tax" class="form-control">
                        <option selected=""  value=''>Select Tax</option>
                        @foreach($tax as $t)
                        <option  value="{{$t->value}}% ({{$t->type}})">{{$t->type}} ({{$t->value}}%)</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="form-group col-md-4" style="float:left">
                     <label>Tax Amount</label>
                     <input type="text" min='0' name="tax_amount" value="{{isset($data->tax_amount)?$data->tax_amount:''}}"  id="tax_amount" class="form-control" autocomplete="off">
                  </div>
                  <div class="form-group col-md-4" style="float:left">
                     <label>Ref No.</label>
                     <input type="text"  name="ref_no" value="{{isset($data->ref_no)?$data->ref_no:''}}" id=""class="form-control" autocomplete="off">
                  </div>
                  <div class="form-group col-md-4" style="float:left">
                     <label>Expense Type</label>
                     <input type="text"  name="category" value="{{isset($data->category)?$data->category:''}}" id="category"class="form-control" autocomplete="off">
                  </div>

                   <div class="form-group col-md-4" style="float:left">
                     <label>Country</label>
                     <input type="text"  name="country" id="country"  class="form-control" value="{{isset($data->country)?$data->country:''}}" autocomplete="off">
                  </div>


                  <div class="form-group">
                     <label>Purpose / Description</label>
                     <textarea rows="5" name="purpose" id=""class="form-control">{{isset($data->purpose)?$data->purpose:''}}</textarea>
                  </div>
                  <div class="form-group">
                     <label> <i class="fa fa-paperclip" aria-hidden="true"></i> Attachments</label>
                     <label style="border: 1px solid lightgrey;padding: 25px" >
                        <center><b id="file_upload"><i class="fa fa-paperclip" aria-hidden="true"></i>  Uploads file here.</b></center>
                        <input type="file"  style="display: none" name="voucher" id=""  class="form-control">
                     </label>
                  </div>
                  @if(isset($data->voucher))
                  @if($data->voucher!="")

                  <div class="form-group">
                    <b>
                     <a  href="{{$data->voucher}}" target="_blank" style="color:blue"><i class="fa fa-eye"></i> View File</a>
                   </b>
                  </div>
                  @endif
                  @endif
                  <button type="submit" class="btn btn-success">Save Expense</button>
               </form>
            </div>
         </div>
      </div>
   </div>
   <!-- End Container fluid  -->
   <!-- footer -->
   {{-- @include('layouts.partials.footer') --}}
   <!-- End footer -->
</div>
<script type="text/javascript">
   $( function() {
   
   
   $('#tax_type').val("{{isset($data->tax_type)?$data->tax_type:''}}");
   $('#pay_type').val("{{isset($data->pay_type)?$data->pay_type:''}}");
   $('#tax').val("{{isset($data->tax)?$data->tax:''}}");
   
   var payee_name = [
   
   @foreach($customer_name as $d)
   "{{$d->customer_name}}",
   @endforeach
   ];
   $( "#payee_name" ).autocomplete({
     source: payee_name
   });
   
   var category = [
   
   @foreach($category as $d)
   "{{$d->category}}",
   @endforeach
   ];
   $( "#category" ).autocomplete({
     source: category
   });
   
   } );
   
   $('#datetimepicker3').datetimepicker({
        closeOnDateSelect:true,
        format:'Y-m-d',
        timepicker:false,
   });
   
   
   $('#amount,#tax_type,#tax').change(function(){
       var temp=$('#tax').val();
       // alert(temp);
     if(temp!=""){
              spl = temp.split("%");
         var  tax =spl[0];
         var tax_type=$('#tax_type').val();
         var amount=$('#amount').val();
         var total_amount=amount;
         var tax_amount=0;
         if(tax_type==2){
             tax_amount=(parseFloat(amount)*parseFloat(tax))/100;
             total_amount=parseFloat(tax_amount)+parseFloat(amount);
         }

     
         $('#net_amount_text').html(parseFloat(total_amount).toFixed(2));
         $('#net_amount').val(parseFloat(total_amount).toFixed(2));
         $('#tax_amount').val(tax_amount);
      }
   });
   
     $('input[type="file"]').change(function(e){
   
      
             var fileName = e.target.files[0].name;
           $('#file_upload').html('<center><b><i class="fa fa-paperclip" aria-hidden="true"></i> Selected File : '+ fileName +'</b></center>');
           
       });
   
   
</script>
@endsection
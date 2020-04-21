@extends('admin.layouts.app')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
@section('site_tile',auth()->user()->site_title)
@section('content')
<div class="page-wrapper">
   <div class="row page-titles">
      <div class="col-md-12 align-self-center">
         <h3 class="text-primary">Dividend Payouts</h3>
      </div>
   </div>
   @include('admin/partials/error')
   @include('admin/partials/success')
   @include('admin/partials/session-error')
   <div id="error-div"></div>
   <div class="container-fluid">

      <div class="row page-inner">


        {{-- Chart Block --}}
        <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="form-group" style="text-align: center;padding: 10px;">
        <label style="display: inline;width: auto !important;">Select Year&nbsp;&nbsp;&nbsp;</label>
        <select name="payment_year" style="display: inline;width:10%;" onchange="javascript:get_chart(this.value);">
        <?php
        for ($i=2015; $i <= date('Y'); $i++) { 
          echo '<option value="'.$i.'"';
          if($i==date('Y')) { echo 'selected'; }
          echo '>'.$i.'</option>';
        }
        ?>
        </select>
        </div>
        <div id="total_payouts" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        </div>
        {{-- End of Chart Block --}}

         <div class="col-lg-12">
            <div class="card">
              <div class="card-title">
                  <h4>Dividend Payout List</h4>
                  <p>All the dividends that are to be paid are listed here. Click on each shareholder's detail to view their payout details. Once you have manually transferred the amount to the shareholder's bank account, you can enter the transaction details and mark as 'Paid'. </p>
              </div>
              <div class="card-body">
                  <div class="table-responsive">
                       @include('admin.partials.table-heading')
                      <input type="hidden" id="export_columns" value="0,1,2,3,4,5,6"/>
                      <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                          <thead>
                              <tr>
                                  <th>#</th>
                                  <th>Sharholder Name</th>
                                  <th>Dividend/Share</th>
                                  <th>Dividend Amount<br>/ Anum.</th>
                                  <th>Amount<br>this term.</th>
                                  <th>Type</th>
                                  <th width="10%">Date</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tfoot>
                              <tr>
                                  <th>#</th>
                                  <th>Sharholder Name</th>
                                  <th>Dividend/Share</th>
                                  <th>Dividend Amount<br>/ Anum.</th>
                                  <th>Amount<br>this term.</th>
                                  <th>Type</th>
                                  <th width="10%">Date</th>
                                  <th>Action</th>
                              </tr>
                          </tfoot>
                          <tbody>
                          @if(date('Y-m-d')>=$settings->ex_dividend_date)
                          <?php $sno=1; ?>
                          @foreach($transactions as $key => $trans)                              
                              @if($trans->next_payment_date=='' || $trans->next_payment_date<=date('Y-m-d'))
                              <tr>
                                  <td>{{ $sno }}</td>
                                  <td>{{ $trans->name }}</td>
                                  <td>{{ $settings->dividend_amt }}</td>
                                  {{-- Per Anum --}}
                                  <?php
                                  $usdperanum=$trans->dividendcoins*$settings->dividend_amt;
                                  if($settings->payment_schedule=='Quarterly') 
                                  {
                                  $usdperterm=$usdperanum/4;
                                  }
                                  else if($settings->payment_schedule=='Half yearly') 
                                  {
                                  $usdperterm=$usdperanum/2;
                                  }
                                  ?>
                                  {{-- End of Per Anum --}}
                                  <td>$ {{ $usdperanum }}</td>
                                  <td>$ {{ $usdperterm }}</td>
                                  <td>{{ $settings->dividend_type }}</td>
                                  <td width="10%">{{ date('Y-m-d',strtotime($settings->ex_dividend_date)) }}</td>
                                  <td><a href="{{ route('admin.dividend_user_details',$trans->user_id) }}"class="label label-primary">View</a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="label label-warning" data-toggle="modal" href="#" data-target="#show_modal_{{$trans->user_id}}">Mark as Paid</a></td>
                              </tr>
                              <?php $sno++; ?>
                              @endif
                          @endforeach
                          @endif
                          </tbody>
                      </table>
                  </div>

              </div>
          </div>
     </div>
  </div>


  <div class="row page-inner">
         <div class="col-lg-12">
            <div class="card">
              <div class="card-title">
                  <h4>Dividend Paid List</h4>
              </div>
              <div class="card-body">
                  <div class="table-responsive">
                       @include('admin.partials.table-heading')
                      <input type="hidden" id="export_columns1" value="0,1,2,3,4,5,6"/>
                      <table id="example32" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                          <thead>
                              <tr>
                                  <th>#</th>
                                  <th>Sharholder Name</th>
                                  <th>Dividend/Share</th>
                                  <th>Dividend Amount<br>/ Anum.</th>
                                  <th>Amount<br>this term.</th>
                                  <th>Type</th>
                                  <th width="10%">Paid Date</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tfoot>
                              <tr>
                                  <th>#</th>
                                  <th>Sharholder Name</th>
                                  <th>Dividend/Share</th>
                                  <th>Dividend Amount<br>/ Anum.</th>
                                  <th>Amount<br>this term.</th>
                                  <th>Type</th>
                                  <th width="10%">Paid Date</th>
                                  <th>Action</th>
                              </tr>
                          </tfoot>
                          <tbody>
                          <?php $sno1=1; ?>
                          @foreach($DividendPayment as $key => $paid)
                              @if($paid->user_id!='' && $paid->payment_id!='')
                              <tr>
                                  <td>{{ $sno1 }}</td>
                                  <td>{{ $paid->name }}</td>
                                  <td>{{ $settings->dividend_amt }}</td>
                                  {{-- Per Anum --}}
                                  <?php
                                  $usdperanum=$paid->dividendcoins*$settings->dividend_amt;
                                  if($settings->payment_schedule=='Quarterly') 
                                  {
                                  $usdperterm=$usdperanum/4;
                                  }
                                  else if($settings->payment_schedule=='Half yearly') 
                                  {
                                  $usdperterm=$usdperanum/2;
                                  }
                                  ?>
                                  {{-- End of Per Anum --}}
                                  <td>$ {{ $usdperanum }}</td>
                                  <td>$ {{ $usdperterm }}</td>
                                  <td>{{ $settings->dividend_type }}</td>
                                  <td width="10%">{{ $paid->payment_date }}</td>
                                  <td><a href="{{URL('/')}}/admin/dividend_userpayment_details/{{$paid->user_id}}/{{$paid->payment_id}}" class="label label-primary">View</a>&nbsp;&nbsp;&nbsp;&nbsp;<span class="label label-success">Paid</span></td>
                              </tr>
                              <?php $sno1++; ?>
                              @endif
                          @endforeach
                          </tbody>
                      </table>
                  </div>

              </div>
          </div>
     </div>
  </div>

</div>

@foreach($transactions as $key => $trans)
<div id="show_modal_{{$trans->user_id}}" class="modal fade" role="dialog">
   <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content col-md-12">
         <div class="modal-header" style="display: block!important; ">
            <h4 class="modal-title"><b>Enter Transaction Details</b>
               <button type="button" class="btn btn-default btn-right" style="float: right!important" data-dismiss="modal"><b>X</b></button>
            </h4>
         </div>

         <form role="form" action="{{route('admin.add_transaction')}}" method="POST">
         <div class="modal-body">
            <table class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%" id="tbl_mdl">
               <tr>
                  <td>Transaction Id</td>
                  <input type="hidden" name="_token" value="{{csrf_token()}}"> 
                  <td><input type="text" name="transid" class="form-control" required></td>
               </tr>
               <tr>
                  <td>Select Bank</td>
                  <td>
                    <select name="adminbank" class="form-control" required>
                      <option value="">Select Bank</option>
                      @foreach($AdminBankDetails as $key => $bank)
                      <option value="{{$bank->id}}">{{$bank->account_name}}</option>
                      @endforeach
                    </select>
                  </td>
                  <?php
                  $usdperanum=$trans->dividendcoins*$settings->dividend_amt;
                  if($settings->payment_schedule=='Quarterly') 
                  {
                  $usdperterm=$usdperanum/4;
                  }
                  else if($settings->payment_schedule=='Half yearly') 
                  {
                  $usdperterm=$usdperanum/2;
                  }
                  ?>
                  <input type="hidden" name="user_id" value="{{$trans->user_id}}"/>
                  <input type="hidden" name="total_dividend_amount" value="{{$usdperanum}}"/>
                  <input type="hidden" name="term_dividend_amount" value="{{$usdperterm}}"/>
               </tr>               
            </table>            
            <br>            
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Mark as Paid</button>
         </div>
       </form>
      </div>
   </div>
</div>
@endforeach

<script>

get_chart('<?php echo date('Y'); ?>');
function get_chart(year)
{
  var url="Dividend_Payment_Chart?year="+year;
  $.ajax({
  type:'GET',
  url:url,  
  success:function(response) 
  {     
        var data_chart = [];
        response.Data.forEach(function(element) {
          data_chart.push(element);
        });
        Highcharts.chart('total_payouts', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Total Dividend Payouts'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [
                    'Jan'+' '+year,
                    'Feb'+' '+year,
                    'Mar'+' '+year,
                    'Apr'+' '+year,
                    'May'+' '+year,
                    'Jun'+' '+year,
                    'Jul'+' '+year,
                    'Aug'+' '+year,
                    'Sep'+' '+year,
                    'Oct'+' '+year,
                    'Nov'+' '+year,
                    'Dec'+' '+year
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Total Amount Paid'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:9px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0;font-size:13px;">{series.name}: </td>' +
                    '<td style="padding:0"><b style="color:{series.color};font-size:13px;">${point.y:.1f}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                color: '#15b9b2',
                name: 'Paid Amount',
                data: data_chart

            }]
        });
        },
  error:function(err) {
  alert('Something went wrong. Please check.')
  }
  });
}
</script>
@endsection
@extends('layouts.app')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
@section('htmlheader_title')
Company's Income/Expense report
@endsection
@section('contentheader_title')
    Company's Income/Expense report
<style type="text/css">
    img {  
  position: relative;
}
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
   #tbl_mdl td{
   color: black!important;
   text-align: left;
   align-content: center;
   }
   #tbl_mdl td:nth-child(odd) {background-color: #f2f2f2;}
   .fade-scale {
   transform: scale(0);
   opacity: 0;
   -webkit-transition: all .25s linear;
   -o-transition: all .25s linear;
   transition: all .25s linear;
   }
   .fade-scale.in {
   opacity: 1;
   transform: scale(1);
   }
</style>
@endsection
@section('main-content')
@include('layouts.partials.notification')

{{-- Chart Block --}}
<div class="row">

<div class="col-md-12" style="text-align: center;margin-left: 20%;">  
<div class="form-group">
<div class="form-group col-md-3" style="float:left">
<span style="font-weight: bold;">From Date</span>
<input type="date" name="from_date_chart" id="from_date_chart" class="form-control" value="<?php echo date('d-M-Y'); ?>">
</div>
<div class="form-group col-md-3" style="float:left">
<span style="font-weight: bold;">To Date</span>
<input type="date" name="to_date_chart" id="to_date_chart" class="form-control" value="<?php echo date('d-M-Y'); ?>">
</div>
<div class="form-group col-md-1" style="float:left;margin-top: 1.7%;">
<button type='button' onclick="javascript:get_chart();" class="btn btn-info">Get Report</button>
</div>
</div>
</div>

<div class="col-md-6">
<div class="box box-primary">
<div id="total_incomeNexpense1" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
</div>
</div>

<div class="col-md-6">
<div class="box box-primary">
<div id="pie_incomeNexpense1" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
</div>
</div>
</div>
{{-- End of Chart Block --}}

<div class="row coinmarketcap-widgets collapse show" id="marketcapsacc">
         <div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Track all the company Income and Expenses on this page and generate a report.</h3>
    </div>
    <div class="box-body big">
             <!-- <h4 class="card-title">Company's Income/Expense report</h4> -->
               <p>Choose and view the Income and Expense data for different time periods. Click on View against each transaction to see more details about it.</p>
              <!--  <p>The income is automatically added from every coin purchase made and you can manually enter the Expense <a href="{{URL('/')}}/admin/add_expense" style="color:blue">here.</a></p> -->
               <!-- <p>All the details are on this page, choose any format to download the report.</p> -->
               <br>

            <form name="filter_exp_date" method="post" action="{{route('filter_expense')}}">
               <input type="hidden" name="_token" value="{{csrf_token()}}"> 
               <div class="form-group col-md-3" style="float:left">
                  <span style="font-weight: bold;">From Date</span>
                  <input type="date"  name="from_date" placeholder="From date " id="from_date_fld"  class="form-control datepicker" value="{{isset($from_date)?$from_date:''}}" autocomplete="off">
               </div>
               <div class="form-group col-md-3" style="float:left">
                   <span style="font-weight: bold;">To Date</span>
                  <input type="date"  name="to_date" placeholder="To date" class="form-control datepicker"  id="to_date_fld" value="{{isset($to_date)?$to_date:''}}" autocomplete="off">
               </div>
               <div class="form-group col-md-3" style="float:left">
                   <span style="font-weight: bold;">Type</span>
                  <select class="form-control" name="type">
                     <option selected disabled>Choose Type </option>
                     <option value="1" @if($type==1)selected @endif>Income </option>
                     <option value="2" @if($type==2)selected @endif>Expenses </option>
                  </select>
               </div>
               <div class="form-group col-md-3" style="float:left">
                   <span style="font-weight: bold;">Expense Type</span>
                  <input type="text" id="category" name="category" placeholder="Expense Type" class="form-control"  value="{{isset($category)?$category:''}}">
               </div>

               <div class="form-group col-md-3" style="float:right;">
                  
                  <button type='submit' class="btn btn-info">Apply Filter</button> 
                  <a href="{{URL('/')}}/expense" class="btn btn-danger">Clear Filter</a>
               </div>
               
            </form>
         </div>  
         </div>     
</div>

           <div class="box box-primary">
   <!--  <div class="box-header with-border">
        <h3 class="box-title">Here you can see all the dividend transactions paid out to you.</h3>
    </div> -->
    <div class="box-body big">
            @foreach($data as $key => $dat)
            <div id="show_mod_{{$dat->id}}" class="modal fade  " role="dialog">
               <div class="modal-dialog modal-lg">
                  <!-- Modal content-->
                  <div class="modal-content col-md-12">
                     <div class="modal-header" style="display: block!important; ">
                        <h4 class="modal-title">
                           <button type="button" class="btn btn-default btn-right" style="float: right!important" data-dismiss="modal"><b>X</b></button>
                        </h4>
                     </div>
                     <div class="modal-body">
                        <table class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%" id="tbl_mdl">
                           <tr>
                              <td>Payee Name</td>
                              <td>{{$dat->customer_name}}</td>
                              <td>Expense Type</td>
                              <td>{{$dat->category}}</td>
                           </tr>
                           <tr>
                              <td>Payment Date</td>
                              <td>{{$dat->date}}</td>
                              <td>Payment Type</td>
                              <td>{{$dat->pay_type}}</td>
                           </tr>
                           <tr>
                              <td>Payee Name</td>
                              <td>{{$dat->customer_name}}</td>
                              <td>Tax type</td>
                              <td>@if($dat->tax_type==1) Inclusive of Tax @elseif($dat->tax_type==2)Exclusive of Tax @endif</td>
                           </tr>
                           <tr>
                              
                              <td>Sub Total</td>
                              <td>{{$dat->amount}}</td>
                              <td>Tax Value</td>
                              <td>{{$dat->tax}}</td>
                           </tr>
                           <tr>
                              
                              <td>Tax amount</td>
                              <td>{{$dat->tax_amount}}</td>
                              <td>Ref No.</td>
                              <td>{{$dat->ref_no}}</td>
                              
                           </tr>
                           <td>Total Amount</td>
                              <td>{{$dat->total_amount}}</td>
                           @if($dat->voucher!="")
                           <tr>
                              <td>Attachment</td>
                              <td><a href="{{$dat->voucher}}" target="_blank" class="label label-primary">View</a></td>
                              
                           </tr>
                           @endif

                        </table>
                        <br>
                        @if($dat->purpose!="")
                        <h4>Description</h4>
                        <div  style="color: black!important;text-align: left">{{$dat->purpose}}</div>
                        @endif
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     </div>
                  </div>
               </div>
            </div>
            @endforeach
              <div class="card-body">
              
            <div class="table-responsive">
              
           <table class="table table-bordered">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Type</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Sub Total</th>
                        <th>Tax in %</th>
                        <th>Total</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tfoot>
                     <tr>
                        <th>#</th>
                        <th>Type</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Sub Total</th>
                        <th>Tax</th>
                        <th>Total</th>
                        <th>Action</th>
                     </tr>
                  </tfoot>
                  <tbody>
                     @foreach($data as $key => $d)
                     <tr>
                        <td>{{ $key+1 }}</td>
                        <td><span class="label" style="background-color: @if($d->type==1) #096903 @else #de220e @endif;color:white!important">@if($d->type==1) Income @else Expense @endif</span></td>
                        <td>{{ $d->category }}</td>
                        <td>{{ $d->date }}</td>
                        <td>{{$d->purpose==''?'-' : substr($d->purpose, 0, 40).'...'}}</td>
                        <td>${{$d->amount==''?'-' :$d->amount}}</td>
                        <td>{{$d->tax==''?'-' :$d->tax}}</td>
                        <td>${{$d->total_amount}}</td>
                        <td>
                           <center>  <a  class="label label-primary" data-toggle="modal" href="#" data-target="#show_mod_{{$d->id}}"><b style="color: white!important">view</b></a><br></center>
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>

<script>

Highcharts.setOptions({
    colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
        return {
            radialGradient: {
                cx: 0.5,
                cy: 0.3,
                r: 0.7
            },
            stops: [
                [0, color],
                [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
            ]
        };
    })
});

get_chart();
function get_chart()
{
  var fromdate=document.getElementById('from_date_chart').value;
  var todate=document.getElementById('to_date_chart').value;
  if(fromdate=='') { fromdate='<?php echo "01-Jan-".date("Y"); ?>'; }
  if(todate=='') { todate='<?php echo date("d-M-Y"); ?>'; }
  var url="IncomeNExpense_Charts?fromdate="+fromdate+"&todate="+todate;
  $.ajax({
  type:'GET',
  url:url,  
  success:function(response) 
  {
      var data_month = [];
      var data_total_amount_income1 = [];
      var data_total_amount_expense1 = [];
      var data_percent_name = [];
      var data_percent_y = [];
      var j=0;
      response.month.forEach(function(element) {
        data_month.push(element);
      });
      response.total_amount_income1.forEach(function(element1) {
        data_total_amount_income1.push(parseInt(element1));
      });
      response.total_amount_expense1.forEach(function(element2) {
        data_total_amount_expense1.push(parseInt(element2));
      });
      response.percent_name.forEach(function(element3) {
        data_percent_name.push({ name : element3 , y: response.percent_y[j] });
        j++;
      });      
      Highcharts.chart('total_incomeNexpense1', {
          chart: {
              type: 'column'
          },
          title: {
              text: 'Total Income & Expense'
          },
          subtitle: {
              text: ''
          },
          xAxis: {
              categories: data_month,
              crosshair: true
          },
          yAxis: {
              min: 0,
              title: {
                  text: 'Total Amount'
              }
          },
          tooltip: {
              headerFormat: '<span style="font-size:9px">{point.key}</span><table>',
              pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                  '<td style="padding:0"><b style="color:#000;">${point.y:.1f}</b></td></tr>',
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
              color: '#096903',
              name: 'Income',
              data: data_total_amount_income1

          }, {
              color: '#de220e',
              name: 'Expense',
              data: data_total_amount_expense1

          }]
      });      

      Highcharts.chart('pie_incomeNexpense1', {
          chart: {
              plotBackgroundColor: null,
              plotBorderWidth: null,
              plotShadow: false,
              type: 'pie'
          },
          title: {
              text: 'Total Income & Expense in Percentage'
          },
          tooltip: {
              pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
          },
          plotOptions: {
              pie: {
                  allowPointSelect: true,
                  cursor: 'pointer',
                  dataLabels: {
                      enabled: true,
                      format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                      style: {
                          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                      },
                      connectorColor: 'silver'
                  }
              }
          },
          series: [{
              name: 'Share',
              data: data_percent_name              
          }]
      });

    },
  error:function(err) {
  alert('Something went wrong. Please check.')
  }
  });
}

$('#from_date_fld').datetimepicker({
      closeOnDateSelect:true,
      format:'d-m-Y',
      timepicker:false,
      maxDate:new Date(), //yesterday is minimum date
    });

   // $('#from_date_chart').datetimepicker({
   //    closeOnDateSelect:true,
   //    format:'d-m-Y',
   //    timepicker:false,
   //    maxDate:new Date(), //yesterday is minimum date
   //  });
    $('#to_date_fld').datetimepicker({
      closeOnDateSelect:true,
      format:'d-m-Y',
      timepicker:false,
      maxDate:new Date(), //yesterday is minimum date
    });
    // $('#to_date_chart').datetimepicker({
    //   closeOnDateSelect:true,
    //   format:'d-m-Y',
    //   timepicker:false,
    //   maxDate:new Date(), //yesterday is minimum date
    // });

    $( function() {
        var category = [
       
       @foreach($autocomplete as $d)
        "{{$d->category}}",
       @endforeach
       ];
       $( "#category" ).autocomplete({
             source: category
       });
   
   } );
</script>

@endsection
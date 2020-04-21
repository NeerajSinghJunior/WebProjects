@extends('admin.layouts.app')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
@section('site_tile',auth()->user()->site_title)
@section('content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<style type="text/css">
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



   .switch {
  position: relative;
  display: inline-block;
  width: 70px;
  height: 30px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 22px;
  width: 22px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<div class="page-wrapper">
<!-- Bread crumb -->
<div class="row page-titles">
   <div class="col-md-8 align-self-center">
      <h3 class="text-primary">Income/Expense Ledger </h3>      
   </div>
   <div class="col-md-4 align-self-center">
   <span><a title="Turning it on will make the reports below to be available for your shareholders to see" href="#" style="color:#2196F3;"><i class="fa fa-info-circle"></i></a> <b style="color:#e6a616c7;">Make Reports visible to investors </b>
      <form method="post" action="{{route('admin.update_expense_report_status')}}" style="display: inline !important;">
      <input type="hidden" name="_token" value="{{csrf_token()}}"> 
      <input type="hidden" name="status" value="{{$status}}"> 
      <label class="switch col-md-3" style="display: inline !important;float: right !important;width:16.6% !important;"> 
        <input type="checkbox" onClick="this.form.submit()" @if($status==1) checked @endif>
        <span class="slider round"></span>
      </label>
      </form>
    </span>
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
      <div class="col-md-12" style="text-align: center;margin-left: 20%;">  
      <div class="form-group">
      <div class="form-group col-md-3" style="float:left">
      <span style="font-weight: bold;">From Date</span>
      <input type="text" name="from_date_chart" id="from_date_chart" class="form-control" value="<?php echo '01-01-'.date('Y'); ?>">
      </div>
      <div class="form-group col-md-3" style="float:left">
      <span style="font-weight: bold;">To Date</span>
      <input type="text" name="to_date_chart" id="to_date_chart" class="form-control" value="<?php echo date('d-m-Y'); ?>">
      </div>
      <div class="form-group col-md-1" style="float:left;margin-top: 2.5%;">
      <button type='button' onclick="javascript:get_chart();" class="btn btn-info">Get Report</button>
      </div>
      </div>
      </div>
      {{-- Chart Block --}}
      <div class="col-lg-6 col-md-12 col-sm-12">
      <div id="total_incomeNexpense2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
      </div>

      <div class="col-lg-6 col-md-12 col-sm-12">
      <div id="pie_incomeNexpense2" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
      </div>
      {{-- End of Chart Block --}}
      <div class="col-lg-12">

         <div class="card">
             <h4 class="card-title">Income/Expense Ledger</h4>
               <p>Track all your Income and Expenses on this page and generate a report.</p>
               <p>The income is automatically added from every coin purchase made and you can manually enter the Expense <a href="{{URL('/')}}/admin/add_expense" style="color:blue">here.</a></p>
               <p>All the details are on this page, choose any format to download the report.</p>
               <p><span style="font-weight:bold;">Upcoming:</span> You will be able to publish your Revenue/Expense details, to your investors/users on their dashboard.</p>
               <p>Showcasing your company's cashflow to investors builds investor trust and is a mandate by certain regulatory bodies and ensure compliance.</p>
               <br>
      
               {{-- <form method="post" action="{{route('admin.update_expense_report_status')}}">
                   <input type="hidden" name="_token" value="{{csrf_token()}}"> 
                   <input type="hidden" name="status" value="{{$status}}">
                  <div class="form-group " style="float:left;color:#e6a616c7">
                     Make Reports visible to investors
                  <label class="switch col-md-3" style="width:10%;float:left;"> 
                    <input type="checkbox" onClick="this.form.submit()" @if($status==1) checked @endif>
                    <span class="slider round"></span>
                  </label>
               </div>
               </form> --}}
            <form name="filter_exp_date" method="post" action="{{route('admin.filter_expense')}}">
               <input type="hidden" name="_token" value="{{csrf_token()}}"> 
               <div class="form-group col-md-3" style="float:left">
                  <span style="font-weight: bold;">From Date</span>
                  <input type="text"  name="from_date" placeholder="From date " id="from_date_fld"  class="form-control datepicker" value="{{isset($from_date)?$from_date:''}}" autocomplete="off">
               </div>
               <div class="form-group col-md-3" style="float:left">
                   <span style="font-weight: bold;">To Date</span>
                  <input type="text"  name="to_date" placeholder="To date" class="form-control datepicker"  id="to_date_fld" value="{{isset($to_date)?$to_date:''}}" autocomplete="off">
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
                  <a href="{{URL('/')}}/admin/expense" class="btn btn-danger">Clear Filter</a>
               </div>
               
            </form>
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
                @include('admin.partials.table-heading')
            <div class="table-responsive">
            	<input type="hidden" id="export_columns" value="0,1,2,3,4,5,6,7"/>
               	<table id="example23" class=" table  table-striped table-bordered table-hover dt-responsive display nowrap" cellspacing="0" >
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
                           <center>  <a  class="label label-primary" data-toggle="modal" href="#" data-target="#show_mod_{{$d->id}}"><b style="color: white!important">view</b></a><br>  <a href="{{ route('admin.edit_exp', $d->id) }}" class="label label-warning">Edit</a><br><a href="{{ route('admin.delete_exp', $d->id) }}" class="label label-danger">Delete</a></center>
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
         </div>
      </div>
   </div>
   <!-- End Container fluid  -->
   <!-- footer -->
   {{-- @include('layouts.partials.footer') --}}
   <!-- End footer -->
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
      console.log(response);
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
      Highcharts.chart('total_incomeNexpense2', {
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

      Highcharts.chart('pie_incomeNexpense2', {
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




// Highcharts.chart('total_incomeNexpense2', {
//     chart: {
//         type: 'column'
//     },
//     title: {
//         text: 'Total Income & Expense'
//     },
//     subtitle: {
//         text: ''
//     },
//     xAxis: {
//         categories: [
//             'Jan'+' <?php echo date("Y"); ?>',
//             'Feb'+' <?php echo date("Y"); ?>',
//             'Mar'+' <?php echo date("Y"); ?>',
//             'Apr'+' <?php echo date("Y"); ?>',
//             'May'+' <?php echo date("Y"); ?>',
//             'Jun'+' <?php echo date("Y"); ?>',
//             'Jul'+' <?php echo date("Y"); ?>',
//             'Aug'+' <?php echo date("Y"); ?>',
//             'Sep'+' <?php echo date("Y"); ?>',
//             'Oct'+' <?php echo date("Y"); ?>',
//             'Nov'+' <?php echo date("Y"); ?>',
//             'Dec'+' <?php echo date("Y"); ?>'
//         ],
//         crosshair: true
//     },
//     yAxis: {
//         min: 0,
//         title: {
//             text: 'Total Amount'
//         }
//     },
//     tooltip: {
//         headerFormat: '<span style="font-size:9px">{point.key}</span><table>',
//         pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
//             '<td style="padding:0"><b style="color:#000;">${point.y:.1f}</b></td></tr>',
//         footerFormat: '</table>',
//         shared: true,
//         useHTML: true
//     },
//     plotOptions: {
//         column: {
//             pointPadding: 0.2,
//             borderWidth: 0
//         }
//     },
//     series: [{
//         color: '#096903',
//         name: 'Income',
//         data: [<?php echo implode(',',$total_amount_income1); ?>]

//     }, {
//         color: '#de220e',
//         name: 'Expense',
//         data: [<?php echo implode(',',$total_amount_expense1); ?>]

//     }]
// });



// Highcharts.setOptions({
//     colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
//         return {
//             radialGradient: {
//                 cx: 0.5,
//                 cy: 0.3,
//                 r: 0.7
//             },
//             stops: [
//                 [0, color],
//                 [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
//             ]
//         };
//     })
// });

// // Build the chart
// Highcharts.chart('pie_incomeNexpense2', {
//     chart: {
//         plotBackgroundColor: null,
//         plotBorderWidth: null,
//         plotShadow: false,
//         type: 'pie'
//     },
//     title: {
//         text: 'Total Income & Expense in Percentage'
//     },
//     tooltip: {
//         pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
//     },
//     plotOptions: {
//         pie: {
//             allowPointSelect: true,
//             cursor: 'pointer',
//             dataLabels: {
//                 enabled: true,
//                 format: '<b>{point.name}</b>: {point.percentage:.1f} %',
//                 style: {
//                     color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
//                 },
//                 connectorColor: 'silver'
//             }
//         }
//     },
//     series: [{
//         name: 'Share',
//         data: [

//             <?php foreach($incomeexp_percent as $percent) { ?>
//             { name: '<?php echo $percent->category; ?>', y: <?php echo $percent->total*100/$total_category; ?> },
//             <?php } ?>
//         ]
//     }]
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


   $('#from_date_fld').datetimepicker({
	   	closeOnDateSelect:true,
	    format:'d-m-Y',
	    timepicker:false,
	    maxDate:new Date(), //yesterday is minimum date
   	});

   $('#from_date_chart').datetimepicker({
      closeOnDateSelect:true,
      format:'d-m-Y',
      timepicker:false,
      maxDate:new Date(), //yesterday is minimum date
    });
  
   // 	var newDate ="";
  	// function set_date(date){
	  //  var start_date=$('#from_date_fld').val();
	  // 	newDate = new Date(start_date);
	  // 	//alert(newDate);
	  // 	console.log(newDate);
  	// }
  	
  	
   	$('#to_date_fld').datetimepicker({

   		// minDate: newDate,
	   	closeOnDateSelect:true,
	    format:'d-m-Y',
	    timepicker:false,
	    maxDate:new Date(), //yesterday is minimum date
   	});

    $('#to_date_chart').datetimepicker({

      // minDate: newDate,
      closeOnDateSelect:true,
      format:'d-m-Y',
      timepicker:false,
      maxDate:new Date(), //yesterday is minimum date
    });
  
 
   
   
   
          
</script>
@endsection
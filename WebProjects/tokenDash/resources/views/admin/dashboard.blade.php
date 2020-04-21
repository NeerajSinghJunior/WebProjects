@extends('admin.layouts.app')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
@section('site_tile',auth()->user()->site_title)
@section('content')
<div class="page-wrapper">
    <!-- Bread crumb -->    
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h3 class="text-primary">Dashboard</h3> 
        </div>
    </div>
    @include('admin/partials/error')
    @include('admin/partials/success')
    @include('admin/partials/session-error')
    <div id="error-div"></div>
    <div class="container-fluid">
        <div class="row page-inner dash-count">
            <div class="col-lg-1 col-md-3  col-sm-12">
            </div>
            <div class="col-lg-3 col-md-6  col-sm-12">
                <div class="card">
                    <div class="data-inner">
                        <p class="lead text-primary">
                                <i class="fa fa-users" aria-hidden="true"></i> No. of members</p>
                        <p class="card-val">{{$TotalUsers}}</p>
                    </div>
                </div>
            </div>
           <!--  <div class="col-lg-3 col-md-6  col-sm-12">
                <div class="card">
                    <div class="data-inner">
                        <p class="lead text-primary">
                                <i class="fa fa-money" aria-hidden="true"></i> Total Supply</p>
                        <p class="card-val">{{$ToatalSupply}}</p>
                    </div>
                </div>
            </div> -->
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    
                    <div class="data-inner">
                        <p class="lead text-primary">
                                <i class="fa fa-bitcoin" aria-hidden="true"></i> Total Tokens to be sent</p>
                        <p class="card-val">{{$PendingTransactionAmount}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <div class="data-inner">
                        <p class="lead text-primary">
                                <i class="fa fa-exchange" aria-hidden="true"></i> Pending Transactions</p>
                        <p class="card-val">{{$PendingTransactionCount}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12">
                  <button type="button" data-toggle="modal" class="btn" data-target="#myModal" style="float:right"><i class="fa fa-info-circle" style="font-size:24px"></i></button>
             <!-- Modal -->
                  <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">
                    
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <!-- <button type="button" class="close" data-dismiss="modal">&times;</button>
                         <h4 class="modal-title">Modal Header</h4>  -->
                        </div>
                        <div class="modal-body">
                            <h4>No. of members: <p>The total number of registered users on the site.</p></h4>
                            <h4>Total Tokens to be sent: <p>Total pending count of tokens that are yet to be sent to your user.</p></h4>
                            <h4>Pending Transactions: <p>The total pending transactions that are waiting to be sent by you.</p></h4>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                      
                    </div>
                  </div>
            </div>

            {{-- Chart Block --}}
            <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group" style="text-align: center;padding: 10px;">
            <label style="display: inline;width: auto !important;">Select Year&nbsp;&nbsp;&nbsp;</label>
            <select name="payment_year" style="display: inline;width:10%;" onchange="javascript:get_chart_token(this.value);">
            <option value="">Select Year</option>
            <?php                
            for ($i=2015; $i <= date('Y'); $i++) { 
              echo '<option value="'.$i.'">'.$i.'</option>';
            }
            ?>
            </select>
            </div>
            <div id="total_token_sale" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12">
            <div id="total_incomeNexpense" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12">

            <div id="pie_incomeNexpense" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
           
            </div>
            {{-- End of Chart Block --}}
                  
                  <!-- Modal -->
            <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                    <div class="card-title">
                        <h4>Latest Token Requests </h4><span style="float:right"> <a href="{{route('admin.home')}}" class="pull-right btn btn-sm btn-info" style="color:white;">
                                View All Requests
                        </a></span>
                        <p style="font-size:14px">Find the latest token request orders here. For semi-automatic token delivery, you will have to verify the payment and send the tokens from here. For Automatic delivery, if the contract is configured, it will show already sent.</p>
                    </div>
                   <div class="card-body">
                    <div class="table-responsive m-t-40">
                        @include('admin.partials.table-heading')
                            <input type="hidden" id="export_columns" value="0,1,2,3,4"/>
                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Amount Sent</th>
                                        <th>Equivalent</th>
                                      {{-- <th>Payment Status</th> --}}
                                        <th>Token send Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Amount Sent</th>
                                        <th>Equivalent</th>
                                        {{--  <th>Payment Status</th>--}}
                                        <th>Token send Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($transactions as $key => $Txn)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $Txn->user->name }}</td>

                                        <td>{{ $Txn->amount }} @if($Txn->currency !='Otders') {{$Txn->currency}}</td>
                                        @else
                                        {{$Txn->others}}
                                        @endif
                                        <td>{{ $Txn->coins }} {{auth()->user()->selling_coin_name}}</td>
                                       {{-- <td>{{ $Txn->pay_status }}</td> --}}
                                        <td>{{ $Txn->status === 'COMPLETED' ?  'Token Sent': 'Pending'}}<br> @if($Txn->pay_type==1)<span class="label" style="background-color: #F39C04;">Semi-Automatic </span>@else <span class="label" style="background-color:#344635 "> Automatic </span>@endif</td>
                                        <td>
                                              <center>   <a href="{{ route('admin.transaction', $Txn->id) }}" class="label label-primary">{{$Txn->status === 'COMPLETED' ? 'View Details' : 'Send Tokens'}}</a></center>
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
    </div>
</div>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>
<body>

<div class="container">
  <h2>Modal Example</h2>
  <!-- Trigger the modal with a button --
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

  <!-- Modal --
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content--
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align: left!important">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>

</body>
</html> -->

<script>
Highcharts.chart('total_incomeNexpense', {
    chart: {
        type: 'column'
    },
    title: {
        text: '<a href="{{ route('admin.expense') }}">Total Income & Expense</a>'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: [
            'Jan'+' <?php echo date("Y"); ?>',
            'Feb'+' <?php echo date("Y"); ?>',
            'Mar'+' <?php echo date("Y"); ?>',
            'Apr'+' <?php echo date("Y"); ?>',
            'May'+' <?php echo date("Y"); ?>',
            'Jun'+' <?php echo date("Y"); ?>',
            'Jul'+' <?php echo date("Y"); ?>',
            'Aug'+' <?php echo date("Y"); ?>',
            'Sep'+' <?php echo date("Y"); ?>',
            'Oct'+' <?php echo date("Y"); ?>',
            'Nov'+' <?php echo date("Y"); ?>',
            'Dec'+' <?php echo date("Y"); ?>'
        ],
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
        data: [<?php echo implode(',',$total_amount_income1); ?>]

    }, {
        color: '#de220e',
        name: 'Expense',
        data: [<?php echo implode(',',$total_amount_expense1); ?>]

    }]
});



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

// Build the chart
Highcharts.chart('pie_incomeNexpense', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: '<a href="{{ route('admin.expense') }}">Total Income & Expense in Percentage</a><br><span style="font-size:11px">* data showing for last 30 days</span>'
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
        data: [

            <?php foreach($incomeexp_percent as $percent) { ?>
            { name: '<?php echo $percent->category; ?>', y: <?php echo $percent->total*100/$total_category; ?> },
            <?php } ?>
        ]
    }]
});

get_chart_token('');
function get_chart_token(year)
{  
  if(year!='')
  {
  var url="Token_Request_Charts?year="+year;
  $.ajax({
  type:'GET',
  url:url,  
  success:function(response) 
  {      
      Highcharts.chart('total_token_sale', {
            chart: {
                type: 'column'
            },
            title: {
                text: '<a href="{{ route('admin.home') }}">Total Token Sold</a>'
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
                    text: 'Total Tokens Sold'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:9px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0;font-size:13px;">{series.name}: </td>' +
                    '<td style="padding:0"><b style="color:{series.color};font-size:13px;">{point.y:f}</b></td></tr>',
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
                color: '#344635',
                name: 'Automatic',
                data: response.total_token_auto

            }, {
                color: '#F39C04',
                name: 'Semi-Automatic',
                data: response.total_token_sauto

            }]
        });

        },
      error:function(err) {
      alert('Something went wrong. Please check.')
      }
      });
    }
    else
    {
        Highcharts.chart('total_token_sale', {
            chart: {
                type: 'column'
            },
            title: {
                text: '<a href="{{ route('admin.home') }}">Total Token Sold</a>'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [<?php echo implode(',',$month1); ?>],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Total Tokens Sold'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:9px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0;font-size:13px;">{series.name}: </td>' +
                    '<td style="padding:0"><b style="color:{series.color};font-size:13px;">{point.y:f}</b></td></tr>',
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
                color: '#344635',
                name: 'Automatic',
                data: [<?php echo implode(',',$total_token_auto); ?>]

            }, {
                color: '#F39C04',
                name: 'Semi-Automatic',
                data: [<?php echo implode(',',$total_token_sauto); ?>]

            }]
        });
    }
}

// Highcharts.chart('total_token_sale', {
//     chart: {
//         type: 'column'
//     },
//     title: {
//         text: 'Total Token Sales'
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
//             text: 'Total Tokens'
//         }
//     },
//     tooltip: {
//         headerFormat: '<span style="font-size:9px">{point.key}</span><table>',
//         pointFormat: '<tr><td style="color:{series.color};padding:0;font-size:13px;">{series.name}: </td>' +
//             '<td style="padding:0"><b style="color:{series.color};font-size:13px;">{point.y:f}</b></td></tr>',
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
//         color: '#344635',
//         name: 'Automatic',
//         data: [<?php echo implode(',',$total_token_auto); ?>]

//     }, {
//         color: '#F39C04',
//         name: 'Semi-Automatic',
//         data: [<?php echo implode(',',$total_token_sauto); ?>]

//     }]
// });
</script>

@endsection
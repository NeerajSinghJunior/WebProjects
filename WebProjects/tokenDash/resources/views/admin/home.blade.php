@extends('admin.layouts.app')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
@section('site_tile',auth()->user()->site_title)
@section('content')
<style>
        .dataTables_filter {
            float: right;
            width: 25%;
            display: inline-block;
            white-space: nowrap;
        }
        .dt-buttons{
            border: 1px solid #f1f1f1;
            padding: 1em;
            border-radius: 3px;
        }
</style>
<div class="page-wrapper">
    <!-- Bread crumb -->
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h3 class="text-primary">Token Requests</h3>
        </div>
    </div>
    <!-- End Bread crumb -->
    <!-- Container fluid  -->
    <div class="container-fluid">
        <!-- Start Page Content -->
        <div class="row page-inner">
            <div class="col-12">
                <div class="form-group" style="text-align: center;padding: 10px;">
                <label style="display: inline;width: auto !important;">Select Year&nbsp;&nbsp;&nbsp;</label>
                <select name="payment_year" style="display: inline;width:10%;" onchange="javascript:get_chart(this.value);">
                <option value="">Select Year</option>
                <?php                
                for ($i=2015; $i <= date('Y'); $i++) { 
                  echo '<option value="'.$i.'">'.$i.'</option>';
                }
                ?>
                </select>
                </div>
                {{-- Chart Block --}}                
                <div id="total_token_sale1" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                {{-- End of Chart Block --}}   
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Token Requests</h4>
                        <p>You can view and send tokens to people who have purchased the tokens here.</p>

                        <p>- All your Token requests are listed here. In the Status, if it shows as PENDING it means that people have paid and are waiting for you to transfer the tokens to them.</p>
                        <p>- See how much they paid and transfer the exact amount of tokens they paid for. </p>
                        <p>- Find the latest token request orders here. For semi-automatic token delivery, you will have to verify the payment and send the tokens from here. For Automatic delivery, if the contract is configured, it will show already sent.</p>
                        <p>- To send tokens to users, click on SEND TOKENS under the Action tab.</p>
                        <br>
                        <p>Balance : <b style="color:#99abb4" id="balance">{{$tokenAmount}}</b></p>
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
                                        {{--<th>Payment Status</th>--}}
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
                                        {{--<th>Payment Status</th>--}}
                                        <th>Token send Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($Transactions as $key => $Txn)
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
                                          <center>  <a href="{{ route('admin.transaction', $Txn->id) }}" class="label label-primary">{{$Txn->status === 'COMPLETED' ? 'View Details' : 'Send Tokens'}}</a> </center>
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

get_chart('');
function get_chart(year)
{  
  if(year!='')
  {
      var url="Token_Request_Charts?year="+year;
      $.ajax({
      type:'GET',
      url:url,  
      success:function(response) 
      {      
          Highcharts.chart('total_token_sale1', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Total Token Sold'
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
        Highcharts.chart('total_token_sale1', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Total Token Sold'
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

App.start("{{ Auth::guard('admin')->user()->ether}}");

</script>

@endsection
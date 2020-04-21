@extends('layouts.app')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
@section('htmlheader_title')
Payment History
@endsection
@section('contentheader_title')
    Payment History
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
</style>
@endsection
@section('main-content')
@include('layouts.partials.notification')
<div class="row coinmarketcap-widgets collapse show" id="marketcapsacc">
<div class="col-md-4 col-sm-6 col-xs-12">
    <div class="box box-primary">
        <div class="box-body">
            <div class="coinmarketcap-currency-widget" data-currencyid="1" data-base="USD" data-secondary="USD" data-ticker="true" data-rank="true" data-marketcap="true" data-volume="true" data-stats="USD" data-statsticker="false">
              <center>
              <h3>Total dividends paid</h3>
              <p>The number of dividend payments made to you</p>
              <br>
              @if(isset($transactions[0]->paid_amount))
              <h3 class="label label-success" style="font-size: 20px;font-weight: bold;">{{count($transactions)}}</h3>
              @else
              <h3 class="label label-success" style="font-size: 20px;font-weight: bold;">0</h3>
              @endif
              </center>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-sm-6 col-xs-12">
    <div class="box box-primary">
        <div class="box-body">
            <div class="coinmarketcap-currency-widget" data-currencyid="2" data-base="USD" data-secondary="USD" data-ticker="true" data-rank="true" data-marketcap="true" data-volume="true" data-stats="USD" data-statsticker="false">
              <center>
              <h3>Total Dividend amount paid</h3>
              <p>The total amount paid as dividends to you</p>
              <br>
              @if(isset($transactions[0]->paid_amount))
              <h3 class="label label-warning" style="font-size: 20px;font-weight: bold;">$ {{$transactions[0]->paid_amount}}</h3>
              @else
              <h3 class="label label-warning" style="font-size: 20px;font-weight: bold;">$ 0</h3>
              @endif
              </center>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-sm-6 col-xs-12">
    <div class="box box-primary">
        <div class="box-body">
            <div class="coinmarketcap-currency-widget" data-currencyid="1831" data-base="USD" data-secondary="USD" data-ticker="true" data-rank="true" data-marketcap="true" data-volume="true" data-stats="USD" data-statsticker="false">
              <center>
              <h3>Last paid date</h3>
              @if(isset($last_date->payment_date))
              <p>The date that you last received a dividend</p>
              <br>
              <h3 class="label label-info" style="font-size: 20px;font-weight: bold;">{{$last_date->payment_date}}</h3>
              @else
              <br>
              <p>NA</p>
              @endif
              </center>
            </div>
        </div>
    </div>
</div>        
</div>


{{-- Chart Block --}}
<div class="box box-primary">
<div class="form-group" style="text-align: center;padding: 10px;">
<label style="display: inline;">Select Year&nbsp;&nbsp;&nbsp;</label>
<select name="payment_year" onchange="javascript:get_chart(this.value);" style="display: inline;width:10%;">
<?php
for ($i=2015; $i <= date('Y'); $i++) { 
  echo '<option value="'.$i.'"';
  if($i==date('Y')) { echo 'selected'; }
  echo '>'.$i.'</option>';
}
?>
</select>
</div>
<div id="dividend_payment_chart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
</div>
{{-- End of Chart Block --}}


<div class="box box-primary">
    <div class="box-header with-border">
        <p>The company makes available it's financial information periodically to its investors and shareholders. You can find below the complete income and expense reports that have incurred.</p>
    </div>
    <div class="box-body big">
    <table class="table table-bordered">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Shareholder Name</th>
                    <th>Dividend/Share</th>
                    <th>Dividend Amount<br>/ Annum.</th>
                    <th>Paid Amount</th>
                    <th>Dividend Type</th>
                    <th>Paid Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                   @foreach($transactions as $key => $transaction)
                   @if(isset($transaction->dividend_amt))
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $transaction->username }}</td>
                        <td>{{ $settings->dividend_amt }}</td>
                        <td>$ {{ $transaction->dividend_amt }}</td>
                        <td>$ {{ $transaction->term_amt }}</td>                        
                        <td>{{ $settings->dividend_type }}</td>
                        <td>{{ $transaction->payment_date }}</td>
                        <td><a href="{{URL('/')}}/userpayment_details/{{$transaction->user_id}}/{{$transaction->transid}}" class="label label-primary">View</a></td>
                    </tr>
                    @endif
                @endforeach
               
            </tbody>
        </table>
    </div>
</div>
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
            
        Highcharts.chart('dividend_payment_chart', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Dividend Payment'
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
                text: 'Paid Amount'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:9px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0;font-size:15px;">{series.name}: </td>' +
                '<td style="padding:0"><b style="color:#000;font-size:15px;">${point.y:.1f}</b></td></tr>',
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
            color: '#00a65a',
            name: 'Paid',
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
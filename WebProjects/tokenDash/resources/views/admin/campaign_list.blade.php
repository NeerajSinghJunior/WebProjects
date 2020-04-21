@extends('admin.layouts.app')
@section('site_tile',auth()->user()->site_title)
@section('content')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<style type="text/css">
 
</style>
<div class="page-wrapper">
    <!-- Bread crumb -->
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h3 class="text-primary">Email Campaigns</h3> 
        </div>
    </div>
    @include('admin/partials/error')
    @include('admin/partials/success')
    @include('admin/partials/session-error')
    <div id="error-div"></div>
    <div class="container-fluid">
        <div class="row page-inner dash-count">
            <div class="col-lg-11 col-md-11  col-sm-11">
            </div>
            <div class="col-lg-1 col-md-1  col-sm-1">
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
                            <h4>No. of Users: <p>The total number of registered users on the mailing lists.</p></h4>
                            <h4>Total Campaigns: <p>Total campaigns that have been sent.</p></h4>
                            <h4>Campaigns Sent: <p>Total Campaigns that have been successfully sent.</p></h4>
                            <h4>Campaigns in draft: <p>Total campaigns that are saved in draft.</p></h4>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                      
                    </div>
                  </div>
            </div>
            <div class="col-lg-3 col-md-6  col-sm-12">
                <div class="card">
                    <div class="data-inner">
                        <p class="lead text-primary">
                                <i class="fa fa-users" aria-hidden="true"></i> No. of Users</p>
                        <p class="card-val">{{$user_count}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6  col-sm-12">
                <div class="card">
                    <div class="data-inner">
                        <p class="lead text-primary">
                                <i class="fa fa-money" aria-hidden="true"></i> Total Campaigns</p>
                        <p class="card-val">{{$campaign_count}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    
                    <div class="data-inner">
                        <p class="lead text-primary">
                                <i class="fa fa-bitcoin" aria-hidden="true"></i> Campaigns Sent</p>
                        <p class="card-val">{{$campaign_sent}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <div class="data-inner">
                        <p class="lead text-primary">
                                <i class="fa fa-exchange" aria-hidden="true"></i> Campaigns in Draft</p>
                        <p class="card-val">{{$campaign_draft}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="row">
                <div class="col-md-6"> 
                    <div id="piechart"></div>
                </div> 
                <div class="col-md-6">
                  <div id="line_top_x" ></div>
                </div>
              </div>
            </div>
            <br>
           
            <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                    <div class="card-title">
                        <h4>Email Campaigns</h4>
                        <p>Reach out to your investors at any point of time using the Email Campaigns Create, send and track your email campaigns. View all the campaign details below.</p>
                    </div>
                   <div class="card-body">
                    <div class="table-responsive m-t-40">
                         @include('admin.partials.table-heading')
                            <input type="hidden" id="export_columns" value="0,1,2,3"/>
                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>S No</th>
                                        <th>Date</th>
                                        <th>Subject</th>
                                        {{-- <th>Mail Content</th> --}}
                                        <th>User Count</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                     <tr>
                                        <th>S No</th>
                                        <th>Date</th>
                                        <th>Subject</th>
                                        {{-- <th>Mail Content</th> --}}
                                        <th>User Count</th>
                                        <th>Details</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($mail as $key=>$val)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{date("d-m-Y",strtotime($val->created_at))}}</td>
                                        <td>{{$val->subject}}</td>
                                        {{-- <td>@php echo htmlspecialchars_decode($val->mail_content); @endphp</td> --}}
                                        <td>{{$val->user_count}}</td>
                                        {{-- <td>
                                            @if($final[$i]['event'] == "delivered")
                                                <button class="btn btn-sm btn-success">Delivered</button>
                                            @endif
                                            @if($final[$i]['event'] == "accepted")
                                                <button class="btn btn-sm btn-info">Read</button>
                                            @endif
                                        </td> --}}
                                        <td><a href="{{ route('admin.get_mail_details', $val->subject) }}"><button type="button" class="btn btn-sm btn-info" >View</button></a></td>
                                    
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
<script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Email Campaigns', 'Day Status'],
  ['Total  No. of Users', <?php echo $user_count; ?> ],
  ['Total Campaigns', <?php echo $campaign_count; ?>],
  ['Campaigns Sent', <?php echo $campaign_sent; ?>],
  ['Campaigns in Draft', <?php echo $campaign_draft; ?>]
]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'Email Campaigns', 'width':550, 'height':400};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Monthly', 'Delivered'],
          @foreach($campaign_chart  as $val)
            ['@php echo $val->month; @endphp',  @php echo $val->total_campaign; @endphp],
          @endforeach
          
        ]);

        var options = {
          title: 'Email Campaigns',
          curveType: 'function',
          legend: { position: 'bottom' },
          width:550,
          height:400
        };

        var chart = new google.visualization.LineChart(document.getElementById('line_top_x'));

        chart.draw(data, options);
      }
    </script>
</head>
<body>


@endsection
@extends('admin.layouts.app')
@section('site_tile',auth()->user()->site_title)
@section('content')
{{-- <style type="text/css">
    .card-val{
        color: #000000 !important;
        font-size: 35px !important;
        font-weight: bolder !important;
        text-align: center !important;
    }
    
</style> --}}
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
{{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> --}}
<div class="page-wrapper">
    <!-- Bread crumb -->
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h3 class="text-primary">Detailed Campaign Status</h3> 
        </div>
    </div>
    @include('admin/partials/error')
    @include('admin/partials/success')
    @include('admin/partials/session-error')
    <div id="error-div"></div>
    <div class="container-fluid">
        <div class="row page-inner dash-count">
            <div class="col-lg-3 col-md-6  col-sm-12">
                <div class="card">
                    <div class="data-inner">
                        <p class="lead text-primary">
                                <i class="fa fa-users" aria-hidden="true"></i> No. of Users</p>
                        <p class="card-val">{{$user_count!=''?$user_count:'0'}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6  col-sm-12">
                <div class="card">
                    
                    <div class="data-inner">
                        <p class="lead text-primary">
                                <i class="fa fa-bitcoin" aria-hidden="true"></i> Total Mails Delivered</p>
                        <p class="card-val">{{$delivered_count!=''?$delivered_count:'0'}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6  col-sm-12">
                <div class="card">
                    <div class="data-inner">
                        <p class="lead text-primary">
                                <i class="fa fa-money" aria-hidden="true"></i> Total Mails Not Sent</p>
                        <p class="card-val">{{$rejected_count!=''?$rejected_count:'0'}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6  col-sm-12">
                <div class="card">
                    <div class="data-inner">
                        <p class="lead text-primary">
                                <i class="fa fa-money" aria-hidden="true"></i>  Mails Un-Subscribed</p>
                        <p class="card-val">{{$failed_count!=''?$failed_count:'0'}}</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="row">
                    <div class="col-md-6">
                        <div id="columnchart_values" style="width: 900px; height: 300px;"></div>
                    </div>
                    <div class="col-md-6">
                        <div id="piechart"></div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                    <div class="card-title">
                        <h4>Detailed Campaign Status</h4>
                        <button type="button" class="pull-right btn btn-sm btn-info" data-toggle="modal" style="float:right;" data-target="#myModal">View Mail Content</button>
                    </div>
                    
                   <div class="card-body">
                     @include('admin.partials.table-heading')
                    <div class="table-responsive m-t-40">
                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>S No</th>
                                        <th>Date</th>
                                        <th>Mail ID</th>
                                        <th>Subject</th>
                                        <th>Status</th>
                                       
                                    </tr>
                                </thead>
                                <tfoot>
                                     <tr>
                                        <th>S No</th>
                                        <th>Date</th>
                                        <th>Mail ID</th>
                                        <th>Subject</th>
                                        <th>Status</th>
                                        
                                    </tr>
                                </tfoot>
                                <tbody>
                                    
                                    @for($i=0;$i<count($final);$i++)
                                        @if($final[$i]['event'] != "accepted")
                                            <tr>
                                                <td>{{$i+1}}</td>
                                                <td>{{$final[$i]['date']}}</td>
                                                <td>{{$final[$i]['recipient']}}</td>
                                                <td>{{$final[$i]['subject']}}</td>
                                                <td>
                                                    @if($final[$i]['event'] == "delivered")
                                                        <span class="label label-success">Delivered</span>
                                                    @endif
                                                    @if($final[$i]['event'] == "rejected")
                                                        <span class="label label-danger">Not Sent</span>
                                                    @endif
                                                    @if($final[$i]['event'] == "failed")
                                                        <span class="label label-info">Un-Subscribed</span>
                                                    @endif
                                                    
                                                </td>
                                            </tr>
                                        @endif
                                    @endfor
                                </tbody>
                            </table>
                        </div>
            </div>
            </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Mail Content</h4>
        </div>
        <div class="modal-body">
          <p>@php echo htmlspecialchars_decode($mail_content); @endphp</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-success" data-dismiss="modal">Close</button>
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
  ['Total Mails Not Sent', <?php echo $rejected_count; ?>],
  ['Total Mails Un-Subscribed', <?php echo $failed_count; ?>],
  ['Total Mails Delivered', <?php echo $delivered_count; ?>]
]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'Detailed Campaign Status', 'width':550, 'height':400};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script>

<script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Count", { role: "style" } ],
        ["Total  No. of Users", <?php echo $user_count; ?>, "#1264e8"],
        ["Total Mails Delivered",<?php echo $delivered_count; ?>, "#ed7308"],
        ["Total Mails Un-Subscribed", <?php echo $failed_count; ?>, "#08ede5"],
        ["Total Mails Not Sent", <?php echo $rejected_count; ?>, "#ed3309"],
        ["Total Mails Bounced", 0, "#109617"]
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Email Campaigns",
        width: 600,
        height: 400,
        bar: {groupWidth: "50%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }
  </script>

@endsection
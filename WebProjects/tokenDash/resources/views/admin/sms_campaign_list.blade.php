@extends('admin.layouts.app')
@section('site_tile',auth()->user()->site_title)
@section('content')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div class="page-wrapper">
    <!-- Bread crumb -->
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h3 class="text-primary">SMS Campaigns</h3> 
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
                            <h4>Total no. of Users: <p>Total number of users who are registered on the site that you can send SMS campaigns to.</p></h4>
                            <h4>Total Campaigns: <p>Total SMS campaigns that are sent. </p></h4>
                            <h4>Campaigns Sent: <p>Total number of Successful SMS campaigns sent.</p></h4>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                      
                    </div>
                  </div>
            </div>
            <div class="col-lg-4 col-md-8  col-sm-12">
                <div class="card">
                    <div class="data-inner">
                        <p class="lead text-primary">
                                <i class="fa fa-users" aria-hidden="true"></i> No. of Users</p>
                        <p>{{$user_count}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-8  col-sm-12">
                <div class="card">
                    <div class="data-inner">
                        <p class="lead text-primary">
                                <i class="fa fa-money" aria-hidden="true"></i> Total Campaigns</p>
                        <p>{{$campaign_count}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-8 col-sm-12">
                <div class="card">
                    
                    <div class="data-inner">
                        <p class="lead text-primary">
                                <i class="fa fa-bitcoin" aria-hidden="true"></i> Campaigns Sent</p>
                        <p>{{$campaign_sent}}</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-12 col-md-12 col-sm-12">
                <center>
                    <div id="piechart"></div>
                </center>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                    <div class="card-title">
                        <h4>SMS Campaigns</h4>
                        <p>View all the campaigns that you've sent, their status and their reports here.</p>
                    </div>
                   <div class="card-body">
                    <div class="table-responsive m-t-40">
                         @include('admin.partials.table-heading')
                        <input type="hidden" id="export_columns" value="0,1,2,3,4"/>
                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>S No</th>
                                        <th>Date</th>
                                        <th>Message Content</th>
                                        <th>User Count</th>
                                        <th>Numbers</th>
                                        
                                    </tr>
                                </thead>
                                <tfoot>
                                     <tr>
                                        <th>S No</th>
                                        <th>Date</th>
                                        <th>Message Content</th>
                                        <th>User Count</th>
                                        <th>Numbers</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($msg as $key=>$val)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{date("d-m-Y",strtotime($val->created_at))}}</td>
                                        <td>@php echo htmlspecialchars_decode($val->message_content); @endphp</td>
                                        <td>{{$val->user_count}}</td>
                                        <td>{{$val->numbers}}</td>
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
  ['SMS Campaigns', 'Day Status'],
  ['Total  No. of Users', <?php echo $user_count; ?> ],
  ['Total Campaigns', <?php echo $campaign_count; ?>],
  ['Campaigns Sent', <?php echo $campaign_sent; ?>]
  ]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'SMS Campaigns', 'width':550, 'height':400};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script>

@endsection
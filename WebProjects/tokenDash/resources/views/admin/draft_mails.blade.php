@extends('admin.layouts.app')
@section('site_tile',auth()->user()->site_title)
@section('content')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div class="page-wrapper">
    <!-- Bread crumb -->
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h3 class="text-primary">Email Campaign draft</h3> 
        </div>
    </div>
    @include('admin/partials/error')
    @include('admin/partials/success')
    @include('admin/partials/session-error')
    <div id="error-div"></div>
    <div class="container-fluid">
        <div class="row page-inner dash-count">
            
            <div class="col-lg-4 col-md-8  col-sm-12">
                <div class="card">
                    <div class="data-inner">
                        <p class="lead text-primary">
                                <i class="fa fa-money" aria-hidden="true"></i> Total Mails in Draft</p>
                        <p>{{$draft_count}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-8 col-sm-12">
                <div class="card">
                    
                    <div class="data-inner">
                        <p class="lead text-primary">
                                <i class="fa fa-bitcoin" aria-hidden="true"></i> Mails Sent</p>
                        <p>{{$mailnot_sent}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-8 col-sm-12">
                <div class="card">
                    <div class="data-inner">
                        <p class="lead text-primary">
                                <i class="fa fa-exchange" aria-hidden="true"></i> Mails Not Sent</p>
                        <p>{{$mail_sent}}</p>
                    </div>
                </div>
            </div>
           {{--  <div class="col-lg-12 col-md-12 col-sm-12">
                <center>
                    <div id="piechart"></div>
                </center>
            </div> --}}
            <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                    <div class="card-title">
                        <h4>Email Campaign draft</h4>
                        <p>View all the campaigns that you've sent, their status and their reports here.</p>
                    </div>
                   <div class="card-body">
                    <div class="table-responsive m-t-40">
                         @include('admin.partials.table-heading')
                            <input type="hidden" id="export_columns" value="0,1,2"/>
                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>S No</th>
                                        <th>Date</th>
                                        <th>Subject</th>
                                       {{--  <th>Mail Content</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                     <tr>
                                        <th>S No</th>
                                        <th>Date</th>
                                        <th>Subject</th>
                                        {{-- <th>Mail Content</th> --}}
                                        <th>Status</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($draft as $key=>$val)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{date("d-m-Y",strtotime($val->created_at))}}</td>
                                        <td>{{$val->subject}}</td>
                                        {{-- <td>@php echo htmlspecialchars_decode($val->mail_content); @endphp</td> --}}
                                        <td>
                                            <a href="{{route('admin.delete_draft_mail',$val->id)}}"><button class="btn btn-sm btn-danger"> Delete</button></a>
                                            <a href="{{route('admin.get_draft_mail',$val->id)}}"><button class="btn btn-sm btn-success"> Send Mail</button></a>
                                        </td>
                                        {{-- <td><a href="{{ route('admin.get_mail_details', $val->subject) }}"><button type="button" class="btn btn-sm btn-info" >View</button></a></td> --}}
                                    
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
  ['Total  Draft Mails', <?php echo $draft_count; ?> ],
  ['Mails Not Sent', <?php echo $mailnot_sent; ?>],
  ['Mails Sent', <?php echo $mail_sent; ?>]
]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'Email Campaigns', 'width':550, 'height':400};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script>

@endsection
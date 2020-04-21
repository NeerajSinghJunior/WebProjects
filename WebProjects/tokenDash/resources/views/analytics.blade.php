@extends('layouts.app')

@section('htmlheader_title')
    My Analytics
@endsection

@section('contentheader_title')
     My Analytics
@endsection

@section('main-content')
    @include('admin/partials/error')
    @include('admin/partials/success')
    <div id="error-div" style="display:none;">
        <div class="alert alert-danger alert-dismissible">
            <ul>
                <li>
                    <p id="error_text"></p>
                </li>
            </ul>
        </div>
    </div>
    <section class="content">
   
     <p class="lead">Analytics Of Token Purchases</p>
     <div class="card">
            <div class="card-content">
               <!--   <div class="wait" >
               <p>
               <center><img src="https://cdn-images-1.medium.com/max/800/0*4Gzjgh9Y7Gu8KEtZ.gif" style="min-width: 400px; width: 400px; margin: 100px" /> </center>
               </p>
            </div> -->
             <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="box box-primary">
             <div id="container" style="min-width: 410px; height: 400px; max-width: 7   00px; margin: 0 auto"></div>
         </div>
     </div>
             
             <center>Last 10 Months</center>
            </div>
          </div>




</section>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
 var url="{{URL('/')}}/get-token-data";
        console.log(url);
        var temp=[];
        var n_chart_data=[];
        $.ajax({
        type:'GET',
        url:url,
        success:function(data) {  
        console.log("Request = ",data); 
        
        data.forEach(function(element) {
                console.log(element.created_at);
                    var dateString = element.created_at,
                    dateTimeParts = dateString.split(' '),
                    timeParts = dateTimeParts[1].split(':'),
                    dateParts = dateTimeParts[0].split('-'),
                    date;

                date = new Date(dateParts[2], parseInt(dateParts[1], 10) - 1, dateParts[0], timeParts[0], timeParts[1]);

                var newDate=Math.abs(date.getTime()); //1379426880000
                console.log(newDate);
                      
                n_chart_data.push([
                 newDate,parseFloat(element.coins)]);
                
        });

         Highcharts.chart('container', {
      chart: {
        zoomType: 'x'
      },
      title: {
        text: 'Analytics Of Token Purchases'
      },
      subtitle: {
        text: document.ontouchstart === undefined ?
            '' : ''
      },
      xAxis: {
        type: 'datetime'
      },
      yAxis: {
        title: {
          text: 'No of Coins'
        }
      },
      legend: {
        enabled: false
      },
      plotOptions: {
        area: {
          fillColor: {
            linearGradient: {
              x1: 0,
              y1: 0,
              x2: 0,
              y2: 1
            },
            stops: [
              [0, Highcharts.getOptions().colors[0]],
              [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
            ]
          },
          marker: {
            radius: 2
          },
          lineWidth: 1,
          states: {
            hover: {
              lineWidth: 1
            }
          },
          threshold: null
        }
      },

      series: [{
        type: 'area',
        name: 'Coins',
        data: n_chart_data
      }]
    });

        // n_chart_data=new Array(temp);
        console.log(JSON.stringify(n_chart_data));
          },
        error:function(err) {
           // alert('Something went wrong. Please check.')
           }
     });

  

   
  });
</script>
@endsection



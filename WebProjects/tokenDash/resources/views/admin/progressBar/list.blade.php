@extends('admin.layouts.app')
@section('site_tile',auth()->user()->site_title)
@section('content')



<style type="text/css">
    .input-icon {
  position: relative;
}

.input-icon > i {
  position: absolute;
  display: block;
  transform: translate(0, -50%);
  top: 50%;
  pointer-events: none;
  width: 25px;
  text-align: center;
    font-style: normal;
}

.input-icon > input {
  padding-left: 25px;
    padding-right: 0;
}

.input-icon-right > i {
  right: 0;
}

.input-icon-right > input {
  padding-left: 0;
  padding-right: 25px;
  /*text-align: right;*/
}

</style>
<div class="page-wrapper">
    <!-- Bread crumb -->
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h3 class="text-primary">Token Offering Status Bar</h3> </div>
    </div>
    <!-- End Bread crumb -->
    <!-- Container fluid  -->
    <div class="container-fluid">
            @include('admin/partials/error')
            @include('admin/partials/success')
            @include('admin/partials/session-error')
            <div>  
                    <div class="card">
                        <div class="card-title">
                            <h4>@if(!$bar) Add @else Edit @endif an Token Offering Status</h4>
                        </div>
                        
                        <div class="card-body">
                                <p>- The statuses you add here are displayed on the User dashboard. You can display your Project goal, Roadmap, the Token Offering status or any event</p>
                                <p>- Once an event / step / goal is completed, mark as achieved, to display it as a completed item on the User dashboard.</p>
                                <p>- Optional,(Price change event) you can configure the token's price to automatically take effect on different dates. The token price will change on the dates mentioned here and will stay the same till another price change event starts on a future date.</p>
                                <p>- The latest price set here will override the default price you set under the system setting. </p>
                                <p>- Additionally, you can choose to notify your users before the price increase. The system will start notifying the user before the 'X' number of days you specify.</p>

                            <div class="basic-form">
                                <form role="form"  action="{{!$bar ? route('admin.storeProgressBar') : route('admin.updateProgressBar', $bar->id) }}" method="POST" autocomplete="off">
                                    @csrf
                                    <div class="form-group">
                                        <label>Token Offering event Title</label>
                                        <input type="text" name="title" value="{{old('title', $bar ? $bar->title :'')}}" class="form-control" placeholder=" Enter the title of your Token Offering event">
                                    </div>
                                    <div class="form-group">
                                        <label>Hints</label>
                                        <input type="text" name="hint" value="{{old('hint', $bar ? $bar->hint : '')}}" class="form-control" placeholder=" Enter a hint to display, when a user places the mouse pointer over an Token Offering status">
                                    </div>

                                    <div class="form-group">
                                        <label>Token Price (Optional)</label>
                                         <div class="input-icon">
                                        <input type="number" name="token_price" min='0' value="{{old('token_price', $bar ? $bar->token_price :' ')}}" class="form-control"  placeholder="Enter the new token price that will take effect on the dates selected below." >
                                       <i class="fa fa-usd" aria-hidden="true"></i>
                                    </div>
                                    </div>
                                
                                    <div class="form-group">
                                        <label>Start date of the Token event</label>
                                        <input type="text" name="progress_bar_date" id="from_date_fld" value="{{old('progress_bar_date', $bar ?$bar->progress_bar_date: '')}}" class="form-control" placeholder=" Start date of the token event (Enter in this format: YYYY/MM/DD)" autocomplete="off">
                                    </div>

                                    
                                    {{--  <div class="form-group">
                                        <label><input type="checkbox" name="is_completed" @if($bar && $bar->is_completed === 1) checked @endif value="1" class="form-control">Mark as Achieved
                                    </label>
                                    </div>  --}}

                                    <div class="form-group">
                                        <label>Notify users of the Price change before a certain number of days (Optional)</label>
                                        <input type="number" style="width: 80%;float: left" name="notify_before" min="0"  value="{{old('notify_before', $bar ? $bar->notify_before :' ')}}" class="form-control"  placeholder="Enter the number of days in advance the users should be notified of the price change." >
                                         
                                    </div>
                                    <span  style="margin-top: 15px;font-size: 15px">&nbsp;&nbsp;<b>Days</b></span>

                                    <div class="checkbox pb-list">
                                        <label><input type="checkbox" name="is_completed" @if($bar && $bar->is_completed === 1) checked @endif value="1" >&nbsp; Mark as Achieved</label>
                                    </div>
                                    <button type="submit" class="btn btn-success pull-right">@if(!$bar) Add @else Update @endif Status</button>
                                </form>
                            </div>
                        </div>
                    </div> 
                  

        <!-- Start Page Content -->
        <div>  
            <div class="card">
                <div class="card-title">
                    <h4>Active Token Offering Statuses</h4>
                    <a class="btn btn-primary pull-right" href="{{route('admin.viewAllProgressBar')}}">Add</a>
                    <p>All your active Token Offering statuses are displayed here. Edit or delete them here. </p>
                </div>
                <div class="card-body">
                    <div class="basic-form ico-s-b">
                        <table class="table">
                            <thead>
                                <th>Title</th>
                                <th>Link</th>
                                <th>Start Date</th>
                                <th>Token Price</th>
                                <th>Completed</th>
                                <th>Action</th>
                            </thead>
                            @foreach($progressBars as $key => $bars)
                            <tr>
                                <td>{{$bars->title}}</td>
                                <td>{{$bars->hint}}</td>
                                <td>{{$bars->progress_bar_date}}</td>
                                <td>{{$bars->coin_price}}</td>
                                <td>{{$bars->is_completed ? "Completed": "Not Completed"}}</td>
                                <td>
                                    <a onclick="deleteConfirmation({{$bars->id}})" href="#">Delete</a> | 
                                    <a href="{{route('admin.viewAllProgressBar')}}?id={{$bars->id}}">Edit</a>  
                                </td>
                            </tr>
                            @endforeach
                        </table>
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
<script>
  $('#from_date_fld').datetimepicker({
                closeOnDateSelect:true,
                 format:'Y-m-d',
                 timepicker:false,
                 minDate:new Date(), //yesterday is minimum date
               
            });
        </script>


@endsection

@section('extra-scripts')


 <script type="text/javascript">
   
        function deleteConfirmation(link) {
            ok = confirm('Are you sure to delete this page?');
            if(ok) window.location.href = '/admin/progressBar/delete/'+link;
            return false;
        }
    </script>
    
@endsection
@extends('admin.layouts.app') 
@section('site_tile',auth()->user()->site_title)
@section('content')
<script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
<script src="https://cdn.ckeditor.com/[version.number]/[distribution]/ckeditor.js"></script>



<div class="page-wrapper">
    <!-- Bread crumb -->
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h3 class="text-primary">Create a new Email Campaign </h3>
            
         </div>
    </div>
    <!-- End Bread crumb -->
    <!-- Container fluid  -->
    <div class="container-fluid">
        <!-- Start Page Content -->
        <div class="row page-inner">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-title">
                        <h4>Create a new Email Campaign </h4>
                        <p>Create and send a new email campaign to your users who have signed up on the platform. You can send to everyone or specifically to people who have purchased the tokens or those who haven't yet.</p>
                    </div>

                    @include('admin/partials/error')


                    @include('admin/partials/success')

                    <div class="card-body">
                        <div class="basic-form">
                            <form role="form"  action="{{ URL::to('admin/send_mail') }}" method="POST" autocomplete="off">
                                @csrf
                                <div class="form-group">
                                    <label>Send to </label>
                                    <select class="form-control" name="category"  onchange="showdates(this.value)" required="required">
                                       <option disabled selected>Choose a user group</option>
                                       <option value="1">All Users</option>
                                       <option value="2">Users who have purchased tokens</option>
                                       <option value="3">Users who haven't purchased tokens </option>
                                       <option value="4">Users who have purchased tokens within these dates</option>
                                    </select>
                                </div>
                               <div class="form-group" id="from_date" style="display: none;">
                                    <label>From Date</label>
                                     <input type="text" name="form_date" id="from_date_fld" class="form-control" autocomplete="off">
                                </div>
                                <div class="form-group" id="to_date" style="display: none;">
                                    <label>To Date</label>
                                    <input type="text" name="to_date" id="to_date_fld" class="form-control" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>Campaign subject line</label>
                                    <input type="text" name="subject" class="form-control" @if(isset($draft->subject)) value="{{$draft->subject}}" @endif required="required">
                                </div>

                                <div class="form-group">
                                    <label>Email Campaign content</label>
                                    <textarea name="message" class="form-control" placeholder="Message"> @if(isset($draft->mail_content)) {{$draft->mail_content}} @endif</textarea>
                                    <script>
                                        CKEDITOR.replace( 'message' );
                                    </script>
                                </div>
                                <input type="hidden" @if(isset($draft->subject)) value="{{$draft->id}}" @endif name="draft_id">
                                <button type="submit" class="btn btn-success" id="send">Send</button>
                                <button type="submit" class="btn btn-primary" value="1" name="draft" id="draft">Save as Draft</button>
                                <button type="button" class="btn btn-info" id="schedule_mail" onclick="schedule()">Schedule Mail</button>

                                <div class="form-group" id="sch_date" style="display: none;">
                                    <label>Date</label>
                                    <input type="text"  name="scheduled_date" class="form-control" min="" id="sch_date_field" autocomplete="off">
                                </div>
                                <button type="submit" class="btn btn-success" id="save_changes" style="display: none;">Save Changes</button>
                                <button type="button" class="btn btn-info" id="close" style="display: none;" onclick="showall()">Close</button>
                                <a href="{{ route('admin.mail_events') }}"><button type="button" class="btn btn-danger" id="cancel">Cancel</button></a>
                            </form>
                        </div>
                    </div>
                </div>

               {{--  <div class="card">
                    <div class="card-title">
                        <h4>All Notifications</h4>
                    </div>
                    <div class="card-body">
                         @include('admin.partials.table-heading')
                        <div class="table-responsive">
                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>

                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Date</th>
                                        <th>Actions</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>

                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Date</th>
                                        <th>Actions</th>

                                    </tr>
                                </tfoot>
                                <tbody>

                                @foreach($notifications as $key => $notification)

                                    <tr>

                                        <th>{{ $key+1 }}</th>
                                        <th>{{ $notification->title }}</th>
                                        <th>{{ $notification->description }}
                                        <th>{{ $notification->created_at->toDateTimeString() }}</th>
                                        <th><a href="{{ URL::to('admin/delete_notification/'.$notification->id) }}" onclick=" return confirm('Are you sure')" class="btn btn-danger">Delete</a></th>

                                    </tr>

                                    @endforeach

                                </tbody>

                            </table>
                        </div>

                    </div>
                </div> --}}


            </div>
            <!-- /# column -->

        </div>
        <!-- End PAge Content -->
    </div>
    <!-- End Container fluid  -->
    <!-- footer -->   
     {{-- @include('layouts.partials.footer') --}}
    <!-- End footer -->
</div>

<script type="text/javascript">

    // $(document).ready(function() {
        //  $('#sch_date_field').datetimepicker({
        //     format: "dd MM yyyy - HH:ii P",
        // showMeridian: true,
        // autoclose: true,
        // todayBtn: true
        //  });

   $('#sch_date_field').datetimepicker({
                closeOnDateSelect:true,
                 format:'d-m-Y H:i',
                 timepicker:true,
                 minDate:new Date(), //yesterday is minimum date
               
            });

    $('#from_date_fld').datetimepicker({
                closeOnDateSelect:true,
                 format:'d-m-Y',
                 timepicker:false,
                 minDate:new Date(), //yesterday is minimum date
               
            });

     $('#to_date_fld').datetimepicker({
                closeOnDateSelect:true,
                 format:'d-m-Y',
                 timepicker:false,
                 minDate:new Date(), //yesterday is minimum date
               
            });


     // });

    function showdates(id) {
       if(id == 4){
            $("#from_date").show();
            $("#to_date").show();
       }else{
            $("#from_date").hide();
            $("#to_date").hide();
       }
    }

    function schedule() {

    // var today = new Date().toISOString().split('T')[0];
    // $("#sch_date_field").attr('min', today);
    // var dateControl = document.querySelector('input[type="datetime-local"]');
    // dateControl.value = today+'T09:00';

        $("#send").hide();
        $("#draft").hide();
        $("#schedule_mail").hide();
        $("#save_changes").show();
        $("#sch_date").show();
        $("#close").show();
        $("#cancel").hide();
       
    }
    function showall() {
        $("#send").show();
        $("#draft").show();
        $("#schedule_mail").show();
        $("#cancel").show();
        $("#sch_date").hide();
        $("#sch_date").hide();
        $("#save_changes").hide();
        $("#close").hide();

    // var dateControl = document.querySelector('input[type="datetime-local"]');
    // dateControl.value = "";
       
    }
</script>
@endsection
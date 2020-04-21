@extends('admin.layouts.app') 
@section('site_tile',auth()->user()->site_title)
@section('content')
<script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
<script src="https://cdn.ckeditor.com/[version.number]/[distribution]/ckeditor.js"></script>
<div class="page-wrapper">
    <!-- Bread crumb -->
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h3 class="text-primary">Create a new SMS Campaign </h3> </div>
    </div>
    <!-- End Bread crumb -->
    <!-- Container fluid  -->
    <div class="container-fluid">
        <!-- Start Page Content -->
        <div class="row page-inner">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-title">
                        <h4>Create a new SMS Campaign </h4>
                        <p> Create and send a new SMS campaign to your users who have signed up on the platform. You can send to everyone or specifically to people who have purchased the tokens or those who haven't yet.</p>
                    </div>

                    @include('admin/partials/error')


                    @include('admin/partials/success')

                    <div class="card-body">
                        <div class="basic-form">
                            <form role="form"  action="{{ URL::to('admin/send_message') }}" method="POST" autocomplete="off">
                                @csrf
                                <div class="form-group">
                                    <label>Send to</label>
                                    <select class="form-control" name="category"  onchange="showdates(this.value)" required="required">
                                       <option value="0">Choose a user group</option>
                                       <option value="1">All Users</option>
                                       <option value="2">To Users who purchased token</option>
                                       <option value="3">To Users who haven't purchased token</option>
                                       <option value="4">To Users who purchased token within the dates</option>
                                    </select>
                                </div>
                                <div class="form-group" id="from_date" style="display: none;">
                                    <label>From Date</label>
                                     <input type="text" name="form_date" id="from_date_fld" class="form-control" autocomplete="off">
                                </div>
                                <div class="form-group" id="to_date" style="display: none;">
                                    <label>To Date</label>
                                    <input type="text" name="to_date"  id="to_date_fld" class="form-control" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>SMS Campaign content</label>
                                    <textarea name="message" class="form-control" placeholder="Message"></textarea>
                                    <script>
                                        CKEDITOR.replace( 'message' );
                                    </script>
                                </div>
                                <button type="submit" class="btn btn-success">Send</button>
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

    $('#from_date_fld').datetimepicker({
                closeOnDateSelect:true,
                 format:'d-m-Y H:i',
                 timepicker:false,
                 minDate:new Date(), //yesterday is minimum date
               
            });

    $('#to_date_fld').datetimepicker({
                closeOnDateSelect:true,
                 format:'d-m-Y',
                 timepicker:false,
                 minDate:new Date(), //yesterday is minimum date
               
            });


    function showdates(id) {
       if(id == 4){
            $("#from_date").show();
            $("#to_date").show();
       }else{
            $("#from_date").hide();
            $("#to_date").hide();
       }
    }
</script>
@endsection
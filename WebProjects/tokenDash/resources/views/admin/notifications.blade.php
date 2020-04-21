@extends('admin.layouts.app') 
@section('site_tile',auth()->user()->site_title)
@section('content')
<div class="page-wrapper">
    <!-- Bread crumb -->
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h3 class="text-primary">Notifications</h3> </div>
    </div>
    <!-- End Bread crumb -->
    <!-- Container fluid  -->
    <div class="container-fluid">
        <!-- Start Page Content -->
        <div class="row page-inner">
            <div class="col-lg-12">
                @include('admin/partials/error')
                @include('admin/partials/success')
                <div class="card">
                    <div class="card-title">
                        <h4>New Notification</h4>
                        <p>Notifications are an important way to keep your users informed about important events. </p>
                        <p>Create and manage notifcations that would be sent to your user's on their dashboard.</p>
                        <p>All the past notifications would be available for the users to see under their notifications tab.</p>


                    <div class="card-body">
                        <div class="basic-form">
                            <form role="form"  action="{{ URL::to('admin/add_notification') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control" placeholder="Title" value="">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" placeholder="Description"></textarea>
                                </div>
                                <button type="submit" class="btn btn-success">Send</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-title">
                        <h4>All Notifications</h4>
                    </div>
                    <div class="card-body">
                         @include('admin.partials.table-heading')
                        <div class="table-responsive">
                            <input type="hidden" id="export_columns" value="0,1,2,3"/>
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
                </div>


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
@endsection
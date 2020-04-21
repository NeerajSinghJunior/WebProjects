@extends('admin.layouts.app')

@section('content')
<div class="page-wrapper">
    <!-- Bread crumb -->
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h3 class="text-primary">Users</h3>
        </div>
    </div>
   
    @include('admin/partials/error')
    @include('admin/partials/success')
    <!-- End Bread crumb -->
    <!-- Container fluid  -->
    <div class="container-fluid">
        <!-- Start Page Content -->
        <div class="row page-inner">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">User Details</h4>
                        <p>All your users details are displayed here. View their Know Your Customer (KYC) documentation, email and phone numbers</p> 
                     
                        <div class="table-responsive m-t-40">
                             @include('admin.partials.table-heading')
                            <input type="hidden" id="export_columns" value="0,1,2,3"/>
                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($Users as $key => $User)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $User->name }}</td>
                                        <td>{{ $User->email }}</td>
                                        <td>{{ $User->phone }}</td>
                                        <td>
                                            <a href="{{ URL::to('admin/delete_user/'.$User->id) }}" onclick="return confirm('Are you Sure')" class="label label-danger">Delete</a>
                                            <a href="{{ route('admin.user_details',$User->id) }}"class="label label-primary">View</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- End PAge Content -->
    </div>
    <!-- End Container fluid  -->
    <!-- footer -->    
    @include('layouts.partials.footer')
    <!-- End footer -->
</div>
@endsection
@extends('layouts.app')

@section('htmlheader_title')
    Account
@endsection

@section('contentheader_title')
    Account Details
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
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="box box-primary">
                <form role="form" action="{{ url('account') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="box-body acc-bb-a">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter the First Name" value="">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter the Email" value="">
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" name="phone" class="form-control" placeholder="Enter the Phone Number" value="">
                        </div>

                        <div class="form-group">
                            <label>Profile Picture</label>
                            <input type="file" name="profile_picture" >
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-block btn-sm">Save</button>
                    </div>
                </form>
            </div>
        </div>
       
</section>
@endsection




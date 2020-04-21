@extends('admin.layouts.app')
@section('site_tile',auth()->user()->site_title)
@section('content')
<div class="page-wrapper">
    <!-- Bread crumb -->
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h3 class="text-primary">Add Footer Menu‌</h3> </div>
    </div>
    <!-- End Bread crumb -->
    <!-- Container fluid  -->
    <div class="container-fluid">
        <!-- Start Page Content -->
        <div>  
            <div class="card">
                <div class="card-title">
                    <h4>Add Footer Menu‌</h4>
                </div>
                <div class="card-body">
                    @include('admin/partials/error')
                    @include('admin/partials/success')
                    @include('admin/partials/session-error')
                    <div class="basic-form">
                        <form role="form"  action="{{ route('admin.storeCms') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" value="{{old('title')}}" class="form-control" placeholder="Enter the title of the page." value="">
                            </div>
                            <div class="form-group">
                                <label>Link</label>
                                <input type="text" name="link" value="{{old('link')}}" class="form-control" placeholder="Enter the Link of the page." value="">
                            </div>
                            <button type="submit" class="btn btn-success">Add</button>
                            <a href="{{route('admin.viewAllCms')}}" class="btn btn-success">Goto List</a>
                        </form>
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
@endsection
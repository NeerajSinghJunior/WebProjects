@extends('admin.layouts.app')
@section('site_tile',auth()->user()->site_title)
@section('content')
<div class="page-wrapper">
    <!-- Bread crumb -->
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h3 class="text-primary">Footer Menu‌</h3> </div>
    </div>
    <!-- End Bread crumb -->
    <!-- Container fluid  -->
    <div class="container-fluid">
        <!-- Start Page Content -->
        <div>  
            <div class="card">
                <div class="card-title">
                    <h4>Footer Menu‌</h4>
                    <p>Create and add footer links that will show up on the dashboard.</p>
                    <a class="btn btn-primary pull-right" href="{{route('admin.addCms')}}">Add</a>
                </div>
                <div class="card-body">
                    @include('admin/partials/error')
                    @include('admin/partials/success')
                    @include('admin/partials/session-error')
                    <div class="basic-form">
                        <table class="table">
                            <thead>
                                <th>Title</th>
                                <th>Link</th>
                                <th>Action</th>
                            </thead>
                            @foreach($pages as $key => $page)
                            <tr>
                                <td>{{$page->title}}</td>
                                <td>{{$page->link}}</td>
                                <td>
                                    <a onclick="deleteConfirmation({{$page->id}})" href="#">Delete</a> | 
                                    <a href="{{route('admin.editCmsForm', $page->id)}}">Edit</a>  
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
@endsection
@section('extra-scripts')
    <script>
        function deleteConfirmation(link) {
            ok = confirm('Are you sure to delete this page?');
            if(ok) window.location.href = '/admin/cms/delete/'+link;
            return false;
        }
    </script>
@endsection
@extends('admin.layouts.app') 
@section('site_tile',auth()->user()->site_title)
@section('content')
<div class="page-wrapper">
    <!-- Bread crumb -->
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h3 class="text-primary">Bank Code Master</h3> </div>
    </div>
    <!-- End Bread crumb -->
    <!-- Container fluid  -->
    <div class="container-fluid">
        <!-- Start Page Content -->
        @include('admin/partials/error')
        @include('admin/partials/success')
        <div class="row page-inner">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-title">
                        <h4>Add New Bank Code</h4>
                        <p>Here you can create new bank code.</p>                        


                    <div class="card-body">
                        <div class="basic-form">
                            <form role="form"  action="{{ URL::to('admin/add_bank_code') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Bank Code</label>
                                    <input type="text" name="bank_code" class="form-control" placeholder="Bank Code" value="{{isset($master_edit->bank_code)?$master_edit->bank_code:''}}">
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control" id="status">
                                      <option value="1"  selected>Active</option>
                                      <option value="2">Inactive</option>
                                    </select>
                                </div>
                                <input type="hidden" value="{{isset($master_edit->id)?$master_edit->id:''}}" name="update_id"/> 
                                @if(isset($master_edit->bank_code))
                                <button type="button" class="btn btn-danger" onclick="window.location.href='{{url('admin/BankCodeMaster')}}'">Cancel</button>
                                <button type="submit" class="btn btn-success">Update</button>
                                @else
                                <button type="submit" class="btn btn-success">Add</button>
                                <button type="button" class="btn btn-info" onclick="window.location.href='{{route('admin.account')}}'">Back to settings</button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-title">
                        <h4>All Bank Codes</h4>
                    </div>
                    <div class="card-body">
                         @include('admin.partials.table-heading')
                        <div class="table-responsive">
                            <input type="hidden" id="export_columns" value="0,1,2,3"/>
                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Bank Code</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Bank Code</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                @if(count($masters)>0)
                                @foreach($masters as $key => $master)
                                <tr>
                                    <th>{{ $key+1 }}</th>
                                    <th>{{ $master->bank_code }}</th>
                                    @if($master->status==1)
                                    <th>Active</th>
                                    @else
                                    <th>Inactive</th>
                                    @endif
                                    <th>
                                      <a href="{{ URL::to('admin/edit_bankcode/'.$master->id) }}" class="btn btn-warning">Edit</a>&nbsp;
                                      <a href="{{ URL::to('admin/delete_bankcode/'.$master->id) }}" onclick=" return confirm('Are you sure')" class="btn btn-danger">Delete</a>
                                    </th>
                                </tr>
                                @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>


  $('#status').val('{{isset($master_edit->status)?$master_edit->status:1}}');
  </script>
@endsection
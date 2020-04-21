@extends('admin.layouts.app')

@section('content')
<div class="page-wrapper">
    <!-- Bread crumb -->
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h3 class="text-primary">Users</h3> </div>
        
    </div>
    <!-- End Bread crumb -->
    <!-- Container fluid  -->
    <div class="container-fluid">
        <!-- Start Page Content -->
        <div class="row page-inner">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">User Details</h4>
                        <div class="table-responsive m-t-40">
                            <table class="user-show">
                                    <tr>
                                            <td>Name</td>
                                            <td>{{$user->name}}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>{{$user->email}}</td>
                                        </tr>
                                        <tr>
                                            <td>Phone Number</td>
                                            <td>{{$user->phone}}</td>
                                        </tr>
                                        <tr>
                                            <td>Address Proof.</td>
                                            <td>
                                                @if($user->address_proof)
                                                    Click <a href="{{asset($user->address_proof)}}" target="_blank" class="text-primary"><u>Here</u></a> to view.
                                                @else
                                                    Not Uploaded
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>ID Proof.</td>
                                            <td>
                                                    @if($user->id_proof)
                                                    Click <a href="{{asset($user->id_proof)}}" target="_blank" class="text-primary"><u>Here</u></a> to view.
                                                @else
                                                    Not Uploaded
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Address Proof.</td>
                                            <td>
                                                    @if($user->photo_proof)
                                                    Click <a href="{{asset($user->photo_proof)}}" target="_blank" class="text-primary"><u>Here</u></a> to view.
                                                @else
                                                    Not Uploaded
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <a href="{{route('admin.DividendPayouts')}}" class="btn btn-sm btn-info pull-right">Goto Dividend Payout List</a>
                                            </td>
                                        </tr>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- End PAge Content -->
    </div>
    <!-- End Container fluid  -->
    <!-- footer -->    @include('layouts.partials.footer')
    <!-- End footer -->
</div>
@endsection
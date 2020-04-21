@extends('admin.layouts.auth')

@section('extra-styles')

    <style>

        .alert-success2{
            background-color: #bdeabd;
            margin-top: 5px;
        }
        .panel-heading.text-center{
            font-size: 20px;
            color: #000;
            font-weight: 600;
            margin-bottom: 1em;
        }


        .panel-body label{
            text-transform: capitalize;
        }

    </style>

    @endsection


@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading text-center">Reset Password</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success2">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/password/email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">E-Mail Address</label>

                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <div class="">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

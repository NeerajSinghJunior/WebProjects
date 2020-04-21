@extends('layouts.app') @section('htmlheader_title') KYC / AML Submission @endsection @section('contentheader_title') KYC / AML Submission @endsection @section('main-content')
<div class="col-md-12 sub-title-head">
    <p>We are required to collect your KYC & AML documents for verification purposes. Thank you for the cooperation.</p>
</div>
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
    @include('admin/partials/error') @include('admin/partials/success')
    <div class="row">
    
        <div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
            <div class="box box-primary">
                <form role="form" action="{{ route('update_kyc_details') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group address-group">
                            <label class="big">Address Proof</label>
                            <input type="file" id="address_proof" name="address_proof" @if(auth()->user()->address_proof) value="{{ auth()->user()->address_proof }}"@endif> @if(auth()->user()->address_proof)
                            <p>Click <a target="_blank" href="{{auth()->user()->address_proof}}">HERE</a> to view</p>
                            @endif
                        </div>
                        <div class="form-group id-proof-group">
                            <label class="big">Id Proof</label>
                            <input type="file" id="id_proof" name="id_proof" @if(auth()->user()->id_proof) value="{{ auth()->user()->id_proof }}"@endif> @if(auth()->user()->id_proof)
                            <p>Click <a target="_blank" href="{{auth()->user()->id_proof}}">HERE</a> to view</p>
                            @endif
                        </div>
                        <div class="form-group photo-proof-group">
                            <label class="big">Photo Proof</label>
                            <p><strong>Note :</strong> Please make sure that you upload a High Resolution image. Your face should also be visible clear and the details in the ID proof should also be very easily readble.</p>
                            <img src="{{ asset('img/id-card.png') }}">
                            <input type="file" id="photo_proof" name="photo_proof" @if(auth()->user()->photo_proof) value="{{ auth()->user()->photo_proof }}"@endif> @if(auth()->user()->photo_proof)
                            <p>Click <a target="_blank" href="{{auth()->user()->photo_proof}}">HERE</a> to view</p>
                            @endif
                        </div>
                    </div>
                    <div class="box-footer">
                        <button id="save-button" type="submit" class="btn btn-primary btn-block btn-sm">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
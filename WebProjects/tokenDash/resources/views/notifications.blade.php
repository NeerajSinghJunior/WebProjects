@extends('layouts.app') @section('htmlheader_title') Notifications @endsection @section('contentheader_title')Notifications: @endsection @section('styles')

@endsection @section('main-content')
<div class="col-md-12 sub-title-head"><p>Following are the list of all the notifications issued so far for this Token Offering. Please checkout each one of them, so you understand what has been happening so far.
New notifications will come as a Pop-up in this dashboard, as soon as it is issued. Thanks!</p></div>
<section class="content ">
    <div class="row notifications">
@foreach($notifications as $notification)
        <div class="col-md-12">
            <div class="callout callout-info">
                <h4><i class="fa fa-bell"></i> {{ $notification->title }}</h4>
                <p>{{ $notification->description }}</p>
            </div>
        </div>
@endforeach
    </div>
</section>
{{--<div class="row">--}}
    {{--<div class="col-md-12 text-right">--}}
        {{--<ul class="pagination">--}}
            {{--<li class="paginate_button previous disabled"><a href="#">Previous</a></li>--}}
            {{--<li class="paginate_button active"><a href="#">1</a></li>--}}
            {{--<li class="paginate_button "><a href="#">2</a></li>--}}
            {{--<li class="paginate_button "><a href="#">3</a></li>--}}
            {{--<li class="paginate_button "><a href="#">4</a></li>--}}
            {{--<li class="paginate_button "><a href="#">5</a></li>--}}
            {{--<li class="paginate_button "><a href="#">6</a></li>--}}
            {{--<li class="paginate_button next"><a href="#">Next</a></li>--}}
        {{--</ul>--}}
    {{--</div>--}}
{{--</div>--}}
@endsection
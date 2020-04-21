@php 
    $settings = DB::table('admins')->select('site_title', 'site_logo', 'fav_ico', 'chat_script', 'analytics_script')->first(); 
    $pages = DB::table('cms')->where('status', 1)->get();
@endphp
<!-- Main Footer -->
</div>
<footer class="main-footer">
    <!-- Default to the left -->
    <div class="row">
        
        <div class="col-md-12 col-sm-12 col-xs-12 footer-link">
            <ul>
                @foreach( $pages as $page)
                    <li><a href="{{ $page->link}}" target="_blank">{{ $page->title}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</footer>
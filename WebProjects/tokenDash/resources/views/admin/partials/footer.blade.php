@php
    $settings = DB::table('admins')->select('site_title', 'site_logo', 'fav_ico')->first();
@endphp
<!-- Main Footer -->
<footer class="main-footer">
    <!-- Default to the left -->
    <strong>{{ $settings->site_title }}</strong>
</footer>

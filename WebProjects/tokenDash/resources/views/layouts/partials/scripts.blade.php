<!-- REQUIRED JS SCRIPTS -->
@php 
    $settings = DB::table('admins')->select('site_title', 'site_logo', 'fav_ico', 'chat_script', 'analytics_script')->first(); 
    $pages = DB::table('cms')->where('status', 1)->get();
@endphp
<!-- JQuery and bootstrap are required by Laravel 5.3 in resources/assets/js/bootstrap.js-->
<!-- Laravel App -->
{{--  <script src="{{ url (mix('/js/app.js')) }}" type="text/javascript"></script>  --}}

<script>

    {{--  App.start("{{ Auth::user()->ether}}");  --}}

</script>
<!--Start of Tawk.to Script-->
{!! $settings->chat_script !!}
{!! $settings->analytics_script !!}
<!--End of Tawk.to Script-->
<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. Slimscroll is required when using the
      fixed layout. -->

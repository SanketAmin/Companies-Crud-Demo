<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel Application') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <!-- Global stylesheets -->
    <link href="{{url('assets/fonts/inter/inter.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('assets/icons/phosphor/styles.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('assets/css/all.min.css')}}" id="stylesheet" rel="stylesheet" type="text/css">
    <link href="{{url('assets/css/datatables/datatables.min.css')}}" id="stylesheet" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/pnotify@4.0.0/dist/PNotifyBrightTheme.css" rel="stylesheet">

    <!-- /global stylesheets -->


</head>
<body>
<div id="app">
    <!-- Main Navbar -->
    @auth()
            @include('layouts.header')
    @endauth
    <!-- End Main Navbar -->
    <div class="page-content">
        @auth()
        @include('layouts.sidebar')

        @endauth
        <div class="content-wrapper">
            <div class="content-inner">
                @yield('content')
            </div>
        </div>
    </div>
</div>

<!-- Core JS files -->
<script src="{{url('assets/js/jquery/jquery.min.js')}}"></script>
<script src="{{url('assets/js/jquery/jquery.validate.min.js')}}"></script>
<script src="{{url('assets/js/demo/demo_configurator.js')}}"></script>
<script src="{{url('assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('assets/js/vendor/tables/datatables/datatables.min.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/pnotify@4.0.0/dist/iife/PNotify.js"></script>

<script src="{{url('assets/js/app.js')}}"></script>
<script>
    $(document).ready(function() {
        function showPNotify(type, title, text) {
            PNotify[type]({
                title: title,
                text: text,
                styling: 'brighttheme',
                delay: 3000
            });
        }

        @if(Session::has('success'))
        showPNotify('success', 'Success', '{{ Session::get('success') }}');
        @endif

        @if(Session::has('error'))
        showPNotify('error', 'Error', '{{ Session::get('error') }}');
        @endif
    });
</script>
@stack('scripts')
</body>
</html>

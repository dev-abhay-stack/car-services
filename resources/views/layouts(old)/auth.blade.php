<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('title') &dash; {{config('app.name', 'CMMS')}}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{asset(Storage::url('logo/favicon.png'))}}" type="image">
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/libs/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/purpose.css') }}">
    @stack('head')
</head>

<body class="application application-offset">
<div class="container-fluid container-application">
    <div class="main-content position-relative">
        
        @yield('content')
        
        @yield('language-bar')
    </div>
</div>

<script src="{{asset('assets/js/purpose.core.js')}}"></script>
<script src="{{asset('assets/js/purpose.js')}}"></script>
<script src="{{asset('assets/js/demo.js')}}"></script>



@stack('script')
</body>
</html>

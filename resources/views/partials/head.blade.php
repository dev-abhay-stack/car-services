@php
    $logo=asset(Storage::url('logo/'));
    $company_favicon=Utility::getValByName('favicon');

    $settings = App\Models\Utility::colorset();
    $mode_setting = \App\Models\Utility::mode_layout();
    $color = 'theme-3';
    if (!empty($setting['color'])) {
        $color = $setting['color'];
    }
    $dark_mode = (!empty($mode_setting['cust_darklayout']) && $mode_setting['cust_darklayout'] == 'on') ? 'on' : 'off';
    
@endphp

<head>
    {{-- @dd(Utility::getValByName('header_text')) --}}
    <title> @yield('page-title') - {{(Utility::getValByName('header_text')) ? Utility::getValByName('header_text') : config('app.name', 'CMMSGo SaaS')}}
    </title>

    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui"
    />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Dashboard Template Description" />
    <meta name="keywords" content="Dashboard Template" />
    <meta name="author" content="Rajodiya Infotech" />

    <!-- Favicon icon -->
    <link rel="icon" href="{{$logo.'/'.(isset($company_favicon) && !empty($company_favicon)?$company_favicon:'favicon.png')}}" type="image/x-icon" />
    <!--calendar-->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/main.css')}}">
    
    <!-- font css -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}">

    @stack('pre-purpose-css-page')
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/style.css') }}">
    <!-- vendor css -->

    @if(env('SITE_RTL') == 'on')
        <link rel="stylesheet" href="{{ asset('assets/css/style-rtl.css')}}" id="main-style-link">
    @else
        @if($dark_mode == 'on')
            <link rel="stylesheet" href="{{ asset('assets/css/style-dark.css')}}">
        @else
            <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}" id="main-style-link">
        @endif
    @endif

    <link rel="stylesheet" href="{{ asset('assets/css/customizer.css') }}">

   

    <link rel="stylesheet" href="{{ asset('assets/css/plugins/dropzone.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/plugins/animate.min.css')}}" />

     <!--bootstrap switch-->
     <link rel="stylesheet" href="{{ asset('assets/css/plugins/bootstrap-switch-button.min.css') }}">

     <link rel="stylesheet" href="{{asset('public/custom/css/custom.css')}}">


</head>



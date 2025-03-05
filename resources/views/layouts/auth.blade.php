{{-- <!DOCTYPE html>
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
</html> --}}

<!DOCTYPE html>

<html dir="{{env('SITE_RTL') == 'on'?'rtl':''}}">
@php
$logos=asset(Storage::url('logo/'));
    $users=\Auth::user();
    $setting = App\Models\Utility::colorset();
    $color = 'theme-3';
    if (!empty($setting['color'])) {
        $color = $setting['color'];
    }

    $logo = Utility::get_superadmin_logo();
    $footer_text = isset(\App\Models\Utility::settings()['footer_text']) ? \App\Models\Utility::settings()['footer_text'] : 'CMMSGo SaaS';
@endphp


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CRMGo SaaS - Projects, Accounting, Leads, Deals & HRM Tool">
    <meta name="author" content="Rajodiya Infotech">

    <link rel="icon" href="{{$logos.'/'.(isset($company_favicon) && !empty($company_favicon)?$company_favicon :'favicon.png')}}" type="image/x-icon" />
    <title>{{(Utility::getValByName('header_text')) ? Utility::getValByName('header_text') : config('app.name', 'CMMSGo SaaS')}}</title>

    {{-- <link rel="icon" href="assets/images/favicon.svg" type="image/x-icon" /> --}}

	<!-- font css -->
	<link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/fonts/feather.css')}}">
	<link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css')}}">
	<link rel="stylesheet" href="{{ asset('assets/fonts/material.css')}}">

	<!-- vendor css -->
  @if (env('SITE_RTL') == 'on')
  <link rel="stylesheet" href="{{ asset('assets/css/style-rtl.css') }}" id="main-style-link">
@else
  @if( isset($setting['cust_darklayout']) && $setting['cust_darklayout'] == 'on')
      <link rel="stylesheet" href="{{ asset('assets/css/style-dark.css') }}">
  @else
      <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link">
  @endif
@endif
	<link rel="stylesheet" href="{{ asset('assets/css/customizer.css')}}">
  <link rel="stylesheet" href="{{asset('public/custom/css/custom.css')}}">

  <style type="text/css">
    img.navbar-brand-img {
        width: 245px;
        height: 61px;
    }
</style>
</head>

<body class="{{ $color }}">
<div class="auth-wrapper auth-v3">
<div class="bg-auth-side bg-primary"></div>
  <div class="auth-content">
      <nav class="navbar navbar-expand-md navbar-light default">
          <div class="container-fluid pe-2">
              <a class="navbar-brand" href="#">
                <img src="{{ asset(Storage::url('logo/'.$logo)) }}" class="auth-logo navbar-logo">
              </a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                  data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false"
                  aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <ul class="navbar-nav align-items-center ms-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                                  <a class="nav-link active" href="#">{{__('Support')}}</a>
                              </li>
                              <li class="nav-item">
                                  <a class="nav-link" href="#">{{__('Terms')}}</a>
                              </li>
                              <li class="nav-item">
                                  <a class="nav-link" href="#">{{__('Privacy')}}</a>
                              </li>
                          
                </ul>
          </div>
          </div>
      </nav>
      @yield('content')
      <div class="auth-footer">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-6">
                      <p class="">{{ __('Copyright  ') }}{{ $footer_text }} </p>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>

@stack('custom-scripts')


<script src="{{ asset('assets/js/vendor-all.js')}}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/js/plugins/feather.min.js')}}"></script>

<script>feather.replace();</script>
<div class="pct-customizer">
    <div class="pct-c-btn">
      <button class="btn btn-primary" id="pct-toggler">
        <i data-feather="settings"></i>
      </button>
    </div>
    <div class="pct-c-content">
      <div class="pct-header bg-primary">
        <h5 class="mb-0 text-white f-w-500">Theme Customizer</h5>
      </div>
      <div class="pct-body">
        <h6 class="mt-2">
          <i data-feather="credit-card" class="me-2"></i>Primary color settings
        </h6>
        <hr class="my-2" />
        <div class="theme-color themes-color">
          <a href="#!" class="" data-value="theme-1"></a>
          <a href="#!" class="" data-value="theme-2"></a>
          <a href="#!" class="" data-value="theme-3"></a>
          <a href="#!" class="" data-value="theme-4"></a>
        </div>
        <!-- <h6 class="mt-2"><i data-feather="credit-card" class="me-2"></i>Header settings</h6>
              <hr class="my-2">
              <div class="theme-color header-color">
                  <a href="#!" class="" data-value="bg-default"><span></span><span></span></a>
                  <a href="#!" class="" data-value="bg-primary"><span></span><span></span></a>
                  <a href="#!" class="" data-value="bg-danger"><span></span><span></span></a>
                  <a href="#!" class="" data-value="bg-warning"><span></span><span></span></a>
                  <a href="#!" class="" data-value="bg-info"><span></span><span></span></a>
                  <a href="#!" class="" data-value="bg-success"><span></span><span></span></a>
                  <a href="#!" class="" data-value="bg-dark"><span></span><span></span></a>
              </div> -->
        <h6 class="mt-4">
          <i data-feather="layout" class="me-2"></i>Sidebar settings
        </h6>
        <hr class="my-2" />
        <div class="form-check form-switch">
          <input
            type="checkbox"
            class="form-check-input"
            id="cust-theme-bg"
            checked
          />
          <label class="form-check-label f-w-600 pl-1" for="cust-theme-bg"
            >Transparent layout</label
          >
        </div>
        <!-- <div class="form-check form-switch">
                  <input type="checkbox" class="form-check-input" id="cust-sidebar">
                  <label class="form-check-label f-w-600 pl-1" for="cust-sidebar">Light Sidebar</label>
              </div> -->
        <!-- <div class="form-check form-switch mt-2">
                  <input type="checkbox" class="form-check-input" id="cust-sidebrand">
                  <label class="form-check-label f-w-600 pl-1" for="cust-sidebrand">Color Brand</label>
              </div>
              <div class="theme-color brand-color d-none">
                  <a href="#!" class="active" data-value="bg-primary"><span></span><span></span></a>
                  <a href="#!" class="" data-value="bg-danger"><span></span><span></span></a>
                  <a href="#!" class="" data-value="bg-warning"><span></span><span></span></a>
                  <a href="#!" class="" data-value="bg-info"><span></span><span></span></a>
                  <a href="#!" class="" data-value="bg-success"><span></span><span></span></a>
                  <a href="#!" class="" data-value="bg-dark"><span></span><span></span></a>
              </div> -->
        <h6 class="mt-4">
          <i data-feather="sun" class="me-2"></i>Layout settings
        </h6>
        <hr class="my-2" />
        <div class="form-check form-switch mt-2">
          <input type="checkbox" class="form-check-input" id="cust-darklayout" />
          <label class="form-check-label f-w-600 pl-1" for="cust-darklayout"
            >Dark Layout</label
          >
        </div>
      </div>
    </div>

  </div>
<script>
    feather.replace();
    var pctoggle = document.querySelector("#pct-toggler");
    if (pctoggle) {
      pctoggle.addEventListener("click", function () {
        if (
          !document.querySelector(".pct-customizer").classList.contains("active")
        ) {
          document.querySelector(".pct-customizer").classList.add("active");
        } else {
          document.querySelector(".pct-customizer").classList.remove("active");
        }
      });
    }

    var themescolors = document.querySelectorAll(".themes-color > a");
    for (var h = 0; h < themescolors.length; h++) {
      var c = themescolors[h];

      c.addEventListener("click", function (event) {
        var targetElement = event.target;
        if (targetElement.tagName == "SPAN") {
          targetElement = targetElement.parentNode;
        }
        var temp = targetElement.getAttribute("data-value");
        removeClassByPrefix(document.querySelector("body"), "theme-");
        document.querySelector("body").classList.add(temp);
      });
    }

    // var custsidebrand = document.querySelector("#cust-sidebrand");
    // custsidebrand.addEventListener('click', function () {
    //     if (custsidebrand.checked) {
    //         document.querySelector(".m-header").classList.add("bg-dark");
    //         document.querySelector(".theme-color.brand-color").classList.remove("d-none");
    //     } else {
    //         removeClassByPrefix(document.querySelector(".m-header"), 'bg-');
    //         // document.querySelector(".m-header > .b-brand > .logo-lg").setAttribute('src', '../assets/images/logo-dark.svg');
    //         document.querySelector(".theme-color.brand-color").classList.add("d-none");
    //     }
    // });

    // var brandcolor = document.querySelectorAll(".brand-color > a");
    // for (var t = 0; t < brandcolor.length; t++) {
    //     var c = brandcolor[t];
    //     c.addEventListener('click', function (event) {
    //         var targetElement = event.target;
    //         if (targetElement.tagName == "SPAN") {
    //             targetElement = targetElement.parentNode;
    //         }
    //         var temp = targetElement.getAttribute('data-value');
    //         if (temp == "bg-default") {
    //             removeClassByPrefix(document.querySelector(".m-header"), 'bg-');
    //         } else {
    //             removeClassByPrefix(document.querySelector(".m-header"), 'bg-');
    //             document.querySelector(".m-header > .b-brand > .logo-lg").setAttribute('src', '../assets/images/logo.svg');
    //             document.querySelector(".m-header").classList.add(temp);
    //         }
    //     });
    // }

    // var headercolor = document.querySelectorAll(".header-color > a");
    // for (var h = 0; h < headercolor.length; h++) {
    //     var c = headercolor[h];

    //     c.addEventListener('click', function (event) {
    //         var targetElement = event.target;
    //         if (targetElement.tagName == "SPAN") {
    //             targetElement = targetElement.parentNode;
    //         }
    //         var temp = targetElement.getAttribute('data-value');
    //         if (temp == "bg-default") {
    //             removeClassByPrefix(document.querySelector(".dash-header:not(.dash-mob-header)"), 'bg-');
    //         } else {
    //             removeClassByPrefix(document.querySelector(".dash-header:not(.dash-mob-header)"), 'bg-');
    //             document.querySelector(".dash-header:not(.dash-mob-header)").classList.add(temp);
    //         }
    //     });
    // }

    // var custside = document.querySelector("#cust-sidebar");
    // custside.addEventListener('click', function () {
    //     if (custside.checked) {
    //         document.querySelector(".dash-sidebar").classList.add("light-sidebar");
    //     } else {
    //         document.querySelector(".dash-sidebar").classList.remove("light-sidebar");
    //     }
    // });

    var custthemebg = document.querySelector("#cust-theme-bg");
    custthemebg.addEventListener("click", function () {
      if (custthemebg.checked) {
        document.querySelector(".dash-sidebar").classList.add("transprent-bg");
        document
          .querySelector(".dash-header:not(.dash-mob-header)")
          .classList.add("transprent-bg");
      } else {
        document.querySelector(".dash-sidebar").classList.remove("transprent-bg");
        document
          .querySelector(".dash-header:not(.dash-mob-header)")
          .classList.remove("transprent-bg");
      }
    });

    var custdarklayout = document.querySelector("#cust-darklayout");
    custdarklayout.addEventListener("click", function () {
      if (custdarklayout.checked) {
        document
          .querySelector(".m-header > .b-brand > .logo-lg")
          .setAttribute("src", "../assets/images/logo.svg");
        document
          .querySelector("#main-style-link")
          .setAttribute("href", "../assets/css/style-dark.css");
      } else {
        document
          .querySelector(".m-header > .b-brand > .logo-lg")
          .setAttribute("src", "../assets/images/logo-dark.svg");
        document
          .querySelector("#main-style-link")
          .setAttribute("href", "../assets/css/style.css");
      }
    });
    function removeClassByPrefix(node, prefix) {
      for (let i = 0; i < node.classList.length; i++) {
        let value = node.classList[i];
        if (value.startsWith(prefix)) {
          node.classList.remove(value);
        }
      }
    }
  </script>
</body>
</html>



<!DOCTYPE html>
<html>
<meta name="csrf-token" content="{{ csrf_token() }}" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@php
$locationsetting = Utility::LocationSetting();
$favlogo =  asset(Storage::url('logo/' . (!empty($locationsetting['favicon']) ? $locationsetting['favicon'] : 'favicon.png')));
$logo =  asset(Storage::url('logo/' . (!empty($locationsetting['logo']) ? $locationsetting['logo'] : 'logo.png')));
@endphp

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @if (trim($__env->yieldContent('page-title')) && Auth::user()->type == 'super admin')
            @yield('page-title') &dash; {{ config('app.name', 'CMMS') }}
        @else
        {{ isset($locationsetting['title_text']) && $locationsetting['title_text'] != '' ? $locationsetting['title_text'] : config('app.name', 'CMMS') }} -@yield('page-title')
        @endif

    </title>


    <link rel="icon" href="{{ $favlogo }}" type="image">

    @stack('css-page')

    <link rel="stylesheet" href="{{ asset('assets/libs/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/fullcalendar/dist/fullcalendar.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/jqueryform/css/demo.css') }}">
    <link href="{{ asset('assets/jqueryform/css/jquery.rateyo.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/purpose.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/ac.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/stylesheet.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-daterangepicker/daterangepicker.css') }}">
    @if(env('SITE_RTL')=='on')
        <link rel="stylesheet" href="{{ asset('css/bootstrap-rtl.css') }}">
    @endif

</head>

<body class="application application-offset">    
    <div class="container-fluid container-application">
        @include('partials.menu')
        <div class="main-content position-relative">
            @include('partials.header')
            <div class="page-content">
                <div class="page-title">
                    <div class="row justify-content-between align-items-center">
                        <div
                            class="col-xl-5 col-lg-4 col-md-4 d-flex align-items-center justify-content-between justify-content-md-start mb-3 mb-md-0">
                            <div class="d-inline-block">
                                <h5 class="h4 d-inline-block font-weight-400 mb-0 ">@yield('page-title')</h5>
                            </div>
                        </div>
                        <div
                            class="col-xl-7 col-lg-8 col-md-8 d-flex align-items-center justify-content-between justify-content-md-end">
                            @yield('action-button')
                        </div>
                    </div>
                </div>
                @yield('content')
            </div>
           
        </div>
    </div>

    <div class="modal fade" id="commonModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div>
                    <h4 class="h4 font-weight-400 float-left modal-title"></h4>
                    <a href="#" class="more-text widget-text float-right close-icon" data-dismiss="modal"
                        aria-label="Close">{{ __('Close') }}</a>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>

    <div id="omnisearch" class="omnisearch">
        <div class="container">
            <div class="omnisearch-form">
                <div class="form-group">
                    <div class="input-group input-group-merge input-group-flush">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input type="text" class="form-control search_keyword"
                            placeholder="{{ __('Type and search By Project & Tasks.') }}">
                    </div>
                </div>
            </div>
            <div class="omnisearch-suggestions">
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="list-unstyled mb-0 search-output text-sm">
                            <li>
                                <a class="list-link pl-4" href="#">
                                    <i class="fas fa-search"></i>
                                    <span>{{ __('Type and search By Project & Tasks.') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Scripts -->
    <!-- Core JS - includes jquery, bootstrap, popper, in-view and sticky-kit -->

    <!-- Page JS -->
    <script src="{{ asset('assets/js/purpose.core.js') }}"></script>

    {{-- vendor.js remove and jquery-ui.min.js add --}}
    {
    <script src="{{ asset('assets/libs/progressbar.js/dist/progressbar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/libs/moment/min/moment.min.js') }}"></script>

    <script src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.form.js') }}"></script>

    <!-- Purpose JS -->
    <script src="{{ asset('assets/js/purpose.js') }}"></script>



    <!-- Demo JS - remove it when starting your project -->
    <script>
        var dataTabelLang = {
            "lengthMenu": "{{ __('Show') }} _MENU_ {{ __('entries') }}",
            "zeroRecords": "{{ __('No data found.') }}",
            "info": "{{ __('Showing page') }} _PAGE_ {{ __('of') }} _PAGES_",
            "infoEmpty": "{{ __('No page available') }}",
            "infoFiltered": "({{ __('filtered from') }} _MAX_ {{ __('total records') }})",
            "paginate": {
                "previous": "{{ __('Previous') }}",
                "next": "{{ __('Next') }}",
                "last": "{{ __('Last') }}"
            }
        };
    </script>

    <script>
        var toster_pos = "{{env('SITE_RTL')=='on' ?'left' : 'right'}}";
    </script>
    <!-- custom JS -->
   
    @stack('script-page')

    @if (Session::has('success'))
        <script>
            show_toastr('{{ __('Success') }}', "{!! session('success') !!}", 'success');
        </script>
        {{ Session::forget('success') }}
    @endif
    @if (Session::has('error'))
        <script>
            show_toastr('{{ __('Error') }}', "{!! session('error') !!}", 'error');
        </script>
        {{ Session::forget('error') }}
    @endif
    <script>
        var date_picker_locale = {
            format: 'YYYY-MM-DD',
            daysOfWeek: [
                "{{ __('Sun') }}",
                "{{ __('Mon') }}",
                "{{ __('Tue') }}",
                "{{ __('Wed') }}",
                "{{ __('Thu') }}",
                "{{ __('Fri') }}",
                "{{ __('Sat') }}"
            ],
            monthNames: [
                "{{ __('January') }}",
                "{{ __('February') }}",
                "{{ __('March') }}",
                "{{ __('April') }}",
                "{{ __('May') }}",
                "{{ __('June') }}",
                "{{ __('July') }}",
                "{{ __('August') }}",
                "{{ __('September') }}",
                "{{ __('October') }}",
                "{{ __('November') }}",
                "{{ __('December') }}"
            ],
        };
        var calender_header = {
            today: "{{ __('today') }}",
            month: '{{ __('month') }}',
            week: '{{ __('week') }}',
            day: '{{ __('day') }}',
            list: '{{ __('list') }}'
        };
    </script>

@if(Utility::getValByName('gdpr_cookie') == 'on')
<script type="text/javascript">

    var defaults = {
        'messageLocales': {
            /*'en': 'We use cookies to make sure you can have the best experience on our website. If you continue to use this site we assume that you will be happy with it.'*/
            'en': "{{Utility::getValByName('cookie_text')}}"
        },
        'buttonLocales': {
            'en': 'Ok'
        },
        'cookieNoticePosition': 'bottom',
        'learnMoreLinkEnabled': false,
        'learnMoreLinkHref': '/cookie-banner-information.html',
        'learnMoreLinkText': {
            'it': 'Saperne di più',
            'en': 'Learn more',
            'de': 'Mehr erfahren',
            'fr': 'En savoir plus'
        },
        'buttonLocales': {
            'en': 'Ok'
        },
        'expiresIn': 30,
        'buttonBgColor': '#d35400',
        'buttonTextColor': '#fff',
        'noticeBgColor': '#051c4b',
        'noticeTextColor': '#fff',
        'linkColor': '#009fdd'
    };
</script>
<script src="{{ asset('assets/js/cookie.notice.js')}}"></script>
@endif
</body>

</html>

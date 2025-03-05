<!DOCTYPE html>
<html dir="{{env('SITE_RTL') == 'on'?'rtl':''}}">
<meta name="csrf-token" content="{{ csrf_token() }}" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('partials.head')
@php
$locationsetting = Utility::LocationSetting();
$favlogo = asset(Storage::url('logo/' . (!empty($locationsetting['favicon']) ? $locationsetting['favicon'] :
'favicon.png')));
$logo = asset(Storage::url('logo/' . (!empty($locationsetting['logo']) ? $locationsetting['logo'] : 'logo.png')));
$mode_setting = \App\Models\Utility::mode_layout();
        
        $color = 'theme-3';
        if (!empty($mode_setting['color'])) {
            $color = $mode_setting['color'];
        }
@endphp

<body class="{{ $color }}">
        @php
      
        $users=\Auth::user();
        $currantLang = $users->currentLanguage();
        $languages=\App\Models\Utility::languages();
        $footer_text=isset(\App\Models\Utility::settings()['footer_text']) ?
        \App\Models\Utility::settings()['footer_text'] : '';
        $setting_data=App\Models\Settings::pluck('value','name')->toArray();
      
        @endphp
        @include('partials.menu')
        <div class="main-content position-relative">
            @include('partials.header')
            <div class="page-content">
                @include('partials.content')
            </div>
            <div class="footer pt-5 pb-4 footer-light" id="footer-main">
                <div class="row text-center text-sm-left align-items-sm-center">
                    <div class="col-sm-6">
                        <p class="text-sm mb-0">{{ $footer_text }}</p>
                    </div>
                    <div class="col-sm-6 mb-md-0">
                        <ul class="nav justify-content-center justify-content-md-end">
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleoverModal" tabindex="-1" role="dialog" aria-labelledby="exampleoverModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleoverModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>


    @include('partials.footer')
    {{-- @include('Chatify::layouts.footerLinks') --}}
    <!-- Demo JS - remove it when starting your project -->


    <script>
        var toster_pos = "{{env('SITE_RTL')=='on' ?'left' : 'right'}}";
    </script>
    <!-- custom JS -->

    @stack('script-page')

    @if (Session::has('success'))
    <script>
        toastrs('{{ __('Success') }}', "{!! session('success') !!}", 'success');
    </script>
    {{ Session::forget('success') }}
    @endif
    @if (Session::has('error'))
    <script>
        toastrs('{{ __('Error') }}', "{!! session('error') !!}", 'error');
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

    <script>


        var exampleModal = document.getElementById('exampleModal')

    exampleModal.addEventListener('show.bs.modal', function(event) {

        // Button that triggered the modal
        var button = event.relatedTarget
            // Extract info from data-bs-* attributes
        var recipient = button.getAttribute('data-bs-whatever')
        var url = button.getAttribute('data-url')
        var size = button.getAttribute('data-size');
        var modalTitle = exampleModal.querySelector('.modal-title')

        var modalBodyInput = exampleModal.querySelector('.modal-body input')
                // modalTitle.textContent = recipient
        $("#exampleModal .modal-title").html(recipient);
        $("#exampleModal .modal-dialog").addClass('modal-' + size);
        $.ajax({
            url: url,
            success: function (data) {
                $('#exampleModal .modal-body').html(data);
                $("#exampleModal").modal('show');
            },
            error: function (data) {
                data = data.responseJSON;
                toastrs('Error', data.error, 'error')
            }
        });
    })


    var exampleModal = document.getElementById('exampleoverModal')

  exampleModal.addEventListener('show.bs.modal', function(event) {
      // Button that triggered the modal
      var button = event.relatedTarget
          // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      var url = button.getAttribute('data-url')
      var size = button.getAttribute('data-size');
      var modalTitle = exampleModal.querySelector('.modal-title')
      var modalBodyInput = exampleModal.querySelector('.modal-body input')
            //   modalTitle.textContent = recipient
            $("#exampleoverModal .modal-title").html(recipient);
      $("#exampleoverModal .modal-dialog").addClass('modal-' + size);
      $.ajax({
          url: url,
          success: function (data) {
              $('#exampleoverModal .modal-body').html(data);
              $("#exampleoverModal").modal('show');
          },
          error: function (data) {
              data = data.responseJSON;
              toastrs('Error', data.error, 'error')
          }
      });
  })
    function arrayToJson(form) {
    var data = $(form).serializeArray();
    var indexed_array = {};

    $.map(data, function(n, i) {
        indexed_array[n['name']] = n['value'];
    });

    return indexed_array;
}



    </script>

    @if($setting_data['gdpr_cookie'] == 'on')
    <script type="text/javascript">
        var defaults = {
        'messageLocales': {
            /*'en': 'We use cookies to make sure you can have the best experience on our website. If you continue to use this site we assume that you will be happy with it.'*/
            'en': "{{ $setting_data['cookie_text'] }}"
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
        'noticeBgColor': '#000000',
        'noticeTextColor': '#fff',
        'linkColor': '#009fdd'
    };
    </script>
    <script src="{{ asset('js/cookie.notice.js')}}"></script>
    @endif
</body>

</html>

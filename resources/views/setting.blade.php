@php $getSetting = Utility::settings();
 $setting = App\Models\Utility::colorset();
    $color = 'theme-3';
    if (!empty($setting['color'])) {
        $color = $setting['color'];
    }
@endphp
@extends('layouts.admin')

@section('page-title')
    {{__('Settings')}}
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('home')}}">{{__('Dashboard')}}</a></li>
<li class="breadcrumb-item" aria-current="page">{{__('Settings')}}</li>
@endsection

@section('content')
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <div class="row">
                <div class="col-xl-3">
                    <div class="card sticky-top" style="top:30px">
                        <div class="list-group list-group-flush" id="useradd-sidenav">
                            <a href="#useradd-1" class="list-group-item list-group-item-action border-0">{{ __('Site Setting') }}
                                <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#useradd-2" class="list-group-item list-group-item-action border-0">{{ __('Email Setting') }}
                                <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#useradd-3" class="list-group-item list-group-item-action border-0">{{ __('Payment Setting') }}
                                <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                        </div>
                    </div>
                </div>
                <div class="col-xl-9">
                    <div id="useradd-1" class="card">
                        {{Form::open(['route'=>'settings.store','method'=>'post', 'enctype' => 'multipart/form-data'])}}
                        <div class="card-header">
                            <h5>{{ __('Site Setting') }}</h5>
                            <small class="text-muted">{{ __('Edit details about your Company') }}</small>
                        </div>

                        <div class="card-body">


                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="small-title">{{ __('Favicon') }}</h5>
                                        </div>
                                        <div class="card-body setting-card setting-logo-box p-3">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="logo-content logo-set-bg text-center py-2">
                                                        <img src="{{ asset(Storage::url('logo/favicon.png')) }}"
                                                            class="small-logo" alt="" />
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="choose-files mt-5">
                                                        <label for="favicon">
                                                            <div class=" bg-primary logo_update"> <i class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                                            </div>
                                                            <input type="file" class="form-control file" name="favicon" id="favicon" 
                                                            data-filename="edit-favicon" accept=".jpeg,.jpg,.png" accept=".jpeg,.jpg,.png">
                                                        </label>
                                                    </div>

                                                  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="small-title">{{ __('Dark Logo') }}</h5>
                                        </div>
                                        <div class="card-body setting-card setting-logo-box p-3">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="logo-content logo-set-bg  text-center py-2">
                                                        <img src="{{ asset(Storage::url('logo/logo-dark.png')) }}"
                                                            class="big-logo" alt="" />
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="choose-files mt-5">
                                                        <label for="logo">
                                                            <div class=" bg-primary logo_update"> <i class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                                            </div>
                                                            <input type="file" class="form-control file" name="logo" id="logo" 
                                                            data-filename="edit-logo" accept=".jpeg,.jpg,.png" accept=".jpeg,.jpg,.png">
                                                        </label>
                                                    </div>

                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="small-title">{{ __('Light Logo') }}</h5>
                                        </div>
                                        <div class="card-body setting-card setting-logo-box p-3">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="logo-content  logo-set-bg text-center py-2">
                                                        <img src="{{ asset(Storage::url('logo/logo-light.png')) }}"
                                                            class="big-logo" alt="" />
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="choose-files mt-5">
                                                        <label for="logo">
                                                            <div class=" bg-primary logo_update"> <i class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                                            </div>
                                                            <input type="file" class="form-control file" name="white_logo" id="white_logo" 
                                                            data-filename="edit-white_logo" accept=".jpeg,.jpg,.png" accept=".jpeg,.jpg,.png">
                                                        </label>
                                                    </div>

                                                 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{-- @dd($setting_data) --}}
                                        {{Form::label('header_text',__('Title Text'),['class'=>'col-form-label text-dark']) }}
                                        {{Form::text('header_text',$setting_data['header_text'],array('class'=>'form-control','placeholder'=>__('Enter Header Title Text')))}}
                                        @error('header_text')
                                        <span class="invalid-header_text" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{Form::label('footer_text',__('Footer Text'),['class'=>'col-form-label text-dark']) }}
                                        {{Form::text('footer_text',$setting_data['footer_text'],array('class'=>'form-control','placeholder'=>__('Enter Footer Text')))}}
                                        @error('footer_text')
                                        <span class="invalid-footer_text" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        {{Form::label('default_language',__('Default Language'),['class'=>'col-form-label text-dark']) }}
                                        <select name="default_language" id="default_language" class="form-control select2">
                                            @foreach(Utility::languages() as $language)
                                                <option @if(Utility::getValByName('default_language') == $language) selected @endif value="{{$language}}">{{Str::upper($language)}}</option>
                                            @endforeach
                                        </select>
                                        @error('default_language')
                                        <span class="invalid-default_language" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- @dd(env('SITE_RTL')) --}}
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col switch-width">
                                            <div class="form-group ml-2 mr-3 ">
                                                <label class="form-label">{{ __('RTL') }}</label>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" data-toggle="switchbutton"
                                                        data-onstyle="primary" class=""
                                                        name="SITE_RTL" id="SITE_RTL"
                                                        {{ env('SITE_RTL') == 'on' ? 'checked="checked"' : '' }}>
                                                    <label class="custom-control-label"
                                                        for="SITE_RTL"></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col switch-width">
                                            <div class="form-group mr-3">
                                                <label class="form-label text-dark " for="display_landing_page">{{ __('Enable Landing Page') }}</label>
                                                <div class="form-check form-switch d-inline-block">
                                                    <input type="checkbox" name="display_landing_page" class="form-check-input" id="display_landing_page" data-toggle="switchbutton" {{ $settings['display_landing_page'] == 'on' ? 'checked="checked"' : '' }} data-onstyle="primary">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col switch-width">
                                            <div class="form-group mr-3">
                                                <label class="form-label text-dark" for="SIGNUP">{{ __('Sign Up') }}</label>
                                            <div class="">
                                                <input type="checkbox" name="SIGNUP" id="SIGNUP" data-toggle="switchbutton" {{ $setting_data['SIGNUP'] == 'on' ? 'checked="checked"' : '' }}  data-onstyle="primary">
                                                <label class="form-check-labe" for="SIGNUP"></label>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col switch-width">
                                            <div class="form-group mr-3">
                                                {{ Form::label('gdpr_cookie', 'GDPR Cookie', ['class' => 'form-label']) }}
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" data-toggle="switchbutton"
                                                        data-onstyle="primary"
                                                        class="custom-control-input gdpr_fulltime gdpr_type"
                                                        name="gdpr_cookie" id="gdpr_cookie"
                                                        {{ isset($setting_data['gdpr_cookie']) && $setting_data['gdpr_cookie'] == 'on' ? 'checked="checked"' : '' }}>
                                                    <label class="custom-control-label form-label"
                                                        for="gdpr_cookie"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-12">
                                    {{Form::label('cookie_text',__('GDPR Cookie Text'),array('class'=>'fulltime') )}}
                                    {!! Form::textarea('cookie_text',$setting_data['cookie_text'], ['class'=>'form-control fulltime','rows'=>'4']) !!}
                                </div>

                            </div>

                            <div class="row">
                                <h4 class="small-title">{{ __('Theme Customizer') }}</h4>
                                <div class="setting-card setting-logo-box p-3">
                                    <div class="row">
                                        <div class="pct-body">
                                            <div class="row">
                                                <div class="col-lg-4 col-xl-4 col-md-4">
                                                    <h6 class="mt-2">
                                                        <i data-feather="credit-card"
                                                            class="me-2"></i>{{ __('Primary color settings') }}
                                                    </h6>
                                                    <hr class="my-2" />
                                                    <div class="theme-color themes-color">
                                                        <a href="#!" class="themes-color-change {{($color =='theme-1') ? 'active_color' : ''}}" data-value="theme-1" onclick="check_theme('theme-1')"></a>
                                                        <input type="radio" class="theme_color" name="color" value="theme-1" style="display: none;">
                                                        <a href="#!" class=" themes-color-change {{($color =='theme-2') ? 'active_color' : ''}}" data-value="theme-2" onclick="check_theme('theme-2')"></a>
                                                        <input type="radio" class="theme_color" name="color" value="theme-2" style="display: none;">
                                                        <a href="#!" class="themes-color-change {{($color =='theme-3') ? 'active_color' : ''}}" data-value="theme-3" onclick="check_theme('theme-3')"></a>
                                                        <input type="radio" class="theme_color" name="color" value="theme-3" style="display: none;">
                                                        <a href="#!" class="themes-color-change {{($color =='theme-4') ? 'active_color' : ''}}" data-value="theme-4" onclick="check_theme('theme-4')"></a>
                                                        <input type="radio" class="theme_color" name="color" value="theme-4" style="display: none;">
                                                      </div>
                                                </div>

                                                <div class="col-lg-4 col-xl-4 col-md-4">
                                                    <h6 class="mt-2  rtl-hide">
                                                        <i data-feather="layout"
                                                            class="me-2"></i>{{ __('Sidebar settings') }}
                                                    </h6>
                                                    <hr class="my-2 rtl-hide" />
                                                    <div class="form-check form-switch rtl-hide">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="cust-theme-bg" name="cust_theme_bg"
                                                            {{ !empty($setting_data['cust_theme_bg']) && $setting_data['cust_theme_bg'] == 'on' ? 'checked' : '' }} />
                                                        <label class="form-check-label f-w-600 pl-1"
                                                            for="cust-theme-bg">{{ __('Transparent layout') }}</label>

                                                    </div>
                                                </div>

                                                <div class="col-lg-4 col-xl-4 col-md-4">
                                                    <h6 class="mt-2 rtl-hide">
                                                        <i data-feather="sun"
                                                            class="me-2"></i>{{ __('Layout settings') }}
                                                    </h6>
                                                    <hr class="my-2 rtl-hide" />
                                                    <div class="form-check form-switch mt-2 rtl-hide">
                                                        <input type="checkbox" class="form-check-input" id="cust-darklayout"
                                                         name="cust_darklayout" {{ !empty($setting_data['cust_darklayout']) && $setting_data['cust_darklayout'] == 'on' ? 'checked' : '' }} />

                                                        <label class="form-check-label f-w-600 pl-1"
                                                            for="cust-darklayout">{{ __('Dark Layout') }}</label>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>


                            <div class="row">

                                <div class="modal-footer">
                                    {{Form::submit(__('Save Change'),array('class'=>'btn btn-print-invoice  btn-primary m-r-10'))}}
                                </div>
                            </div>


                        {{ Form::close() }}
                    </div>

                    <!--Email Setting-->
                    <div id="useradd-2" class="card">
                        {{Form::open(['route'=>'email.settings.store','method'=>'post'])}}
                        <div class="card-header">
                            <h5>{{ __('Email Setting') }}</h5>
                            <small class="text-muted">{{ __('Edit details about your Company Email Setting') }}</small>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                    {{Form::label('mail_driver',__('Mail Driver'),array('class'=>'form-control-label')) }}
                                    {{Form::text('mail_driver',env('MAIL_DRIVER'),array('class'=>'form-control','placeholder'=>__('Enter Mail Driver')))}}
                                    @error('mail_driver')
                                    <span class="invalid-mail_driver" role="alert">
                                             <strong class="text-danger">{{ $message }}</strong>
                                             </span>
                                    @enderror
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                    {{Form::label('mail_host',__('Mail Host'),array('class'=>'form-control-label')) }}
                                    {{Form::text('mail_host',env('MAIL_HOST'),array('class'=>'form-control ','placeholder'=>__('Enter Mail Driver')))}}
                                    @error('mail_host')
                                    <span class="invalid-mail_driver" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                    {{Form::label('mail_port',__('Mail Port'),array('class'=>'form-control-label')) }}
                                    {{Form::text('mail_port',env('MAIL_PORT'),array('class'=>'form-control','placeholder'=>__('Enter Mail Port')))}}
                                    @error('mail_port')
                                    <span class="invalid-mail_port" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                    {{Form::label('mail_username',__('Mail Username'),array('class'=>'form-control-label')) }}
                                    {{Form::text('mail_username',env('MAIL_USERNAME'),array('class'=>'form-control','placeholder'=>__('Enter Mail Username')))}}
                                    @error('mail_username')
                                    <span class="invalid-mail_username" role="alert">
                                             <strong class="text-danger">{{ $message }}</strong>
                                             </span>
                                    @enderror
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                    {{Form::label('mail_password',__('Mail Password'),array('class'=>'form-control-label')) }}
                                    {{Form::text('mail_password',env('MAIL_PASSWORD'),array('class'=>'form-control','placeholder'=>__('Enter Mail Password')))}}
                                    @error('mail_password')
                                    <span class="invalid-mail_password" role="alert">
                                             <strong class="text-danger">{{ $message }}</strong>
                                             </span>
                                    @enderror
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                    {{Form::label('mail_encryption',__('Mail Encryption'),array('class'=>'form-control-label')) }}
                                    {{Form::text('mail_encryption',env('MAIL_ENCRYPTION'),array('class'=>'form-control','placeholder'=>__('Enter Mail Encryption')))}}
                                    @error('mail_encryption')
                                    <span class="invalid-mail_encryption" role="alert">
                                             <strong class="text-danger">{{ $message }}</strong>
                                             </span>
                                    @enderror
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                    {{Form::label('mail_from_address',__('Mail From Address'),array('class'=>'form-control-label')) }}
                                    {{Form::text('mail_from_address',env('MAIL_FROM_ADDRESS'),array('class'=>'form-control','placeholder'=>__('Enter Mail From Address')))}}
                                    @error('mail_from_address')
                                    <span class="invalid-mail_from_address" role="alert">
                                             <strong class="text-danger">{{ $message }}</strong>
                                             </span>
                                    @enderror
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                    {{Form::label('mail_from_name',__('Mail From Name'),array('class'=>'form-control-label')) }}
                                    {{Form::text('mail_from_name',env('MAIL_FROM_NAME'),array('class'=>'form-control','placeholder'=>__('Enter Mail Encryption')))}}
                                    @error('mail_from_name')
                                    <span class="invalid-mail_from_name" role="alert">
                                             <strong class="text-danger">{{ $message }}</strong>
                                             </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="modal-footer ">
                                <div class="row col-12">
                                    <div class="form-group col-md-6">
                                        <a href="#" data-url="{{route('test.email')}}" id="test_email"
                                            data-title="{{ __('Send Test Mail') }}" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                            class="btn  btn-primary send_email">
                                            {{ __('Send Test Mail') }}
                                        </a>
                                    </div>
                                    <div class="form-group col-md-6 text-end">
                                        <input type="submit" value="{{ __('Save Changes') }}" class="btn btn-primary">
                                    </div>
                                </div>
                            </div>

                        </div>

                        {{ Form::close() }}
                    </div>

                    <!--Payment Setting-->
                    <div id="useradd-3" class="card">
                        <div class="card-header">
                            <h5>{{ __('Payment Setting') }}</h5>
                            <small class="text-muted">{{ __('This detail will use for collect payment on subscription of plan.') }}</small>
                        </div>
                        <div class="card-body">
                            <form id="setting-form" method="post" action="{{route('payment.setting')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                                        <label class="col-form-label">{{__('Currency')}} *</label>
                                                        <input type="text" name="currency" class="form-control" id="currency" value="{{(!isset($payment['currency']) || is_null($payment['currency'])) ? '' : $payment['currency']}}" required>
                                                        <small class="text-xs">
                                                            {{ __('Note: Add currency code as per three-letter ISO code') }}.
                                                            <a href="https://stripe.com/docs/currencies" target="_blank">{{ __('you can find out here..') }}</a>
                                                        </small>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                                        <label for="currency_symbol" class="col-form-label">{{__('Currency Symbol')}}</label>
                                                        <input type="text" name="currency_symbol" class="form-control" id="currency_symbol" value="{{(!isset($payment['currency_symbol']) || is_null($payment['currency_symbol'])) ? '' : $payment['currency_symbol']}}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="faq justify-content-center">
                                    <div class="col-sm-12 col-md-10 col-xxl-12">
                                        <div class="accordion accordion-flush" id="accordionExample">

                                            <!-- Strip -->
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-2">
                                                    <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i> {{ __('Stripe') }}
                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse1" class="accordion-collapse collapse"aria-labelledby="heading-2-2"data-bs-parent="#accordionExample" >
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                <h5 class="h5">{{ __('Stripe') }}</h5>
                                                            </div>
                                                            <div class="col-6 py-2 text-end">
                                                                <div class="form-check form-switch d-inline-block">
                                                                    <input type="hidden" name="is_stripe_enabled" value="off">
                                                                    <input type="checkbox" class="form-check-input" name="is_stripe_enabled" id="is_stripe_enabled" {{(isset($payment['is_stripe_enabled']) && $payment['is_stripe_enabled'] == 'on') ? 'checked' : ''}}>
                                                                    <label class="custom-control-label form-label" for="is_stripe_enabled">{{__('Enable Stripe')}}</label>
                                                                </div>
                                                            </div>


                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="stripe_key">{{__('Stripe Key')}}</label>
                                                                    <input class="form-control" placeholder="{{__('Stripe Key')}}" name="stripe_key" type="text" value="{{(!isset($payment['stripe_key']) || is_null($payment['stripe_key'])) ? '' : $payment['stripe_key']}}" id="stripe_key">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="stripe_secret">{{__('Stripe Secret')}}</label>
                                                                    <input class="form-control " placeholder="{{ __('Stripe Secret') }}" name="stripe_secret" type="text" value="{{(!isset($payment['stripe_secret']) || is_null($payment['stripe_secret'])) ? '' : $payment['stripe_secret']}}" id="stripe_secret">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="stripe_secret">{{__('Stripe_Webhook_Secret')}}</label>
                                                                    <input class="form-control " placeholder="{{ __('Enter Stripe Webhook Secret') }}" name="stripe_webhook_secret" type="text" value="{{(!isset($payment['stripe_webhook_secret']) || is_null($payment['stripe_webhook_secret'])) ? '' : $payment['stripe_webhook_secret']}}" id="stripe_webhook_secret">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Paypal -->
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-3">
                                                    <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i> {{ __('Paypal') }}
                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse2" class="accordion-collapse collapse"aria-labelledby="heading-2-3"data-bs-parent="#accordionExample" >
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                <h5 class="h5">{{ __('Paypal') }}</h5>
                                                            </div>

                                                            <div class="col-6 py-2 text-end">
                                                                <div class="form-check form-switch d-inline-block">
                                                                    <input type="hidden" name="is_paypal_enabled" value="off">
                                                                    <input type="checkbox" class="form-check-input" name="is_paypal_enabled" id="is_paypal_enabled" {{(isset($payment['is_paypal_enabled']) && $payment['is_paypal_enabled'] == 'on') ? 'checked' : ''}}>
                                                                    <label class="custom-control-label form-control-label" for="is_paypal_enabled">{{__('Enable Paypal')}}</label>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <label class="paypal-label col-form-label" for="paypal_mode">{{__('Paypal Mode')}}</label> <br>
                                                                <div class="d-flex">
                                                                    <div class="mr-2" style="margin-right: 15px;">
                                                                        <div class="border card p-3">
                                                                            <div class="form-check">
                                                                                <label class="form-check-labe text-dark">
                                                                                    <input type="radio" name="paypal_mode" value="sandbox" class="form-check-input" {{ !isset($payment['paypal_mode']) || $payment['paypal_mode'] == '' || $payment['paypal_mode'] == 'sandbox' ? 'checked="checked"' : '' }}>

                                                                                    {{__('Sandbox')}}
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mr-2">
                                                                        <div class="border card p-3">
                                                                            <div class="form-check">
                                                                                <label class="form-check-labe text-dark">
                                                                                    <input type="radio" name="paypal_mode" value="live" class="form-check-input" {{ isset($payment['paypal_mode']) && $payment['paypal_mode'] == 'live' ? 'checked="checked"' : '' }}>

                                                                                    {{__('Live')}}
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="paypal_client_id">{{ __('Client ID') }}</label>
                                                                    <input type="text" name="paypal_client_id" id="paypal_client_id" class="form-control" value="{{(!isset($payment['paypal_client_id']) || is_null($payment['paypal_client_id'])) ? '' : $payment['paypal_client_id']}}" placeholder="{{ __('Client ID') }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="paypal_secret_key">{{ __('Secret Key') }}</label>
                                                                    <input type="text" name="paypal_secret_key" id="paypal_secret_key" class="form-control" value="{{(!isset($payment['paypal_secret_key']) || is_null($payment['paypal_secret_key'])) ? '' : $payment['paypal_secret_key']}}" placeholder="{{ __('Secret Key') }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Paystack -->
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-4">
                                                    <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i> {{ __('Paystack') }}
                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse3" class="accordion-collapse collapse"aria-labelledby="heading-2-4"data-bs-parent="#accordionExample" >
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                <h5 class="h5">{{ __('Paystack') }}</h5>
                                                            </div>
                                                            <div class="col-6 py-2 text-end">
                                                                <div class="form-check form-switch d-inline-block">
                                                                    <input type="hidden" name="is_paystack_enabled" value="off">
                                                                    <input type="checkbox" class="form-check-input" name="is_paystack_enabled" id="is_paystack_enabled" {{(isset($payment['is_paystack_enabled']) && $payment['is_paystack_enabled'] == 'on') ? 'checked' : ''}}>
                                                                    <label class="custom-control-label form-control-label" for="is_paystack_enabled">{{__('Enable Paystack')}}</label>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="paypal_client_id">{{ __('Public Key')}}</label>
                                                                    <input type="text" name="paystack_public_key" id="paystack_public_key" class="form-control" value="{{(!isset($payment['paystack_public_key']) || is_null($payment['paystack_public_key'])) ? '' : $payment['paystack_public_key']}}" placeholder="{{ __('Public Key')}}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="paystack_secret_key">{{ __('Secret Key') }}</label>
                                                                    <input type="text" name="paystack_secret_key" id="paystack_secret_key" class="form-control" value="{{(!isset($payment['paystack_secret_key']) || is_null($payment['paystack_secret_key'])) ? '' : $payment['paystack_secret_key']}}" placeholder="{{ __('Secret Key') }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                             <!-- FLUTTERWAVE -->
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-5">
                                                    <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i> {{ __('Flutterwave') }}
                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse4" class="accordion-collapse collapse"aria-labelledby="heading-2-5"data-bs-parent="#accordionExample" >
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                <h5 class="h5">{{ __('Flutterwave') }}</h5>
                                                            </div>
                                                            <div class="col-6 py-2 text-end">
                                                                <div class="form-check form-switch d-inline-block">
                                                                    <input type="hidden" name="is_flutterwave_enabled" value="off">
                                                                    <input type="checkbox" class="form-check-input" name="is_flutterwave_enabled" id="is_flutterwave_enabled" {{(isset($payment['is_flutterwave_enabled']) && $payment['is_flutterwave_enabled'] == 'on') ? 'checked' : ''}}>
                                                                    <label class="custom-control-label form-control-label" for="is_flutterwave_enabled">{{__('Enable Flutterwave')}}</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="paypal_client_id">{{ __('Public Key')}}</label>
                                                                    <input type="text" name="flutterwave_public_key" id="flutterwave_public_key" class="form-control" value="{{(!isset($payment['flutterwave_public_key']) || is_null($payment['flutterwave_public_key'])) ? '' : $payment['flutterwave_public_key']}}" placeholder="Public Key">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="paystack_secret_key">{{ __('Secret Key') }}</label>
                                                                    <input type="text" name="flutterwave_secret_key" id="flutterwave_secret_key" class="form-control" value="{{(!isset($payment['flutterwave_secret_key']) || is_null($payment['flutterwave_secret_key'])) ? '' : $payment['flutterwave_secret_key']}}" placeholder="Secret Key">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Razorpay -->
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-6">
                                                    <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="true" aria-controls="collapse5">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i> {{ __('Razorpay') }}
                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse5" class="accordion-collapse collapse"aria-labelledby="heading-2-6"data-bs-parent="#accordionExample" >
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                <h5 class="h5">{{ __('Razorpay') }}</h5>
                                                            </div>
                                                            <div class="col-6 py-2 text-end">
                                                                <div class="form-check form-switch d-inline-block">
                                                                    <input type="hidden" name="is_razorpay_enabled" value="off">
                                                                    <input type="checkbox" class="form-check-input" name="is_razorpay_enabled" id="is_razorpay_enabled" {{(isset($payment['is_razorpay_enabled']) && $payment['is_razorpay_enabled'] == 'on') ? 'checked' : ''}}>
                                                                    <label class="custom-control-label form-control-label" for="is_razorpay_enabled">{{__('Enable Razorpay')}}</label>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="paypal_client_id">Public Key</label>

                                                                    <input type="text" name="razorpay_public_key" id="razorpay_public_key" class="form-control" value="{{(!isset($payment['razorpay_public_key']) || is_null($payment['razorpay_public_key'])) ? '' : $payment['razorpay_public_key']}}" placeholder="Public Key">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="paystack_secret_key">Secret Key</label>
                                                                    <input type="text" name="razorpay_secret_key" id="razorpay_secret_key" class="form-control" value="{{(!isset($payment['razorpay_secret_key']) || is_null($payment['razorpay_secret_key'])) ? '' : $payment['razorpay_secret_key']}}" placeholder="Secret Key">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Paytm -->
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-7">
                                                    <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="true" aria-controls="collapse6">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i> {{ __('Paytm') }}
                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse6" class="accordion-collapse collapse"aria-labelledby="heading-2-7"data-bs-parent="#accordionExample" >
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                <h5 class="h5">{{ __('Paytm') }}</h5>
                                                            </div>

                                                            <div class="col-6 py-2 text-end">
                                                                <div class="form-check form-switch d-inline-block">
                                                                    <input type="hidden" name="is_paytm_enabled" value="off">
                                                                    <input type="checkbox" class="form-check-input" name="is_paytm_enabled" id="is_paytm_enabled" {{(isset($payment['is_paytm_enabled']) && $payment['is_paytm_enabled'] == 'on') ? 'checked' : ''}}>
                                                                    <label class="custom-control-label form-control-label" for="is_paytm_enabled">{{__('Enable Paytm')}}</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label class="paypal-label col-form-label" for="paypal_mode">Paytm Environment</label> <br>
                                                                <div class="d-flex">
                                                                    <div class="mr-2" style="margin-right: 15px;">
                                                                        <div class="border card p-3">
                                                                            <div class="form-check">
                                                                                <label class="form-check-labe text-dark">

                                                                                    <input type="radio" name="paytm_mode" value="local" class="form-check-input" {{ !isset($payment['paytm_mode']) || $payment['paytm_mode'] == '' || $payment['paytm_mode'] == 'local' ? 'checked="checked"' : '' }}>

                                                                                    {{__('Local')}}
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mr-2">
                                                                        <div class="border card p-3">
                                                                            <div class="form-check">
                                                                                <label class="form-check-labe text-dark">
                                                                                    <input type="radio" name="paytm_mode" value="production" class="form-check-input" {{ isset($payment['paytm_mode']) && $payment['paytm_mode'] == 'production' ? 'checked="checked"' : '' }}>

                                                                                    {{__('Production')}}
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="paytm_public_key">Merchant ID</label>
                                                                    <input type="text" name="paytm_merchant_id" id="paytm_merchant_id" class="form-control" value="{{(!isset($payment['paytm_merchant_id']) || is_null($payment['paytm_merchant_id'])) ? '' : $payment['paytm_merchant_id']}}" placeholder="Merchant ID">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="paytm_secret_key">Merchant Key</label>
                                                                    <input type="text" name="paytm_merchant_key" id="paytm_merchant_key" class="form-control" value="{{(!isset($payment['paytm_merchant_key']) || is_null($payment['paytm_merchant_key'])) ? '' : $payment['paytm_merchant_key']}}" placeholder="Merchant Key">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="paytm_industry_type">Industry Type</label>
                                                                    <input type="text" name="paytm_industry_type" id="paytm_industry_type" class="form-control" value="{{(!isset($payment['paytm_industry_type']) || is_null($payment['paytm_industry_type'])) ? '' : $payment['paytm_industry_type']}}" placeholder="Industry Type">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Mercado Pago-->
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-8">
                                                    <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse7" aria-expanded="true" aria-controls="collapse7">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i> {{ __('Mercado Pago') }}
                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse7" class="accordion-collapse collapse"aria-labelledby="heading-2-8"data-bs-parent="#accordionExample" >
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                <h5 class="h5">{{ __('Mercado Pago') }}</h5>
                                                            </div>
                                                            <div class="col-6 py-2 text-end">
                                                                <div class="form-check form-switch d-inline-block">
                                                                    <input type="hidden" name="is_mercado_enabled" value="off">
                                                                    <input type="checkbox" class="form-check-input" name="is_mercado_enabled" id="is_mercado_enabled" {{(isset($payment['is_mercado_enabled']) && $payment['is_mercado_enabled'] == 'on') ? 'checked' : ''}}>
                                                                    <label class="custom-control-label form-control-label" for="is_mercado_enabled">{{__('Enable Mercado Pago')}}</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ">
                                                                <label class="coingate-label col-form-label" for="mercado_mode">{{__('Mercado Mode')}}</label> <br>
                                                                <div class="d-flex">
                                                                    <div class="mr-2" style="margin-right: 15px;">
                                                                        <div class="border card p-3">
                                                                            <div class="form-check">
                                                                                <label class="form-check-labe text-dark">
                                                                                    <input type="radio" name="mercado_mode" value="sandbox" class="form-check-input" {{ isset($payment['mercado_mode']) && $payment['mercado_mode'] == '' || isset($payment['mercado_mode']) && $payment['mercado_mode'] == 'sandbox' ? 'checked="checked"' : '' }}>
                                                                                    {{__('Sandbox')}}
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mr-2">
                                                                        <div class="border card p-3">
                                                                            <div class="form-check">
                                                                                <label class="form-check-labe text-dark">
                                                                                    <input type="radio" name="mercado_mode" value="live" class="form-check-input" {{ isset($payment['mercado_mode']) && $payment['mercado_mode'] == 'live' ? 'checked="checked"' : '' }}>
                                                                                    {{__('Live')}}
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="mercado_access_token">{{ __('Access Token') }}</label>
                                                                    <input type="text" name="mercado_access_token" id="mercado_access_token" class="form-control" value="{{isset($payment['mercado_access_token']) ? $payment['mercado_access_token']:''}}" placeholder="{{ __('Access Token') }}"/>
                                                                    @if ($errors->has('mercado_secret_key'))
                                                                        <span class="invalid-feedback d-block">
                                                                            {{ $errors->first('mercado_access_token') }}
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Mollie -->
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-9">
                                                    <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse8" aria-expanded="true" aria-controls="collapse8">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i> {{ __('Mollie') }}
                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse8" class="accordion-collapse collapse"aria-labelledby="heading-2-9"data-bs-parent="#accordionExample" >
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                <h5 class="h5">{{ __('Mollie') }}</h5>
                                                            </div>
                                                            <div class="col-6 py-2 text-end">
                                                                <div class="form-check form-switch d-inline-block">
                                                                    <input type="hidden" name="is_mollie_enabled" value="off">
                                                                    <input type="checkbox" class="form-check-input" name="is_mollie_enabled" id="is_mollie_enabled" {{(isset($payment['is_mollie_enabled']) && $payment['is_mollie_enabled'] == 'on') ? 'checked' : ''}}>
                                                                    <label class="custom-control-label form-control-label" for="is_mollie_enabled">{{__('Enable Mollie')}}</label>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="mollie_api_key" class="col-form-label">{{ __('Mollie Api Key') }}</label>
                                                                    <input type="text" name="mollie_api_key" id="mollie_api_key" class="form-control" value="{{(!isset($payment['mollie_api_key']) || is_null($payment['mollie_api_key'])) ? '' : $payment['mollie_api_key']}}" placeholder="Mollie Api Key">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="mollie_profile_id" class="col-form-label">{{ __('Mollie Profile Id') }}</label>
                                                                    <input type="text" name="mollie_profile_id" id="mollie_profile_id" class="form-control" value="{{(!isset($payment['mollie_profile_id']) || is_null($payment['mollie_profile_id'])) ? '' : $payment['mollie_profile_id']}}" placeholder="Mollie Profile Id">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="mollie_partner_id" class="col-form-label">{{ __('Mollie Partner Id') }}</label>
                                                                    <input type="text" name="mollie_partner_id" id="mollie_partner_id" class="form-control" value="{{(!isset($payment['mollie_partner_id']) || is_null($payment['mollie_partner_id'])) ? '' : $payment['mollie_partner_id']}}" placeholder="Mollie Partner Id">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Skrill -->
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-10">
                                                    <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse9" aria-expanded="true" aria-controls="collapse9">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i> {{ __('Skrill') }}
                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse9" class="accordion-collapse collapse"aria-labelledby="heading-2-10"data-bs-parent="#accordionExample" >
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                <h5 class="h5">{{ __('Skrill') }}</h5>
                                                            </div>
                                                            <div class="col-6 py-2 text-end">
                                                                <div class="form-check form-switch d-inline-block">
                                                                    <input type="hidden" name="is_skrill_enabled" value="off">
                                                                    <input type="checkbox" class="form-check-input" name="is_skrill_enabled" id="is_skrill_enabled" {{(isset($payment['is_skrill_enabled']) && $payment['is_skrill_enabled'] == 'on') ? 'checked' : ''}}>
                                                                    <label class="custom-control-label form-control-label" for="is_skrill_enabled">{{__('Enable Skrill')}}</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="mollie_api_key" class="col-form-label">Skrill Email</label>
                                                                    <input type="text" name="skrill_email" id="skrill_email" class="form-control" value="{{(!isset($payment['skrill_email']) || is_null($payment['skrill_email'])) ? '' : $payment['skrill_email']}}" placeholder="Enter Skrill Email">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- CoinGate -->
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-11">
                                                    <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse10" aria-expanded="true" aria-controls="collapse10">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i> {{ __('CoinGate') }}
                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse10" class="accordion-collapse collapse"aria-labelledby="heading-2-11"data-bs-parent="#accordionExample" >
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                <h5 class="h5">{{ __('CoinGate') }}</h5>
                                                            </div>
                                                            <div class="col-6 py-2 text-end">
                                                                <div class="form-check form-switch d-inline-block">
                                                                    <input type="hidden" name="is_coingate_enabled" value="off">
                                                                    <input type="checkbox" class="form-check-input" name="is_coingate_enabled" id="is_coingate_enabled" {{(isset($payment['is_coingate_enabled']) && $payment['is_coingate_enabled'] == 'on') ? 'checked' : ''}}>
                                                                    <label class="custom-control-label form-control-label" for="is_coingate_enabled">{{__('Enable CoinGate')}}</label>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <label class="col-form-label" for="coingate_mode">CoinGate Mode</label> <br>
                                                                <div class="d-flex">
                                                                    <div class="mr-2" style="margin-right: 15px;">
                                                                        <div class="border card p-3">
                                                                            <div class="form-check">
                                                                                <label class="form-check-labe text-dark">

                                                                                    <input type="radio" name="coingate_mode" value="sandbox" class="form-check-input" {{ !isset($payment['coingate_mode']) || $payment['coingate_mode'] == '' || $payment['coingate_mode'] == 'sandbox' ? 'checked="checked"' : '' }}>

                                                                                    {{__('Sandbox')}}
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mr-2">
                                                                        <div class="border card p-3">
                                                                            <div class="form-check">
                                                                                <label class="form-check-labe text-dark">
                                                                                    <input type="radio" name="coingate_mode" value="live" class="form-check-input" {{ isset($payment['coingate_mode']) && $payment['coingate_mode'] == 'live' ? 'checked="checked"' : '' }}>
                                                                                    {{__('Live')}}
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="coingate_auth_token">CoinGate Auth Token</label>
                                                                    <input type="text" name="coingate_auth_token" id="coingate_auth_token" class="form-control" value="{{(!isset($payment['coingate_auth_token']) || is_null($payment['coingate_auth_token'])) ? '' : $payment['coingate_auth_token']}}" placeholder="CoinGate Auth Token">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <div class="form-group">
                                        <input class="btn btn-print-invoice  btn-primary m-r-10" type="submit" value="{{__('Save Changes')}}">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>

@endsection


@push('script-page')
    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300
        })
    </script>
    <script>
        $(document).on("click", '.send_email', function (e) {
            console.log("sda");
            e.preventDefault();
            var title = $(this).attr('data-title');

            var size = 'md';
            var url = $(this).attr('data-url');
            if (typeof url != 'undefined') {
                $("#commonModal .modal-title").html(title);
                $("#commonModal .modal-dialog").addClass('modal-' + size);
                $("#commonModal").modal('show');

                $.post(url, {
                    mail_driver: $("#mail_driver").val(),
                    mail_host: $("#mail_host").val(),
                    mail_port: $("#mail_port").val(),
                    mail_username: $("#mail_username").val(),
                    mail_password: $("#mail_password").val(),
                    mail_encryption: $("#mail_encryption").val(),
                    mail_from_address: $("#mail_from_address").val(),
                    mail_from_name: $("#mail_from_name").val(),
                }, function (data) {
                    $('#commonModal .modal-body').html(data);
                });
            }
        });
        $(document).on('submit', '#test_email', function (e) {
            e.preventDefault();
            $("#email_sending").show();
            var post = $(this).serialize();
            console.log(post);

            var url = $(this).attr('action');
            $.ajax({
                type: "post",
                url: url,
                data:post,
                cache: false,
                beforeSend: function () {
                    $('#test_email .btn-create').attr('disabled', 'disabled');
                },
                success: function (data) {
                    if (data.is_success) {
                        show_toastr('Success', data.message, 'success');
                    } else {
                        show_toastr('Error', data.message, 'error');
                    }
                    $("#email_sending").hide();
                },
                complete: function () {
                    $('#test_email .btn-create').removeAttr('disabled');
                },
            });
        })
    </script>


    <script>
        $(document).ready(function () {
            if ($('.gdpr_fulltime').is(':checked') ) {

                $('.fulltime').show();
            } else {

                $('.fulltime').hide();
            }

        $('#gdpr_cookie').on('change', function() {
            if ($('.gdpr_fulltime').is(':checked') ) {

                $('.fulltime').show();
            } else {

                $('.fulltime').hide();
            }
        });
    });

        $('.themes-color-change').on('click',function(){
        var color_val = $(this).data('value');
        $('.theme-color').prop('checked', false);
        $('.themes-color-change').removeClass('active_color');
        $(this).addClass('active_color');
        $(`input[value=${color_val}]`).prop('checked', true);

    }); 
    </script>
@endpush

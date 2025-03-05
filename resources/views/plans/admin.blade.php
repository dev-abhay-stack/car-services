{{-- @extends('layouts.admin')

@section('page-title') {{ __('Plans') }} @endsection

@section('action-button')
    @if(Auth::user()->user_type == 'super admin')
        <a href="#" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="modal"
        data-bs-target="#exampleModal" data-url="{{ route('plans.create') }}" data-size="lg"
        data-bs-whatever="{{__('Create New Plan')}}" data-toggle="tooltip"
        data-bs-title="{{__('Create New Plan')}}"> <span class="text-white">
            <i class="ti ti-plus"></i></span>
        </a>
    @endif
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('home')}}">{{__('Dashboard')}}</a></li>
<li class="breadcrumb-item active" aria-current="page">{{__('Plans')}}</li>
@endsection


@section('content') --}}
    {{-- <section class="section">
        <div class="row">
            @foreach ($plans as $key => $plan)
                <div class="col-lg-4 col-xl-3 col-md-6 col-sm-6 mt-4">
                    <div class="plan-3">
                        <h6 class="d-flex align-items-center float-right">
                        <a href="#" data-url="{{route('plans.edit',$plan->id)}}" data-ajax-popup="true" data-title="Edit Assets" class="edit-icon">
                            <i class="fa fa-pencil-alt"></i>
                        </a></h6>
                        <div class="text-center">
                            <a href="#" class="avatar rounded-circle avatar-lg hover-translate-y-n3">
                                <img alt="{{ $plan->name }}" src="{{asset(Storage::url('plans/'.$plan->image))}}" class="">
                            </a>
                            <h6 class="mt-1">
                                {{ $plan->name }}
                                @if((isset($paymentSetting['is_stripe_enabled']) && $paymentSetting['is_stripe_enabled'] == 'on') || (isset($paymentSetting['is_paypal_enabled']) && $paymentSetting['is_paypal_enabled'] == 'on') || (isset($paymentSetting['is_paystack_enabled']) && $paymentSetting['is_paystack_enabled'] == 'on') || (isset($paymentSetting['is_flutterwave_enabled']) && $paymentSetting['is_flutterwave_enabled'] == 'on') || (isset($paymentSetting['is_razorpay_enabled']) &&
                                    $paymentSetting['is_razorpay_enabled'] == 'on') || (isset($paymentSetting['is_mercado_enabled']) && $paymentSetting['is_mercado_enabled'] == 'on') || (isset($paymentSetting['is_paytm_enabled']) && $paymentSetting['is_paytm_enabled'] == 'on') || (isset($paymentSetting['is_mollie_enabled']) && $paymentSetting['is_mollie_enabled'] == 'on') || (isset($paymentSetting['is_skrill_enabled']) && $paymentSetting['is_skrill_enabled'] == 'on') || (isset($paymentSetting['is_coingate_enabled']) && $paymentSetting['is_coingate_enabled'] == 'on'))

                                    <a href="#" class="edit-icon d-flex align-items-center float-right" data-url="{{ route('plans.edit',$plan->id) }}" data-ajax-popup="true" data-title="{{__('Edit Plan')}}" data-toggle="tooltip" data-original-title="{{__('Edit')}}">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                @endif
                            </h6>
                        </div>
                        @if($plan->id != 1)
                            <p class="price">
                                <small> <h6>{{(env('CURRENCY_SYMBOL')) ? env('CURRENCY_SYMBOL') : '$'}}{{$plan->monthly_price}} {{ __('Monthly Price') }}</h6> </small>
                            <small><h6>{{(env('CURRENCY_SYMBOL')) ? env('CURRENCY_SYMBOL') : '$'}}{{$plan->annual_price}} {{ __('Annual Price') }}</h6></small>
                            </p>
                        @endif
                        <ul class="plan-detail">
                            @if($plan->id != 1)
                                <li>{{ ($plan->trial_days < 0)?__('Unlimited'):$plan->trial_days }} {{__('Trial Days')}}</li>
                            @endif
                            <li>{{ ($plan->max_locations < 0)?__('Unlimited'):$plan->max_locations }} {{__('Locations')}}</li>
                            <li>{{ ($plan->max_users < 0)?__('Unlimited'):$plan->max_users }} {{__('Users Per Locations')}}</li>
                            <li>{{ ($plan->max_wo < 0)?__('Unlimited'):$plan->max_wo }} {{__('Work Order Per Location')}}</li>
                        </ul>
                        <div class="text-center">
                            <p class="h6 text-white">
                                {{ $plan->description }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section> --}}


{{-- @endsection --}}

@extends('layouts.admin')
@php
    $dir = asset(Storage::url('uploads/plan'));
@endphp
@section('page-title')
    {{__('Manage Plan')}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('Home')}}</a></li>
    <li class="breadcrumb-item">{{__('Plan')}}</li>
@endsection
@section('action-btn')
    <div class="float-end">
        @can('create plan')
            @if(isset($admin_payment_setting) && !empty($admin_payment_setting))
                @if($admin_payment_setting['is_stripe_enabled'] == 'on' || $admin_payment_setting['is_paypal_enabled'] == 'on' || $admin_payment_setting['is_paystack_enabled'] == 'on' || $admin_payment_setting['is_flutterwave_enabled'] == 'on'|| $admin_payment_setting['is_razorpay_enabled'] == 'on' || $admin_payment_setting['is_mercado_enabled'] == 'on'|| $admin_payment_setting['is_paytm_enabled'] == 'on'  || $admin_payment_setting['is_mollie_enabled'] == 'on'||
                $admin_payment_setting['is_skrill_enabled'] == 'on' || $admin_payment_setting['is_coingate_enabled'] == 'on' || $admin_payment_setting['is_paymentwall_enabled'] == 'on')
                        <a href="#" data-url="{{ route('plans.create') }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Create')}}"  data-title="{{__('Create New Plan')}}" class="btn btn-sm btn-primary">
                            <i class="ti ti-plus"></i>
                        </a>
                @endif
            @endif
        @endcan
    </div>
@endsection
@section('content')
    <div class="row">
        @foreach($plans as $plan)
            <div class="col-lg-4 col-xl-3 col-md-6 col-sm-6">
                <div class="card price-card price-1 wow animate__fadeInUp" data-wow-delay="0.2s" style="
                   visibility: visible;
                   animation-delay: 0.2s;
                   animation-name: fadeInUp;
                   ">
                    <div class="card-body">
                        <span class="price-badge bg-primary">{{ $plan->name }}</span>
                        <h3 class="mb-2 f-w-600 ">{{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$')}}{{ number_format($plan->monthly_price) }}<small class="text-sm">/{{__('Month')}}</small></h3>
                        <h3 class="mb-4 f-w-600 ">{{(env('CURRENCY_SYMBOL')) ? env('CURRENCY_SYMBOL') : '$'}}{{$plan->annual_price}} <small class="text-sm">/{{ __('Annual Price') }}</small></h3>
                        
                        <p class="m-b-0">
                            @if($plan->id != 1)
                            {{__('Trial Days : ')}}   {{ ($plan->trial_days < 0)?__('Unlimited'):$plan->trial_days }}
                            @endif
                        </p>
                        
                        <ul class="list-unstyled my-3">
                            <li> <span class="theme-avtar"><i class="text-primary ti ti-circle-plus"></i></span>{{ ($plan->max_locations < 0)?__('Unlimited'):$plan->max_locations }} {{__('Locations')}}</li>
                            <li><span class="theme-avtar"><i class="text-primary ti ti-circle-plus"></i></span>{{ ($plan->max_users < 0)?__('Unlimited'):$plan->max_users }} {{__('Users Per Locations')}}</li>
                            <li><span class="theme-avtar"><i class="text-primary ti ti-circle-plus"></i></span>{{ ($plan->max_wo < 0)?__('Unlimited'):$plan->max_wo }} {{__('Work Order Per Location')}}</li>
                        </ul>
                        <br>
                        {{-- @can('edit plan') --}}
                            <div class="col-12">
                                <a title="{{__('Edit Plan')}}" href="#" class="btn btn-primary btn-icon m-1"  data-bs-toggle="modal"
                                data-bs-target="#exampleModal" data-size="lg"
                                data-url="{{ route('plans.edit',$plan->id) }}" data-bs-whatever="{{ __('Edit Plan') }}"
                                data-title="{{__('Edit Plan')}}" data-toggle="tooltip" data-original-title="{{__('Edit')}}">
                                    <i class="ti ti-edit"></i>
                                </a>
                            </div>
                        {{-- @endcan --}}
                        @if(isset($admin_payment_setting) && !empty($admin_payment_setting))
                            @if($admin_payment_setting['is_stripe_enabled'] == 'on' || $admin_payment_setting['is_paypal_enabled'] == 'on' || $admin_payment_setting['is_paystack_enabled'] == 'on' || $admin_payment_setting['is_flutterwave_enabled'] == 'on'|| $admin_payment_setting['is_razorpay_enabled'] == 'on' || $admin_payment_setting['is_mercado_enabled'] == 'on'|| $admin_payment_setting['is_paytm_enabled'] == 'on'  || $admin_payment_setting['is_mollie_enabled'] == 'on'||
                            $admin_payment_setting['is_skrill_enabled'] == 'on' || $admin_payment_setting['is_coingate_enabled'] == 'on' ||$admin_payment_setting['is_paymentwall_enabled'] == 'on')
                                @can('buy plan')
                                    @if($plan->id != \Auth::user()->plan)
                                        @if($plan->price > 0)
                                            <a href="{{route('stripe',\Illuminate\Support\Facades\Crypt::encrypt($plan->id))}}" class="btn btn-sm btn-primary">{{__('Buy Plan')}}</a>
                                        @else
                                            <a href="#" class="btn btn-sm btn-primary">{{__('Free')}}</a>
                                        @endif
                                    @endif
                                    @if($plan->id != 1 && $plan->id != \Auth::user()->plan)
                                        @if(\Auth::user()->requested_plan != $plan->id)
                                                <a href="{{ route('send.request',[\Illuminate\Support\Facades\Crypt::encrypt($plan->id)])}}" class="btn btn-sm btn-success btn-icon m-1" data-title="{{__('Send Request')}}" data-bs-toggle="tooltip" title="{{__('Send Request')}}">
                                                    <span class="btn-inner--icon"><i class="ti ti-corner-up-right"></i></span>
                                                </a>
                                        @else
                                                <a href="{{ route('request.cancel',\Auth::user()->id) }}" class="btn btn-sm btn-danger btn-icon m-1" data-title="{{__('Cancle Request')}}" data-bs-toggle="tooltip" title="{{__('Cancle Request')}}">
                                                    <span class="btn-inner--icon"><i class="ti ti-x"></i></span>
                                                </a>
                                        @endif
                                    @endif
                                @endcan
                            @endif
                        @endif
                        @if(\Auth::user()->type=='company' && \Auth::user()->plan == $plan->id)
                            <p class="server-plan text-white">
                                {{__('Plan Expired : ') }} {{!empty(\Auth::user()->plan_expire_date) ? \Auth::user()->dateFormat(\Auth::user()->plan_expire_date):'Unlimited'}}
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection


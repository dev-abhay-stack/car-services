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
                        @if(\Auth::user()->user_type != 'super admin' && \Auth::user()->plan == $plan->id && \Auth::user()->plan_type == 'monthly')
                            <div class="d-flex flex-row-reverse m-0 p-0 ">
                                <span class="d-flex align-items-center ">
                                    <i class="f-10 lh-1 fas fa-circle text-success"></i>
                                    <span class="ms-2">{{ __('Active') }}</span>
                                </span>
                            </div>
                        @endif
                        <h3 class="mb-2 f-w-600 ">{{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$')}}{{ number_format($plan->monthly_price) }}<small class="text-sm">/{{__('Month')}}</small></h3>
                        <h3 class="mb-4 f-w-600 ">{{(env('CURRENCY_SYMBOL')) ? env('CURRENCY_SYMBOL') : '$'}}{{$plan->annual_price}} <small class="text-sm">/{{ __('Annual Price') }}</small></h3>
                        <p class="mb-0">
                            <div class="col-auto">
                                <p class="server-plan">
                                    {{__('Trial Expires on ')}} <b>{{ (date('d M Y',strtotime(\Auth::user()->plan_expire_date))) }}</b>
                                </p>
                            </div>
                        </p>
                        <ul class="list-unstyled">
                            <li> <span class="theme-avtar"><i class="text-primary ti ti-circle-plus"></i></span>{{ ($plan->trial_days < 0)?__('Unlimited'):$plan->trial_days }} {{__('Trial Days')}}</li>
                            <li><span class="theme-avtar"><i class="text-primary ti ti-circle-plus"></i></span>{{ ($plan->max_locations < 0)?__('Unlimited'):$plan->max_locations }} {{__('Locations')}}</li>
                            <li><span class="theme-avtar"><i class="text-primary ti ti-circle-plus"></i></span>{{ ($plan->max_users < 0)?__('Unlimited'):$plan->max_users }} {{__('Users Per Location')}}</li>
                            <li><span class="theme-avtar"><i class="text-primary ti ti-circle-plus"></i></span>{{ ($plan->max_wo < 0)?__('Unlimited'):$plan->max_wo }} {{__('Work Order Per Location')}}</li>
                        </ul>
                        <br>
                        <div class="row align-items-center">
                            @if(Auth::user()->user_type != 'super admin')
                                @if(\Auth::user()->plan == $plan->id && Auth::user()->is_trial_done == 1 && \Auth::user()->plan_type == 'monthly')
                                  
                                    @if(\Auth::user()->plan != $plan->id)
                                        @if((isset($paymentSetting['is_stripe_enabled']) && $paymentSetting['is_stripe_enabled'] == 'on') || (isset($paymentSetting['is_paypal_enabled']) && $paymentSetting['is_paypal_enabled'] == 'on') || (isset($paymentSetting['is_paystack_enabled']) && $paymentSetting['is_paystack_enabled'] == 'on') || (isset($paymentSetting['is_flutterwave_enabled']) && $paymentSetting['is_flutterwave_enabled'] == 'on') || (isset($paymentSetting['is_razorpay_enabled']) && $paymentSetting['is_razorpay_enabled'] == 'on') || (isset($paymentSetting['is_mercado_enabled']) && $paymentSetting['is_mercado_enabled'] == 'on') || (isset($paymentSetting['is_paytm_enabled']) && $paymentSetting['is_paytm_enabled'] == 'on') || (isset($paymentSetting['is_mollie_enabled']) && $paymentSetting['is_mollie_enabled'] == 'on') || (isset($paymentSetting['is_skrill_enabled']) && $paymentSetting['is_skrill_enabled'] == 'on') || (isset($paymentSetting['is_coingate_enabled']) && $paymentSetting['is_coingate_enabled'] == 'on'))
                                            <div class="col-auto">
                                                <div class="text-center">
                                                    <a href="{{route('payment',['monthly', \Illuminate\Support\Facades\Crypt::encrypt($plan->id)])}}" id="interested_plan_{{ $plan->id }}" class="button btn btn-xs rounded-pill">
                                                        <i class="fas fa-cart-plus mr-2"></i>{{ __('Subscribe') }}
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                @elseif(\Auth::user()->plan == $plan->id  && \Auth::user()->plan_type == 'monthly' && (empty(\Auth::user()->plan_expire_date) || date('Y-m-d') < \Auth::user()->plan_expire_date))
                                    <div class="col-auto">
                                        <p class="server-plan">
                                            @if(!empty(\Auth::user()->plan_expire_date))
                                                {{__('Plan Expires on ')}} <b>{{  date('d M Y',strtotime(\Auth::user()->plan_expire_date))}}</b>
                                            @else
                                                <b>{{__('Unlimited')}}</b>
                                            @endif
                                        </p>
                                    </div>
                                @elseif((isset($paymentSetting['is_stripe_enabled']) && $paymentSetting['is_stripe_enabled'] == 'on') || (isset($paymentSetting['is_paypal_enabled']) && $paymentSetting['is_paypal_enabled'] == 'on') || (isset($paymentSetting['is_paystack_enabled']) && $paymentSetting['is_paystack_enabled'] == 'on') || (isset($paymentSetting['is_flutterwave_enabled']) && $paymentSetting['is_flutterwave_enabled'] == 'on') || (isset($paymentSetting['is_razorpay_enabled']) && $paymentSetting['is_razorpay_enabled'] == 'on') || (isset($paymentSetting['is_mercado_enabled']) && $paymentSetting['is_mercado_enabled'] == 'on') || (isset($paymentSetting['is_paytm_enabled']) && $paymentSetting['is_paytm_enabled'] == 'on') || (isset($paymentSetting['is_mollie_enabled']) && $paymentSetting['is_mollie_enabled'] == 'on') || (isset($paymentSetting['is_skrill_enabled']) && $paymentSetting['is_skrill_enabled'] == 'on') || (isset($paymentSetting['is_coingate_enabled']) && $paymentSetting['is_coingate_enabled'] == 'on'))
                                    @if(\Auth::user()->is_trial_done == 0 && $plan->id != 1)
                                        <div class="col">
                                            <a href="{{route('take.a.plan.trial',$plan->id)}}" class="button btn btn-xs rounded-pill">
                                                <i class="fas fa-cart-plus mr-2"></i>{{ __('Active Free Trial') }}
                                            </a>
                                        </div>
                                    @endif

                                    <div class="{{$plan->id == 1 ? 'col-12' :  'col-8' }}">
                                            <a href="{{route('payment',['monthly', \Illuminate\Support\Facades\Crypt::encrypt($plan->id)])}}" id="interested_plan_{{ $plan->id }}" class="btn  btn-primary d-flex justify-content-center align-items-center ">{{__('Subscribe')}} <i class="fas fa-arrow-right m-1"></i></a><p></p>
                                    </div>
                                @endif
                            @endif

                            @if(\Auth::user()->type != 'Super Admin' && \Auth::user()->plan != $plan->id)
                            @if($plan->id != 1)
                                    @if(\Auth::user()->requested_plan != $plan->id)
                                    <div class="col-4">
                                        <a href="{{ route('send.request',[\Illuminate\Support\Facades\Crypt::encrypt($plan->id)]) }}" class="btn btn-primary btn-icon m-1" data-title="{{__('Send Request')}}" data-toggle="tooltip">
                                            <span class="btn-inner--icon"><i class="fas fa-share"></i></span>
                                        </a>
                                        </div>
                                    @else
                                    <div class="col-4">
                                        <a href="{{ route('request.cancel',\Auth::user()->id) }}" class="btn btn-icon m-1 btn-danger" data-title="{{__('Cancle Request')}}" data-toggle="tooltip">
                                            <span class="btn-inner--icon"><i class="fas fa-times"></i></span>
                                        </a>
                                        </div>
                                    @endif

                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

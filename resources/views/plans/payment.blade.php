{{-- @extends('layouts.admin')

@section('page-title')
    {{__('Payment')}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card ">
                <div class="card-header border-0 pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">{{$plan->name}}</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body text-center plan-box">
                    <a href="#" class="avatar rounded-circle avatar-lg hover-translate-y-n3">
                        <img alt="Image placeholder" src="{{asset(Storage::url('plans/').$plan->image)}}" class="">
                    </a>

                    <h5 class="h6 my-4 "><span class="final-price">{{$plan->price}}</span> / {{!empty($plan->subscription_type) ? $plan->subscription_type : ''}}</h5>

                    @if(\Auth::user()->type=='company' && \Auth::user()->plan == $plan->id)
                        <h5 class="h6 my-4">
                            {{__('Expired : ')}} {{\Auth::user()->plan_expire_date ? \Auth::user()->dateFormat(\Auth::user()->plan_expire_date):__('Unlimited')}}
                        </h5>
                    @endif
                    <h5 class="h6 my-4">{{$plan->description}}</h5>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-6 text-center">
                            <span class="h5 mb-0">{{$plan->trial_days}}</span>
                            <span class="d-block text-sm"> {{__('Trial Days')}}</span>
                        </div>
                        <div class="col-6 text-center">
                            <span class="h5 mb-0">{{$plan->max_locations}}</span>
                            <span class="d-block text-sm"> {{__('Locations')}}</span>
                        </div>
                        <div class="col-6 text-center">
                            <span class="h5 mb-0">{{$plan->max_users}}</span>
                            <span class="d-block text-sm"> {{__('Users Per Location')}}</span>
                        </div>
                        <div class="col-6 text-center">
                            <span class="h5 mb-0">{{$plan->max_wo}}</span>
                            <span class="d-block text-sm"> {{__('Work order Per Location')}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-lg-4 order-lg-2">
                    <div class="card plan-stripe-box">
                        <div class="list-group list-group-flush" id="tabs">

                            <div data-href="#stripe-payment" class="custom-list-group-item list-group-item text-primary">
                                <div class="media">
                                    <i class="fas fa-cog pt-1"></i>
                                    <div class="media-body ml-3">
                                        <a href="javascript:void(0)" class="stretched-link h6 mb-1">{{__('Stripe')}}</a>
                                        <p class="mb-0 text-sm">{{__('Details about your plan stript payment')}}</p>
                                    </div>
                                </div>
                            </div>

                            <div data-href="#paypal-payment" class="custom-list-group-item list-group-item">
                                <div class="media">
                                    <i class="fas fa-cog pt-1"></i>
                                    <div class="media-body ml-3">
                                        <a href="javascript:void(0)" class="stretched-link h6 mb-1">{{__('Paypal')}}</a>
                                        <p class="mb-0 text-sm">{{__('Details about your plan paypal payment')}}</p>
                                    </div>
                                </div>
                            </div>

                            <div data-href="#paystack-payment" class="custom-list-group-item list-group-item">
                                <div class="media">
                                    <i class="fas fa-cog pt-1"></i>
                                    <div class="media-body ml-3">
                                        <a href="javascript:void(0)" class="stretched-link h6 mb-1">{{__('Paystack')}}</a>
                                        <p class="mb-0 text-sm">{{__('Details about your plan Paystack payment')}}</p>
                                    </div>
                                </div>
                            </div>

                            <div data-href="#flutterwave-payment" class="custom-list-group-item list-group-item">
                                <div class="media">
                                    <i class="fas fa-cog pt-1"></i>
                                    <div class="media-body ml-3">
                                        <a href="javascript:void(0)" class="stretched-link h6 mb-1">{{__('Flutterwave')}}</a>
                                        <p class="mb-0 text-sm">{{__('Details about your plan Flutterwave payment')}}</p>
                                    </div>
                                </div>
                            </div>

                            <div data-href="#razorpay-payment" class="custom-list-group-item list-group-item">
                                <div class="media">
                                    <i class="fas fa-cog pt-1"></i>
                                    <div class="media-body ml-3">
                                        <a href="javascript:void(0)" class="stretched-link h6 mb-1">{{__('Razorpay')}}</a>
                                        <p class="mb-0 text-sm">{{__('Details about your plan Razorpay payment')}}</p>
                                    </div>
                                </div>
                            </div>

                            <div data-href="#paytm-payment" class="custom-list-group-item list-group-item">
                                <div class="media">
                                    <i class="fas fa-cog pt-1"></i>
                                    <div class="media-body ml-3">
                                        <a href="javascript:void(0)" class="stretched-link h6 mb-1">{{__('Paytm')}}</a>
                                        <p class="mb-0 text-sm">{{__('Details about your plan Paytm payment')}}</p>
                                    </div>
                                </div>
                            </div>

                            <div data-href="#mercadopago-payment" class="custom-list-group-item list-group-item">
                                <div class="media">
                                    <i class="fas fa-cog pt-1"></i>
                                    <div class="media-body ml-3">
                                        <a href="javascript:void(0)" class="stretched-link h6 mb-1">{{__('Mercado Pago')}}</a>
                                        <p class="mb-0 text-sm">{{__('Details about your plan Mercado Pago payment')}}</p>
                                    </div>
                                </div>
                            </div>

                            <div data-href="#mollie-payment" class="custom-list-group-item list-group-item">
                                <div class="media">
                                    <i class="fas fa-cog pt-1"></i>
                                    <div class="media-body ml-3">
                                        <a href="javascript:void(0)" class="stretched-link h6 mb-1">{{__('Mollie')}}</a>
                                        <p class="mb-0 text-sm">{{__('Details about your plan Mollie payment')}}</p>
                                    </div>
                                </div>
                            </div>

                            <div data-href="#skrill-payment" class="custom-list-group-item list-group-item">
                                <div class="media">
                                    <i class="fas fa-cog pt-1"></i>
                                    <div class="media-body ml-3">
                                        <a href="javascript:void(0)" class="stretched-link h6 mb-1">{{__('Skrill')}}</a>
                                        <p class="mb-0 text-sm">{{__('Details about your plan Skrill payment')}}</p>
                                    </div>
                                </div>
                            </div>

                            <div data-href="#coingate-payment" class="custom-list-group-item list-group-item">
                                <div class="media">
                                    <i class="fas fa-cog pt-1"></i>
                                    <div class="media-body ml-3">
                                        <a href="javascript:void(0)" class="stretched-link h6 mb-1">{{__('Coingate')}}</a>
                                        <p class="mb-0 text-sm">{{__('Details about your plan Coingate payment')}}</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-8 order-lg-1">

                    @if(isset($admin_payment_setting['is_stripe_enabled']) && $admin_payment_setting['is_stripe_enabled'] == 'on')

                        <div id="stripe-payment" class="tabs-card {{ (isset($admin_payment_setting['is_stripe_enabled']) && $admin_payment_setting['is_stripe_enabled'] == 'on') ? "active" : "d-none" }}">
                            <div class="card ">
                                <form class="w3-container w3-display-middle w3-card-4" method="POST" id="stripe-payment-form" action="{{ route('stripe.post') }}">
                                    @csrf
                                    <br><h5 class="h6 mb-2 ml-3">{{__('Pay Using Stripe')}}</h5>
                                    <div class="border p-3 mb-3 rounded payment-box stripe-payment-div">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label for="stripe_coupon">{{__('Coupon')}}</label>
                                                    <input type="text" id="stripe_coupon" name="coupon" class="form-control coupon" placeholder="{{ __('Enter Coupon Code') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2 coupon-apply-btn">
                                                <div class="form-group apply-stripe-btn-coupon">
                                                    <a href="#" class="btn btn-primary apply-coupon btn-sm" data-from="stripe">{{ __('Apply') }}</a>
                                                </div>
                                            </div>
                                            <div class="col-12 text-right stripe-coupon-tr" style="display: none">
                                                <b>{{__('Coupon Discount')}}</b> : <b class="stripe-coupon-price"></b>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="error" style="display: none;">
                                                    <div class='alert-danger alert'>{{__('Please correct the errors and try again.')}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3 mr-3">
                                        <div class="text-sm-right">
                                            <input type="hidden" id="stripe" value="stripe" name="payment_processor" class="custom-control-input">
                                            <input type="hidden" name="plan_id" value="{{\Illuminate\Support\Facades\Crypt::encrypt($plan->id)}}">
                                            <input type="hidden" name="stripe_payment_frequency" class="payment_frequency" value="{{$frequency}}">
                                            <button class="btn btn-primary btn-sm pay-button h-auto" type="submit">
                                                <i class="mdi mdi-cash-multiple mr-1"></i> {{__('Pay Now')}} (<span class="stripe-final-price">{{$plan->price }}</span>)
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif

                    @if(isset($admin_payment_setting['is_paypal_enabled']) && $admin_payment_setting['is_paypal_enabled'] == 'on')

                        <div id="paypal-payment" class="tabs-card d-none">
                            <div class="card ">
                                <form class="w3-container w3-display-middle w3-card-4" method="POST" id="paypal-payment-form" action="{{ route('plan.pay.with.paypal') }}">
                                    @csrf
                                    <br><h5 class="h6 mb-2 ml-3">{{__('Pay Using Paypal')}}</h5>
                                    <div class="border p-3 mb-3 rounded payment-box paypal-payment-div">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label for="paypal_coupon">{{__('Coupon')}}</label>
                                                    <input type="text" id="paypal_coupon" name="coupon" class="form-control coupon" placeholder="{{ __('Enter Coupon Code') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2 coupon-apply-btn">
                                                <div class="form-group apply-paypal-btn-coupon">
                                                    <a href="#" class="btn btn-primary apply-coupon btn-sm" data-from="paypal">{{ __('Apply') }}</a>
                                                </div>
                                            </div>
                                            <div class="col-12 text-right paypal-coupon-tr" style="display: none">
                                                <b>{{__('Coupon Discount')}}</b> : <b class="paypal-coupon-price"></b>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="error" style="display: none;">
                                                    <div class='alert-danger alert'>{{__('Please correct the errors and try again.')}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3 mr-3">
                                        <div class="text-sm-right">
                                            <input type="hidden" name="plan_id" value="{{\Illuminate\Support\Facades\Crypt::encrypt($plan->id)}}">
                                            <input type="hidden" name="paypal_payment_frequency" class="payment_frequency" value="{{$frequency}}">
                                            <button class="btn btn-primary btn-sm pay-button h-auto" type="submit">
                                                <i class="mdi mdi-cash-multiple mr-1"></i> {{__('Pay Now')}} (<span class="paypal-final-price">{{$plan->price }}</span>)
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    @endif


                    @if(isset($admin_payment_setting['is_paystack_enabled']) && $admin_payment_setting['is_paystack_enabled'] == 'on')
                        <div class="tabs-card d-none" id="paystack-payment">
                            <div class="card">
                                <form role="form" action="{{ route('plan.pay.with.paystack') }}" method="post" id="paystack-payment-form" class="w3-container w3-display-middle w3-card-4">
                                    @csrf
                                    <br><h5 class="h6 mb-2 ml-3">{{__('Pay Using Paystack')}}</h5>
                                    <div class="border p-3 mb-3 rounded payment-box paystack-payment-div">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label for="paystack_coupon" class="form-control-label text-dark">{{__('Coupon')}}</label>
                                                    <input type="text" id="paystack_coupon" name="coupon" class="form-control coupon" data-from="paystack" placeholder="{{ __('Enter Coupon Code') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2 coupon-apply-btn">
                                                <div class="form-group apply-paystack-btn-coupon">
                                                    <a href="#" class="btn btn-primary apply-coupon btn-sm" data-from="paystack">{{ __('Apply') }}</a>
                                                </div>
                                            </div>
                                            <div class="col-12 text-right paystack-coupon-tr" style="display: none">
                                                <b>{{__('Coupon Discount')}}</b> : <b class="paystack-coupon-price"></b>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="error" style="display: none;">
                                                    <div class='alert-danger alert'>{{__('Please correct the errors and try again.')}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3 mr-3">
                                        <div class="text-sm-right">
                                            <input type="hidden" name="plan_id" value="{{\Illuminate\Support\Facades\Crypt::encrypt($plan->id)}}">
                                            <input type="hidden" name="paystack_payment_frequency" class="payment_frequency" value="{{$frequency}}">
                                            <button class="btn btn-primary btn-sm pay-button h-auto" type="button" id="pay_with_paystack">
                                                <i class="mdi mdi-cash-multiple mr-1"></i> {{__('Pay Now')}} (<span class="paystack-final-price">{{$plan->price }}</span>)</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    @endif

                    @if(isset($admin_payment_setting['is_flutterwave_enabled']) && $admin_payment_setting['is_flutterwave_enabled'] == 'on')

                        <div class="tabs-card d-none" id="flutterwave-payment">
                            <div class="card ">
                                <form role="form" action="{{ route('plan.pay.with.flaterwave') }}" method="post" class="w3-container w3-display-middle w3-card-4" id="flaterwave-payment-form">
                                    @csrf
                                    <br><h5 class="h6 mb-2 ml-3">{{__('Pay Using Flutterwave')}}</h5>
                                    <div class="border p-3 mb-3 rounded payment-box flaterwave-payment-div">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label for="flaterwave_coupon" class="form-control-label text-dark">{{__('Coupon')}}</label>
                                                    <input type="text" id="flaterwave_coupon" name="coupon" class="form-control coupon" data-from="flaterwave" placeholder="{{ __('Enter Coupon Code') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2 coupon-apply-btn">
                                                <div class="form-group pt-3 mt-3">
                                                    <a href="#" class="btn btn-primary apply-coupon btn-sm" data-from="flaterwave">{{ __('Apply') }}</a>
                                                </div>
                                            </div>
                                            <div class="col-12 text-right flaterwave-coupon-tr" style="display: none">
                                                <b>{{__('Coupon Discount')}}</b> : <b class="flaterwave-coupon-price"></b>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="error" style="display: none;">
                                                    <div class='alert-danger alert'>{{__('Please correct the errors and try again.')}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3 mr-3">
                                        <div class="text-sm-right">
                                            <input type="hidden" name="plan_id" value="{{\Illuminate\Support\Facades\Crypt::encrypt($plan->id)}}">
                                            <input type="hidden" name="flutterwave_payment_frequency" class="payment_frequency" value="{{$frequency}}">
                                            <button class="btn btn-primary btn-sm pay-button h-auto" type="button" id="pay_with_flaterwave">
                                                <i class="mdi mdi-cash-multiple mr-1"></i> {{__('Pay Now')}} (<span class="flaterwave-final-price">{{$plan->price }}</span>)
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>


                    @endif

                    @if(isset($admin_payment_setting['is_razorpay_enabled']) && $admin_payment_setting['is_razorpay_enabled'] == 'on')

                        <div class="tabs-card d-none" id="razorpay-payment">
                            <div class="card ">
                                <form role="form" action="{{ route('plan.pay.with.razorpay') }}" method="post" class="w3-container w3-display-middle w3-card-4" id="razorpay-payment-form">
                                    @csrf
                                    <br><h5 class="h6 mb-2 ml-3">{{__('Pay Using Razorpay')}}</h5>
                                    <div class="border p-3 mb-3 rounded payment-box razorpay-payment-div">
                                        <div class="row">
                                            <div class="col-10">
                                                <div class="form-group">
                                                    <label for="razorpay_coupon" class="form-control-label text-dark">{{__('Coupon')}}</label>
                                                    <input type="text" id="razorpay_coupon" name="coupon" class="form-control coupon" data-from="razorpay" placeholder="{{ __('Enter Coupon Code') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2 coupon-apply-btn">
                                                <div class="form-group pt-3 mt-3">
                                                    <a href="#" class="btn btn-primary apply-coupon btn-sm" data-from="razorpay">{{ __('Apply') }}</a>
                                                </div>
                                            </div>
                                            <div class="col-12 text-right razorpay-coupon-tr" style="display: none">
                                                <b>{{__('Coupon Discount')}}</b> : <b class="razorpay-coupon-price"></b>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="error" style="display: none;">
                                                    <div class='alert-danger alert'>{{__('Please correct the errors and try again.')}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3 mr-3">
                                        <div class="text-sm-right">
                                            <input type="hidden" name="plan_id" value="{{\Illuminate\Support\Facades\Crypt::encrypt($plan->id)}}">
                                            <input type="hidden" name="razorpay_payment_frequency" class="payment_frequency" value="{{$frequency}}">
                                            <button class="btn btn-primary btn-sm pay-button h-auto" type="button" id="pay_with_razorpay">
                                                <i class="mdi mdi-cash-multiple mr-1"></i> {{__('Pay Now')}} (<span class="razorpay-final-price">{{ $plan->price }}</span>)
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    @endif

                    @if(isset($admin_payment_setting['is_paytm_enabled']) && $admin_payment_setting['is_paytm_enabled'] == 'on')
                        <div class="tabs-card d-none" id="paytm-payment">
                            <div class="card ">
                                <form role="form" action="{{ route('plan.pay.with.paytm') }}" method="post" class="w3-container w3-display-middle w3-card-4" id="paytm-payment-form">
                                    @csrf
                                    <br><h5 class="h6 mb-2 ml-3">{{__('Pay Using Paytm')}}</h5>
                                    <div class="border p-3 mb-3 rounded payment-box paytm-payment-div">
                                        <div class="row">
                                            <div class="col-10">
                                                <div class="form-group">
                                                    <label for="paytm_coupon" class="form-control-label text-dark">{{__('Mobile Number')}}</label>
                                                    <input type="text" id="mobile" name="mobile" class="form-control mobile" data-from="mobile" placeholder="{{ __('Enter Mobile Number') }}" required>
                                                </div>
                                            </div>
                                            <div class="col-10">
                                                <div class="form-group">
                                                    <label for="paytm_coupon" class="form-control-label text-dark">{{__('Coupon')}}</label>
                                                    <input type="text" id="paytm_coupon" name="coupon" class="form-control coupon" data-from="paytm" placeholder="{{ __('Enter Coupon Code') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group pt-3 mt-3">
                                                    <a href="#" class="btn btn-primary apply-coupon btn-sm" data-from="paytm">{{ __('Apply') }}</a>
                                                </div>
                                            </div>
                                            <div class="col-12 text-right paytm-coupon-tr" style="display: none">
                                                <b>{{__('Coupon Discount')}}</b> : <b class="paytm-coupon-price"></b>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="error" style="display: none;">
                                                    <div class='alert-danger alert'>{{__('Please correct the errors and try again.')}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3 mr-3">

                                        <div class="text-sm-right">
                                            <input type="hidden" name="plan_id" value="{{\Illuminate\Support\Facades\Crypt::encrypt($plan->id)}}">
                                            <input type="hidden" name="paytm_payment_frequency" class="payment_frequency" value="{{$frequency}}">
                                            <button class="btn btn-primary btn-sm pay-button h-auto" type="submit" id="pay_with_paytm">
                                                <i class="mdi mdi-cash-multiple mr-1"></i> {{__('Pay Now')}} (<span class="paytm-final-price">{{$plan->price }}</span>)
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    @endif

                    @if(isset($admin_payment_setting['is_mercado_enabled']) && $admin_payment_setting['is_mercado_enabled'] == 'on')
                        <div class="tabs-card d-none" id="mercadopago-payment">
                            <div class="card ">
                                <form role="form" action="{{ route('plan.pay.with.mercado') }}" method="post" class="w3-container w3-display-middle w3-card-4" id="mercado-payment-form">
                                    @csrf
                                    <br><h5 class="h6 mb-2 ml-3">{{__('Pay Using Mercado Pago')}}</h5>
                                    <div class="border p-3 mb-3 rounded payment-box mercado-payment-div">
                                        <div class="row">
                                            <div class="col-10">
                                                <div class="form-group">
                                                    <label for="mercado_coupon" class="form-control-label text-dark">{{__('Coupon')}}</label>
                                                    <input type="text" id="mercado_coupon" name="coupon" class="form-control coupon" data-from="mercado" placeholder="{{ __('Enter Coupon Code') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group pt-3 mt-3">
                                                    <a href="#" class="btn btn-primary apply-coupon btn-sm" data-from="mercado">{{ __('Apply') }}</a>
                                                </div>
                                            </div>
                                            <div class="col-12 text-right mercado-coupon-tr" style="display: none">
                                                <b>{{__('Coupon Discount')}}</b> : <b class="mercado-coupon-price"></b>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="error" style="display: none;">
                                                    <div class='alert-danger alert'>{{__('Please correct the errors and try again.')}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3 mr-3">

                                        <div class="text-sm-right">
                                            <input type="hidden" name="plan_id" value="{{\Illuminate\Support\Facades\Crypt::encrypt($plan->id)}}">
                                            <input type="hidden" name="mercado_payment_frequency" class="payment_frequency" value="{{$frequency}}">
                                            <button class="btn btn-primary btn-sm pay-button h-auto" type="submit" id="pay_with_paytm">
                                                <i class="mdi mdi-cash-multiple mr-1"></i> {{__('Pay Now')}} (<span class="mercado-final-price">{{$plan->price }}</span>)
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif

                    @if(isset($admin_payment_setting['is_mollie_enabled']) && $admin_payment_setting['is_mollie_enabled'] == 'on')

                        <div class="tabs-card d-none" id="mollie-payment">
                            <div class="card">
                                <form role="form" action="{{ route('plan.pay.with.mollie') }}" method="post" class="w3-container w3-display-middle w3-card-4" id="mollie-payment-form">
                                    @csrf
                                    <br><h5 class="h6 mb-2 ml-3">{{__('Pay Using Mollie')}}</h5>
                                    <div class="border p-3 mb-3 rounded payment-box mollie-payment-div">
                                        <div class="row">
                                            <div class="col-10">
                                                <div class="form-group">
                                                    <label for="mollie_coupon" class="form-control-label text-dark">{{__('Coupon')}}</label>
                                                    <input type="text" id="mollie_coupon" name="coupon" class="form-control coupon" data-from="mollie" placeholder="{{ __('Enter Coupon Code') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group pt-3 mt-3">
                                                    <a href="#" class="btn btn-primary apply-coupon btn-sm" data-from="mollie">{{ __('Apply') }}</a>
                                                </div>
                                            </div>
                                            <div class="col-12 text-right mollie-coupon-tr" style="display: none">
                                                <b>{{__('Coupon Discount')}}</b> : <b class="mollie-coupon-price"></b>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="error" style="display: none;">
                                                    <div class='alert-danger alert'>{{__('Please correct the errors and try again.')}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3 mr-3">

                                        <div class="text-sm-right">
                                            <input type="hidden" name="plan_id" value="{{\Illuminate\Support\Facades\Crypt::encrypt($plan->id)}}">
                                            <input type="hidden" name="mollie_payment_frequency" class="payment_frequency" value="{{$frequency}}">
                                            <button class="btn btn-primary btn-sm pay-button h-auto" type="submit" id="pay_with_mollie">
                                                <i class="mdi mdi-cash-multiple mr-1"></i> {{__('Pay Now')}} (<span class="mollie-final-price">{{$plan->price }}</span>)
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif


                    @if(isset($admin_payment_setting['is_skrill_enabled']) && $admin_payment_setting['is_skrill_enabled'] == 'on')
                        <div class="tabs-card d-none" id="skrill-payment">
                            <div class="card ">
                                <form role="form" action="{{ route('plan.pay.with.skrill') }}" method="post" class="w3-container w3-display-middle w3-card-4" id="skrill-payment-form">
                                    @csrf
                                    <br><h5 class="h6 mb-2 ml-3">{{__('Pay Using Skrill')}}</h5>
                                    <div class="border p-3 mb-3 rounded payment-box skrill-payment-div">
                                        <div class="row">
                                            <div class="col-10">
                                                <div class="form-group">
                                                    <label for="skrill_coupon" class="form-control-label text-dark">{{__('Coupon')}}</label>
                                                    <input type="text" id="skrill_coupon" name="coupon" class="form-control coupon" data-from="skrill" placeholder="{{ __('Enter Coupon Code') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group pt-3 mt-3">
                                                    <a href="#" class="btn btn-primary apply-coupon btn-sm" data-from="skrill">{{ __('Apply') }}</a>
                                                </div>
                                            </div>
                                            <div class="col-12 text-right skrill-coupon-tr" style="display: none">
                                                <b>{{__('Coupon Discount')}}</b> : <b class="skrill-coupon-price"></b>
                                            </div>
                                        </div>
                                        @php
                                            $skrill_data = [
                                                'transaction_id' => md5(date('Y-m-d') . strtotime('Y-m-d H:i:s') . 'user_id'),
                                                'user_id' => 'user_id',
                                                'amount' => 'amount',
                                                'currency' => 'currency',
                                            ];
                                            session()->put('skrill_data', $skrill_data);
                                        @endphp
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="error" style="display: none;">
                                                    <div class='alert-danger alert'>{{__('Please correct the errors and try again.')}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3 mr-3">

                                        <div class="text-sm-right">
                                            <input type="hidden" name="plan_id" value="{{\Illuminate\Support\Facades\Crypt::encrypt($plan->id)}}">
                                            <input type="hidden" name="skrill_payment_frequency" class="payment_frequency" value="{{$frequency}}">
                                            <button class="btn btn-primary btn-sm pay-button h-auto" type="submit" id="pay_with_skrill">
                                                <i class="mdi mdi-cash-multiple mr-1"></i> {{__('Pay Now')}} (<span class="skrill-final-price">{{ $plan->price }}</span>)
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif

                    @if(isset($admin_payment_setting['is_coingate_enabled']) && $admin_payment_setting['is_coingate_enabled'] == 'on')

                        <div class="tabs-card d-none" id="coingate-payment">
                            <div class="card ">
                                <form role="form" action="{{ route('plan.pay.with.coingate') }}" method="post" class="w3-container w3-display-middle w3-card-4" id="coingate-payment-form">
                                    @csrf
                                    <br><h5 class="h6 mb-2 ml-3">{{__('Pay Using Coingate')}}</h5>
                                    <div class="border p-3 mb-3 rounded payment-box coingate-payment-div">
                                        <div class="row">
                                            <div class="col-10">
                                                <div class="form-group">
                                                    <label for="coingate_coupon" class="form-control-label text-dark">{{__('Coupon')}}</label>
                                                    <input type="text" id="coingate_coupon" name="coupon" class="form-control coupon" data-from="coingate" placeholder="{{ __('Enter Coupon Code') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group pt-3 mt-3">
                                                    <a href="#" class="btn btn-primary apply-coupon btn-sm" data-from="coingate">{{ __('Apply') }}</a>
                                                </div>
                                            </div>
                                            <div class="col-12 text-right coingate-coupon-tr" style="display: none">
                                                <b>{{__('Coupon Discount')}}</b> : <b class="coingate-coupon-price"></b>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="error" style="display: none;">
                                                    <div class='alert-danger alert'>{{__('Please correct the errors and try again.')}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3 mr-3">

                                        <div class="text-sm-right">
                                            <input type="hidden" name="plan_id" value="{{\Illuminate\Support\Facades\Crypt::encrypt($plan->id)}}">
                                            <input type="hidden" name="coingate_payment_frequency" class="payment_frequency" value="{{$frequency}}">
                                            <button class="btn btn-primary btn-sm pay-button h-auto" type="submit" id="pay_with_coingate">
                                                <i class="mdi mdi-cash-multiple mr-1"></i> {{__('Pay Now')}} (<span class="coingate-final-price">{{ $plan->price }}</span>)
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script-page')

    <script src="https://js.stripe.com/v3/"></script>
    <script type="text/javascript">
        $(document).ready(function () {

        });

        $(document).on('click', '.apply-coupon', function (e) {
            e.preventDefault();
            var where = $(this).attr('data-from');
            applyCoupon($('#' + where + '_coupon').val(), where);
        })

        $('.custom-list-group-item').on('click', function () {
            var href = $(this).attr('data-href');
            $('.tabs-card').addClass('d-none');
            $(href).removeClass('d-none');
            $('#tabs .custom-list-group-item').removeClass('text-primary');
            $(this).addClass('text-primary');
        });

        function applyCoupon(coupon_code, where) {

            if (coupon_code != null && coupon_code != '') {
                $.ajax({
                    url: '{{route('apply.coupon')}}',
                    datType: 'json',
                    data: {
                        plan_id: '{{\Illuminate\Support\Facades\Crypt::encrypt($plan->id)}}',
                        coupon: coupon_code,
                        frequency: "{{ $frequency }}",
                    },
                    success: function (data) {
                        if (data.is_success) {
                            $('.' + where + '-coupon-tr').show().find('.' + where + '-coupon-price').text(data.discount_price);
                            $('.' + where + '-final-price').text(data.final_price);
                        } else {
                            $('.' + where + '-coupon-tr').hide().find('.' + where + '-coupon-price').text('');
                            $('.' + where + '-final-price').text(data.final_price);
                            show_toastr('Error', data.message, 'error');
                        }
                    }
                })
            } else {
                show_toastr('Error', '{{__('Invalid Coupon Code.')}}', 'error');
                $('.' + where + '-coupon-tr').hide().find('.' + where + '-coupon-price').text('');
            }
        }
    </script>

    @if(isset($admin_payment_setting['is_stripe_enabled']) && $admin_payment_setting['is_stripe_enabled']== 'on' && !empty($admin_payment_setting['stripe_key']) && !empty($admin_payment_setting['stripe_secret']))

        <?php $stripe_session = Session::get('stripe_session');?>
        <?php if(isset($stripe_session) && $stripe_session): ?>
        <script>
            var stripe = Stripe('{{ $admin_payment_setting['stripe_key'] }}');
            stripe.redirectToCheckout({
                sessionId: '{{ $stripe_session->id }}',
            }).then((result) => {
                console.log(result);
            });
        </script>
        <?php endif ?>
    @endif

    @if(isset($admin_payment_setting['is_paystack_enabled']) && $admin_payment_setting['is_paystack_enabled'] == 'on')

        <script src="https://js.paystack.co/v1/inline.js"></script>

        <script>
            $(document).on("click", "#pay_with_paystack", function (e) {

                e.preventDefault();

                $('#paystack-payment-form').ajaxForm(function (res) {
                    if(res.flag == 1){
                        var coupon_id = res.coupon;
                        var frequency = res.frequency;
                        var paystack_callback = "{{ url('/plan/paystack') }}";
                        var order_id = '{{time()}}';
                        var handler = PaystackPop.setup({
                            key: '{{ $admin_payment_setting['paystack_public_key']  }}',
                            email: res.email,
                            amount: res.total_price*100,
                            currency: 'NGN',
                            ref: 'pay_ref_id' + Math.floor((Math.random() * 1000000000) +
                                1
                            ), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
                            metadata: {
                                custom_fields: [{
                                    display_name: "Email",
                                    variable_name: "email",
                                    value: res.email,
                                }]
                            },

                            callback: function(response) {


                                window.location.href = paystack_callback +'/' + response.reference+'/'+'{{encrypt($plan->id)}}'+'?coupon_id='+coupon_id+'&frequency='+frequency+'';
                            },
                            onClose: function() {
                                alert('window closed');
                            }
                        });
                        handler.openIframe();
                    }else if(res.flag == 2){
                        setTimeout(() => {
                            show_toastr('{{__('Success')}}', res.msg, 'success');
                            window.location.href = "{{route('plans.index')}}";
                        }, 2000);

                    }else{
                        show_toastr('Error', res.msg, 'msg');
                    }

                }).submit();
            });
        </script>
    @endif

    @if(isset($admin_payment_setting['is_flutterwave_enabled']) && $admin_payment_setting['is_flutterwave_enabled'] == 'on')
        <script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>

        <script>

        //    Flaterwave Payment
        $(document).on("click", "#pay_with_flaterwave", function (e) {

            e.preventDefault();

            $('#flaterwave-payment-form').ajaxForm(function (res) {
                if(res.flag == 1){
                    var coupon_id = res.coupon;
                    var API_publicKey = '';
                    if("{{ isset($admin_payment_setting['flutterwave_public_key'] ) }}"){
                        API_publicKey = "{{$admin_payment_setting['flutterwave_public_key']}}";
                    }
                    var nowTim = "{{ date('d-m-Y-h-i-a') }}";
                    var flutter_callback = "{{ url('/plan/flaterwave') }}";
                    var x = getpaidSetup({
                        PBFPubKey: API_publicKey,
                        customer_email: '{{Auth::user()->email}}',
                        amount: res.total_price,
                        currency: res.currency,
                        txref: nowTim + '__' + Math.floor((Math.random() * 1000000000)) + 'fluttpay_online-' +
                            {{ date('Y-m-d') }},
                        meta: [{
                            metaname: "payment_id",
                            metavalue: "id"
                        }],
                        onclose: function () {
                        },
                        callback: function (response) {
                            var txref = response.tx.txRef;
                            if (
                                response.tx.chargeResponseCode == "00" ||
                                response.tx.chargeResponseCode == "0"
                            ) {
                                window.location.href = flutter_callback + '/' + txref + '/' + '{{\Illuminate\Support\Facades\Crypt::encrypt($plan->id)}}?coupon_id=' + coupon_id+'&payment_frequency='+res.payment_frequency;
                            } else {
                                // redirect to a failure page.
                            }
                            x.close(); // use this to close the modal immediately after payment.
                        }});
                }else if(res.flag == 2){
                    setTimeout(() => {
                        show_toastr('{{__('Success')}}', res.msg, 'success');
                        window.location.href = "{{route('plans.index')}}";
                    }, 2000);
                }else{
                    show_toastr('Error', res.msg, 'msg');
                }

            }).submit();
        });
        </script>
    @endif

    @if(isset($admin_payment_setting['is_razorpay_enabled']) && $admin_payment_setting['is_razorpay_enabled'] == 'on')
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <script>

            // Razorpay Payment
            $(document).on("click", "#pay_with_razorpay", function (e) {
                e.preventDefault();
                $('#razorpay-payment-form').ajaxForm(function (res) {
                    if(res.flag == 1){

                        var razorPay_callback = '{{url('/plan/razorpay')}}';
                        var totalAmount = res.total_price * 100;
                        var coupon_id = res.coupon;
                        var API_publicKey = '';
                        if("{{isset( $admin_payment_setting['razorpay_public_key']  )}}"){
                            API_publicKey = "{{$admin_payment_setting['razorpay_public_key']}}";
                        }
                        var options = {
                            "key": API_publicKey, // your Razorpay Key Id
                            "amount": totalAmount,
                            "name": 'Plan',
                            "currency": res.currency,
                            "description": "",
                            "handler": function (response) {
                                window.location.href = razorPay_callback + '/' + response.razorpay_payment_id + '/' + '{{\Illuminate\Support\Facades\Crypt::encrypt($plan->id)}}?coupon_id=' + coupon_id+'&payment_frequency='+res.payment_frequency;
                            },
                            "theme": {
                                "color": "#528FF0"
                            }
                        };
                        var rzp1 = new Razorpay(options);
                        rzp1.open();
                    }else if(res.flag == 2){
                        setTimeout(() => {
                            show_toastr('{{__('Success')}}', res.msg, 'success');
                            window.location.href = "{{route('plans.index')}}";
                        }, 2000);
                    }else{
                        show_toastr('Error', res.msg, 'msg');
                    }

                }).submit();
            });
        </script>
    @endif
@endpush --}}

@extends('layouts.admin')
@php
    $dir= asset(Storage::url('uploads/plan'));
@endphp
@push('script-page')

    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    {{-- <script src="https://api.paymentwall.com/brick/build/brick-default.1.5.0.min.js"> </script> --}}
   <script type="text/javascript">
    @if($plan->price > 0.0 && $admin_payment_setting['is_stripe_enabled'] == 'on' && !empty($admin_payment_setting['stripe_key']) && !empty($admin_payment_setting['stripe_secret']))
        var stripe = Stripe('{{ $admin_payment_setting['stripe_key'] }}');
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        var style = {
            base: {
                // Add your base input styles here. For example:
                fontSize: '14px',
                color: '#32325d',
            },
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {style: style});

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Create a token or display an error when the form is submitted.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            stripe.createToken(card).then(function (result) {
                if (result.error) {
                    $("#card-errors").html(result.error.message);
                    toastrs('Error', result.error.message, 'error');
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });

        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }

    @endif

        $(document).ready(function () {
            $(document).on('click', '.apply-coupon', function () {

                var ele = $(this);
                var coupon = ele.closest('.row').find('.coupon').val();
                $.ajax({
                    url: '{{route('apply.coupon')}}',
                    datType: 'json',
                    data: {
                        plan_id: '{{\Illuminate\Support\Facades\Crypt::encrypt($plan->id)}}',
                        coupon: coupon
                    },
                    success: function (data) {
                        $('.final-price').text(data.final_price);
                        $('#stripe_coupon, #paypal_coupon').val(coupon);
                        if (data.is_success) {
                            toastrs('Success', data.message, 'success');
                        } else {
                            toastrs('Error', 'Coupon code is required', 'error');
                        }
                    }
                })
            });
        });

            @if(isset($admin_payment_setting['paystack_public_key']))

                $(document).on("click", "#pay_with_paystack", function () {
                    $('#paystack-payment-form').ajaxForm(function (res) {
                        if (res.flag == 1) {
                            var paystack_callback = "{{ url('/plan/paystack') }}";
                            var order_id = '{{time()}}';
                            var coupon_id = res.coupon;
                            var handler = PaystackPop.setup({
                                key: '{{ $admin_payment_setting['paystack_public_key']  }}',
                                email: res.email,
                                amount: res.total_price * 100,
                                currency: res.currency,
                                ref: 'pay_ref_id' + Math.floor((Math.random() * 1000000000) +
                                    1
                                ), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
                                metadata: {
                                    custom_fields: [{
                                        display_name: "Email",
                                        variable_name: "email",
                                        value: res.email,
                                    }]
                                },

                                callback: function (response) {
                                    console.log(response.reference, order_id);
                                    window.location.href = paystack_callback + '/' + response.reference + '/' + '{{encrypt($plan->id)}}' + '?coupon_id=' + coupon_id
                                },
                                onClose: function () {
                                    alert('window closed');
                                }
                            });
                            handler.openIframe();
                        } else if (res.flag == 2) {

                        }
                        // else {
                        //     toastrs('Error', data.message, 'msg');
                        // }

                    }).submit();
                });

            @endif

            @if(isset($admin_payment_setting['flutterwave_public_key']))
            //    Flaterwave Payment
                $(document).on("click", "#pay_with_flaterwave", function () {
                    $('#flaterwave-payment-form').ajaxForm(function (res) {
                        if (res.flag == 1) {
                            var coupon_id = res.coupon;
                            var API_publicKey = '{{ $admin_payment_setting['flutterwave_public_key']  }}';
                            var nowTim = "{{ date('d-m-Y-h-i-a') }}";
                            var flutter_callback = "{{ url('/plan/flaterwave') }}";
                            var x = getpaidSetup({
                                PBFPubKey: API_publicKey,
                                customer_email: '{{Auth::user()->email}}',
                                amount: res.total_price,
                                currency: '{{env('CURRENCY')}}',
                                txref: nowTim + '__' + Math.floor((Math.random() * 1000000000)) + 'fluttpay_online-' + {{ date('Y-m-d') }},
                                meta: [{
                                    metaname: "payment_id",
                                    metavalue: "id"
                                }],
                                onclose: function () {
                                },
                                callback: function (response) {
                                    var txref = response.tx.txRef;
                                    if (
                                        response.tx.chargeResponseCode == "00" ||
                                        response.tx.chargeResponseCode == "0"
                                    ) {
                                        window.location.href = flutter_callback + '/' + txref + '/' + '{{\Illuminate\Support\Facades\Crypt::encrypt($plan->id)}}?coupon_id=' + coupon_id;
                                    } else {
                                        // redirect to a failure page.
                                    }
                                    x.close(); // use this to close the modal immediately after payment.
                                }
                            });
                        } else if (res.flag == 2) {

                        } else {
                            toastrs('Error', data.message, 'msg');
                        }

                    }).submit();
                });

            @endif

            @if(isset($admin_payment_setting['razorpay_public_key']))
            // Razorpay Payment
                $(document).on("click", "#pay_with_razorpay", function () {
                    $('#razorpay-payment-form').ajaxForm(function (res) {
                        if (res.flag == 1) {

                            var razorPay_callback = '{{url('/plan/razorpay')}}';
                            var totalAmount = res.total_price * 100;
                            var coupon_id = res.coupon;
                            var options = {
                                "key": "{{ $admin_payment_setting['razorpay_public_key']  }}", // your Razorpay Key Id
                                "amount": totalAmount,
                                "name": 'Plan',
                                "currency": '{{env('CURRENCY')}}',
                                "description": "",
                                "handler": function (response) {
                                    window.location.href = razorPay_callback + '/' + response.razorpay_payment_id + '/' + '{{\Illuminate\Support\Facades\Crypt::encrypt($plan->id)}}?coupon_id=' + coupon_id;
                                },
                                "theme": {
                                    "color": "#528FF0"
                                }
                            };
                            var rzp1 = new Razorpay(options);
                            rzp1.open();
                        } else if (res.flag == 2) {

                        } else {
                            toastrs('Error', data.message, 'msg');
                        }

                    }).submit();
                });
            @endif

    </script>
@endpush
@php
    $dir= asset(Storage::url('uploads/plan'));
    $dir_payment= asset(Storage::url('uploads/payments'));
@endphp
@section('page-title')
    {{__('Order Summary')}}
@endsection
@section('title')
    <div class="d-inline-block">
        <h5 class="h4 d-inline-block font-weight-400 mb-0">{{__('Order Summary')}}</h5>
    </div>
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('plans.index')}}">{{__('Plan')}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{__('Order Summary')}}</li>
@endsection
@section('action-btn')
@endsection
@section('content')
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <div class="row">
                <div class="col-xl-3">
                    <div class="sticky-top" style="top:30px">
                        <div class="card ">
                            <div class="list-group list-group-flush" id="useradd-sidenav">
                                @if($admin_payment_setting['is_stripe_enabled'] == 'on' && !empty($admin_payment_setting['stripe_key']) && !empty($admin_payment_setting['stripe_secret']))
                                    <a href="#stripe_payment"
                                        class="list-group-item list-group-item-action">{{ __('Stripe') }}
                                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                    </a>
                                @endif

                                @if($admin_payment_setting['is_paypal_enabled'] == 'on' && !empty($admin_payment_setting['paypal_client_id']) && !empty($admin_payment_setting['paypal_secret_key']))
                                    <a href="#paypal_payment"
                                        class="list-group-item list-group-item-action">{{ __('Paypal') }}
                                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                    </a>
                                @endif

                                @if($admin_payment_setting['is_paystack_enabled'] == 'on' && !empty($admin_payment_setting['paystack_public_key']) && !empty($admin_payment_setting['paystack_secret_key']))
                                    <a href="#paystack_payment"
                                        class="list-group-item list-group-item-action">{{ __('Paystack') }}
                                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                    </a>
                                @endif

                                @if(isset($admin_payment_setting['is_flutterwave_enabled']) && $admin_payment_setting['is_flutterwave_enabled'] == 'on')
                                    <a href="#flutterwave_payment"
                                        class="list-group-item list-group-item-action">{{ __('Flutterwave') }}<div
                                            class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                                @endif

                                @if(isset($admin_payment_setting['is_razorpay_enabled']) && $admin_payment_setting['is_razorpay_enabled'] == 'on')
                                    <a href="#razorpay_payment"
                                        class="list-group-item list-group-item-action">{{ __('Razorpay') }} <div
                                            class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                                @endif

                                @if(isset($admin_payment_setting['is_mercado_enabled']) && $admin_payment_setting['is_mercado_enabled'] == 'on')
                                    <a href="#mercado_payment"
                                        class="list-group-item list-group-item-action">{{ __('Mercado Pago') }}<div
                                            class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                                @endif

                                @if(isset($admin_payment_setting['is_paytm_enabled']) && $admin_payment_setting['is_paytm_enabled'] == 'on')
                                    <a href="#paytm_payment"
                                        class="list-group-item list-group-item-action">{{ __('Paytm') }}
                                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                    </a>
                                @endif

                                @if(isset($admin_payment_setting['is_mollie_enabled']) && $admin_payment_setting['is_mollie_enabled'] == 'on')
                                    <a href="#mollie_payment"
                                        class="list-group-item list-group-item-action">{{ __('Mollie') }}<div
                                            class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                                @endif

                                @if(isset($admin_payment_setting['is_skrill_enabled']) && $admin_payment_setting['is_skrill_enabled'] == 'on')
                                    <a href="#skrill_payment"
                                        class="list-group-item list-group-item-action">{{ __('Skrill') }}<div
                                            class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                                @endif

                                @if(isset($admin_payment_setting['is_coingate_enabled']) && $admin_payment_setting['is_coingate_enabled'] == 'on')
                                    <a href="#coingate_payment"
                                        class="list-group-item list-group-item-action">{{ __('Coingate') }}<div
                                            class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                                @endif

                                @if(isset($admin_payment_setting['is_paymentwall_enabled']) && $admin_payment_setting['is_paymentwall_enabled'] == 'on')
                                    <a href="#paymentwall_payment"
                                        class="list-group-item list-group-item-action">{{ __('Paymentwall') }}<div
                                            class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                                @endif
                            </div>
                        </div>

                        <div class="mt-5">
                            <div class="card price-card price-1 wow animate__fadeInUp" data-wow-delay="0.2s" style="
                                                                        visibility: visible;
                                                                        animation-delay: 0.2s;
                                                                        animation-name: fadeInUp;
                                                                      ">
                                <div class="card-body">
                                    <span class="price-badge bg-primary">{{ $plan->name }}</span>
                                        @if (\Auth::user()->type == 'Owner' && \Auth::user()->plan == $plan->id)
                                            <div class="d-flex flex-row-reverse m-0 p-0 ">
                                                <span class="d-flex align-items-center ">
                                                    <i class="f-10 lh-1 fas fa-circle text-success"></i>
                                                    <span class="ms-2">{{ __('Active') }}</span>
                                                </span>
                                            </div>
                                        @endif

                                    <div class="text-end">
                                        <div class="">
                                            @if (\Auth::user()->type == 'super admin')
                                                <a title="Edit Plan" data-size="lg" href="#" class="action-item"
                                                    data-url="{{ route('plans.edit', $plan->id) }}"
                                                    data-ajax-popup="true" data-title="{{ __('Edit Plan') }}"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="{{ __('Edit Plan') }}"><i class="fas fa-edit"></i></a>
                                            @endif
                                        </div>
                                    </div>

                                        <h3 class="mb-4 f-w-600  ">
                                            <h5 class="h6 my-4 "><span class="final-price">{{$plan->price}}</span> / {{!empty($plan->subscription_type) ? $plan->subscription_type : ''}}</h5>
                                            {{-- {{ env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$' }}{{ $plan->price . ' / ' . __(\App\Models\Plan::$arrDuration[$plan->duration]) }}</small> --}}
                                        </h3>
                                        <p class="mb-0">
                                            {{ __('Trial : ') . $plan->trial_days . __(' Days') }}<br />
                                        </p>
                                        @if ($plan->description)
                                            <p class="mb-0">
                                                {{ $plan->description }}<br />
                                            </p>
                                        @endif
                                        <ul class="list-unstyled">
                                            <li> <span class="theme-avtar"><i class="text-primary ti ti-circle-plus"></i></span>{{ ($plan->trial_days < 0)?__('Unlimited'):$plan->trial_days }} {{__('Trial Days')}}</li>
                                            <li><span class="theme-avtar"><i class="text-primary ti ti-circle-plus"></i></span>{{ ($plan->max_locations < 0)?__('Unlimited'):$plan->max_locations }} {{__('Locations')}}</li>
                                            <li><span class="theme-avtar"><i class="text-primary ti ti-circle-plus"></i></span>{{ ($plan->max_users < 0)?__('Unlimited'):$plan->max_users }} {{__('Users Per Location')}}</li>
                                            <li><span class="theme-avtar"><i class="text-primary ti ti-circle-plus"></i></span>{{ ($plan->max_wo < 0)?__('Unlimited'):$plan->max_wo }} {{__('Work Order Per Location')}}</li>
                                        </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-xl-9">
                    {{-- stripe payment --}}
                    <div id="stripe_payment" class="card">
                        <div class="card-header">
                            <h5>{{ __('Stripe') }}</h5>
                        </div>

                        @if ($admin_payment_setting['is_stripe_enabled'] == 'on' && !empty($admin_payment_setting['stripe_key']) && !empty($admin_payment_setting['stripe_secret']))
                            <div class="tab-pane {{ ($admin_payment_setting['is_stripe_enabled'] == 'on' &&!empty($admin_payment_setting['stripe_key']) &&!empty($admin_payment_setting['stripe_secret'])) == 'on'? 'active': '' }}"
                                id="stripe_payment">
                                <form role="form" action="{{ route('stripe.post') }}" method="post"
                                    class="require-validation" id="payment-form">
                                    @csrf
                                    <div class="border p-3 rounded stripe-payment-div">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="custom-radio">
                                                    <label
                                                        class="font-16 font-weight-bold">{{ __('Credit / Debit Card') }}</label>
                                                </div>
                                                <p class="mb-0 pt-1 text-sm">
                                                    {{ __('Safe money transfer using your bank account. We support Mastercard, Visa, Discover and American express.') }}
                                                </p>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="card-name-on"
                                                        class="form-label text-dark">{{ __('Name on card') }}</label>
                                                    <input type="text" name="name" id="card-name-on"
                                                        class="form-control required"
                                                        placeholder="{{ \Auth::user()->name }}">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div id="card-element">
                                                    <!-- A Stripe Element will be inserted here. -->
                                                </div>
                                                <div id="card-errors" role="alert"></div>
                                            </div>
                                            <div class="col-md-12 mt-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="form-group w-100">
                                                        <label for="paypal_coupon"
                                                            class="form-label">{{ __('Coupon') }}</label>
                                                        <input type="text" id="stripe_coupon" name="coupon"
                                                            class="form-control coupon"
                                                            placeholder="{{ __('Enter Coupon Code') }}">
                                                    </div>
                                                    <div class="form-group ms-3 mt-4">
                                                        <a href="#" class="text-muted apply-coupon" data-toggle="tooltip"
                                                            data-title="{{ __('Apply') }}"><i
                                                                class="fas fa-save"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="error" style="display: none;">
                                                    <div class='alert-danger alert'>
                                                        {{ __('Please correct the errors and try again.') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 my-2 px-2">
                                        <div class="text-end">
                                            <input type="hidden" name="plan_id"
                                                value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                            <input type="submit" value="{{ __('Pay Now') }}"
                                                class="btn btn-primary">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                    {{-- stripr payment end --}}

                    {{-- paypal end --}}
                    <div id="paypal_payment" class="card">
                        <div class="card-header">
                            <h5>{{ __('Paypal') }}</h5>
                        </div>
                        {{-- <div class="card-body"> --}}
                        @if ($admin_payment_setting['is_paypal_enabled'] == 'on' && !empty($admin_payment_setting['paypal_client_id']) && !empty($admin_payment_setting['paypal_secret_key']))
                            <div class="tab-pane {{ ($admin_payment_setting['is_stripe_enabled'] != 'on' &&$admin_payment_setting['is_paypal_enabled'] == 'on' &&!empty($admin_payment_setting['paypal_client_id']) &&!empty($admin_payment_setting['paypal_secret_key'])) == 'on'? 'active': '' }}"
                                id="paypal_payment">
                                {{-- <div class="card"> --}}
                                <form class="w3-container w3-display-middle w3-card-4" method="POST" id="payment-form"
                                    action="{{ route('plan.pay.with.paypal') }}">
                                    @csrf
                                    <input type="hidden" name="plan_id"
                                        value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">

                                    <div class="border p-3 mb-3 rounded">
                                        <div class="row">
                                            <div class="col-md-12 mt-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="form-group w-100">
                                                        <label for="paypal_coupon"
                                                            class="form-label">{{ __('Coupon') }}</label>
                                                        <input type="text" id="paypal_coupon" name="coupon"
                                                            class="form-control coupon"
                                                            placeholder="{{ __('Enter Coupon Code') }}">
                                                    </div>

                                                    <div class="form-group ms-3 mt-4">
                                                        <a href="#" class="text-muted apply-coupon" data-toggle="tooltip"
                                                            data-title="{{ __('Apply') }}"><i
                                                                class="fas fa-save"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 my-2 px-2">
                                        <div class="text-end">
                                            <input type="submit" value="{{ __('Pay Now') }}"
                                                class="btn btn-primary">
                                        </div>
                                    </div>
                                </form>
                                {{-- </div> --}}
                            </div>
                        @endif
                        {{-- </div> --}}
                    </div>
                    {{-- paypal end --}}

                    {{-- Paystack --}}
                    <div id="paystack_payment" class="card">
                        <div class="card-header">
                            <h5>{{ __('Paystack') }}</h5>

                        </div>
                        {{-- <div class="card-body"> --}}
                        @if (isset($admin_payment_setting['is_paystack_enabled']) && $admin_payment_setting['is_paystack_enabled'] == 'on')
                            <div id="paystack-payment" class="tabs-card">
                                <div class="">
                                    <div class="border p-3 mb-3 rounded payment-box">
                                        <div class="d-flex align-items-center">
                                            <div class="form-group w-100">
                                                <label for="paystack_coupon"
                                                    class="form-label">{{ __('Coupon') }}</label>
                                                <input type="text" id="paystack_coupon" name="coupon"
                                                    class="form-control coupon"
                                                    placeholder="{{ __('Enter Coupon Code') }}">
                                            </div>

                                            <div class="form-group ms-3 mt-4">
                                                <a href="#" class="text-muted apply-coupon" data-toggle="tooltip"
                                                    data-title="{{ __('Apply') }}"><i class="fas fa-save"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-12 text-right paymentwall-coupon-tr" style="display: none">
                                            <b>{{__('Coupon Discount')}}</b> : <b class="paymentwall-coupon-price"></b>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 my-2 px-2">
                                        <div class="text-end">
                                            <input type="submit" id="pay_with_paystack" value="{{__('Pay Now')}}" class="btn btn-primary btn-sm">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        {{-- </div> --}}
                    </div>
                    {{-- Paystack end --}}

                    {{-- Flutterwave --}}

                    <div id="flutterwave_payment" class="card">
                        <div class="card-header">
                            <h5>{{ __('Flutterwave') }}</h5>

                        </div>
                        {{-- <div class="card-body"> --}}
                        @if (isset($admin_payment_setting['is_flutterwave_enabled']) && $admin_payment_setting['is_flutterwave_enabled'] == 'on')
                            <div class="tab-pane " id="flutterwave_payment">
                                <form class="w3-container w3-display-middle w3-card-4" method="POST" id="payment-form"
                                    action="{{ route('plan.pay.with.paypal') }}">
                                    @csrf
                                    <input type="hidden" name="plan_id"
                                        value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">

                                    <div class="border p-3 mb-3 rounded payment-box">
                                        <div class="d-flex align-items-center">
                                            <div class="form-group w-100">
                                                <label for="flutterwave_coupon"
                                                    class="form-label">{{ __('Coupon') }}</label>
                                                <input type="text" id="flutterwave_coupon" name="coupon"
                                                    class="form-control coupon"
                                                    placeholder="{{ __('Enter Coupon Code') }}">
                                            </div>

                                            <div class="form-group ms-3 mt-4">
                                                <a href="#" class="text-muted apply-coupon" data-toggle="tooltip"
                                                    data-title="{{ __('Apply') }}"><i class="fas fa-save"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 my-2 px-2">
                                        <div class="text-end">
                                            <input type="submit" id="pay_with_coingate" value="{{__('Pay Now')}}" class="btn btn-primary btn-sm">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>

                    {{-- Flutterwave END --}}

                    {{-- Razorpay --}}
                    <div id="razorpay_payment" class="card">
                        <div class="card-header">
                            <h5>{{ __('Razorpay') }} </h5>

                        </div>
                        {{-- <div class="card-body"> --}}
                        @if (isset($admin_payment_setting['is_razorpay_enabled']) && $admin_payment_setting['is_razorpay_enabled'] == 'on')
                            <div class="tab-pane " id="razorpay_payment">

                                <form class="w3-container w3-display-middle w3-card-4" method="POST" id="payment-form"
                                    action="{{ route('plan.pay.with.paypal') }}">
                                    @csrf
                                    <input type="hidden" name="plan_id"
                                        value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">

                                    <div class="border p-3 mb-3 rounded payment-box">
                                        <div class="d-flex align-items-center">
                                            <div class="form-group w-100">
                                                <label for="razorpay_coupon"
                                                    class="form-label">{{ __('Coupon') }}</label>
                                                <input type="text" id="razorpay_coupon" name="coupon"
                                                    class="form-control coupon"
                                                    placeholder="{{ __('Enter Coupon Code') }}">
                                            </div>

                                            <div class="form-group ms-3 mt-4">
                                                <a href="#" class="text-muted apply-coupon" data-toggle="tooltip"
                                                    data-title="{{ __('Apply') }}"><i class="fas fa-save"></i></a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 my-2 px-2">
                                        <div class="text-end">
                                            <input type="button" id="pay_with_razorpay" value="{{__('Pay Now')}}" class="btn btn-primary btn-sm">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                    {{-- Razorpay end --}}

                    {{-- Mercado Pago --}}
                    <div id="mercado_payment" class="card">
                        <div class="card-header">
                            <h5>{{ __('Mercado Pago') }}</h5>

                        </div>
                        {{-- <div class="card-body"> --}}
                        @if (isset($admin_payment_setting['is_mercado_enabled']) && $admin_payment_setting['is_mercado_enabled'] == 'on')
                            <div class="tab-pane " id="mercado_payment">

                                <form class="w3-container w3-display-middle w3-card-4" method="POST" id="payment-form"
                                    action="{{ route('plan.pay.with.paypal') }}">
                                    @csrf
                                    <input type="hidden" name="plan_id"
                                        value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">

                                    <div class="border p-3 mb-3 rounded payment-box">
                                        <div class="d-flex align-items-center">
                                            <div class="form-group w-100">
                                                <label for="mercado_coupon"
                                                    class="form-label">{{ __('Coupon') }}</label>
                                                <input type="text" id="mercado_coupon" name="coupon"
                                                    class="form-control coupon"
                                                    placeholder="{{ __('Enter Coupon Code') }}">
                                            </div>

                                            <div class="form-group ms-3 mt-4">
                                                <a href="#" class="text-muted apply-coupon" data-toggle="tooltip"
                                                    data-title="{{ __('Apply') }}"><i class="fas fa-save"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 my-2 px-2">
                                        <div class="text-end">
                                            <input type="submit" id="pay_with_mercado" value="{{__('Pay Now')}}" class="btn btn-primary btn-sm">
                                        </div>
                                    </div>
                                </form>

                            </div>
                        @endif
                    </div>
                    {{-- Mercado Pago end --}}

                    {{-- Paytm --}}
                    <div id="paytm_payment" class="card">
                        <div class="card-header">
                            <h5>{{ __('Paytm') }}</h5>

                        </div>
                        {{-- <div class="card-body"> --}}
                        @if (isset($admin_payment_setting['is_paytm_enabled']) && $admin_payment_setting['is_paytm_enabled'] == 'on')
                            <div class="tab-pane " id="paytm_payment">
                                <form class="w3-container w3-display-middle w3-card-4" method="POST" id="payment-form"
                                    action="{{ route('plan.pay.with.paytm') }}">
                                    @csrf
                                    <input type="hidden" name="plan_id"
                                        value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                    <input type="hidden" name="total_price" id="paytm_total_price"
                                        value="{{ $plan->price }}" class="form-control">
                                    <div class="border p-3 mb-3 rounded payment-box">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="mobile_number">{{ __('Mobile Number') }}</label>
                                                    <input type="text" id="mobile_number" name="mobile_number"
                                                        class="form-control coupon"
                                                        placeholder="{{ __('Enter Mobile Number') }}">
                                                </div>
                                            </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="form-group w-100">
                                                        <label for="paytm_coupon"
                                                            class="form-label">{{ __('Coupon') }}</label>
                                                        <input type="text" id="paytm_coupon" name="coupon"
                                                            class="form-control coupon"
                                                            placeholder="{{ __('Enter Coupon Code') }}">
                                                    </div>

                                                    <div class="form-group ms-3 mt-4">
                                                        <a href="#" class="text-muted apply-coupon" data-toggle="tooltip"
                                                            data-title="{{ __('Apply') }}"><i class="fas fa-save"></i></a>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 my-2 px-2">
                                        <div class="text-end">
                                            <button class="btn btn-primary"  id="pay_with_paytm" type="submit">
                                                {{ __('Pay Now') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        @endif
                    </div>
                    {{-- Paytm end --}}

                    {{-- Mollie --}}
                    <div id="mollie_payment" class="card">
                        <div class="card-header">
                            <h5>{{ __('Mollie') }}</h5>

                        </div>
                        {{-- <div class="card-body"> --}}
                        @if (isset($admin_payment_setting['is_mollie_enabled']) && $admin_payment_setting['is_mollie_enabled'] == 'on')
                        <div class="tab-pane " id="mollie_payment">
                                <form class="w3-container w3-display-middle w3-card-4" method="POST" id="payment-form"
                                    action="{{ route('plan.pay.with.mollie') }}">
                                    @csrf
                                    <input type="hidden" name="plan_id"
                                        value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                    <input type="hidden" name="total_price" id="mollie_total_price"
                                        value="{{ $plan->price }}" class="form-control">
                                        <div class="border p-3 mb-3 rounded payment-box">
                                            <div class="d-flex align-items-center">
                                                <div class="form-group w-100">
                                                    <label for="mollie_coupon"
                                                        class="form-label">{{ __('Coupon') }}</label>
                                                    <input type="text" id="mollie_coupon" name="coupon"
                                                        class="form-control coupon"
                                                        placeholder="{{ __('Enter Coupon Code') }}">
                                                </div>

                                                <div class="form-group ms-3 mt-4">
                                                    <a href="#" class="text-muted apply-coupon" data-toggle="tooltip"
                                                        data-title="{{ __('Apply') }}"><i class="fas fa-save"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="col-sm-12 my-2 px-2">
                                        <div class="text-end">
                                            <button class="btn btn-primary" id="pay_with_mollie" type="submit">
                                                 {{ __('Pay Now') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif
                        {{-- Mollie end --}}
                    </div>
                        {{-- Skrill --}}
                        <div id="skrill_payment" class="card">
                            <div class="card-header">
                                <h5>{{ __('Skrill') }}</h5>

                            </div>
                            {{-- <div class="card-body"> --}}
                            @if (isset($admin_payment_setting['is_skrill_enabled']) && $admin_payment_setting['is_skrill_enabled'] == 'on')
                                <div class="tab-pane " id="skrill_payment">

                                    <form class="w3-container w3-display-middle w3-card-4" method="POST" id="payment-form"
                                        action="{{ route('plan.pay.with.skrill') }}">
                                        @csrf
                                        <input type="hidden" name="id"
                                            value="{{ date('Y-m-d') }}-{{ strtotime(date('Y-m-d H:i:s')) }}-payatm">
                                        <input type="hidden" name="order_id"
                                            value="{{ str_pad(!empty($order->id) ? $order->id + 1 : 0 + 1, 4, '100', STR_PAD_LEFT) }}">
                                        @php
                                            $skrill_data = [
                                                'transaction_id' => md5(date('Y-m-d') . strtotime('Y-m-d H:i:s') . 'user_id'),
                                                'user_id' => 'user_id',
                                                'amount' => 'amount',
                                                'currency' => 'currency',
                                            ];
                                            session()->put('skrill_data', $skrill_data);

                                        @endphp
                                        <input type="hidden" name="plan_id"
                                            value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                        <input type="hidden" name="total_price" id="skrill_total_price"
                                            value="{{ $plan->price }}" class="form-control">
                                            <div class="border p-3 mb-3 rounded payment-box">
                                                <div class="d-flex align-items-center">
                                                    <div class="form-group w-100">
                                                        <label for="skrill_coupon"
                                                            class="form-label">{{ __('Coupon') }}</label>
                                                        <input type="text" id="skrill_coupon" name="coupon"
                                                            class="form-control coupon"
                                                            placeholder="{{ __('Enter Coupon Code') }}">
                                                    </div>
                                                    <div class="form-group ms-3 mt-4">
                                                        <a href="#" class="text-muted apply-coupon" data-toggle="tooltip"
                                                            data-title="{{ __('Apply') }}"><i class="fas fa-save"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        <div class="col-sm-12 my-2 px-2">
                                            <div class="text-end">
                                                <button class="btn btn-primary" id="pay_with_skrill" type="submit">
                                                     {{ __('Pay Now') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            @endif
                        </div>
                        {{-- Skrill end --}}

                        {{-- Coingate --}}
                        <div id="coingate_payment" class="card">
                            <div class="card-header">
                                <h5>{{ __('Coingate') }}</h5>

                            </div>
                            {{-- <div class="card-body"> --}}
                            @if (isset($admin_payment_setting['is_coingate_enabled']) && $admin_payment_setting['is_coingate_enabled'] == 'on')
                                <div class="tab-pane " id="coingate_payment">
                                    <form class="w3-container w3-display-middle w3-card-4" method="POST" id="payment-form"
                                        action="{{ route('plan.pay.with.coingate') }}">
                                        @csrf
                                        <input type="hidden" name="counpon" id="coingate_coupon" value="">
                                        <input type="hidden" name="plan_id"
                                            value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                        <input type="hidden" name="total_price" id="coingate_total_price"
                                            value="{{ $plan->price }}" class="form-control">
                                            <div class="border p-3 mb-3 rounded payment-box">
                                                <div class="d-flex align-items-center">
                                                    <div class="form-group w-100">
                                                        <label for="coingate_coupon"
                                                            class="form-label">{{ __('Coupon') }}</label>
                                                        <input type="text" id="coingate_coupon" name="coupon"
                                                            class="form-control coupon"
                                                            placeholder="{{ __('Enter Coupon Code') }}">
                                                    </div>

                                                    <div class="form-group ms-3 mt-4">
                                                        <a href="#" class="text-muted apply-coupon" data-toggle="tooltip"
                                                            data-title="{{ __('Apply') }}"><i class="fas fa-save"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 my-2 px-2">
                                                <div class="text-end">
                                                    <button class="btn btn-primary" id="pay_with_coingate" type="submit">
                                                        {{ __('Pay Now') }}
                                                    </button>
                                                </div>
                                            </div>
                                    </form>
                                </div>
                            @endif
                        </div>
                        {{-- Coingate end --}}


                    </div>
            </div>
        </div>
    </div>

@endsection



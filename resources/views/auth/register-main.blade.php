

@extends('layouts.auth')

@push('custom-scripts')
@if(env('RECAPTCHA_MODULE') == 'yes')
        {!! NoCaptcha::renderJs() !!}
@endif
@endpush

@section('content')

			<div class="card">
				<div class="row align-items-center text-start">
					<div class="col-xl-6">
                        {{Form::open(array('route'=>'register','method'=>'post','id'=>'loginForm'))}}
                            <div class="card-body">
                                <div class="">
                                    <h2 class="mb-3 f-w-600">{{ __('Register') }}</h2>

                                </div>
                                <div class="">
                                    <div class="form-group mb-3">
                                        <label class="form-label">{{ __('Full Name') }}</label>
                                        {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Username')))}}
                                    </div>
                                    @error('name')
                                    <span class="error invalid-name text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <div class="form-group mb-3">
                                        <label class="form-label">{{ __('Email') }}</label>
                                        {{Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Email address')))}}
                                    </div>
                                    @error('email')
                                    <span class="error invalid-email text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <div class="form-group mb-3">
                                        <label class="form-label">{{ __('Password') }}</label>
                                        {{Form::password('password',array('class'=>'form-control','id'=>'input-password','placeholder'=>__('Password')))}}
                                    </div>
                                    @error('password')
                                    <span class="error invalid-password text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <div class="form-group">
                                        <label class="form-control-label">{{__('Confirm password')}}</label>
                                            {{Form::password('password_confirmation',array('class'=>'form-control','id'=>'confirm-input-password','placeholder'=>__('Confirm Password')))}}
                                          
                                        @error('password_confirmation')
                                        <span class="error invalid-password_confirmation text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="d-grid">
                                        <button class="btn btn-primary btn-block mt-2">{{ __('Register') }}</button>
                                    </div>

                                </div>
                                <p class="mb-2 my-4 text-center">{{ __('Already have an account?') }} <a href="{{ route('login') }}" class="f-w-400">{{ __('Login') }}</a></p>
                            </div>
                          </div>
                          <div class="col-xl-6 img-card-side">
                            <div class="auth-img-content">
                              <img src="{{ asset('assets/images/auth/img-auth-3.svg') }}" alt="" class="img-fluid">
                              <h3 class="text-white mb-4 mt-5">{{ __('“Attention is the new currency”') }}</h3>
                              <p class="text-white">{{ __('The more effortless the writing looks, the more effort the writer
                                actually put into the process.')}}</p>
                            </div>
                          </div>
                        </div>
                      </div>

@endsection




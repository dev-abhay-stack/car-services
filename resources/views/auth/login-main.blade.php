{{-- @extends('layouts.auth')

@section('title')
    {{ __('Login') }}
@endsection
@php
$logo = asset(Storage::url('logo/logo.png'));
@endphp
@section('content')
<div class="page-content">
    <div class="min-vh-100 py-5 d-flex align-items-center">
        <div class="w-100">
            <div class="row justify-content-center">
                <div class="col-sm-8 col-lg-4">
                  <div class="row justify-content-center mb-3">
                    <a class="navbar-brand" href="{{url('/')}}">
                        <img src="{{ $logo }}" class="auth-logo" width="300">
                    </a>
                  </div>
                    <div class="card shadow zindex-100 mb-0">
                        <div class="card-body px-md-5 py-5">
                            <div class="mb-5">
                                <h6 class="h3">{{__('Login')}}</h6>
                                <p class="text-muted mb-0">{{__('Sign in to your account to continue.')}}</p>
                            </div>
                            <span class="clearfix"></span>
                            <form id="form_data" role="form" method="POST" action="{{ route('login') }}">
                              @csrf
                              <div class="form-group">
                                <label class="form-control-label" for="email">{{__('Email')}}</label>
                                <div class="input-group input-group-merge">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                  </div>
                                  <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{old('email')}}" required autofocus>
                                </div>
                              </div>
                              <div class="form-group mb-4">
                                <div class="d-flex align-items-center justify-content-between">
                                  <div>
                                    <label class="form-control-label" for="password">{{__('Password')}}</label>
                                  </div>
                                  @if (Route::has('password.request'))
                                  <div class="mb-2">
                                    <a href="{{ route('password.request') }}" class="small text-muted text-underline--dashed border-primary">{{ __('Forgot your password?') }}</a>
                                  </div>
                                  @endif
                                </div>
                                <div class="input-group input-group-merge">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                  </div>
                                  <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                                  <div class="input-group-append">
                                    <span class="input-group-text">
                                      <a href="#" data-toggle="password-text" data-target="#password">
                                        <i class="fas fa-eye"></i>
                                      </a>
                                    </span>
                                  </div>
                                </div>
                              </div>
                              <div class="mt-4">
                                <button id="login_button" type="submit" class="btn btn-sm btn-primary btn-icon rounded-pill">
                                  <span class="btn-inner--text">{{ __('Log in') }}</span>
                                  <span class="btn-inner--icon"><i class="fas fa-long-arrow-alt-right"></i></span>
                                </button></div>
                            </form>
                        </div>
                    <div class="card-footer px-md-5"><small>{{ __('Not registered?')}}</small>
                        <a href="{{route('register')}}" class="small font-weight-bold">{{ __('Create account')}}</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
<script>
$(document).ready(function () {

  $("#form_data").submit(function (e) {
      $("#login_button").attr("disabled", true);
      return true;
  });
});
</script>
 --}}


@extends('layouts.auth')

@push('custom-scripts')
@if(env('RECAPTCHA_MODULE') == 'yes')
{!! NoCaptcha::renderJs() !!}
@endif
@endpush

@php
    $currantLang = basename(App::getLocale());
@endphp

@section('content')

<!-- [ auth-signup ] start -->
		<div class="card">
			<div class="row align-items-center text-start">
				<div class="col-xl-6">
					<div class="card-body">
						<div class="">
							<h2 class="mb-3 f-w-600">{{ __('Login') }}</h2>
						</div>
						{{Form::open(array('route'=>'login','method'=>'post','id'=>'loginForm','class'=> 'login-form'
						))}}
						<div class="">
							<div class="form-group mb-3">
								<label class="form-label">{{ __('Email') }}</label>
								{{Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter Your Email')))}}
								@error('email')
								<span class="error invalid-email text-danger" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror

							</div>
							<div class="form-group mb-3">
								<label class="form-label">{{ __('Password') }}</label>
								{{Form::password('password',array('class'=>'form-control','placeholder'=>__('Enter Your Password'),'id'=>'input-password'))}}

								@if (Route::has('password.request'))
								<div class="mb-2 ms-2 mt-3">
									<a href="{{ route('password.request') }}"
										class="small text-muted text-underline--dashed border-primary">
										{{__('Forgot Your Password?')}}</a>
								</div>
								@endif

								@error('password')
								<span class="error invalid-password text-danger" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror

							</div>


							@if(env('RECAPTCHA_MODULE') == 'yes')
							<div class="form-group col-lg-12 col-md-12 mt-3">
								{!! NoCaptcha::display() !!}
								@error('g-recaptcha-response')
								<span class="small text-danger" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
							@endif
							<div class="d-grid">
								{{Form::submit(__('Sign in'),array('class'=>'btn btn-primary btn-block mt-2','id'=>'saveBtn'))}}
							</div>
							{{ Form::close() }}

							{{-- @if(Utility::getValByName('SIGNUP') == 'on') --}}
							<p class="my-4 text-center">{{ __('Dont have an account?') }}
									<a href="{{ route('register') }}" class="my-4 ">{{ __('Register') }}</a>
							</p>
							{{-- @endif --}}
						</div>

					</div>
				</div>
				<div class="col-xl-6 img-card-side">
					<div class="auth-img-content">
						<img src="{{ asset('assets/images/auth/img-auth-3.svg') }}" alt="" class="img-fluid">
						<h3 class="text-white mb-4 mt-5"> {{ __('“Attention is the new currency”') }}</h3>
						<p class="text-white"> {{__('The more effortless the writing looks, the more effort the writer
							actually put into the process.')}}</p>
					</div>
				</div>
			</div>
		</div>
		

<!-- [ auth-signup ] end -->

@endsection


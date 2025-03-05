@extends('layouts.auth')

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



@extends('layouts.auth')

@section('title')
    {{ __('Register') }}
@endsection
@php
$logo = asset(Storage::url('logo/logo.png'));
@endphp
@section('content')

<div class="page-content">
    <div class="min-vh-100 py-5 d-flex align-items-center">
      <div class="w-100">
        <div class="row justify-content-center">
          <div class="col-sm-8 col-lg-5">
            <div class="row justify-content-center mb-3">
                  <a class="navbar-brand" href="{{url('/')}}">
                      <img src="{{ $logo }}" class="auth-logo" width="300">
                  </a>
              </div>
            <div class="card shadow zindex-100 mb-0">
              <div class="card-body px-md-5 py-5">
                <div class="mb-5">
                  <h6 class="h3">{{__('Create account')}}</h6>
                </div>
                <span class="clearfix"></span>
                <form role="form" method="POST" action="{{ route('register') }}">
                  @csrf
                  <div class="form-group">
                    <label class="form-control-label" for="name">{{__('Name')}}</label>
                    <div class="input-group input-group-merge">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                      </div>
                      <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name')}}" required autofocus>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label" for="email">{{__('Email')}}</label>
                    <div class="input-group input-group-merge">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                      </div>
                      <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{old('email')}}" required>
                    </div>
                  </div>
                  <div class="form-group mb-4">
                    <label class="form-control-label" for="password">{{__('Password')}}</label>
                    <div class="input-group input-group-merge">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                      </div>
                      <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" required name="password">
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <a href="#" data-toggle="password-text" data-target="#password">
                            <i class="fas fa-eye"></i>
                          </a>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label" for="password_confirmation">{{__('Confirm password')}}</label>
                    <div class="input-group input-group-merge">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                      </div>
                      <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>
                  </div>
                  <div class="mt-4"><button type="submit" class="btn btn-sm btn-primary btn-icon rounded-pill">
                      <span class="btn-inner--text">{{__('Create my account')}}</span>
                      <span class="btn-inner--icon"><i class="fas fa-long-arrow-alt-right"></i></span>
                    </button></div>
                </form>
              </div>
              <div class="card-footer px-md-5"><small>{{__('Already have an acocunt?')}}</small>
                <a href="{{route('login')}}" class="small font-weight-bold">{{__('Sign in')}}</a></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

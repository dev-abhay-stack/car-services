@extends('layouts.auth')
@section('page-title')
    {{__('Reset Password')}}
@endsection
@section('content')
<div class="page-content">
    <div class="min-vh-100 py-5 d-flex align-items-center">
        <div class="w-100">
            <div class="row justify-content-center">
                <div class="form-group auth-lang">
                    {{-- <select name="language" id="language" class="form-control" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                        @foreach(Utility::languages() as $language)
                            <option @if($lang == $language) selected @endif value="{{ route('login',$language) }}">{{Str::upper($language)}}</option>
                        @endforeach
                    </select> --}}
                </div>
                <div class="col-sm-8 col-lg-5 col-xl-4">
                    <div class="row justify-content-center mb-3">
                        <a class="navbar-brand" href="#">
                            <img src="{{asset(Storage::url('logo/logo.png'))}}" class="auth-logo" width="250">
                        </a>
                    </div>
                    <div class="card shadow zindex-100 mb-0">
                        <div class="card-body px-md-5 py-5">
                            <div class="mb-5">
                                <h6 class="h3">{{_('Password Reset')}}</h6>
                                <p class="text-muted mb-0">{{_('Enter your email below to proceed.')}}</p>
                            </div>
                            @if (session('status'))
                                <small class="text-muted">{{ session('status') }}</small>
                            @endif
                            <span class="clearfix"></span>
                            {{Form::open(array('route'=>'password.email','method'=>'post','id'=>'loginForm'))}}
                            @csrf
                            <div class="form-group">
                                {{Form::label('email',__('Email'),array('class' => 'form-control-label') )}}
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    {{Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter Your Email')))}}
                                </div>
                                @error('email')
                                <span class="invalid-email text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            @if(env('RECAPTCHA_MODULE') == 'yes')
                            <div class="form-group mt-3">
                                {!! NoCaptcha::display() !!}
                                @error('g-recaptcha-response')
                                <span class="small text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            @endif

                            <div class="mt-4">
                                {{Form::submit(__(' Forgot Password'),array('class'=>'btn btn-sm btn-primary btn-icon rounded-pill','id'=>'saveBtn'))}}
                            </div>
                            {{Form::close()}}
                        </div>
                        <div class="card-footer px-md-5"><small>Back to?</small>
                            <a href="{{ url('login') }}" class="small font-weight-bold">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection



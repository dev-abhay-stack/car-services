@extends('layouts.main')
@section('title', 'Form')
@section('content')

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Create Forms') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('forms.index') }}">{{ __('Form') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Create') }}</div>
                </div>
            </div>

            <div class="section-body">

                <form class="form-horizontal" method="POST" id='payment-form' enctype="multipart/form-data"
                    action="{{ route('forms.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-xl-6 mx-auto order-xl-1">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="heading-small text-muted mb-4">{{ __('Create Form') }}</h6>

                                    <div class="">
                                        <div class=" row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="name">{{ __('Title of form') }}</label>
                                                    <input type="text" name="title" class="form-control" id="password"
                                                        placeholder="{{ __('Title of form') }}">
                                                    @if ($errors->has('form'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('form') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>

                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="name">{{ __('Select Logo') }}</label>
                                                    <input type="file" name="form_logo" class="form-control"
                                                        value="Select  Logo">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>{{ __('Recipient Emails') }}</label>
                                                    <input type="text" name="email[]" class="form-control inputtags">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="success_msg">{{ __('Success Message') }}</label>
                                                    <textarea name="success_msg" class="form-control" id="success_msg"
                                                        placeholder="{{ __('Success Message') }}"></textarea>
                                                    @if ($errors->has('success_msg'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('success_msg') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="thanks_msg">{{ __('Client Message') }}</label>
                                                    <textarea name="thanks_msg" class="form-control" id="thanks_msg"
                                                        placeholder="{{ __('Client Message') }}"></textarea>
                                                    @if ($errors->has('thanks_msg'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('thanks_msg') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>{{ __('Role') }}</label>
                                                    {!! Form::select('roles[]', $roles, null, ['class' => 'form-control custom_select ', 'multiple' => 'multiple']) !!}
                                                </div>
                                            </div>

                                            <div class="col-md-8 form-group">
                                                <label class="d-block">{{ __('Payment') }}</label>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="custom-switch mt-2 float-right">
                                                    <input name="payment" class="custom-switch-input" type="checkbox"
                                                       
                                                        {{ setting('payment') == '1' ? 'checked' : 'unchecked' }}>
                                                    <span class="custom-switch-indicator"></span>
                                                </label>
                                            </div>
                                            <div class="card-body {{ setting('payment') == '1' ? 'block' : 'd-none' }}"
                                                id="payment">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="amount">{{ __('Amount') }}</label>
                                                        <input type="number" name="amount" class="form-control"
                                                            id="amount" placeholder="{{ __('Amount') }}">
                                                        @if ($errors->has('amount'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('amount') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="currency_symbol">{{ __('Currency Symbol') }}</label>
                                                        <input name="currency_symbol" class="form-control"
                                                            id="currency_symbol"
                                                            placeholder="{{ __('Currency symbol') }}">
                                                        @if ($errors->has('currency_symbol'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('currency_symbol') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="currency_name">{{ __('Currency Name') }}</label>
                                                        <input name="currency_name" class="form-control"
                                                            id="currency_name" placeholder="{{ __('Currency name') }}">
                                                        <p>{{ __('The name of currency is to be taken frome this document.') }}
                                                            <a href="https://stripe.com/docs/currencies"
                                                                class="m-2"
                                                                target="_blank">{{ __('Document') }}</a> </p>

                                                        @if ($errors->has('currency_name'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('currency_name') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" mt-4 ">
                                        <button type="submit"
                                            class=" form_payment btn btn-primary col-md-2 float-right ">{{ __('Create Form') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
@push('style')
    <link href="{{ asset('assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" />
@endpush

@push('script')
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script src="{{ asset('assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script>
        $(".inputtags").tagsinput('items');
        $(document).ready(function() {
            $(".custom_select").select2();
        })
    </script>
    <script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('success_msg', {
            filebrowserUploadUrl: "{{ route('ckeditors.upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace('thanks_msg', {
            filebrowserUploadUrl: "{{ route('ckeditors.upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });
    </script>
    <script>
        $(document).on('click', "input[name$='payment']", function() {
            if (this.checked) {
                $('#payment').fadeIn(500);
                $("#payment").removeClass('d-none');
                $("#payment").addClass('d-block');
            } else {
                $('#payment').fadeOut(500);
                $("#payment").removeClass('d-block');
                $("#payment").addClass('d-none');
            }
        })
    </script>

@endpush

@extends('layouts.admin')

@section('page-title', __('Settings'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('home')}}">{{__('Dashboard')}}</a></li>
<li class="breadcrumb-item active" aria-current="page">{{__('Settings')}}</li>
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
                            <a href="#useradd-2" class="list-group-item list-group-item-action border-0">{{ __('System Setting') }}
                                <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#useradd-3" class="list-group-item list-group-item-action border-0">{{ __('Email Setting') }}
                                <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9">
                    <div id="useradd-1" class="card">
                        {{ Form::open(['route' => ['user.settings.store'], 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
                        <div class="card-header">
                            <h5>{{ __('Site Setting') }}</h5>
                            <small class="text-muted">{{ __('Edit details about your Company') }}</small>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                

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
                                                            <img src="{{ asset(Storage::url('logo/' . (!empty($location['favicon']) ? $location['favicon'] : 'favicon.png'))) }}"
                                                                class="small-logo" alt="" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="choose-files mt-5">
                                                            <label for="favicon">
                                                                <div class=" bg-primary logo_update"> <i class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                                                </div>
                                                                <input type="file" class="form-control file" name="favicon" id="small-favicon" data-filename="edit-favicon" accept=".jpeg,.jpg,.png" accept=".jpeg,.jpg,.png">
                                                            </label>
                                                        </div>
                                                    </div>

                                                    {{-- <div class="col-12">
                                                        <div class="choose-file">
                                                            <label for="favicon" class="form-label">
                                                                <div>{{ __('Choose file here') }}</div>
                                                                <input type="file" class="form-control" name="favicon"
                                                                    id="small-favicon" data-filename="edit-favicon">
                                                            </label>
                                                            <p class="edit-favicon"></p>
                                                        </div>
                                                    </div> --}}
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

                                                            <img  src="{{ asset(Storage::url('logo/' . (!empty($location['logo']) ? $location['logo'] : 'logo-dark.png'))) }}"
                                                                class="big-logo" alt="" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="choose-files mt-5">
                                                            <label for="logo">
                                                                <div class=" bg-primary logo_update"> <i class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                                                </div>
                                                                <input type="file" class="form-control file" name="logo" id="logo" data-filename="edit-logo" accept=".jpeg,.jpg,.png" accept=".jpeg,.jpg,.png">
                                                            </label>
                                                        </div>

                                                        {{-- <div class="choose-file">
                                                            <label for="logo" class="form-label">
                                                                <div>{{ __('Choose file here') }}</div>
                                                                <input type="file" class="form-control" name="logo" id="logo"
                                                                    data-filename="edit-logo">
                                                            </label>
                                                            <p class="edit-logo"></p>
                                                        </div> --}}
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

                                                            <img  src="{{ asset(Storage::url('logo/' . (!empty($location['white_logo']) ? $location['white_logo'] : 'logo-light.png'))) }}"
                                                            class="big-logo" alt="" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12">

                                                        <div class="choose-files mt-5">
                                                            <label for="logo">
                                                                <div class=" bg-primary logo_update"> <i class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                                                </div>
                                                                <input type="file" class="form-control file" name="white_logo" id="white_logo" data-filename="edit-white_logo" accept=".jpeg,.jpg,.png" accept=".jpeg,.jpg,.png">
                                                            </label>
                                                        </div>

                                                        {{-- <div class="choose-file">
                                                            <label for="logo" class="form-label">
                                                                <div>{{ __('Choose file here') }}</div>
                                                                <input type="file" class="form-control" name="white_logo"
                                                                    id="white_logo" data-filename="edit-white_logo">
                                                            </label>
                                                            <p class="edit-white_logo"></p>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{Form::label('header_text',__('Title Text'),['class'=>'col-form-label text-dark']) }}
                                        <input class="form-control" placeholder="Title Text" name="title_text"
                                        type="text"
                                        value="{{ !empty($location['title_text']) ? $location['title_text'] : '' }}"
                                        id="title_text">
                                        @error('title_text')
                                        <span class="invalid-header_text" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                     
                                        {{ Form::label('header_text', __('Footer Text'), ['class' => 'col-form-label text-dark']) }}
                                        <input class="form-control" placeholder="Title Text"
                                        name="footer_text" type="text"
                                        value="{{ !empty($location['footer_text']) ? $location['footer_text'] : '' }}"
                                        id="footer_text">
                                        @error('footer_text')
                                        <span class="invalid-footer_text" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="modal-footer">
                                    {{Form::submit(__('Save Change'),array('class'=>'btn btn-print-invoice  btn-primary m-r-10'))}}
                                </div>
                            </div>

                        </div>

                        {{ Form::close() }}
                    </div>

                    <div id="useradd-2" class="card">
                        {{ Form::open(['route' => ['user.settings.store'], 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
                        <div class="card-header">
                            <h5>{{ __('System Setting') }}</h5>
                            <small class="text-muted">{{ __('Edit details about your Company Sysem Setting') }}</small>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="title_text" class="form-label">{{ __('Date format') }}</label>
                                        {!! Form::select('date_format', ['d/m/Y' => 'DD/MM/YYYY', 'm-d-Y' => 'MM-DD-YYYY', 'd-m-Y' => 'DD-MM-YYYY'], !empty($location['date_format']) ? $location['date_format'] : '', ['class' => 'form-control ', 'required' => 'required']) !!}

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="title_text" class="form-label">{{ __('Currency') }}</label>
                                        <input class="form-control" placeholder="Title Text" name="currency" type="text"
                                            id="currency"
                                            value="{{ !empty($location['currency']) ? $location['currency'] : '' }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label text-dark"
                                            for="example3cols3Input">{{ __('Currency Symbol Position') }}</label>
                                        <div class="row">
                                            <div class=" col-sm-6 col-md-12">
                                                <div class="d-flex radio-check">
                                                    <div class="form-check form-check-inline">
                                                        {!! Form::radio('site_currency_symbol_position', 'pre', !empty($location['site_currency_symbol_position']) && $location['site_currency_symbol_position'] == 'pre' ? true : false, ['class' => 'custom-control-input form-check-input', 'id' => 'pre_symbol']) !!}
                                                        <label class="custom-control-label"
                                                            for="pre_symbol">{{ __('Pre') }}</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        {!! Form::radio('site_currency_symbol_position', 'post', !empty($location['site_currency_symbol_position']) && $location['site_currency_symbol_position'] == 'post' ? true : false, ['class' => 'custom-control-input form-check-input', 'id' => 'post_symbol']) !!}
                                                        <label class="custom-control-label"
                                                            for="post_symbol">{{ __('Post') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" value="{{ __('Save Changes') }}" class="btn btn-primary">
                                </div>
                            </div>
                        </div>

                        {{ Form::close() }}
                    </div>


                    <div id="useradd-3" class="card">
                        {{ Form::open(['route' => 'user.email.settings.store', 'method' => 'post']) }}
                        <div class="card-header">
                            <h5>{{ __('Email Setting') }}</h5>
                            <small class="text-muted">{{ __('Edit details about your Company Email Setting') }}</small>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-4 form-group">
                                    {{ Form::label('mail_driver', __('Mail Driver'), ['class' => 'form-label']) }}
                                    {{ Form::text('mail_driver', !empty($email_data['mail_driver']) ? $email_data['mail_driver'] : '', ['class' => 'form-control','placeholder' => __('Enter Mail Driver')]) }}
                                    @error('mail_driver')
                                        <span class="invalid-mail_driver" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-4 form-group">
                                    {{ Form::label('mail_host', __('Mail Host'), ['class' => 'form-label']) }}
                                    {{ Form::text('mail_host', !empty($email_data['mail_host']) ? $email_data['mail_host'] : '', ['class' => 'form-control ','placeholder' => __('Enter Mail Driver')]) }}
                                    @error('mail_host')
                                        <span class="invalid-mail_driver" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-4 form-group">
                                    {{ Form::label('mail_port', __('Mail Port'), ['class' => 'form-label']) }}
                                    {{ Form::text('mail_port', !empty($email_data['mail_port']) ? $email_data['mail_port'] : '', ['class' => 'form-control','placeholder' => __('Enter Mail Port')]) }}
                                    @error('mail_port')
                                        <span class="invalid-mail_port" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-4 form-group">
                                    {{ Form::label('mail_username', __('Mail Username'), ['class' => 'form-label']) }}
                                    {{ Form::text('mail_username', !empty($email_data['mail_username']) ? $email_data['mail_username'] : '', ['class' => 'form-control','placeholder' => __('Enter Mail Username')]) }}
                                    @error('mail_username')
                                        <span class="invalid-mail_username" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-4 form-group">
                                    {{ Form::label('mail_password', __('Mail Password'), ['class' => 'form-label']) }}
                                    {{ Form::text('mail_password', !empty($email_data['mail_password']) ? $email_data['mail_password'] : '', ['class' => 'form-control','placeholder' => __('Enter Mail Password')]) }}
                                    @error('mail_password')
                                        <span class="invalid-mail_password" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-4 form-group">
                                    {{ Form::label('mail_encryption', __('Mail Encryption'), ['class' => 'form-label']) }}
                                    {{ Form::text('mail_encryption', !empty($email_data['mail_encryption']) ? $email_data['mail_encryption'] : '', ['class' => 'form-control','placeholder' => __('Enter Mail Encryption')]) }}
                                    @error('mail_encryption')
                                        <span class="invalid-mail_encryption" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-4 form-group">
                                    {{ Form::label('mail_from_address', __('Mail From Address'), ['class' => 'form-label']) }}
                                    {{ Form::text('mail_from_address',!empty($email_data['mail_from_address']) ? $email_data['mail_from_address'] : '',['class' => 'form-control', 'placeholder' => __('Enter Mail From Address')]) }}
                                    @error('mail_from_address')
                                        <span class="invalid-mail_from_address" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-4 form-group">
                                    {{ Form::label('mail_from_name', __('Mail From Name'), ['class' => 'form-label']) }}
                                    {{ Form::text('mail_from_name', !empty($email_data['mail_from_name']) ? $email_data['mail_from_name'] : '', ['class' => 'form-control','placeholder' => __('Enter Mail Encryption')]) }}
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
                                        <a href="#" data-url="{{ route('user.test.mail') }}" id="test_email"
                                            data-title="{{ __('Send Test Mail') }}"  data-bs-toggle="modal"
                                            data-bs-target="#exampleModal"
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
                </div>
            </div>
            <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/repeater.js') }}"></script>
    <script src="{{ asset('assets/js/colorPick.js') }}"></script>

    @push('script-page')
        <script>
            var scrollSpy = new bootstrap.ScrollSpy(document.body, {
                target: '#useradd-sidenav',
                offset: 300
            })
        </script>

        <script>
            $(document).on("click", '.send_email', function(e) {
               
                e.preventDefault();
                var title = $(this).attr('data-title');

                var size = 'md';
                var url = $(this).attr('data-url');
                if (typeof url != 'undefined') {
                    $("#exampleModal .modal-title").html(title);
                    $("#exampleModal .modal-dialog").addClass('modal-' + size);
                    $("#exampleModal").modal('show');

                    $.post(url, {
                        mail_driver: $("#mail_driver").val(),
                        mail_host: $("#mail_host").val(),
                        mail_port: $("#mail_port").val(),
                        mail_username: $("#mail_username").val(),
                        mail_password: $("#mail_password").val(),
                        mail_encryption: $("#mail_encryption").val(),
                        mail_from_address: $("#mail_from_address").val(),
                        mail_from_name: $("#mail_from_name").val(),
                    }, function(data) {
                        $('#exampleModal .modal-body').html(data);
                    });
                }
            });
            $(document).on('submit', '#test_email', function(e) {
                e.preventDefault();
                $("#email_sending").show();
                var post = $(this).serialize();
                console.log(post);

                var url = $(this).attr('action');
                $.ajax({
                    type: "post",
                    url: url,
                    data: post,
                    cache: false,
                    beforeSend: function() {
                        $('#test_email .btn-create').attr('disabled', 'disabled');
                    },
                    success: function(data) {
                        if (data.is_success) {
                            show_toastr('Success', data.message, 'success');
                        } else {
                            show_toastr('Error', data.message, 'error');
                        }
                        $("#email_sending").hide();
                    },
                    complete: function() {
                        $('#test_email .btn-create').removeAttr('disabled');
                    },
                });
            })
        </script>
    @endpush
@endpush

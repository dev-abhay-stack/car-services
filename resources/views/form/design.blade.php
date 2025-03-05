@extends('layouts.main')
@section('title', 'Form')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Design Forms') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('forms.index') }}">{{ __('Form') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Design') }}</div>
                </div>
            </div>
            <div class="section-body">
                {{ Form::model($form, ['route' => ['forms.design.update', $form->id], 'method' => 'PUT', 'id' => 'design-form']) }}
                <div class="row">
                    <div class="col-xl-12 order-xl-1">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="heading-small text-muted mb-4">{{ __('Design Form') }}</h6>
                                <div class="">
                                <div class=" row">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div id="stage1" class="build-wrap"></div>
                                                <input type="hidden" name="json" value="{{ $form->json }}">
                                                <br>
                                                <div class="action-buttons">
                                                    <button id="showData" class="d-none"
                                                        type="button">{{ __('Show Data') }}</button>
                                                    <button id="clearFields" class="d-none"
                                                        type="button">{{ __('Clear All Fields') }}</button>
                                                    <button id="getData" class="d-none"
                                                        type="button">{{ __('Get Data') }}</button>
                                                    <button id="getXML" class="d-none"
                                                        type="button">{{ __('Get XML Data') }}</button>
                                                    <button id="getJSON" class="btn btn-primary"
                                                        type="button">{{ __('Update') }}</button>
                                                    <button id="getJSONs" class="d-none"
                                                        onClick="javascript:history.go(-1)"
                                                        type="button">{{ __('Back') }}</button>
                                                    <button id="getJS" class="d-none"
                                                        type="button">{{ __('Get JS Data') }}</button>
                                                    <button id="setData" class="d-none"
                                                        type="button">{{ __('Set Data') }}</button>
                                                    <button id="addField" class="d-none"
                                                        type="button">{{ __('Add Field') }}</button>
                                                    <button id="removeField" class="d-none"
                                                        type="button">{{ __('Remove Field') }}</button>
                                                    <button id="testSubmit" class="d-none"
                                                        type="submit">{{ __('Test Submit') }}</button>
                                                    <button id="resetDemo" class="d-none"
                                                        type="button">{{ __('Reset Demo') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </section>
    </div>
@endsection
@push('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/jqueryform/css/demo.css') }}">
    <link href="{{ asset('assets/jqueryform/css/jquery.rateyo.min.css') }}" rel="stylesheet" />
@endpush
@push('script')
<script src="{{ asset('assets/jqueryform/js/vendor.js') }}"></script>
<script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/jqueryform/js/form-builder.min.js') }}"></script>
    <script src="{{ asset('assets/jqueryform/js/form-render.min.js') }}"></script>
    <script src="{{ asset('assets/jqueryform/js/demoFirst.js') }}"></script>
    <script src="{{ asset('assets/jqueryform/js/jquery.rateyo.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $("#setData").trigger('click');
            }, 30);
        });
    </script>
@endpush

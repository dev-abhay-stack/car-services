@extends('layouts.main')
@section('title', 'Form')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('View Forms') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('forms.index') }}">{{ __('Form') }}</a></div>
                    <div class="breadcrumb-item">{{ __('View') }}</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">

                    @if (!empty($form_value->Form->logo))
                        <div class="text-center gallery gallery-md">
                            <img id="app-dark-logo" class="gallery-item float-none"
                                src="{{ asset('storage/app/' . $form_value->Form->logo) }}" alt="form_logo">
                        </div>
                    @endif

                    <div class="card col-md-6 mx-auto">

                        <div class="card-header">
                            <h4 class="text-center w-100"> {{ $form_value->Form->title }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="view-form-data">
                                <div class="row">
                                    @foreach ($array as $row_key => $row)
                                        @if ($row->type == 'checkbox-group')
                                            <div class="col-12">
                                                <b>{{ Form::label($row->name, $row->label) }}@if ($row->required) * @endif
                                                </b>
                                                <p>
                                                <ul>
                                                    @foreach ($row->values as $key => $options)
                                                        @if (isset($options->selected))
                                                            <li>
                                                                <label>{{ $options->label }}</label>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                                </p>
                                            </div>
                                        @elseif($row->type == 'file')
                                            <div class="col-12">
                                                <b>{{ Form::label($row->name, $row->label) }}@if ($row->required) * @endif
                                                </b>
                                                <p>
                                                    @if (isset($row->value))
                                                        @if (isset($row->multiple))
                                                            <div class="row">
                                                                @foreach ($row->value as $img)
                                                                    <div class="col-6">
                                                                        <img src="{{ asset('storage/app/' . $img) }}"
                                                                            class="img-responsive img-thumbnail mb-2">
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @else
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <img src="{{ asset('storage/app/' . $row->value) }}"
                                                                        class="img-responsive img-thumbnail mb-2">
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endif
                                                </p>
                                            </div>
                                        @elseif($row->type == 'header')
                                            <div class="col-12">
                                                <{{ $row->subtype }}>
                                                    {{ $row->label }}
                                                    </{{ $row->subtype }}>
                                            </div>
                                        @elseif($row->type == 'paragraph')
                                            <div class="col-12">
                                                <{{ $row->subtype }}>
                                                    {{ $row->label }}
                                                    </{{ $row->subtype }}>
                                            </div>
                                        @elseif($row->type == 'radio-group')
                                            <div class="col-12">
                                                <b>{{ Form::label($row->name, $row->label) }}@if ($row->required) * @endif
                                                </b>
                                                <p>
                                                    @foreach ($row->values as $key => $options)
                                                        @if (isset($options->selected))
                                                            {{ $options->label }}
                                                        @endif
                                                    @endforeach
                                                </p>
                                            </div>
                                        @elseif($row->type == 'select')
                                            <div class="col-12">
                                                <b>{{ Form::label($row->name, $row->label) }}@if ($row->required) * @endif
                                                </b>
                                                <p>
                                                    @foreach ($row->values as $options)
                                                        @if (isset($options->selected))
                                                            {{ $options->label }}
                                                        @endif
                                                    @endforeach
                                                </p>
                                            </div>
                                        @elseif($row->type == 'autocomplete')
                                            <div class="col-12">
                                                <b>{{ Form::label($row->name, $row->label) }}@if ($row->required) * @endif
                                                </b>
                                                <p>
                                                    @foreach ($row->values as $options)
                                                        @if (isset($options->selected))
                                                            {{ $options->label }}
                                                        @endif
                                                    @endforeach
                                                </p>
                                            </div>
                                        @elseif($row->type == 'text')
                                            <div class="col-12">
                                                <b>{{ Form::label($row->name, $row->label) }}@if ($row->required) * @endif
                                                </b>
                                                <p>
                                                    {{ isset($row->value) ? $row->value : '' }}
                                                </p>
                                            </div>
                                        @elseif($row->type == 'date')
                                            <div class="col-12">
                                                <b>{{ Form::label($row->name, $row->label) }}@if ($row->required) * @endif
                                                </b>
                                                <p>
                                                    {{ isset($row->value) ? date('d-m-Y', strtotime($row->value)) : '' }}
                                                </p>
                                            </div>
                                        @elseif($row->type == 'textarea')
                                            <div class="col-12">
                                                <b>{{ Form::label($row->name, $row->label) }}@if ($row->required) * @endif
                                                </b>
                                                @if ($row->subtype == 'ckeditor')
                                                    {!! isset($row->value) ? $row->value : '' !!}
                                                @else
                                                    <p>
                                                        {{ isset($row->value) ? $row->value : '' }}
                                                    </p>
                                                @endif
                                            </div>
                                        @elseif($row->type == 'starRating')
                                            <div class="col-12">
                                                @php
                                                    $attr = ['class' => 'form-control'];
                                                    if ($row->required) {
                                                        $attr['required'] = 'required';
                                                    }
                                                    $value = isset($row->value) ? $row->value : 0;
                                                    $no_of_star = isset($row->number_of_star) ? $row->number_of_star : 5;
                                                @endphp
                                                <b> {{ Form::label($row->name, $row->label) }}@if ($row->required) * @endif
                                                </b>
                                                <p>
                                                <div id="{{ $row->name }}" class="starRating"
                                                    data-value="{{ $value }}"
                                                    data-no_of_star="{{ $no_of_star }}">
                                                </div>
                                                <input type="hidden" name="{{ $row->name }}"
                                                    value="{{ $value }}">
                                                </p>
                                            </div>
                                        @else
                                            <div class="col-12">
                                                <b>{{ Form::label($row->name, $row->label) }}@if ($row->required) * @endif
                                                </b>
                                                <p>
                                                    {{ isset($row->value) ? $row->value : '' }}
                                                </p>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('style')
    <link href="{{ asset('assets/jqueryform/css/jquery.rateyo.min.css') }}" rel="stylesheet" />
@endpush
@push('script')
    <script src="{{ asset('assets/jqueryform/js/jquery.rateyo.min.js') }}"></script>
    <script>
        var $starRating = $('.starRating');
        if ($starRating.length) {
            $starRating.each(function() {
                var val = $(this).attr('data-value');
                var no_of_star = $(this).attr('data-no_of_star');
                if (no_of_star == 10) {
                    val = val / 2;
                }
                $(this).rateYo({
                    rating: val,
                    readOnly: true,
                    numStars: no_of_star
                })
            });
        }
    </script>
@endpush

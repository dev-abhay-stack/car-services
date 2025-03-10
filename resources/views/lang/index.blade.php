@extends('layouts.admin')
@push('css-page')
@endpush
@push('script-page')
@endpush
@section('page-title')
    {{__('Language')}}
@endsection
@section('title')
    <div class="d-inline-block">
        <h5 class="h4 d-inline-block font-weight-400 mb-0">   {{__('Language')}}</h5>
    </div>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('home')}}">{{__('Dashboard')}}</a></li>
<li class="breadcrumb-item" aria-current="page">{{__('Language')}}</li>
@endsection


@section('action-button')
        <a href="#" class="btn btn-sm btn-primary btn-icon m-1" data-size="md" data-url="{{ route('create.language') }}" data-bs-toggle="modal" data-bs-target="#exampleoverModal"
        data-bs-whatever="{{__('Create New Language')}}" data-bs-toggle="tooltip" title="{{ __('Create Language') }}"
        data-bs-original-title="{{__('Create New Language')}}">
            <i class="ti ti-plus text-white"></i>
        </a>

        @if($currantLang != (!empty(env('default_language')) ? env('default_language') : 'en'))
        <div class="action-btn bg-danger ms-2">
            <form method="POST" action="{{ route('lang.destroy', $currantLang) }}">
                @csrf
                <input name="_method" type="hidden" value="DELETE">
                <button type="submit"
                    class="btn btn-sm btn-danger btn-icon m-1 show_confirm"
                    data-toggle="tooltip" title='{{ __('Delete') }}'>
                    <span class="text-white"> <i class="ti ti-trash"></i></span>
                </button>
            </form>
        </div>
    @endif
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-3 col-md-3">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills flex-column " id="myTab4" role="tablist">
                        @foreach($languages as $lang)
                            <li class="nav-item">
                                <a href="{{route('manage.language',[$lang])}}" class="nav-link {{($currantLang == $lang)?'active':''}}">{{Str::upper($lang)}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-xl-9 col-md-9">
                <div class="p-3 card">
                    <ul class="nav nav-pills nav-fill" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-user-tab-1" data-bs-toggle="pill"
                                data-bs-target="#pills-user-1" type="button">{{__('Labels')}}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-user-tab-2" data-bs-toggle="pill"
                                data-bs-target="#pills-user-2" type="button">{{__('Messages')}}</button>
                        </li>

                    </ul>
                </div>
                <div class="card card-fluid">
                    <div class="card-body" style="position: relative;">
                        <div class="tab-content no-padding" id="myTab2Content">
                            <div class="tab-pane fade show active" id="lang1" role="tabpanel" aria-labelledby="home-tab4">

                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="pills-user-1" role="tabpanel" aria-labelledby="pills-user-tab-1">
                                        <form method="post" action="{{route('store.language.data',[$currantLang])}}">
                                            @csrf
                                            <div class="row">
                                                @foreach($arrLabel as $label => $value)
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="example3cols1Input">{{$label}} </label>
                                                            <input type="text" class="form-control" name="label[{{$label}}]" value="{{$value}}">
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="col-lg-12 text-right">
                                                    <button class="btn-create badge-blue" type="submit">{{ __('Save Changes')}}</button>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="pills-user-2" role="tabpanel" aria-labelledby="pills-user-tab-2">
                                        <form method="post" action="{{route('store.language.data',[$currantLang])}}">
                                            @csrf
                                            <div class="row">
                                                @foreach($arrMessage as $fileName => $fileValue)
                                                    <div class="col-lg-12">
                                                        <h5>{{ucfirst($fileName)}}</h5>
                                                    </div>
                                                    @foreach($fileValue as $label => $value)
                                                        @if(is_array($value))
                                                            @foreach($value as $label2 => $value2)
                                                                @if(is_array($value2))
                                                                    @foreach($value2 as $label3 => $value3)
                                                                        @if(is_array($value3))
                                                                            @foreach($value3 as $label4 => $value4)
                                                                                @if(is_array($value4))
                                                                                    @foreach($value4 as $label5 => $value5)
                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <label>{{$fileName}}.{{$label}}.{{$label2}}.{{$label3}}.{{$label4}}.{{$label5}}</label>
                                                                                                <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}][{{$label2}}][{{$label3}}][{{$label4}}][{{$label5}}]" value="{{$value5}}">
                                                                                            </div>
                                                                                        </div>
                                                                                    @endforeach
                                                                                @else
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-group">
                                                                                            <label>{{$fileName}}.{{$label}}.{{$label2}}.{{$label3}}.{{$label4}}</label>
                                                                                            <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}][{{$label2}}][{{$label3}}][{{$label4}}]" value="{{$value4}}">
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                            @endforeach
                                                                        @else
                                                                            <div class="col-lg-6">
                                                                                <div class="form-group">
                                                                                    <label>{{$fileName}}.{{$label}}.{{$label2}}.{{$label3}}</label>
                                                                                    <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}][{{$label2}}][{{$label3}}]" value="{{$value3}}">
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                @else
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label>{{$fileName}}.{{$label}}.{{$label2}}</label>
                                                                            <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}][{{$label2}}]" value="{{$value2}}">
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label>{{$fileName}}.{{$label}}</label>
                                                                    <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}]" value="{{$value}}">
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </div>
                                            <div class="col-lg-12 text-right">
                                                <button class="btn-create badge-blue" type="submit">{{ __('Save Changes')}}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
        </div>

    </div>
@endsection


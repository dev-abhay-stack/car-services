@extends('layouts.main')
@section('title', 'Forms')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Forms') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Forms') }}</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive py-4">
                                            {{ $dataTable->table(['width' => '100%']) }}
                                        </div>
                                    </div>
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
    @include('layouts.includes.datatable_css')
@endpush
@push('script')
    @include('layouts.includes.datatable_js')
    {{ $dataTable->scripts() }}
    <script>
        function copyToClipboard(element) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).data('url')).select();
            document.execCommand("copy");
            $temp.remove();
            iziToast.success({
                title: 'Great',
                message: '{{ __('Copied!') }}',
                position: 'topRight'
            });
        }
    </script>
@endpush

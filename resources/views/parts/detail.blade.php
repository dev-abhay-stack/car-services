@extends('layouts.admin')

@section('page-title')
    {{ $Parts->name }}
@endsection
@push('css-page')
@endpush
@section('action-button')
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('parts.index')}}">{{__('Parts')}}</li></a>
    <li class="breadcrumb-item active" aria-current="page">{{__('Parts Details')}}</li>
@endsection


@section('content')

<div class="row">
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <div class="row">
                <div class="col-xl-3">
                    <div class="card sticky-top" style="top:30px">
                        <div class="list-group list-group-flush" id="useradd-sidenav">
                            <a href="#useradd-0"
                            class="list-group-item list-group-item-action border-0">{{ __('Overview') }} <div
                                class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#useradd-1"
                                class="list-group-item list-group-item-action border-0">{{ __('Reports') }} <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#useradd-2"
                                class="list-group-item list-group-item-action border-0">{{ __('Assets') }} <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#useradd-3"
                                class="list-group-item list-group-item-action border-0">{{ __('Vender') }} <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#useradd-4"
                                class="list-group-item list-group-item-action border-0">{{ __('POs') }} <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#useradd-5"
                                    class="list-group-item list-group-item-action border-0">{{ __('Log Time') }} <div
                                        class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                        </div>
                    </div>
                </div>

                <div class="col-xl-9"> 
                    <div id="useradd-0">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card gridBox rounded-25 hover-shadow-lg p-0 card_height">
                                    <div class="card-body text-center">
                                        <div class="card_img">
                                            <a href="#" class="hover-translate-y-n3 ">
                                                <img src="{{ asset(Storage::url('Parts/thumbnail/' . $Parts->thumbnail)) }}"
                                                    alt="{{ $Parts->name }}" avatar="{{ $Parts->name }}">
                                            </a>
                                            <a href="#" title="{{ __('Locked') }}" class="img_title">
                                                {{ $Parts->name }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                
                            <div class="col-8">
                                <div class="card">
                                    <div class="card-body">
                                        <h5>{{ __('Details') }}</h5>
                                        <div class="row  mt-4">
                                            <div class="col-md-4 col-sm-6">
                                                <div class="d-flex align-items-start">
                    
                                                    <div class="ms-2">
                                                        <h5 class="mb-0 text-dark">{{ __('Name') }}</h5>
                                                        <p class="text-muted text-sm mb-0">{{ $Parts->name }}</p>
                    
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6 my-3 my-sm-0">
                                                <div class="d-flex align-items-start">
                    
                                                    <div class="ms-2">
                                                        <h5 class="mb-0 text-dark">{{ __('Number') }}</h5>
                                                        <p class="text-muted text-sm mb-0">
                                                            {{ $Parts->number }}</p>
                    
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6 my-3 my-sm-0">
                                                <div class="d-flex align-items-start">
                    
                                                    <div class="ms-2">
                                                        <h5 class="mb-0 text-dark">{{ __('Quantity') }}</h5>
                                                        <p class="text-muted text-sm mb-0">
                                                            {{ $Parts->quantity }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6 my-3 my-sm-0 mt-3">
                                                <div class="d-flex align-items-start">
                    
                                                    <div class="ms-2">
                                                        <h5 class="mb-0 text-dark">{{ __('Price') }}</h5>
                                                        <p class="text-muted text-sm mb-0">
                                                            {{ $Parts->price }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6 my-3 my-sm-0 mt-3">
                                                <div class="d-flex align-items-start">
                    
                                                    <div class="ms-2">
                                                        <h5 class="mb-0 text-dark">{{ __('Category') }}</h5>
                                                        <p class="text-muted text-sm mb-0">
                                                            {{ $Parts->category }}</p>
                                                    </div>
                                                </div>
                                            </div>
                    
                                        </div>
                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="useradd-1">
                        <div class="card">
                            <div class="card-header">
                        
                                <h5 class="mb-0">{{ __('Reports') }}</h5>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row align-items-center justify-content-between">
                                                    <div class="col-auto mb-3 mb-sm-0">
                                                        <div class="d-flex align-items-center">
                                                            <div class="theme-avtar bg-warning">
                                                                <i class="ti ti-shopping-cart"></i>
                                                            </div>
                                                            <div class="ms-3">
                                                                <small class="text-muted">{{ __('Total') }}</small>
                                                                <h6 class="m-0">{{ __('Parts Used') }}</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto text-end">
                                                        <h4 class="m-0">{{ $total_parts_purchase }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row align-items-center justify-content-between">
                                                    <div class="col-auto mb-3 mb-sm-0">
                                                        <div class="d-flex align-items-center">
                                                            <div class="theme-avtar bg-primary">
                                                                <i class="ti ti-shopping-cart"></i>
                                                            </div>
                                                            <div class="ms-3">
                                                                <small class="text-muted">{{ ('Total') }}</small>
                                                                <h6 class="m-0">{{ ('Cost') }}</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto text-end">
                                                        <h4 class="m-0">{{ !empty($total_cost->total_cost) ? $total_cost->total_cost : 0 }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="useradd-2">
                        <div class="card">
                            <div class="card-header">
                                <div class="float-end">
                                    <p class="text-muted d-none d-sm-flex align-items-center mb-0">
                                        <a href="#" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal"
                                            data-url="{{ route('assets.associate.create', ['parts_assets', $Parts->id]) }}"
                                            data-bs-whatever="{{ __('Associate Assets') }}"> <span
                                                class="text-white">
                                                <i class="ti ti-plus" data-bs-toggle="tooltip"
                                                    data-bs-original-title="{{ __('Associate') }}"></i></span>
                                        </a>
                                    </p>
                                </div>
                                <h5 class="mb-0">{{ __('Assets') }}</h5>
                            </div>

                            <div class="card-body">
                                <table class="table dataTable3 mt-3">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Assets Thumbnail') }}</th>
                                            <th>{{ __('Name') }}</th>
                                            <th class="text-end">{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($assets as $assets_val)
                                            <tr>
                                                @php
                                                    $thumbnail = !empty($assets_val->thumbnail) ? 'Assets/thumbnail/' . $assets_val->thumbnail : 'avatar/placeholder.jpg';
                                                @endphp
                                                <td width="100">
                                                    <div><img src="{{ asset(Storage::url($thumbnail)) }}"
                                                            class="img-fluid" width="70"></div>
                                                </td>
                                                <td>{{ $assets_val->name }}</td>
                                                <td class="action w-10">
                                                    <span>
                                                        @can('manage assets')
                                                            <div class="action-btn bg-warning ms-2 float-end">
                                                                <a href="{{ route('assets.show', [$assets_val->id]) }}"
                                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="tooltip"
                                                                    title="{{__('View')}}" data-bs-whatever="{{ __('View Assets') }}">
                                                                    <i class="ti ti-eye text-white"></i>
                                                                </a>
                                                            </div>


                                                        @endcan

                                                        @can('delete assets')
                                                        <div class="action-btn bg-danger ms-2 float-end">
                                                            {!! Form::open(['method' => 'DELETE', 'route' => ['assets.associate_remove', $module, $assets_val->id]]) !!}
                                                            <a href="#!" class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm m-2">
                                                                <i class="ti ti-trash text-white" data-bs-toggle="tooltip"
                                                                data-bs-original-title="{{__('Delete')}}"></i>
                                                            </a>
                                                            {!! Form::close() !!}
                                                        </div>
                                                        @endcan

                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="useradd-3">
                        <div class="card">
                            <div class="card-header">
                                @can('associate vendor')
                                    <div class="float-end">
                                        <p class="text-muted d-none d-sm-flex align-items-center mb-0">
                                            <a href="#" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal"
                                                data-url="{{ route('vendors.associate.create', ['parts_vendor', $Parts->id]) }}"
                                                data-bs-whatever="{{ __('Associate Assets') }}"> <span
                                                    class="text-white">
                                                    <i class="ti ti-plus" data-bs-toggle="tooltip"
                                                        data-bs-original-title="{{ __('Associate') }}"></i></span>
                                            </a>
                                        </p>
                                    </div>
                                @endcan
                                <h5 class="mb-0">{{ __('Vendors') }}</h5>
                            </div>

                            <div class="card-body">
                                <table class="table dataTable3 mt-3">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Vendor Thumbnail') }}</th>
                                            <th>{{ __('Name') }}</th>
                                            <th class="float-end">{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vendor as $vendor_val)
                                            <tr>
                                                @php
                                                    $thumbnail = !empty($vendor_val->image) ? 'vendors/' . $vendor_val->image : 'avatar/placeholder.jpg';
                                                @endphp
                                                <td width="100">
                                                    <div><img src="{{ asset(Storage::url($thumbnail)) }}"
                                                            class="img-fluid" width="70"></div>
                                                </td>
                                                <td>{{ $vendor_val->name }}</td>
                                                <td class="action">
                                                    <span >
                                                        @can('manage vendor')
                                                        <div class="action-btn bg-warning ms-2 float-end">
                                                            <a href="{{ route('vendors.show', [$vendor_val->id]) }}" class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                            data-bs-whatever="{{__('View Vendor')}}" data-bs-toggle="tooltip"
                                                            data-bs-original-title="{{__('View')}}">
                                                            <span class="text-white"> <i class="ti ti-eye"></i></span></a>
                                                        </div>


                                                        @endcan

                                                        @can('delete vendor')
                                                            <div class="action-btn bg-danger ms-2 float-end">
                                                                {!! Form::open(['method' => 'DELETE', 'route' => ['vendors.associate_remove', 'parts_vendor', $vendor_val->id]]) !!}
                                                                <a href="#!" class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm m-2">
                                                                    <i class="ti ti-trash text-white" data-bs-toggle="tooltip"
                                                                    data-bs-original-title="{{__('Delete')}}"></i>
                                                                </a>
                                                                {!! Form::close() !!}
                                                            </div>
                                                        @endcan
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="useradd-4">
                        <div class="card">
                            <div class="card-header">
                                @can('create pos')
                                    <div class="float-end">
                                        <a href="{{ route('pos.create', ['partsid' => $Parts->id]) }}"
                                            class="btn btn-sm btn-primary btn-icon m-1" data-size="lg" data-bs-whatever="{{__('Create POs')}}"
                                            data-bs-title="{{ __(' Create POs') }}" data-bs-toggle="tooltip">
                                            <i class="ti ti-plus text-white"></i>
                                        </a>
                                    </div>
                                @endcan
                                <h5 class="mb-0">{{ __('POs') }}</h5>
                            </div>

                            <div class="card-body">
                                <table class="table dataTable3 mt-3">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Vendor Name') }}</th>
                                            <th>{{ __('User Name') }}</th>
                                            <th>{{ __('Purchase Order Date') }}</th>
                                            <th>{{ __('Expected Delivery Date') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($parts_pos as $invoice)
                                            <tr>
                                                <td>{{ $invoice->vendor_name }}</td>
                                                <td>{{ $invoice->user_name }}</td>
                                                <td>{{ $invoice->pos_date }}</td>

                                                <td>{{ $invoice->delivery_date }}</td>

                                                <td class="Action w-10">
                                                    <span>
                                                        @can('edit pos')
                                                        <div class="action-btn bg-info ms-2 ">
                                                            <a href="{{ route('pos.edit', \Crypt::encrypt($invoice->id)) }}"
                                                                class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="tooltip"
                                                                    title="{{__('Edit')}}" data-bs-whatever="{{ __('Edit') }}">
                                                                <i class="ti ti-edit"></i>
                                                            </a>
                                                        </div>
                                                        @endcan
                                                        @can('delete pos')
                                                        <div class="action-btn bg-danger ms-2">
                                                            {!! Form::open(['method' => 'DELETE', 'route' => ['pos.destroy', $invoice->id]]) !!}
                                                            <a href="#!" class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm m-2">
                                                                <i class="ti ti-trash text-white"></i>
                                                            </a>
                                                            {!! Form::close() !!}
                                                        </div>

                                                        @endcan
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="useradd-5">
                         <div class="card">
                            <div class="card-header">
                                @can('create logtime')
                                    <div class="float-end">
                                        <p class="text-muted d-none d-sm-flex align-items-center mb-0">
                                            <a href="#" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal"
                                                data-url="{{ route('partslogtime.create', ['parts_id' => $Parts->id]) }}"
                                                data-bs-whatever="{{ __('Create Log Time') }}"> <span
                                                    class="text-white">
                                                    <i class="ti ti-plus" data-bs-toggle="tooltip"
                                                        data-bs-original-title="{{ __('Create') }}"></i></span>
                                            </a>
                                        </p>
                                    </div>
                                @endcan
                                <h5 class="mb-0">{{ __('Log Time') }}</h5>
                            </div>

                            <div class="card-body">
                                <table class="table dataTable3 mt-3">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Description') }}</th>
                                            <th class="float-end">{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($partslogtime as $partslogtime_val)
                                            <tr>

                                                <td style="white-space: inherit;">
                                                    <a href="#"
                                                        data-url="{{ route('partslogtime.edit', $partslogtime_val->id) }}"  data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal" data-bs-whatever="{{__('View Log Time')}}" data-bs-toggle="tooltip" title="{{ __('View Log Time') }}"
                                                        data-title="{{ __('View Log Time') }}"
                                                        data-bs-toggle="tooltip">
                                                        <i class="ti ti-clock"></i>
                                                        {{ date('Y-m-d H:i A', strtotime($partslogtime_val->created_at)) }}
                                                        - {{ $partslogtime_val->description }}
                                                    </a>
                                                </td>

                                                <td class="action w-10">
                                                    <span>
                                                        <div class="action-btn bg-danger ms-2">
                                                            {!! Form::open(['method' => 'DELETE', 'route' => ['partslogtime.destroy', $partslogtime_val->id]]) !!}
                                                            <a href="#!" class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm m-2">
                                                                <i class="ti ti-trash text-white"></i>
                                                            </a>
                                                            {!! Form::close() !!}
                                                        </div>
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

</div>


@endsection

@push('script-page')
<script>
    var scrollSpy = new bootstrap.ScrollSpy(document.body, {
        target: '#useradd-sidenav',
        offset: 300
    })
</script>

    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $("#setData").trigger('click');
            }, 30);
        });
    </script>

    <script>
        $(document).ready(function() {
            var tab = 'report';
            @if ($tab = Session::get('tab-status'))
                var tab = '{{ $tab }}';
            @endif
            var nav_tab = '';
            @if ($nav_tab = Session::get('nav-status'))
                var nav_tab = '{{ $nav_tab }}';
            @endif

            setTimeout(function() {
                $("#tabs .list-group-list[data-href='#tabs-" + tab + "']").trigger("click");
                if (nav_tab != '') {
                    $(".nav-item .nav-link[href='#" + nav_tab + "_navigation']").trigger("click");
                }
            }, 10);


            @if (Session::has('success') && Session::has('id') && !empty(Session::get('id')))
                show_toastr('Success', '{{ Session::get('success') }}', 'success');
                $("#tabs-integrations").find("#{{ Session::get('id') }}").trigger("click");
                {{ Session::forget('success') }}
                {{ Session::forget('id') }}
            @endif

            $('.list-group-list').on('click', function() {
                var href = $(this).attr('data-href');
                $('.tabs-card').addClass('d-none');
                $(href).removeClass('d-none');
                $('#tabs .list-group-list').removeClass('text-primary');
                $(this).addClass('text-primary');
            });
        });
    </script>
@endpush

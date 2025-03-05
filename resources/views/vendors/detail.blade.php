@extends('layouts.admin')

@section('page-title')
    {{ $Vendor->name }}
@endsection
@push('css-page')
@endpush
@section('action-button')
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('vendors.index')}}">{{__('Vendor')}}</li></a>
    <li class="breadcrumb-item active" aria-current="page">{{__('Vendor Details')}}</li>
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
                                @can('manage parts')
                                    <a href="#useradd-1"
                                        class="list-group-item list-group-item-action border-0">{{ __('Parts') }} <div
                                            class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                                @endcan
                                @can('manage assets')
                                    <a href="#useradd-2"
                                        class="list-group-item list-group-item-action border-0">{{ __('Asset') }} <div
                                            class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                                @endcan
                                @can('manage pos')
                                <a href="#useradd-3"
                                    class="list-group-item list-group-item-action border-0">{{ __('POs') }} <div
                                        class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                                @endcan
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
                                                    <img src="{{ asset(Storage::url('vendors/' . $Vendor->image)) }}" alt="{{ $Vendor->name }}"
                                                        avatar="{{ $Vendor->name }}">
                                                </a>
                                                <a href="#" title="{{ __('Locked') }}" class="img_title">
                                                    {{ $Vendor->name }}
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
                                                            <p class="text-muted text-sm mb-0">{{ $Vendor->name }}</p>
                        
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6 my-3 my-sm-0">
                                                    <div class="d-flex align-items-start">
                        
                                                        <div class="ms-2">
                                                            <h5 class="mb-0 text-dark">{{ __('Contact') }}</h5>
                                                            <p class="text-muted text-sm mb-0">
                                                                {{ $Vendor->contact }}</p>
                        
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6 my-3 my-sm-0">
                                                    <div class="d-flex align-items-start">
                        
                                                        <div class="ms-2">
                                                            <h5 class="mb-0 text-dark">{{ __('Email') }}</h5>
                                                            <p class="text-muted text-sm mb-0">
                                                                {{ $Vendor->email }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                <div class="col-md-4 col-sm-6 my-3 my-sm-0 mt-3">
                                                    <div class="d-flex align-items-start">
                        
                                                        <div class="ms-2">
                                                            <h5 class="mb-0 text-dark">{{ __('Phone') }}</h5>
                                                            <p class="text-muted text-sm mb-0">
                                                                {{ $Vendor->phone }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6 my-3 my-sm-0 mt-3">
                                                    <div class="d-flex align-items-start">
                        
                                                        <div class="ms-2">
                                                            <h5 class="mb-0 text-dark">{{ __('Address') }}</h5>
                                                            <p class="text-muted text-sm mb-0">
                                                                {{ $Vendor->address }}</p>
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
                        <div id="useradd-1">
                            <div class="card">
                                <div class="card-header">
                                    <div class="float-end">
                                        @can('associate parts')
                                            <p class="text-muted d-none d-sm-flex align-items-center mb-0">
                                                <a href="#" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal"
                                                    data-url="{{ route('parts.associate.create', ['vendors', $Vendor->id]) }}"
                                                    data-bs-whatever="{{ __('Associate Parts') }}"> <span
                                                        class="text-white">
                                                        <i class="ti ti-plus" data-bs-toggle="tooltip"
                                                            data-bs-original-title="{{ __('Associate') }}"></i></span>
                                                </a>
                                            </p>
                                        @endcan
                                    </div>
                                    <h5 class="mb-0">{{ __('Parts') }}</h5>
                                </div>

                                <div class="card-body">
                                    <table class="table dataTable3 mt-3">
                                        <thead>
                                            <tr>
                                                <th>{{ __('Parts Thumbnail') }}</th>
                                                <th>{{ __('Name') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($parts as $parts_val)
                                                <tr>
                                                    @php
                                                        $thumbnail = !empty($parts_val->thumbnail) ? 'Parts/thumbnail/' . $parts_val->thumbnail : 'avatar/placeholder.jpg';
                                                    @endphp
                                                    <td width="100">
                                                        <div><img src="{{ asset(Storage::url($thumbnail)) }}"
                                                                class="img-fluid" width="70"></div>
                                                    </td>
                                                    <td>{{ $parts_val->name }}</td>
                                                    <td class="action w-10">
                                                        <span>
                                                            @can('manage parts')
                                                                <div class="action-btn bg-warning ms-2 float-end">
                                                                    <a href="{{ route('parts.show', [$parts_val->id]) }}"
                                                                        class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="tooltip"
                                                                        title="{{__('View')}}" data-bs-whatever="{{ __('View Parts') }}">
                                                                        <i class="ti ti-eye text-white"></i>
                                                                    </a>
                                                                </div>
                                                            @endcan

                                                            @can('delete parts')
                                                                <div class="action-btn bg-danger ms-2 float-end">
                                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['parts.associate_remove', $module, $parts_val->id]]) !!}
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

                        <div id="useradd-2">
                            <div class="card">
                                <div class="card-header">
                                    <div class="float-end">
                                        @can('associate assets')
                                            <p class="text-muted d-none d-sm-flex align-items-center mb-0">
                                                <a href="#" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal"
                                                    data-url="{{ route('assets.associate.create', ['vendors', $Vendor->id]) }}"
                                                    data-bs-whatever="{{ __('Associate Assets') }}"> <span
                                                        class="text-white">
                                                        <i class="ti ti-plus" data-bs-toggle="tooltip"
                                                            data-bs-original-title="{{ __('Assets') }}"></i></span>
                                                </a>
                                            </p>
                                        @endcan
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

                        <div id="useradd-3">
                            <div class="card">
                                <div class="card-header">
                                    <div class="float-end">
                                        @can('create pos')
                                            <p class="text-muted d-none d-sm-flex align-items-center mb-0">
                                                <a href="{{ route('pos.create', ['vendor_id' => $Vendor->id]) }}" class="btn btn-sm btn-primary btn-icon m-1"
                                                    
                                                    data-bs-whatever="{{ __('Associate Pos') }}"> <span
                                                        class="text-white">
                                                        <i class="ti ti-plus" data-bs-toggle="tooltip"
                                                            data-bs-original-title="{{ __('Associate') }}"></i></span>
                                                </a>
                                            </p>
                                        @endcan
                                    </div>
                                    <h5 class="mb-0">{{ __('Pos') }}</h5>
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
                                            @foreach ($vendor_pos as $invoice)
                                                <tr>
                                                    <td>{{ $invoice->vendor_name }}</td>
                                                    <td>{{ $invoice->user_name }}</td>
                                                    <td>{{ $invoice->pos_date }}</td>
                                                    <td>{{ $invoice->delivery_date }}</td>

                                                    <td class="action w-10">
                                                        <span>
                                                            @can('edit pos')
                                                                <div class="action-btn bg-info ms-2">
                                                                    <a href="{{ route('pos.edit', \Crypt::encrypt($invoice->id)) }}"
                                                                        class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="tooltip"
                                                                        title="{{__('Edit')}}" data-bs-whatever="{{ __('Edit') }}">
                                                                        <i class="ti ti-edit text-white "></i>
                                                                    </a>
                                                                </div>

                                                            @endcan
                                                            @can('delete pos')
                                                            <div class="action-btn bg-danger ms-2">
                                                                
                                                                {!! Form::open(['method' => 'DELETE', 'route' => ['pos.destroy', $invoice->id]]) !!}
                                                                <a href="#!" class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm ">
                                                                    <i class="ti ti-trash text-white" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Delete') }}"></i>
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
            var tab = 'parts';
            @if ($tab = Session::get('tab-status'))
                var tab = '{{ $tab }}';
            @else
                var tab_name = $('#tabs li a:eq(0)').attr('data-href');
                var tab = tab_name.replace("#tabs-", "");
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

    @extends('layouts.admin')

    @section('page-title')
        {{ $Assets->name }}
    @endsection

    @section('action-button')
    @endsection


@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('asset.index')}}">{{__('Assets')}}</li></a>
    <li class="breadcrumb-item active" aria-current="page">{{__('Asset Details')}}</li>
@endsection

    <link rel="stylesheet" href="{{ asset('assets/libs/dropzone/dist/dropzone.css') }}">
    @section('content')
        <div class="row">
            <!-- [ sample-page ] start -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-3">{{ $Assets->name }} {{ __('Image') }}</h4>
                        <div class="position-relative overflow-hidden rounded">
                            <img src="{{ asset(Storage::url('Assets/thumbnail/' . $Assets->thumbnail)) }}"
                                alt="{{ $Assets->name }}" avatar="{{ $Assets->name }}" class="w-100">
                            <div class="">
                                <a href="#" title="{{ __('Locked') }}" class="img_title">
                                    {{ $Assets->name }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $Assets->name }} {{ __('Description') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    @if (count($AssetsField) > 0)
                                        @foreach ($AssetsField as $detail)
                                            @if ($detail->name == 'Documents and Picture')
                                            @elseif($detail->name == 'Waste Disposal National Regulations')
                                            <div class="col-lg-4 mb-2">
                                                <h5 class="text-sm">{{ $detail->name }}</h5>
                                                <div class="action-btn bg-warrning ms-2">
                                                    <a href="{{ asset(Storage::url('Assets/' . $detail->value)) }}"
                                                        download="waste disposal national" class="waste_disposal" style="">
                                                        <i class=" ti ti-download"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            @else
                                            <div class="col-lg-4 mb-2">
                                                <span>
                                                    <h5 class="text-sm">{{ $detail->name }}</h5>
                                                    <p class="detail_name">{{ $detail->value }}</p>
                                                </span>
                                            </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-lg-4">
                                    <div>
                                        <p> {!! DNS2D::getBarcodeHTML(route('asset.show', $Assets->id), 'QRCODE', 3, 3) !!} </p>
                                    </div>
                                </div>
                            </div>
                            
                           
                        </div>
                    </div>
                </div>
                <!-- [ sample-page ] end -->
            </div>

            <div class="row justify-content-center">
                <!-- [ sample-page ] start -->
                <div class="col-lg-12 col-md-12 col-xxl-12">
                    <div class="p-3 card">
                        <ul class="nav nav-pills nav-fill" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-user-tab-1" data-bs-toggle="pill"
                                    data-bs-target="#pills-user-1" type="button">{{ __('Reports') }}</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-user-tab-2" data-bs-toggle="pill"
                                    data-bs-target="#pills-user-2" type="button">{{ __('PMs') }}</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-user-tab-3" data-bs-toggle="pill"
                                    data-bs-target="#pills-user-3" type="button">{{ __('WOS') }}</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-user-tab-4" data-bs-toggle="pill"
                                    data-bs-target="#pills-user-4" type="button">{{ __('Parts') }}</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-user-tab-5" data-bs-toggle="pill"
                                    data-bs-target="#pills-user-5" type="button">{{ __('Vendors') }}</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-user-tab-6" data-bs-toggle="pill"
                                    data-bs-target="#pills-user-6" type="button">{{ __('Log Time') }}</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-user-tab-7" data-bs-toggle="pill"
                                    data-bs-target="#pills-user-7"
                                    type="button">{{ __('Documents and Picture') }}</button>
                            </li>
                        </ul>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-user-1" role="tabpanel"
                                    aria-labelledby="pills-user-tab-1">
                                    <h5 class="mb-0">{{ __('Recent Orders') }}</h5>
                                    <small class="text-muted text-end">{{ __('Current Year Orders') }}</small>
                                    <div class="col-xxl-12">
                                        <div class="card">

                                            <div class="card-body">
                                                <div id="traffic-chart"></div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="tab-pane fade" id="pills-user-2" role="tabpanel"
                                    aria-labelledby="pills-user-tab-2">
                                    <div class="justify-content-between align-items-center d-flex">
                                        <h3 class="mb-0 ">{{ __('PMs') }}</h3>
                                        <span class="float-end">
                                            @can('associate pms')
                                                <a href="#" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal"
                                                    data-url="{{ route('parts.associate.create', ['pms', $Assets->id]) }}"
                                                    data-bs-whatever="{{ __('Associate PMs') }}" data-bs-toggle="tooltip"
                                                    title="{{ __('Associate PMs') }}"
                                                    data-bs-original-title="{{ __('Associate PMs') }}"> <span
                                                        class="text-white">
                                                        <i class="ti ti-settings text-white"></i></span>
                                                </a>
                                            @endcan
                                        </span>
                                    </div>
                                    <div class="col-xl-12 mt-3">
                                        <div class="">
                                            <div class="card-header table-border-style">
                                                <h5></h5>
                                                <div class="table-responsive">
                                                    <table class="table pc-dt-simple" id="pc-dt-simple">
                                                        <thead>
                                                            <tr>
                                                                <th>{{ __('Name') }}</th>
                                                                <th width="200px"> {{ __('Action') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($pms as $pms_val)
                                                                <tr>
                                                                    <td>{{ $pms_val->name }}</td>
                                                                    <td class="action" style="width: 10%">
                                                                        <span class="">
                                                                            @can('manage pms')
                                                                                <div class="action-btn bg-warning ms-2">
                                                                                    <a href="{{ route('pms.show', [$pms_val->id]) }}"
                                                                                        class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                                                        data-bs-whatever="{{ __('View PMs') }}"
                                                                                        data-bs-toggle="tooltip"
                                                                                        title="{{ __('View PMs') }}"
                                                                                        data-bs-original-title="{{ __('View PMs') }}">
                                                                                        <span class="text-white"> <i
                                                                                                class="ti ti-eye"></i></span></a>
                                                                                </div>
                                                                            @endcan
                                                                            @can('delete pms')
                                                                            <div class="action-btn bg-danger ms-2">
                                                                                {!! Form::open(['method' => 'DELETE', 'class' => 'm-0', 'route' => ['parts.associate_remove', $module_pms, $pms_val->id]]) !!}
                                                                                <a href="#!"
                                                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm">
                                                                                    <i class="ti ti-trash text-white"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-bs-original-title="{{ __('Delete') }}"></i>
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

                                <div class="tab-pane fade" id="pills-user-3" role="tabpanel"
                                    aria-labelledby="pills-user-tab-3">
                                    <div class="justify-content-between align-items-center d-flex">
                                        <h4 class="h4 font-weight-400 float-left">{{ __('WOs') }}</h4>
                                        @can('create wos')
                                            <a href="#" class="btn btn-sm btn-primary btn-icon m-1"
                                                data-url="{{ route('opentask.create', ['assets_id' => $Assets->id]) }}"
                                                data-size="lg" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                title="{{ __('Add WOs') }}" data-toggle="tooltip"><i
                                                    class="ti ti-settings"></i>
                                            </a>
                                        @endcan
                                    </div>
                                    <div class="col-xl-12 mt-3">
                                        <div class="">
                                            <div class="card-header table-border-style">
                                                <h5></h5>
                                                <div class="table-responsive">
                                                    <table class="table pc-dt-simple" id="pc-dt-simple">
                                                        <thead>
                                                            <tr>
                                                                <th>{{ __('Work Order Name') }}</th>
                                                                <th>{{ __('Priority') }}</th>
                                                                <th>{{ __('Instructions') }}</th>
                                                                <th> {{ __('Action') }}</th>
                                                            </tr>
                                                        </thead>
                                                        @php
                                                            $prioritys = App\Models\WorkOrder::priority();
                                                        @endphp
                                                        <tbody>
                                                            @foreach ($wos as $wos_val)
                                                                <tr>
                                                                    <td>{{ $wos_val->wo_name }}</td>
                                                                    <td>

                                                                        @foreach ($prioritys as $priority)
                                                                            @if ($priority['priority'] == $wos_val->priority)
                                                                                <span
                                                                                    class="badge budget-light p-2 px-3 rounded {{ $priority['color'] }}">
                                                                                    {{ $wos_val->priority }}</span>
                                                                            @endif
                                                                        @endforeach
                                                                    </td>
                                                                    <td>{{ $wos_val->instructions }}</td>
                                                                    <td class="action" style="width: 10%">
                                                                        <span>
                                                                            <div class="row">
                                                                                @can('manage wos')
                                                                                    <div class="action-btn bg-warning ms-2">
                                                                                        <a href="{{ route('opentask.show', [$wos_val->id]) }}"
                                                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                                                            data-bs-whatever="{{ __('View WOs') }}"
                                                                                            data-bs-toggle="tooltip"
                                                                                            title="{{ __('View WOs') }}"
                                                                                            data-bs-original-title="{{ __('View WOs') }}">
                                                                                            <span class="text-white"> <i
                                                                                                    class="ti ti-eye"></i></span></a>
                                                                                    </div>

                                                                                    {{-- <a href="{{ route('opentask.show', [$wos_val->id]) }}"
                                                                            class="edit-icon bg-success" data-toggle="tooltip"
                                                                            data-title="{{ 'View WOs' }}">
                                                                            <i class="fa fa-eye"></i>
                                                                        </a> --}}
                                                                                @endcan

                                                                                @can('delete wos')
                                                                                <div class="action-btn bg-danger ms-2">
                                                                                    {!! Form::open(['method' => 'DELETE', 'class' => 'm-0', 'route' => ['opentask.destroy', $wos_val->id]]) !!}
                                                                                    <a href="#!"
                                                                                        class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm ">
                                                                                        <i class="ti ti-trash text-white"
                                                                                            data-bs-toggle="tooltip"
                                                                                            data-bs-original-title="{{ __('Delete') }}"></i>
                                                                                    </a>
                                                                                    {!! Form::close() !!}
                                                                                </div>

                                                                                    {{-- <div class="action-btn bg-danger ms-2">
                                                                                        {!! Form::open(['method' => 'DELETE', 'class' => 'm-0', 'route' => ['opentask.destroy', $wos_val->id], 'id' => 'delete-form-' . $wos_val->id]) !!}
                                                                                        {!! Form::hidden('assets_id', $Assets->id) !!}
                                                                                        <button type="submit"
                                                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm"
                                                                                            data-toggle="tooltip"
                                                                                            title='{{ __('Delete') }}'>
                                                                                            <span class="text-white"> <i
                                                                                                    class="ti ti-trash "></i></span>
                                                                                        </button>
                                                                                        {!! Form::close() !!}
                                                                                    </div> --}}
                                                                                @endcan
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
                                <div class="tab-pane fade" id="pills-user-4" role="tabpanel"
                                    aria-labelledby="pills-user-tab-4">
                                    <div class="justify-content-between align-items-center d-flex">
                                        <h4 class="h4 font-weight-400 float-left">{{ __('Associated Parts') }}</h4>
                                        @can('associate parts')
                                            <a href="#" class="btn btn-sm btn-primary btn-icon m-1"
                                                data-url="{{ route('parts.associate.create', ['parts', $Assets->id]) }}"
                                                data-size="lg" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                data-bs-whatever="{{ __('Associate Parts') }}"
                                                title="{{ __('Associate Parts') }}" data-bs-toggle="tooltip">
                                                <span class="btn-inner--icon"><i class="ti ti-settings"></i>
                                            </a>
                                        @endcan
                                    </div>

                                    <div class="col-xl-12 mt-3">
                                        <div class="">
                                            <div class="card-header table-border-style">
                                                <h5></h5>
                                                <div class="table-responsive">
                                                    <table class="table pc-dt-simple" id="pc-dt-simple">
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
                                                                        <div><img
                                                                                src="{{ asset(Storage::url($thumbnail)) }}"
                                                                                class="img-fluid" width="70"></div>
                                                                    </td>
                                                                    <td>{{ $parts_val->name }}</td>
                                                                    <td class="action" style="width: 10%">
                                                                        <span>
                                                                            @can('manage parts')
                                                                                <div class="action-btn bg-warning ms-2">
                                                                                    <a href="{{ route('parts.show', [$parts_val->id]) }}"
                                                                                        class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                                                        data-bs-whatever="{{ __('View Parts') }}"
                                                                                        data-bs-toggle="tooltip"
                                                                                        title="{{ __('View Parts') }}"
                                                                                        data-bs-original-title="{{ __('View Parts') }}">
                                                                                        <span class="text-white"> <i
                                                                                                class="ti ti-eye"></i></span></a>
                                                                                </div>

                                                                                {{-- <a href="{{ route('parts.show', [$parts_val->id]) }}"
                                                                        class="edit-icon bg-success" data-toggle="tooltip"
                                                                        data-title="{{ __('View Parts') }}">
                                                                        <i class="fa fa-eye"></i>
                                                                    </a> --}}
                                                                            @endcan
                                                                            @can('delete parts')
                                                                            <div class="action-btn bg-danger ms-2">
                                                                                {!! Form::open(['method' => 'DELETE', 'class' => 'm-0', 'route' => ['parts.associate_remove', $module_assets, $parts_val->id]]) !!}
                                                                                <a href="#!"
                                                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm ">
                                                                                    <i class="ti ti-trash text-white"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-bs-original-title="{{ __('Delete') }}"></i>
                                                                                </a>
                                                                                {!! Form::close() !!}
                                                                            </div>

                                                                                {{-- <div class="action-btn bg-danger ms-2">
                                                                                    {!! Form::open(['method' => 'POST', 'class' => 'm-0', 'route' => ['parts.associate_remove', $module_assets, $parts_val->id], 'id' => 'delete-form-' . $parts_val->id]) !!}
                                                                                    {!! Form::hidden('assets_id', $Assets->id) !!}
                                                                                    <button type="submit"
                                                                                        class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm"
                                                                                        data-toggle="tooltip"
                                                                                        title='{{ __('Delete') }}'>
                                                                                        <span class="text-white"> <i
                                                                                                class="ti ti-trash "></i></span>
                                                                                    </button>
                                                                                    {!! Form::close() !!}
                                                                                </div> --}}


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

                                <div class="tab-pane fade" id="pills-user-5" role="tabpanel"
                                    aria-labelledby="pills-user-tab-4">
                                    <div class="justify-content-between align-items-center d-flex">
                                        <h4 class="h4 font-weight-400 float-left">{{ __('Associate Vendor') }}</h4>
                                        @can('associate vendor')
                                            <a href="#" class="btn btn-sm btn-primary btn-icon m-1"
                                                data-url="{{ route('vendors.associate.create', ['assets_vendor', $Assets->id]) }}"
                                                data-size="lg" data-bs-toggle="modal" data-bs-target="#exampleoverModal"
                                                data-bs-whatever="{{ __('Associate Vendor') }}"
                                                title="{{ __('Associate Vendor') }}" data-bs-toggle="tooltip">
                                                <span class="btn-inner--icon"><i class="ti ti-settings"></i>
                                            </a>
                                        @endcan
                                    </div>

                                    <div class="col-xl-12 mt-3">
                                        <div class="">
                                            <div class="card-header table-border-style">
                                                <h5></h5>
                                                <div class="table-responsive">
                                                    <table class="table pc-dt-simple" id="pc-dt-simple">
                                                        <thead>
                                                            <tr>
                                                                <th>{{ __('Vendor Thumbnail') }}</th>
                                                                <th>{{ __('Name') }}</th>
                                                                <th class="text-end">{{ __('Action') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($vendor as $vendor_val)
                                                                <tr>
                                                                    @php
                                                                        $thumbnail = !empty($vendor_val->image) ? 'vendors/' . $vendor_val->image : 'avatar/placeholder.jpg';
                                                                    @endphp
                                                                    <td width="100">
                                                                        <div><img
                                                                                src="{{ asset(Storage::url($thumbnail)) }}"
                                                                                class="img-fluid" width="70"></div>
                                                                    </td>
                                                                    <td>{{ $vendor_val->name }}</td>
                                                                    <td class="action text-end">
                                                                        <span>
                                                                            @can('manage vendor')
                                                                                <div class="action-btn bg-warning ms-2">
                                                                                    <a href="{{ route('vendors.show', [$vendor_val->id]) }}"
                                                                                        class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                                                        data-bs-whatever="{{ __('View Vendor') }}"
                                                                                        data-bs-toggle="tooltip"
                                                                                        title="{{ __('View Vendor') }}"
                                                                                        data-bs-original-title="{{ __('View Vendor') }}">
                                                                                        <span class="text-white"> <i
                                                                                                class="ti ti-eye"></i></span></a>
                                                                                </div>
                                                                            @endcan

                                                                            @can('delete vendor')
                                                                            <div class="action-btn bg-danger ms-2">
                                                                                {!! Form::open(['method' => 'DELETE', 'class' => 'm-0', 'route' => ['vendors.associate_remove', 'assets_vendor', $vendor_val->id]]) !!}
                                                                                <a href="#!"
                                                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm ">
                                                                                    <i class="ti ti-trash text-white"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-bs-original-title="{{ __('Delete') }}"></i>
                                                                                </a>
                                                                                {!! Form::close() !!}
                                                                            </div>

                                                                                {{-- <div class="action-btn bg-danger ms-2">
                                                                                    {!! Form::open(['method' => 'POST', 'class' => 'm-0', 'route' => ['vendors.associate_remove', 'assets_vendor', $vendor_val->id], 'id' => 'delete-form-' . $vendor_val->id]) !!}
                                                                                    {!! Form::hidden('assets_id', $Assets->id) !!}
                                                                                    <button type="submit"
                                                                                        class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm"
                                                                                        data-toggle="tooltip"
                                                                                        title='{{ __('Delete') }}'>
                                                                                        <span class="text-white"> <i
                                                                                                class="ti ti-trash "></i></span>
                                                                                    </button>
                                                                                    {!! Form::close() !!}
                                                                                </div> --}}
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

                                <div class="tab-pane fade" id="pills-user-6" role="tabpanel"
                                    aria-labelledby="pills-user-tab-4">
                                    <div class="justify-content-between align-items-center d-flex">
                                        <h4 class="h4 font-weight-400 float-left">{{ __('Log Time') }}</h4>
                                        @can('create logtime')
                                            <a href="#" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="modal"
                                                data-bs-target="#exampleoverModal"
                                                data-bs-whatever="{{ __('Create Log Time') }}"
                                                data-url="{{ route('assetslogtime.create', ['assets_id' => $Assets->id]) }}"
                                                data-size="lg" data-ajax-popup="true" title="{{ __('Log Time') }}"
                                                data-bs-toggle="tooltip"> <i class="fas fa-cogs"></i>

                                            </a>
                                        @endcan
                                    </div>

                                    <div class="col-xl-12 mt-3">
                                        <div class="">
                                            <div class="card-header table-border-style">
                                                <h5></h5>
                                                <div class="table-responsive">
                                                    <table class="table pc-dt-simple" id="pc-dt-simple">
                                                        <thead>
                                                            <tr>
                                                                <th>{{ __('Description') }}</th>
                                                                <th>{{ __('Action') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($assetslogtime as $assetslogtime_val)
                                                                <tr>
                                                                    <td style="white-space: inherit">
                                                                        <a href="#"
                                                                            data-url="{{ route('assetslogtime.edit', $assetslogtime_val->id) }}"
                                                                            data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="Edit Log Time"
                                                                            data-toggle="tooltip">

                                                                            <i class="far fa-clock"></i>
                                                                            {{ $assetslogtime_val->hours }}
                                                                            {{ __('hr') }}
                                                                            {{ $assetslogtime_val->minute }}
                                                                            {{ __('min') }}
                                                                            <span style="color: black"></span>
                                                                            {{ $assetslogtime_val->name }}
                                                                            {{ date('Y-m-d H:i A', strtotime($assetslogtime_val->created_at)) }}
                                                                            - {{ $assetslogtime_val->description }}
                                                                        </a>
                                                                    </td>
                                                                    <td class="action" style="width: 10%">
                                                                        <span>
                                                                            @can('delete logtime')
                                                                            <div class="action-btn bg-danger ms-2">
                                                                                {!! Form::open(['method' => 'DELETE', 'class' => 'm-0', 'route' => ['assetslogtime.destroy', $assetslogtime_val->id]]) !!}
                                                                                <a href="#!"
                                                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm ">
                                                                                    <i class="ti ti-trash text-white"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-bs-original-title="{{ __('Delete') }}"></i>
                                                                                </a>
                                                                                {!! Form::close() !!}
                                                                            </div>

                                                                                {{-- <div class="action-btn bg-danger ms-2">
                                                                                    {!! Form::open(['method' => 'DELETE', 'class' => 'm-0', 'route' => ['assetslogtime.destroy', $assetslogtime_val->id], 'id' => 'delete-form-' . $assetslogtime_val->id]) !!}
                                                                                    @csrf
                                                                                    {!! Form::hidden('assets_id', $Assets->id) !!}

                                                                                    <button type="submit"
                                                                                        class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm"
                                                                                        data-toggle="tooltip" title='Delete'>
                                                                                        <span class="text-white"> <i
                                                                                                class="ti ti-trash"></i></span>
                                                                                    </button>
                                                                                    </form>
                                                                                </div> --}}
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

                                <div class="tab-pane fade" id="pills-user-7" role="tabpanel"
                                    aria-labelledby="pills-user-tab-4">
                                    <div class="justify-content-between align-items-center d-flex">
                                        <h4 class="h4 font-weight-400 float-left">{{ __('Documents and Picture') }}</h4>

                                    </div>

                                    <div class="card">
                                        <div class="card-body">
                                            <div class=" height-450">
                                                <div class="card-body bg-none top-5-scroll">
                                                    <div class="col-md-12 dropzone browse-file" id="dropzonewidget"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ Main Content ] end -->
            </div>

        @endsection
        @push('pre-purpose-script-page')
            <script src="{{ asset('assets/js/plugins/apexcharts.min.js') }}"></script>
            <script>
                (function() {
                    var options = {
                        chart: {
                            height: 150,
                            type: 'area',
                            toolbar: {
                                show: false,
                            },
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            width: 2,
                            curve: 'smooth'
                        },
                        series: [{
                            name: '{{ __('Order') }}',
                            data: {!! json_encode($chartData['data']) !!}
                        }, ],
                        xaxis: {
                            categories: {!! json_encode($chartData['label']) !!},
                            title: {
                                text: '{{ __('Month') }}'
                            }
                        },
                        colors: ['#ffa21d'],

                        grid: {
                            strokeDashArray: 4,
                        },
                        legend: {
                            show: false,
                        },
                        markers: {
                            size: 4,
                            colors: ['#ffa21d'],
                            opacity: 0.9,
                            strokeWidth: 2,
                            hover: {
                                size: 7,
                            }
                        },
                        yaxis: {
                            tickAmount: 3,
                            min: 10,
                            max: 70,
                        }

                    };
                    var chart = new ApexCharts(document.querySelector("#traffic-chart"), options);
                    chart.render();
                })();

                // $(document).ready(function() {
                //     @if (auth()->user()->user_type == 'super admin' || auth()->user()->user_type == 'company')
                //         var tab = 'report';
                //     @else
                //         var tab = 'pms';
                //     @endif

                //     @if ($tab = Session::get('tab-status'))
                //         var tab = '{{ $tab }}';
                //     @else
                //         var tab_name = $('#tabs li a:eq(0)').attr('data-href');
                //         var tab = tab_name.replace("#tabs-", "");
                //     @endif

                //     var nav_tab = '';
                //     @if ($nav_tab = Session::get('nav-status'))
                //         var nav_tab = '{{ $nav_tab }}';
                //     @endif

                //     setTimeout(function() {
                //         $("#tabs .list-group-list[data-href='#tabs-" + tab + "']").trigger("click");
                //         if (nav_tab != '') {
                //             $(".nav-item .nav-link[href='#" + nav_tab + "_navigation']").trigger("click");
                //         }
                //     }, 10);

                //     $('.list-group-list').on('click', function() {
                //         var href = $(this).attr('data-href');
                //         $('.tabs-card').addClass('d-none');
                //         $(href).removeClass('d-none');
                //         $('#tabs .list-group-list').removeClass('text-primary');
                //         $(this).addClass('text-primary');
                //     });


                // });
            </script>

            <script src="{{ asset('assets/libs/dropzone/dist/dropzone-min.js') }}"></script>
            <script>
                //asset detail page in document and picture dropzone
                @if (Auth::user()->type != 'Client')
                    Dropzone.autoDiscover = false;
                    myDropzone = new Dropzone("#dropzonewidget", {
                    maxFiles: 20,
                    maxFilesize: 20,
                    parallelUploads: 1,
                    filename: false,
                    acceptedFiles: ".jpeg,.jpg,.png,.pdf,.doc,.txt,.docx",
                    url: "{{ route('assets.file.upload', $Assets->id) }} ",
                    success: function (file, response) {
                    if (response.is_success) {
                    dropzoneBtn(file, response);
                    } else {
                    myDropzone.removeFile(file);
                    show_toastr('Error', response.error, 'error');
                    }
                    },
                    error: function (file, response) {
                    myDropzone.removeFile(file);
                    if (response.error) {
                    show_toastr('Error', response.error, 'error');
                    } else {
                    show_toastr('Error', response, 'error');
                    }
                    }
                    });
                    myDropzone.on("sending", function (file, xhr, formData) {
                    formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
                    formData.append("lead_id", {{ $Assets->id }});
                    });


                    function dropzoneBtn(file, response) {
                    var del = document.createElement('a');
                    del.setAttribute('href', response.delete);
                    del.setAttribute('class', "action-btn bg-danger ms-2 mx-3 mt-2 btn btn-sm align-items-center");
                    del.setAttribute('data-toggle', "tooltip");
                    del.setAttribute('data-original-title', "{{ __('Delete') }}");
                    del.innerHTML = "<i class='ti ti-trash'></i>";

                    var download = document.createElement('a');
                    download.setAttribute('href', response.download);
                    download.setAttribute('class', "badge badge-pill badge-blue mx-1");
                    download.setAttribute('data-toggle', "tooltip");
                    download.setAttribute('data-original-title', "{{ __('Download') }}");
                    download.innerHTML = "<i class='ti ti-download'></i>";


                    del.addEventListener("click", function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    if (confirm("Are you sure ?")) {
                    var btn = $(this);
                    $.ajax({
                    url: btn.attr('href'),
                    data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'DELETE',
                    success: function (response) {
                    if (response.is_success) {
                    btn.closest('.dz-image-preview').remove();
                    } else {
                    show_toastr('Error', response.error, 'error');
                    }
                    },
                    error: function (response) {
                    response = response.responseJSON;
                    if (response.is_success) {
                    show_toastr('Error', response.error, 'error');
                    } else {
                    show_toastr('Error', response, 'error');
                    }
                    }
                    })
                    }
                    });

                    var html = document.createElement('div');
                    html.appendChild(download);
                    html.appendChild(del);

                    file.previewTemplate.appendChild(html);
                    }


                    var
                    Asset_other_document_extesnion="{{ \File::extension(storage_path('Assets/' . $Asset_waste_disposal_national_regulations->value)) }}";

                    //all file which are added using dropzon is shown in doxument & picture tab those file data and file path
                    @foreach ($Assets_file as $file)
                        @if ($file)
                            // Create the mock file:
                            var mockFile = {name: "{{ $file->value }}", size:
                            {{ \File::size(storage_path('documents_files/' . $file->value)) }} };

                            var file_extension="{{ \File::extension(storage_path('documents_files/' . $file->value)) }}";

                            if(file_extension=="png" || file_extension=="jpg" || file_extension=="jpeg")
                            {
                            // Call the default addedfile event handler
                            myDropzone.emit("addedfile", mockFile);
                            // And optionally show the thumbnail of the file:
                            myDropzone.emit("thumbnail", mockFile, "{{ asset(Storage::url('documents_files/' . $file->value)) }}");
                            myDropzone.emit("complete", mockFile);
                            }
                            if(file_extension=="pdf")
                            {
                            // Call the default addedfile event handler
                            myDropzone.emit("addedfile", mockFile);
                            // And optionally show the thumbnail of the file:
                            myDropzone.emit("thumbnail", mockFile, "{{ asset('assets/img/icons/files/pdf.png') }}");
                            myDropzone.emit("complete", mockFile);
                            }
                            if(file_extension=="docx" || file_extension=="doc")
                            {
                            // Call the default addedfile event handler
                            myDropzone.emit("addedfile", mockFile);
                            // And optionally show the thumbnail of the file:
                            myDropzone.emit("thumbnail", mockFile, "{{ asset('assets/img/icons/files/doc.png') }}");
                            myDropzone.emit("complete", mockFile);
                            }


                            dropzoneBtn(mockFile, {download: "{{ route('assets.file.download', $file->id) }}",delete:
                            "{{ route('assets.file.delete', $file->id) }}"});
                        @endif
                    @endforeach
                @endif
            </script>



            <script>
                function changetab(tabname) {
                    var someTabTriggerEl = document.querySelector('button[data-bs-target="' + tabname + '"]');
                    // bootstrap.Tab.getInstance(someTabTriggerEl).show();
                    var actTab = new bootstrap.Tab(someTabTriggerEl);
                    actTab.show();
                }
            </script>

        @endpush

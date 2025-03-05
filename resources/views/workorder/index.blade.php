@extends('layouts.admin')
@section('page-title')
    {{ __('Work Order') }}
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('home')}}">{{__('Dashboard')}}</a></li>
<li class="breadcrumb-item active" aria-current="page">{{__('Work Order')}}</li>
@endsection

@section('action-button')
    @can('create wos')


    <a href="#" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="modal"
    data-bs-target="#exampleModal" data-url="{{ url('opentask_import')}}"  data-size="lg"
    data-bs-whatever="{{__('Import WOs')}}"> <span class="text-white">
        <i class="ti ti-file-import" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Import WOs') }}"></i></span>
    </a>
    <a href="#" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="modal"
    data-bs-target="#exampleModal" data-url="{{ route('opentask.create')}}"  data-size="lg"
    data-bs-whatever="{{__('Create New WOs')}}" > <span class="text-white">
        <i class="ti ti-plus" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Create') }}"></i></span>
    </a>
    @endcan


@endsection
@section('content')

    <div class="col-xl-12 col-lg-12 col-md-12 d-flex Palign-items-center justify-content-end mb-5">
        <div class="btn-group btn-group-toggle" data-toggle="buttons"
            aria-label="Basic radio toggle button group">
            <label
                class="btn btn-secondary month-label active">
                <a href="{{ route('opentask.index') }}" class="text-white" >  {{ __("Open") }} </a>
                   
            </label>

            <label
                class="btn btn-secondary year-label">
                <a href="{{ route('opentask.complete.task') }}" class="text-white">  {{ __("Completed") }} </a>
                   
            </label>
        </div>
    </div>





    <div class="col-xl-12">
        <div class="card">
            <div class="card-header card-body table-border-style">
                <h5></h5>
                <div class="table-responsive">
                    <table class="table" id="pc-dt-simple">
                        <thead>
                            <tr>
                                <th>{{ __('Work Order Name') }}</th>
                                <th>{{ __('Priority') }}</th>
                                <th>{{ __('Instructions') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th width="200px"> {{ __('Action') }}</th>
                            </tr>
                        </thead>
                        @php($prioritys = App\Models\WorkOrder::priority())
                        <tbody>
                            @if (Auth::user()->user_type == 'employee' )
                                @foreach ($assign_work_order as $assign_work_orders)
                                    <tr>
                                        <td>{{ $assign_work_orders->wo_name }}</td>
                                        <td>
                                            @foreach ($prioritys as $priority)
                                                @if ($priority['priority'] == $assign_work_orders->priority)
                                                    <span
                                                        class="badge badge-light text-light {{ $priority['color'] }}">
                                                        {{ $assign_work_orders->priority }}</span>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ $assign_work_orders->instructions }}</td>
                                        <td>{{ $assign_work_orders->work_status }}</td>

                                        <td class="action">
                                            <span>
                                                @can('manage wos')
                                                <div class="action-btn bg-warning ms-2">
                                                    <a href="{{ route('opentask.show', [$assign_work_orders->id]) }}" class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                        data-bs-whatever="{{__('View WOs')}}" data-bs-toggle="tooltip" title="{{ __('View WOs') }}"
                                                        data-bs-original-title="{{__('View WOs')}}"> <span class="text-white"> <i
                                                                class="ti ti-eye"></i></span></a>
                                                    </div>
                                                @endcan

                                                @can('edit wos')
                                                <div class="action-btn bg-info ms-2">
                                                    <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="modal"
                                                    data-size="lg"
                                                        data-bs-target="#exampleModal" data-url="{{route('opentask.edit', $assign_work_orders->id)  }}"
                                                        data-bs-whatever="{{__('Edit WOs')}}"> <span class="text-white"> <i
                                                                class="ti ti-edit" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Edit') }}"></i></span></a>
                                                    </div>
                                                @endcan

                                                @can('delete wos')
                                                <div class="action-btn bg-danger ms-2">
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['opentask.destroy', $assign_work_orders->id]]) !!}
                                                        <a href="#!" class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm ">
                                                            <i class="ti ti-trash text-white"></i>
                                                        </a>
                                                    {!! Form::close() !!}
                                                </div>
                                                @endcan

                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection


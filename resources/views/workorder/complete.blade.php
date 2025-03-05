@extends('layouts.admin')
@section('page-title')
    {{ __('Work Order') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('opentask.index')}}">{{__('Work Order')}}</li></a>
    <li class="breadcrumb-item active" aria-current="page">{{__('Completed Task')}}</li>
@endsection

@section('action-button')
    <a href="#" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="modal"
    data-bs-target="#exampleModal" data-url="{{ route('opentask.create')}}"  data-size="lg"
    data-bs-whatever="{{__('Create New WOs')}}" > <span class="text-white">
        <i class="ti ti-plus" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Create') }}"></i></span>
    </a>
@endsection

@section('content')
<div class="col-xl-12 col-lg-12 col-md-12 d-flex Palign-items-center justify-content-end mb-3">
    <div class="row">
        <div class="btn-group btn-group-toggle" data-toggle="buttons"
            aria-label="Basic radio toggle button group">
            <label
                class="btn btn-secondary month-label active">
                <a href="{{ route('opentask.index') }}" class="text-white">  {{ __("Open") }} </a>

            </label>

            <label
                class="btn btn-secondary year-label">
                <a href="{{ route('opentask.complete.task') }}" class="text-white">{{ __("Completed") }}</a>

            </label>
        </div>
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
                        <tbody>
                            @foreach ($work_order as $workorder_val)
                                <tr>
                                    <td>{{ $workorder_val->wo_name }}</td>
                                    <td>{{ $workorder_val->priority }}</td>
                                    <td>{{ $workorder_val->instructions }}</td>
                                    <td>{{ __('Complete') }}</td>
                                    <td class="action">
                                        <span>
                                            <div class="action-btn bg-warning ms-2">
                                                <a href="{{ route('opentask.show', [$workorder_val->id]) }}"
                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                    data-bs-toggle="tooltip" data-bs-original-title="{{ __('View') }}">
                                                    <i class="ti ti-eye text-white" ></i>
                                                </a>
                                            </div>
                                            <div class="action-btn bg-info ms-2">
                                                <a href="#" data-url="{{ route('opentask.edit', $workorder_val->id) }}"
                                                    data-bs-toggle="modal" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-target="#exampleModal"  data-bs-whatever="{{__('Edit WOs')}}">
                                                    <i class="ti ti-edit text-white" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Edit') }}"
                                                    ></i>
                                                </a>
                                            </div>
                                            <div class="action-btn bg-danger ms-2">
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['opentask.destroy', $workorder_val->id]]) !!}
                                                <a href="#!" class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm ">
                                                    <i class="ti ti-trash text-white" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Delete') }}"></i>
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

@endsection

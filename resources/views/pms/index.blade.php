@extends('layouts.admin')
@section('page-title')
    {{ __('Preventive Maintenance Tasks') }}
@endsection
@section('action-button')
    @if (Gate::check('create pms'))
        <a href="#" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="modal" data-bs-target="#exampleModal"
            data-url="{{ route('pms.create') }}" data-size="lg" data-bs-whatever="{{ __('Create New PMs') }}"
            > <span class="text-white">
                <i class="ti ti-plus text-white" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Create') }}"></i></span>
        </a>
    @endif
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{__('PMs')}}</li>

@endsection

@section('content')
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header card-body table-border-style">
                <h5></h5>
                <div class="table-responsive">
                    <table class="table" id="pc-dt-simple">
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
                                    <td class="action">
                                        <span class="table_btn">
                                            @can('manage pms')
                                                <div class="action-btn bg-warning ms-2">
                                                    <a href="{{ route('pms.show', [$pms_val->id]) }}"
                                                        class="mx-3 btn btn-sm d-inline-flex align-items-center" data-url="#"
                                                        data-bs-whatever="{{ __('View PMs') }}"  data-bs-toggle="tooltip" data-bs-original-title="{{ __('View') }}"> <span
                                                            class="text-white"> <i class="ti ti-eye"></i></span></a>
                                                </div>
                                            @endcan
                                            @can('edit pms')
                                                <div class="action-btn bg-info ms-2">
                                                    <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                        data-bs-toggle="modal" data-bs-target="#exampleoverModal"
                                                        data-url="{{ route('pms.edit', $pms_val->id) }}" data-size="lg"
                                                        data-bs-whatever="{{ __('Edit PMs   ') }}"> <span
                                                            class="text-white"> <i class="ti ti-edit" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Edit') }}"></i></span></a>
                                                </div>
                                            @endcan
                                            @can('delete pms')
                                                <div class="action-btn bg-danger ms-2">
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['pms.destroy', $pms_val->id]]) !!}
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
@endsection

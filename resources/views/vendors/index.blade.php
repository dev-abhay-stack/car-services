@extends('layouts.admin')
@section('page-title')
    {{__('Vendor')}}
@endsection
@section('action-button')
    @if(Gate::check('create vendor'))
        <a href="#" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="modal"
        data-bs-target="#exampleoverModal" data-url="{{ route('vendors.create')}}"  data-size="lg"
        data-bs-whatever="{{__('Create New Vendor')}}"
       >
            <i class="ti ti-plus text-white" data-bs-toggle="tooltip"  data-bs-original-title="{{__('Create')}}" ></i>
        </a>
    @endif
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{__('Vendor')}}</li>

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
                                <th>{{__('Image')}}</th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Email')}}</th>
                                <th>{{__('Phone')}}</th>
                                <th width="200px"> {{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Vendor as $vendor_val)
                            <tr>
                                @php
                                    $image = !empty($vendor_val->image) ? 'vendors/'.$vendor_val->image : 'avatar/placeholder.jpg';
                                @endphp
                                <td width="100"><div><img src="{{asset(Storage::url($image))}}" class="img-fluid" width="70"></div></td>
                                <td>{{$vendor_val->name}}</td>
                                <td>{{$vendor_val->email}}</td>
                                <td>{{$vendor_val->phone}}</td>


                                <td class="action">
                                    <span>
                                        @if(Gate::check('manage vendor'))
                                        <div class="action-btn bg-warning ms-2">
                                            <a href="{{ route('vendors.show',[$vendor_val->id]) }}"
                                                class="mx-3 btn btn-sm d-inline-flex align-items-center" data-url="#"
                                                data-bs-whatever="{{ __('View Vendor') }}" data-bs-toggle="tooltip"
                                                data-bs-original-title="{{ __('View') }}"> <span
                                                    class="text-white"> <i class="ti ti-eye"></i></span></a>
                                        </div>
                                        @endif
                                        @if(Gate::check('edit vendor'))
                                        <div class="action-btn bg-info ms-2">
                                            <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                data-bs-toggle="modal" data-bs-target="#exampleoverModal"
                                                data-url="{{ route('vendors.edit',$vendor_val->id) }}" data-size="lg"
                                                data-bs-whatever="{{ __('Edit Vendor') }}"> <span
                                                    class="text-white"> <i class="ti ti-edit"  data-bs-toggle="tooltip"
                                                    data-bs-original-title="{{ __('Edit') }}"></i></span></a>
                                        </div>
                                        @endif
                                        @if(Gate::check('delete vendor'))
                                        <div class="action-btn bg-danger ms-2">
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['vendors.destroy', $vendor_val->id]]) !!}
                                            <a href="#!" class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm ">
                                                <i class="ti ti-trash text-white" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Delete') }}"></i>
                                            </a>
                                            {!! Form::close() !!}

                                        </div>

                                        @endif
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

@extends('layouts.admin')
@section('page-title')
    {{__('Parts')}}
@endsection
@section('action-button')
    @if(Gate::check('create parts'))
    <a href="#" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="modal"
    data-bs-target="#exampleoverModal" data-url="{{ route('parts.create')}}"  data-size="lg"
    data-bs-whatever="{{__('Create New Parts')}}"> <span class="text-white">
        <i class="ti ti-plus text-white" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Create') }}"></i></span>
    </a>

    @endif
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{__('Parts')}}</li>
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
                                <th>{{__('Parts Thumbnail')}}</th>
                                <th>{{__('Name')}}</th>
                                <th width="200px"> {{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($parts as $parts_val)
                                <tr>
                                    @php
                                        $thumbnail = !empty($parts_val->thumbnail) ? 'Parts/thumbnail/'.$parts_val->thumbnail : 'avatar/placeholder.jpg';
                                    @endphp
                                    <td width="100"><div><img src="{{asset(Storage::url($thumbnail))}}" class="img-fluid" width="70"></div></td>
                                    <td>{{$parts_val->name}}</td>
                                    <td class="action">
                                        <span class="table_btn">
                                            @if(Gate::check('manage parts'))
                                            <div class="action-btn bg-warning ms-2">
                                                <a href="{{ route('parts.show',[$parts_val->id]) }}" class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                 data-url="#"
                                                data-bs-whatever="{{__('View Parts')}}" data-bs-toggle="tooltip" title="{{ __('View Parts') }}"
                                                data-bs-original-title="{{__('View')}}"> <span class="text-white"> <i
                                                        class="ti ti-eye"></i></span></a>
                                            </div>

                                            @endif
                                            @if(Gate::check('edit parts'))
                                            <div class="action-btn bg-info ms-2">
                                                <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="modal"
                                                data-bs-target="#exampleoverModal" data-url="{{ route('parts.edit',$parts_val->id) }}" data-size="lg"
                                                data-bs-whatever="{{__('Edit Parts')}}"> <span class="text-white"> <i
                                                        class="ti ti-edit" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Edit') }}"></i></span></a>
                                            </div>

                                            @endif
                                            @if(Gate::check('delete parts'))
                                            <div class="action-btn bg-danger ms-2">
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['parts.destroy', $parts_val->id]]) !!}
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

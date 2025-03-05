@extends('layouts.admin')
@section('page-title')
    {{__('Assets')}}
@endsection
@section('action-button')
    @can('create assets')
    <a href="#" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="modal"
    data-bs-target="#exampleModal" data-url="{{ route('asset.create')}}"  data-size="lg"
    data-bs-whatever="{{__('Create New Assets')}}" > <span class="text-white">
        <i class="ti ti-plus text-white" data-bs-toggle="tooltip"
        data-bs-original-title="{{__('Create')}}"></i></span>
    </a>
    @endcan
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{__('Assets')}}</li>
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
                                <th>{{__('Asset Thumbnail')}}</th>
                                <th>{{__('Name')}}</th>
                                <th width="200px"> {{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($assets as $assets_val)
                            <tr>
                                @php
                                    $thumbnail = !empty($assets_val->thumbnail) ? 'Assets/thumbnail/'.$assets_val->thumbnail : 'avatar/placeholder.jpg';
                                @endphp
                                <td width="100"><div><img src="{{asset(Storage::url($thumbnail))}}" class="img-fluid" width="70"></div></td>
                                <td>{{$assets_val->name}}</td>
                                <td class="action">
                                    <span class="table_btn">
                                        @can('manage assets')
                                        <div class="action-btn bg-warning ms-2">
                                            <a href="{{ route('asset.show',[$assets_val->id]) }}" class="mx-3 btn btn-sm d-inline-flex align-items-center"  data-size="lg"
                                                data-bs-whatever="{{__('View Assets')}}" data-bs-toggle="tooltip"
                                                data-size="lg"
                                                data-bs-original-title="{{__('View')}}"> <span class="text-white"> <i
                                                        class="ti ti-eye"></i></span></a>
                                        </div>


                                        @endcan
                                        @can('edit assets')
                                            <div class="action-btn bg-info ms-2">
                                                <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="modal" data-size="lg"
                                                    data-bs-target="#exampleModal" data-url="{{route('asset.edit',$assets_val->id)  }}"
                                                    data-bs-whatever="{{__('Edit Assets')}}" data-size="lg"
                                                   > <span class="text-white"> <i class="ti ti-edit" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Edit') }}"></i></span></a>
                                            </div>

                                        @endcan
                                        @can('delete assets')
                                        <div class="action-btn bg-danger ms-2">
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['asset.destroy', $assets_val->id]]) !!}
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

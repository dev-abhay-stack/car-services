@extends('layouts.admin')
@section('page-title')
    {{__('Manage Locations')}}
@endsection
@section('action-button')
    <a href="#" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="modal"
    data-bs-target="#exampleModal" data-url="{{ route('location.create')}}"
    data-bs-whatever="{{__('Create New Location')}}">
        <i class="ti ti-plus text-white" data-bs-toggle="tooltip" data-bs-original-title="{{__('Create')}}"></i>
    </a>
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('home')}}">{{__('Dashboard')}}</a></li>
<li class="breadcrumb-item active" aria-current="page">{{__('Location')}}</li>
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
                                <th>{{__('Name')}}</th>
                                <th>{{__('Address')}}</th>
                                <th width="200px"> {{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($locations as $location_val)
                                <tr>
                                    <td>{{$location_val->name}}</td>
                                    <td>{{$location_val->address}}</td>
                                        <div class="row ">
                                            <td class="">
                                                <div class="action-btn bg-dark ms-2">
                                                <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                 data-url="{{ route('work_request.QRCode',$location_val->id) }}"
                                                 data-bs-toggle="modal" data-bs-target="#exampleModal" data-title="{{__('Submit a Work Request')}}"
                                                 data-toggle="tooltip" data-original-title="{{__('Look up this Work Request Portal by a QR code')}}">
                                                    <i class="ti ti-qrcode text-white"></i>
                                                </a>
                                                </div>

                                                    <div class="action-btn bg-warning ms-2">
                                                        <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center cp_link" data-link="{{route('work_request.portal',\Illuminate\Support\Facades\Crypt::encrypt($location_val->id))}}"
                                                            data-bs-whatever="{{__('Copy Link')}}" data-bs-toggle="tooltip"
                                                            data-bs-original-title="{{__('Copy Link')}}"> <span class="text-white"> <i
                                                                    class="ti ti-link"></i></span></a>
                                                    </div>

                                                <div class="action-btn bg-info ms-2">
                                                    <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal" data-url="{{ route('location.edit',$location_val->id) }}"
                                                        data-bs-whatever="{{__('Edit Location')}}"> <span class="text-white"> <i
                                                                class="ti ti-edit" data-bs-toggle="tooltip" data-bs-original-title="{{__('Edit')}}"></i></span></a>
                                                </div>

                                                <div class="action-btn bg-danger ms-2">
                                                    {!! Form::open(['method' => 'DELETE', 'class' => 'm-0','route' => ['location.destroy', $location_val->id]]) !!}
                                                    <a href="#!" class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm m-2">
                                                        <i class="ti ti-trash text-white" data-bs-toggle="tooltip" data-bs-original-title="{{__('Delete')}}"></i>
                                                    </a>
                                                    {!! Form::close() !!}


                                                </div>

                                            </td>
                                        </div>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection
{{-- 
@push('pre-purpose-script-page')

@endpush --}}
@push('pre-purpose-script-page')
<script type="text/javascript" src="{{ asset('assets/js/jquery.qrcode.js') }}"></script>
    <script type="text/javascript">
        $('.cp_link').on('click', function () {
            var value = $(this).attr('data-link');
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(value).select();
            document.execCommand("copy");
            $temp.remove();
            toastrs('Success', '{{__('Link Copy on Clipboard')}}', 'success')
        });
    </script>
@endpush

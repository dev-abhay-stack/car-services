@extends('layouts.admin')
@section('page-title')
    {{ __('Manage Purchase Orders') }}
@endsection

@section('action-button')
    @can('create pos')
        <a href="{{ route('pos.create',0)}}" class="btn btn-sm btn-primary btn-icon m-1" data-size="lg"
            data-bs-whatever="{{__('Create New POs')}}" data-bs-toggle="tooltip" title="{{ __('Create POs') }}"
            data-bs-original-title="{{__('Create New POs')}}">
                <i class="ti ti-plus text-white"></i>
        </a>
    @endcan

@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{__('POs')}}</li>

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
                                <th>{{ __('Vendor Name') }}</th>
                                <th>{{ __('User Name') }}</th>
                                <th>{{ __('Purchase Order Date') }}</th>
                                <th>{{ __('Expected Delivery Date') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pos as $invoice)
                                    <tr>
                                        <td>{{ $invoice->vendor_name }}</td>
                                        <td>{{ $invoice->user_name }}</td>
                                        <td>{{ $invoice->pos_date }}</td>

                                        <td>{{ $invoice->delivery_date }}</td>

                                        <td class="Action">
                                            <span>
                                                @can('edit pos')
                                                <div class="action-btn bg-info ms-2">
                                                    <a href="{{ route('pos.edit', \Crypt::encrypt($invoice->id)) }}" class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                        data-bs-whatever="{{ __('Edit POs') }}" data-bs-toggle="tooltip"
                                                        title="{{ __('Edit') }}"
                                                        data-bs-original-title="{{ __('Edit POs') }}"> <span
                                                            class="text-white"> <i class="ti ti-edit"></i></span></a>
                                                </div>

                                                    {{-- <a href="{{ route('pos.edit', \Crypt::encrypt($invoice->id)) }}"
                                                        class="edit-icon" data-toggle="tooltip"
                                                        data-original-title="{{ __('Edit POs') }}" data-toggle="tooltip">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a> --}}
                                                @endcan
                                                @can('delete pos')
                                                <div class="action-btn bg-danger ms-2">
                                                    <form method="POST" action="{{ route('pos.destroy', $invoice->id) }}">
                                                        @csrf
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <button type="submit"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm"
                                                            data-toggle="tooltip" title='{{ __('Delete') }}'>
                                                            <span class="text-white"> <i class="ti ti-trash"></i></span>
                                                        </button>
                                                    </form>
                                                </div>

                                                    {{-- <a href="#" class="delete-icon " data-toggle="tooltip"
                                                        data-original-title="{{ __('Delete') }}"
                                                        data-confirm="{{ __('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?') }}"
                                                        data-confirm-yes="document.getElementById('delete-form-{{ $invoice->id }}').submit();" data-toggle="tooltip">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['pos.destroy', $invoice->id], 'id' => 'delete-form-' . $invoice->id]) !!}
                                                    {!! Form::close() !!} --}}
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

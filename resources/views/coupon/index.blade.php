@extends('layouts.admin')

@section('page-title') {{__('Coupon')}} @endsection

@section('action-button')
    <a href="#" class="btn btn-sm btn-primary btn-icon m-1" data-size="lg" data-url="{{route('coupons.create')}}" data-bs-target="#exampleModal" data
    data-bs-whatever="{{__('Create New Coupon')}}" data-bs-toggle="modal" data-bs-toggle="tooltip" title="{{ __('Create Coupon') }}" data-bs-original-title="{{__('Create New Coupon')}}">
        <i class="ti ti-plus text-white"></i>
    </a>

@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('home')}}">{{__('Dashboard')}}</a></li>
<li class="breadcrumb-item" aria-current="page">{{__('Coupon')}}</li>
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
                                <th> {{__('Name')}}</th>
                                <th> {{__('Code')}}</th>
                                <th> {{__('Discount (%)')}}</th>
                                <th> {{__('Limit')}}</th>
                                <th> {{__('Used')}}</th>
                                <th> {{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                              @foreach ($coupons as $coupon)
                                <tr>
                                    <td>{{ $coupon->name }}</td>
                                    <td>{{ $coupon->code }}</td>
                                    <td>{{ $coupon->discount }}</td>
                                    <td>{{ $coupon->limit }}</td>
                                    <td>{{ $coupon->used_coupon() }}</td>
                                    <td>
                                        <span>
                                            <div class="action-btn bg-warning ms-2">
                                                    <a href="{{ route('coupons.show',$coupon->id) }}" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-whatever="{{ __('View Coupons') }}" data-bs-toggle="tooltip"
                                                        title="{{ __('View') }}"
                                                        data-bs-original-title="{{ __('View') }}"> <span
                                                            class="text-white"> <i class="ti ti-eye"></i></span></a>
                                            </div>

                                            <div class="action-btn bg-info ms-2">
                                                    <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-url="{{route('coupons.edit',$coupon->id) }}"
                                                        data-bs-whatever="{{ __('Edit Coupons') }}" data-bs-toggle="tooltip" data-bs-target="#exampleModal" data-bs-toggle="modal"
                                                        title="{{ __('Edit') }}"
                                                        data-bs-original-title="{{ __('Edit Coupons') }}"> <span
                                                            class="text-white"> <i class="ti ti-edit"></i></span></a>
                                            </div>

                                            <div class="action-btn bg-danger ms-2">
                                                <form method="POST" action="{{ route('coupons.destroy',$coupon->id) }}">
                                                    @csrf
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button type="submit"
                                                        class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm"
                                                        data-toggle="tooltip" title='{{ __('Delete') }}'>
                                                        <span class="text-white"> <i class="ti ti-trash"></i></span>
                                                    </button>
                                                </form>
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

@push('css-page')
@endpush
@push('script-page')'
    <script>
        $(document).on('click', '#code-generate', function () {
            console.log("dsa");
            var length = 10;
            var result = '';
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            var charactersLength = characters.length;
            for (var i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            $('#auto-code').val(result);
        });
    </script>
@endpush

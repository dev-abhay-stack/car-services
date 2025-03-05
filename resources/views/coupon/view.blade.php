@extends('layouts.admin')

@section('page-title') {{__('Coupon Detail')}} @endsection

@section('content')
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header card-body table-border-style">
                <h5></h5>
                <div class="table-responsive">
                    <table class="table" id="pc-dt-simple">
                        <thead>
                            <tr>
                                <th> {{__('Coupon')}}</th>
                                <th> {{__('User')}}</th>
                                <th> {{__('Date')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userCoupons as $userCoupon)
                                <tr>
                                    <td>{{ $coupon->code }}</td>
                                    <td>{{ !empty($userCoupon->userDetail)?$userCoupon->userDetail->name:'' }}</td>
                                    <td>{{ $userCoupon->created_at }}</td>
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
@push('scripts')
    <script>
        $(document).ready(function () {

        });
    </script>
@endpush

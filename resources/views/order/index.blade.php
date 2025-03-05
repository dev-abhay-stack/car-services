@extends('layouts.admin')

@section('page-title') {{__('Orders')}} @endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('home')}}">{{__('Dashboard')}}</a></li>
<li class="breadcrumb-item" aria-current="page">{{__('Order')}}</li>
@endsection

@section('content')

    {{-- <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="selection-datatable table table-responsive" class="table dataTable" width="100%">
                            <thead>
                            <tr>
                                <th>{{__('Order Id')}}</th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Plan Name')}}</th>
                                <th>{{__('Price')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Payment Type')}}</th>
                                <th>{{__('Coupon')}}</th>
                                <th>{{__('Date')}}</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($orders as $order)
                                @php($color = ($order->payment_status == 'succeeded' || $order->payment_status == 'approved') ? 'success' : 'danger')
                                <tr>
                                    <td>{{$order->order_id}}</td>
                                    <td>{{ $order->name }}</td>
                                    <td>{{$order->plan_name}}</td>
                                    <td>{{env('CURRENCY_SYMBOL')}}{{number_format($order->price)}}</td>
                                    <td>{{__(ucfirst($order->payment_status))}}</td>
                                    <td>{{ __($order->payment_type) }}</td>

                                    <td>{{App\Models\Coupon::coupen_details($order->coupon)}}</td>
                                     <td>{{App\Models\Utility::dateFormat($order->created_at)}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}


    <div class="col-xl-12">
        <div class="card">
            <div class="card-header card-body table-border-style">
                <h5></h5>
                <div class="table-responsive">
                    <table class="table" id="pc-dt-simple">
                        <thead>
                            <tr>
                                <th>{{__('Order Id')}}</th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Plan Name')}}</th>
                                <th>{{__('Price')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Payment Type')}}</th>
                                <th>{{__('Coupon')}}</th>
                                <th>{{__('Date')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                @php($color = ($order->payment_status == 'succeeded' || $order->payment_status == 'approved') ? 'success' : 'danger')
                                <tr>
                                    <td>{{$order->order_id}}</td>
                                    <td>{{ $order->name }}</td>
                                    <td>{{$order->plan_name}}</td>
                                    <td>{{env('CURRENCY_SYMBOL')}}{{number_format($order->price)}}</td>
                                    <td>{{__(ucfirst($order->payment_status))}}</td>
                                    <td>{{ __($order->payment_type) }}</td>

                                    <td>{{App\Models\Coupon::coupen_details($order->coupon)}}</td>
                                    <td>{{App\Models\Utility::dateFormat($order->created_at)}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

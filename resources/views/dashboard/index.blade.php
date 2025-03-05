@extends('layouts.admin')
@php
if (Auth::user()->user_type == 'company') {
    $currentlocation = User::userCurrentLocation();
    $userlocation = Auth::user()->location;
    foreach ($userlocation as $locations) {
        if ($currentlocation == $locations->id) {
            $location_name = $locations->name;
        }
    }
} else {
    $location_name = '';
}
@endphp
@section('page-title')
    {{ __('Dashboard') }}
    @if (Auth::user()->user_type == 'company')
        {{ __(' - ') }} {{ $location_name }}
    @endif
@endsection

@section('content')


    @if (Auth::user()->user_type == 'super admin')
        <div class="row">
            <!-- [ sample-page ] start -->
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-xxl-7">
                        <div class="row">
                            <div class="col-lg-4 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="theme-avtar bg-primary">
                                            <i class="ti ti-home"></i>
                                        </div>
                                        <p class="text-muted text-sm mt-4 mb-2">{{ $totalPaidUsers }}
                                            {{ __('Paid Users') }}</p>
                                        <h6 class="mb-3">{{ __('Total') }}</h6>
                                        <h3 class="mb-0">{{ $totalUsers }} <span
                                                class="h5">{{ __('Users') }}</span></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="theme-avtar bg-info">
                                            <i class="ti ti-click"></i>
                                        </div>
                                        <p class="text-muted text-sm mt-4 mb-2">
                                            {{ (env('CURRENCY_SYMBOL') != '' ? env('CURRENCY_SYMBOL') : '$') . $totalOrderAmount }}</small>
                                            {{ __('Order Amount') }}</p>
                                        <h6 class="mb-3">{{ __('Total') }}</h6>
                                        <h3 class="mb-0">{{ $totalOrders }} <span
                                                class="h5">{{ __('Orders') }}</span></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="theme-avtar bg-warning">
                                            <i class="ti ti-report-money"></i>
                                        </div>
                                        <p class="text-muted text-sm mt-4 mb-2">
                                            @if ($mostPlans)
                                                {{ $mostPlans->name }}
                                            @else
                                                -
                                            @endif {{ __('Most purchase plan') }}
                                        </p>
                                        <h6 class="mb-3">{{ __('Total') }}</h6>
                                        <h3 class="mb-0">{{ $totalPlans }} <span
                                                class="h5">{{ __('Plans') }}</span></h3>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="col-xxl-5">
                        <div class="card">
                            <div class="card-header">
                                <h5> {{ __('Recent Orders') }}</h5>
                            </div>
                            <div class="card-body">
                                <div id="traffic-chart1"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- [ sample-page ] end -->
        </div>
    @elseif(Auth::user()->user_type == 'company')
        <div class="row">
            <!-- [ sample-page ] start -->
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-xxl-6">
                        <div class="row">
                            <div class="col-lg-3 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="theme-avtar bg-primary">
                                            <i class="ti ti-clipboard-check"></i>
                                        </div>
                                        <p class="text-muted text-sm mt-4 mb-2">{{ __('Total') }}</p>
                                        <h6 class="mb-3">{{ __('Total Open Work Order') }}</h6>
                                        <h3 class="mb-0">{{ $open_workOrder }} </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="theme-avtar bg-info">
                                            <i class="ti ti-click"></i>
                                        </div>
                                        <p class="text-muted text-sm mt-4 mb-2">{{ __('Total') }}</p>
                                        <h6 class="mb-3">{{ __('Complete Work Order') }}</h6>
                                        <h3 class="mb-0">{{ $complete_workOrder }} </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="theme-avtar bg-warning">
                                            <i class="ti ti-box"></i>
                                        </div>
                                        <p class="text-muted text-sm mt-4 mb-2">{{ __('Total') }}</p>
                                        <h6 class="mb-3">{{ __('Assets') }}</h6>
                                        <h3 class="mb-0">{{ $total_assets }} </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="theme-avtar bg-danger">
                                            <i class="ti ti-tools"></i>
                                        </div>
                                        <p class="text-muted text-sm mt-4 mb-2">{{ __('Total') }}</p>
                                        <h6 class="mb-3">{{ __('PMs') }}</h6>
                                        <h3 class="mb-0">{{ $total_pms }} </h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-xxl-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start">
                                            <div class="theme-avtar bg-primary">
                                                <i class="ti ti-clipboard-list"></i>
                                            </div>
                                            <div class="ms-3">
                                                <p class="text-muted mb-0">{{ __('Work Order Overview') }}</p>

                                            </div>
                                        </div>
                                    </div>
                                    <div id="task-chart-work-order"></div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="d-flex align-items-start mb-3">
                                            <div class="theme-avtar bg-danger">
                                                <i class="ti ti-file-zip"></i>
                                            </div>
                                            <div class="ms-3">
                                                <h4 class="mb-0">{{ __('Total Work Order') }}</h4>

                                            </div>
                                        </div>
                                        @foreach ($arrProcessPer as $index => $value)
                                            <div class="col-6">
                                                <i class="fas fa-chart {{ $arrProcessClass[$index] }} mt-3 h3"></i>
                                                <div class="row">
                                                    <h6 class="font-weight-bold">
                                                        <span>{{ $value }}%</span>
                                                        <p class="text-muted mb-0">{{ __($arrProcessLabel[$index]) }}</p>
                                                    </h6>
                                                </div>

                                            </div>
                                        @endforeach


                                    </div>
                                    <div class="col-6">
                                        <div id="total_work_order"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="card card-fluid">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="mb-0">{{ __('Work Order') }}</h5>
                                        <p> <b> {{ $completeTask }}</b> {{ __('Work Order completed out of') }}
                                            {{ $totalTask }} </p>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-centered table-hover mb-0 animated">
                                <tbody>
                                    @forelse($tasks as $task)
                                        <tr>
                                            <td>
                                                <div class="font-14 my-1"><a
                                                        href="{{ route('opentask.show', [$task->id]) }}"
                                                        class="text-body">{{ $task->title }}</a></div>

                                                @php($date = '<span class="text-' . ($task->date < date('Y-m-d') ? 'danger' : 'success') . '">' . date('Y-m-d', strtotime($task->date)) . '</span> ')

                                                <span class="text-muted font-13">{{ __('Due Date') }} :
                                                    {!! $date !!}</span>
                                            </td>
                                            <td>
                                                <span class="text-muted font-13">{{ __('Status') }}</span> <br />
                                                @if ($task->status == '1')
                                                    <span class="badge bg-success p-2 px-3 rounded">{{ __('Open') }}</span>
                                                @else
                                                    <span class="badge bg-primary p-2 px-3 rounded">{{ __('Complete') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="text-muted font-13">{{ __('Project') }}</span>
                                                <div class="font-14 mt-1 font-weight-normal">{{ $task->wo_name }}
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr class="text-center">
                                            <td>
                                                <h6 class="text-center font-13">{{ __('No Work order found') }}</h6>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>


                        </div>
                    </div>

                </div>
                <!-- [ sample-page ] end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
        </div>
    @else
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-0 mt-3 text-center text-white bg-info">
                    <div class="card-body">
                        <h5 class="card-title mb-0">
                            {{ __('There is no active Workspace. Please create Workspace from right side menu.') }}
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    @endif



@endsection

@push('pre-purpose-script-page')
    <script src="{{ asset('assets/js/plugins/apexcharts.min.js') }}"></script>

    @if (Auth::user()->user_type == 'super admin')
        <script>
            (function() {
                var options = {
                    chart: {
                        height: 150,
                        type: 'area',
                        toolbar: {
                            show: false,
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        width: 2,
                        curve: 'smooth'
                    },
                    series: [{
                        name: '{{ __('Order') }}    ',
                        data: {!! json_encode($chartData['data']) !!}
                    }, ],
                    xaxis: {
                        categories: {!! json_encode($chartData['label']) !!},
                    },
                    colors: ['#ffa21d'],

                    grid: {
                        strokeDashArray: 4,
                    },
                    legend: {
                        show: false,
                    },
                    markers: {
                        size: 4,
                        colors: ['#ffa21d', '#FF3A6E'],
                        opacity: 0.9,
                        strokeWidth: 2,
                        hover: {
                            size: 7,
                        }
                    },
                    yaxis: {
                        tickAmount: 3,
                        min: 10,
                        max: 70,
                    }
                };
                var chart = new ApexCharts(document.querySelector("#traffic-chart1"), options);
                chart.render();
            })();
        </script>
    @elseif(isset($currentlocation) && $currentlocation)
        <script>
            (function() {
                var options = {
                    chart: {
                        height: 150,
                        type: 'area',
                        toolbar: {
                            show: false,
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        width: 2,
                        curve: 'smooth'
                    },
                    series: [{
                        name: '{{ __('Order') }}',
                        data: {!! json_encode($chartData['data']) !!}
                    }],
                    xaxis: {
                        categories: {!! json_encode($chartData['label']) !!},
                    },
                    colors: ['#ffa21d'],

                    grid: {
                        strokeDashArray: 4,
                    },
                    legend: {
                        show: false,
                    },
                    markers: {
                        size: 4,
                        colors: ['#ffa21d'],
                        opacity: 0.9,
                        strokeWidth: 2,
                        hover: {
                            size: 7,
                        }
                    },
                    yaxis: {
                        tickAmount: 3,
                        min: 10,
                        max: 70,
                    }
                };
                var chart = new ApexCharts(document.querySelector("#task-chart-work-order"), options);
                chart.render();
            })();

            (function() {
                var options = {
                    chart: {
                        height: 210,
                        type: 'donut',
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '70%',
                            }
                        }
                    },
                    series: {!! json_encode($arrProcessPer) !!},
                    colors: ["#3ec9d6", "#6fd943"],
                    labels: {!! json_encode($arrProcessLabel) !!},
                    legend: {
                        show: false
                    }
                };
                var chart = new ApexCharts(document.querySelector("#total_work_order"), options);
                chart.render();
            })();


         

            
        </script>
    @endif
@endpush

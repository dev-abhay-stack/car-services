@extends('layouts.admin')
@section('page-title')
    {{ __('Dashboard') }}
@endsection

@section('content')

    @if (Auth::user()->user_type == 'employee')
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
                                    <h3 class="mt-3">{{ $assign_work_order }} </h3>
                                    <p> {{ __('Total Assign  Work Order') }} </p>

                                </div>
                            </div>
                        </div>
                        @if (count($created_work_order) > 0)
                            <div class="col-lg-4 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="theme-avtar bg-primary">
                                            <i class="ti ti-home"></i>
                                        </div>
                                        <h3 class="mt-3">{{ $complete_workorder }} </h3>
                                        <p> {{ __('Total Completed Work Order') }} </p>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="theme-avtar bg-primary">
                                            <i class="ti ti-home"></i>
                                        </div>
                                        <h3 class="mt-3">{{ $open_workorder }} </h3>
                                        <p> {{ __('Total Open  Work Order') }} </p>

                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>

                </div>
                <div class="col-xxl-5">
                    <div class="card">
                        <div class="card-header">
                            <h5> {{ __('Work Order Overview') }}</h5>
                        </div>
                        <div class="card-body">
                            <div id="traffic-chart1"></div>
                        </div>
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
            <div class="card animated">
                <div class="card-header">
                    <h6 class="float-left text_header">
                        {{ __('Work Order') }}
                        <small class="d-block mt-2"><b>{{ $completeTask }}</b>
                            {{ __('Work Order completed out of') }} {{ $totalTask }}</small>
                    </h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-centered table-hover mb-0 animated">
                            <tbody>
                                @foreach ($tasks as $task)
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
                                                <span class="badge badge-success">{{ __('Open') }}</span>
                                            @else
                                                <span class="badge badge-primary">{{ __('Complete') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="text-muted font-13">{{ __('Project') }}</span>
                                            <div class="font-14 mt-1 font-weight-normal">{{ $task->wo_name }}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif


@endsection

@push('pre-purpose-script-page')
    <script src="{{ asset('assets/js/plugins/apexcharts.min.js') }}"></script>

    <script>
        $(document).on('click', '.assign_workorder', function() {

            $(".text_header").html("Assign Work order");

        });
    </script>

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
                    name: '{{ __('Order') }} ',
                    data: [50,30,45,20,40,30]
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
                    series: [74, 26],
                    colors: ["#3ec9d6", "#6fd943"],
                    labels: ["In progress", "Done"],
                    legend: {
                        show: false
                    }
                };
                var chart = new ApexCharts(document.querySelector("#total_work_order"), options);
                chart.render();
            })();

    </script>
@endpush

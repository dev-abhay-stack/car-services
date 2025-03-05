@extends('layouts.admin')

@section('page-title')
    {{ __('Work Order detail') }}
@endsection

@section('page-title')
    {{ $Workorder->name }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('opentask.index')}}">{{__('Work Order')}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{__('Work Order Complete Task Details')}}</li>
@endsection

@push('script-page')
<script>
    var scrollSpy = new bootstrap.ScrollSpy(document.body, {
        target: '#useradd-sidenav',
        offset: 300
    })
</script>

@endpush
@push('pre-purpose-script-page')


    <script src="{{ asset('assets/libs/dropzone/dist/dropzone-min.js') }}"></script>
    <script>
        @if (Auth::user()->type != 'Client')
            Dropzone.autoDiscover = false;
            myDropzone = new Dropzone("#dropzonewidget", {
            maxFiles: 20,
            maxFilesize: 20,
            parallelUploads: 1,
            filename: false,
            acceptedFiles: ".jpeg,.jpg,.png,.pdf,.doc,.txt,.docx",
            url: "{{ route('opentask.file.upload', $Workorder->id) }} ",
            success: function (file, response) {
            if (response.is_success) {
            dropzoneBtn(file, response);
            } else {
            myDropzone.removeFile(file);
            show_toastr('Error', response.error, 'error');
            }
            },
            error: function (file, response) {
            myDropzone.removeFile(file);
            if (response.error) {
            show_toastr('Error', response.error, 'error');
            } else {
            show_toastr('Error', response, 'error');
            }
            }
            });
            myDropzone.on("sending", function (file, xhr, formData) {
            formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
            formData.append("lead_id", {{ $Workorder->id }});
            });
        
        
            function dropzoneBtn(file, response) {
            var del = document.createElement('a');
            del.setAttribute('href', response.delete);
            del.setAttribute('class', "action-btn bg-danger ms-2 mx-3 mt-2 btn btn-sm align-items-center");
            del.setAttribute('data-toggle', "tooltip");
            del.setAttribute('data-original-title', "{{ __('Delete') }}");
            del.innerHTML = "<i class='ti ti-trash text-white'></i>";
        
            var download = document.createElement('a');
            download.setAttribute('href', response.download);
            download.setAttribute('class', "action-btn bg-info mt-2 btn btn-sm align-items-center");
            download.setAttribute('data-toggle', "tooltip");
            download.setAttribute('data-original-title', "{{ __('Download') }}");
            download.innerHTML = "<i class='ti ti-download text-white'></i>";
        
        
            del.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();
            if (confirm("Are you sure ?")) {
            var btn = $(this);
            $.ajax({
            url: btn.attr('href'),
            data: {
            _token: $('meta[name="csrf-token"]').attr('content')
            },
            type: 'DELETE',
            success: function (response) {
            if (response.is_success) {
            btn.closest('.dz-image-preview').remove();
            } else {
            show_toastr('Error', response.error, 'error');
            }
            },
            error: function (response) {
            response = response.responseJSON;
            if (response.is_success) {
            show_toastr('Error', response.error, 'error');
            } else {
            show_toastr('Error', response, 'error');
            }
            }
            })
            }
            });
        
            var html = document.createElement('div');
            html.appendChild(download);
            html.appendChild(del);
        
            file.previewTemplate.appendChild(html);
            }
        
            @foreach ($Workorder_file as $file)
                @if ($file)
                    var mockFile = {name: "{{ $file->image }}", size:
                    {{ \File::size(storage_path('workorder_files/' . $file->image)) }} };
        
                    var file_extension="{{ \File::extension(storage_path('workorder_files/' . $file->image)) }}";
                    if(file_extension=="png" || file_extension=="jpg" || file_extension=="jpeg")
                    {
                    myDropzone.emit("addedfile", mockFile);
                    myDropzone.emit("thumbnail", mockFile, "{{ asset(Storage::url('workorder_files/' . $file->image)) }}");
                    myDropzone.emit("complete", mockFile);
                    }
                    if(file_extension=="pdf")
                    {
                    myDropzone.emit("addedfile", mockFile);
                    myDropzone.emit("thumbnail", mockFile, "{{ asset('assets/img/icons/files/pdf.png') }}");
                    myDropzone.emit("complete", mockFile);
                    }
                    if(file_extension=="docx" || file_extension=="doc")
                    {
                    myDropzone.emit("addedfile", mockFile);
                    myDropzone.emit("thumbnail", mockFile, "{{ asset('assets/img/icons/files/doc.png') }}");
                    myDropzone.emit("complete", mockFile);
                    }
        
        
        
                    dropzoneBtn(mockFile, {download: "{{ route('opentask.file.download', $file->id) }}",delete:
                    "{{ route('opentask.file.delete', $file->id) }}"});
                @endif
            @endforeach
        @endif
    </script>

    <script>
        $('#work_status').on('change', function() {

            var workstatus = $('#work_status').val();
            var wosid = $('#wosid').val();
            $.ajax({
                type: "POST",
                url: "{{ route('wos.workstatus') }}",
                data: {
                    work_status: workstatus,
                    wos_id: wosid
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {

                }
            });
        });
    </script>

    <script src="{{ asset('assets/js/plugins/apexcharts.min.js') }}"></script>
    {{-- <script>
        var projectStatusOptions = {
            series: {!! json_encode($arrPartsper) !!},

            chart: {
                height: '270px',
                width: '500px',
                type: 'pie',
            },
            colors: ["#00B8D9", "#36B37E"],
            labels: {!! json_encode($arrPartsLabel) !!},

            plotOptions: {
                pie: {
                    dataLabels: {
                        offset: -5
                    }
                }
            },
            title: {
                text: ""
            },
            dataLabels: {},
            legend: {
                display: false
            },

        };
        var projectStatusChart = new ApexCharts(document.querySelector("#project-status-chart"), projectStatusOptions);
        projectStatusChart.render();
    </script> --}}
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
                    data: {!! json_encode($chartData['label']) !!}
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
            var chart = new ApexCharts(document.querySelector("#visitors-chart"), options);
            chart.render();
        })();
    </script>
    <script>
        (function () {
        var options = {
            chart: {
                height: 140,
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
            series: {!! json_encode($arrPartsper) !!},
            colors: [ '#FF3A6E', '#3ec9d6'],
            labels: {!! json_encode($arrPartsLabel) !!},
            legend: {
                show: false
            }
        };
        var chart = new ApexCharts(document.querySelector("#projects-chart"), options);
        chart.render();
        })();
    </script>
@endpush
@section('action-button')
<div class="row">
    <div class="col-12"> 
    @if ($Workorder->status == 1)
        <a href="#" class="btn btn-sm btn-primary btn-icon m-1 header_btns"
            data-url="{{ route('opentask.task.complete', ['task_id' => $Workorder->id]) }}" data-size="lg"
            data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="{{__('Create WOs')}}">
            <span class="btn-inner--icon"><i class="fa fa-check"></i> {{ __('Task Complete') }}</span>
        </a>
    @elseif($Workorder->status == 2)
        {!! Form::open(['method' => 'POST', 'route' => ['opentask.task.reopen', $Workorder->id]]) !!}
        <a href="#!" class="btn btn-sm btn-primary btn-icon m-1 show_confirm">
            <i class="ti ti-lock-open text-white"> {{ __('Reopen Task') }}</i>
        </a>
        {!! Form::close() !!}
    @endif

    @php
        $wosstatus = App\Models\WorkOrder::wosstatus();
    @endphp
    
    {!! Form::open(['method' => 'POST', 'class' => 'm-0']) !!}
    <input type="hidden" id="wosid" name="wosid" value="{{ $Workorder->id }}">
    <div class="form-group header_btns status_btns">
        <select name="priority" class="form-control select2" id="work_status">
            @foreach ($wosstatus as $wos_status)
                <option {{ $wos_status['work_status'] == $Workorder->work_status ? 'selected' : '' }}
                    value="{{ $wos_status['work_status'] }}">{{ $wos_status['work_status'] }}</option>
            @endforeach
        </select>
    </div>
    {!! Form::close() !!}
</div>
</div>
@endsection
<link rel="stylesheet" href="{{ asset('assets/libs/dropzone/dist/dropzone.css') }}">
@section('content')
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <div class="row">
                <div class="col-xl-3">
                    <div class="card sticky-top" style="top:30px">
                        <div class="list-group list-group-flush" id="useradd-sidenav">
                            <a href="#useradd-1" class="list-group-item list-group-item-action">{{ __('Overview') }}
                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <a href="#useradd-2" class="list-group-item list-group-item-action">{{ __('Report') }} <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#useradd-3" class="list-group-item list-group-item-action">{{ __('POs') }} <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#useradd-4" class="list-group-item list-group-item-action">{{ __('Parts') }} <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#useradd-5" class="list-group-item list-group-item-action">{{ __('Log Time') }} <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#useradd-6" class="list-group-item list-group-item-action">{{ __('Invoice') }} <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#useradd-7"
                                class="list-group-item list-group-item-action">{{ __('Document and Picture') }} <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#useradd-8" class="list-group-item list-group-item-action">{{ __('Comments') }} <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            

                        </div>
                    </div>
                </div>


                <div class="col-xl-9">
                    <div class="useradd-1">
                        <div class="row">
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5>{{ __('Assets') }}</h5>
                                        <div class="card_img">
                                            <a href="#" class="hover-translate-y-n3 ">

                                                <img src="{{ asset(Storage::url('Assets/thumbnail/' . $Assets_data->thumbnail)) }}"
                                                    alt="{{ $Assets_data->name }}" avatar="{{ $Assets_data->name }}">

                                            </a>
                                            <a href="#" title="{{ __('Locked') }}" class="img_title">
                                                {{ $Assets_data->name }}
                                            </a>
                                        </div>
                                        <div class="action-btn bg-warning ms-2">
                                            <a href="{{ route('asset.show', [$Assets_data->id]) }}"
                                                class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                data-bs-toggle="tooltip" data-bs-original-title="{{ _('View') }}">
                                                <i class="ti ti-eye text-white"></i>
                                            </a>
                                        </div>
                                        <div class="action-btn bg-info ms-2">
                                            <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                data-url="{{ route('wos.assetsedit', $Workorder->id) }}" data-size="lg"
                                                data-bs-whatever="{{ __('Edit Work Order') }}"> <span
                                                    class="text-white"> <i class="ti ti-edit"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-original-title="{{ __('Edit') }}"></i></span></a>
                                        </div>
                                        <div class="float-end">
                                            <span class="badge bg-primary p-2 px-3 rounded h6 text-white">
                                                <span class="">{{ __('Assets') }} </span>
                                            </span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5>{{ __('Details') }}</h5>
                                        <div class="row  mt-4">
                                            <div class="col-md-4 col-sm-6">
                                                <div class="d-flex align-items-start">

                                                    <div class="ms-2">
                                                        <h5 class="mb-0 text-dark">{{ __('WOs Name') }}</h5>
                                                        <p class="text-muted text-sm mb-0">{{ $Workorder->wo_name }}</p>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6 my-3 my-sm-0">
                                                <div class="d-flex align-items-start">

                                                    <div class="ms-2">
                                                        <h5 class="mb-0 text-dark">{{ __('Instructions') }}</h5>
                                                        <p class="text-muted text-sm mb-0">
                                                            {{ $Workorder->instructions }}</p>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <div class="d-flex align-items-start">

                                                    <div class="ms-2">
                                                        <h5 class="mb-0 ">{{ __('Due Date') }}</h5>
                                                        <p class="text-muted text-sm mb-0">{{ $Workorder->wo_name }}</p>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row  mt-4">
                                                <div class="col-md-4 col-sm-6">
                                                    <div class="d-flex align-items-start">
                                                        <div class="ms-2">
                                                            <h5 class="mb-0">{{ __('Time') }}</h5>
                                                            <p class="text-muted text-sm mb-0">{{ $Workorder->time }}
                                                            </p>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6">
                                                    <div class="d-flex align-items-start">
                                                        <div class="ms-2">
                                                            <h5 class="mb-0">{{ __('Assigned') }}</h5>
                                                            <p class="text-muted text-sm mb-0">
                                                                @if ($Sand_data)
                                                                    {{ implode(',', $Sand_data) }}
                                                                @else
                                                                    {{ app\Models\WorkOrder::assignTo($Workorder->created_by) }}
                                                                @endif
                                                            </p>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6">
                                                    <div class="d-flex align-items-start">
                                                        <div class="ms-2">
                                                            <h5 class="mb-0"> {{ __('Priority') }}</h5>
                                                            <p class="text-muted text-sm mb-0">
                                                                {{ $Workorder->priority }}</p>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-sm-6">
                                                <h5 class="mb-0"> {{ __('Tags') }}</h5>
                                            </div>
                                            <div class="col-sm-6">

                                                @foreach ($Workorder_tag as $workorder_tags)
                                                    <span
                                                        class="badge bg-primary p-2 px-3 rounded">{{ $workorder_tags }}</span>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="useradd-2">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="theme-avtar bg-primary">
                                                <i class="ti ti-users"></i>
                                            </div>
                                            <div class="ms-3">
                                                <small class="text-muted">{{ __('Recent Orders') }}</small>

                                            </div>
                                        </div>
                                        <div id="visitors-chart"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="float-end">
                                            <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Refferals"><i
                                                    class="ti ti-info-circle"></i></a>
                                        </div>
                                        <h5>{{ __('Purchase Parts') }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <div id="projects-chart"></div>
                                            </div>
                                            <div class="col-6">
                                                
                                                <div class="row mt-3">

                                                    <div class="col-12">
                                                        <span class="d-flex align-items-center mb-2">
                                                            <i class="f-10 lh-1 fas fa-circle text-warning"></i>
                                                            <h5 class="ms-2 mt-2">{{ $arrPartsper[0] }}%</h5>
                                                            <span class="ms-2 text-sm">{{ __('Not Purchased') }}</span>
                                                        </span>
                                                    </div>
                                                    <div class="col-12">
                                                        <span class="d-flex align-items-center mb-2">
                                                            <i class="f-10 lh-1 fas fa-circle text-info"></i>
                                                            <h5 class="ms-2 mt-2">{{ $arrPartsper[1] }}%</h5>
                                                            <span class="ms-2 text-sm">{{ __('Purchased') }}</span>
                                                        </span>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="useradd-3">
                        <div class="card">
                            <div class="card-header">
                                <div class="float-end">
                                    @can('create pos')
                                        <p class="text-muted d-none d-sm-flex align-items-center mb-0">
                                            <a href="{{ route('pos.create', ['wo_id' => $Workorder->id]) }}"
                                                class="btn btn-sm btn-primary btn-icon m-1"
                                                data-bs-whatever="{{ __('Create New Milestone') }}"> <span
                                                    class="text-white">
                                                    <i class="ti ti-plus text-white" data-bs-toggle="tooltip"
                                                        data-bs-original-title="{{ __('Create') }}"></i></span>
                                            </a>
                                        </p>
                                    @endcan
                                </div>
                                <h5 class="mb-0">{{ __('POs') }}</h5>
                            </div>
                            <div class="card-body">
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
                                            @foreach ($wo_pos as $invoice)
                                                <tr>
                                                    <td>{{ $invoice->vendor_name }}</td>
                                                    <td>{{ $invoice->user_name }}</td>
                                                    <td>{{ $invoice->pos_date }}</td>

                                                    <td>{{ $invoice->delivery_date }}</td>

                                                    <td class="Action" style="width: 10%">
                                                        <span>
                                                            <div class="action-btn bg-info ms-2">
                                                                <a href="{{ route('pos.edit', \Crypt::encrypt($invoice->id)) }}"
                                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                                    data-bs-toggle="tooltip"
                                                                    data-bs-original-title="{{ __('Edit') }}">
                                                                    <i class="ti ti-edit text-white"></i>
                                                                </a>
                                                            </div>
                                                            <div class="action-btn bg-danger ms-2">
                                                                {!! Form::open(['method' => 'DELETE', 'class' => 'm-0', 'route' => ['pos.destroy', $invoice->id]]) !!}
                                                                <a href="#!"
                                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm ">
                                                                    <i class="ti ti-trash text-white"
                                                                        data-bs-toggle="tooltip"
                                                                        data-bs-original-title="{{ __('Delete') }}"></i>
                                                                </a>
                                                                {!! Form::close() !!}
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

                    <div class="useradd-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="float-end">
                                    @can('create parts')
                                        <p class="text-muted d-none d-sm-flex align-items-center mb-0">
                                            <a href="#"
                                                data-url="{{ route('parts.associate.create', ['open_task', $Workorder->id]) }}"
                                                data-bs-toggle="modal" class="btn btn-sm btn-primary btn-icon m-1"
                                                data-bs-target="#exampleoverModal"
                                                data-bs-whatever="{{ __('Associate Parts') }}"> <span
                                                    class="text-white">
                                                    <i class="ti ti-plus text-white" data-bs-toggle="tooltip"
                                                        data-bs-original-title="{{ __('Create') }}"></i></span>
                                            </a>
                                        </p>
                                    @endcan
                                </div>
                                <h5 class="mb-0">{{ __('Parts') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="pc-dt-simple">
                                        <thead>
                                            <tr>
                                                <th>{{ __('Parts Thumbnail') }}</th>
                                                <th>{{ __('Name') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($parts as $parts_val)
                                                <tr>
                                                    @php
                                                        $thumbnail = !empty($parts_val->thumbnail) ? 'Parts/thumbnail/' . $parts_val->thumbnail : 'avatar/placeholder.jpg';
                                                    @endphp
                                                    <td width="100">
                                                        <div><img src="{{ asset(Storage::url($thumbnail)) }}"
                                                                class="img-fluid" width="70"></div>
                                                    </td>
                                                    <td>{{ $parts_val->name }}</td>
                                                    <td class="action" style="width: 10%">
                                                        <span>
                                                            <div class="action-btn bg-info ms-2">
                                                                <a href="{{ route('parts.show', [$parts_val->id]) }}"
                                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center">
                                                                    <i class="ti ti-eye text-white"></i>
                                                                </a>
                                                            </div>
                                                            <div class="action-btn bg-danger ms-2">
                                                                {!! Form::open(['method' => 'DELETE', 'route' => ['parts.associate_remove', 'open_task', $parts_val->id] ,'class' => 'm-0']) !!}
                                                                {!! Form::hidden('open_task_id', $Workorder->id) !!}
                                                                <a href="#!"
                                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm ">
                                                                    <i class="ti ti-trash text-white"></i>
                                                                </a>
                                                                {!! Form::close() !!}
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

                    <div class="useradd-5">
                        <div class="card">
                            <div class="card-header">
                                <div class="float-end">
                                    @can('create logtime')
                                        <p class="text-muted d-none d-sm-flex align-items-center mb-0">
                                            <a href="#"
                                                data-url="{{ route('woslogtime.create', ['wo_id' => $Workorder->id]) }}"
                                                data-bs-toggle="modal" class="btn btn-sm btn-primary btn-icon m-1"
                                                data-bs-target="#exampleoverModal"
                                                data-bs-whatever="{{ __('Create Log Time') }}"> <span
                                                    class="text-white">
                                                    <i class="ti ti-plus text-white" data-bs-toggle="tooltip"
                                                        data-bs-original-title="{{ __('Create') }}"></i></span>
                                            </a>
                                        </p>
                                    @endcan
                                </div>
                                <h5 class="mb-0">{{ __('Log Time') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="pc-dt-simple">
                                        <thead class="d-none">
                                            <tr>
                                                <th>{{ __('Time') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($woslogtime as $woslogtime_val)
                                                <tr>
                                                    <td style="white-space: inherit">

                                                        <a href="#"
                                                            data-url="{{ route('woslogtime.edit', $woslogtime_val->wos_lt) }}"
                                                            data-bs-target="#exampleoverModal" data-bs-toggle="modal"
                                                            data-bs-original-title="{{ __('View') }}"
                                                            data-bs-whatever="{{ __('Edit Log Time') }}">

                                                            <i class="far fa-clock"></i>
                                                            {{ $woslogtime_val->hours }} {{ __('hr') }}
                                                            {{ $woslogtime_val->minute }} {{ __('min') }} <span
                                                                style="color: black">{{ __('by') }}</span>
                                                            {{ $woslogtime_val->name }}
                                                            {{ date('Y-m-d H:i A', strtotime($woslogtime_val->created_at)) }}
                                                            - {{ $woslogtime_val->description }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <span>
                                                            @can('delete logtime')
                                                                <div class="action-btn bg-danger ms-2">
                                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['woslogtime.destroy', $woslogtime_val->wos_lt] , 'class' => 'm-0']) !!}
                                                                    <a href="#!"
                                                                        class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm">
                                                                        <i class="ti ti-trash text-white"></i>
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

                    <div class="useradd-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="float-end">
                                    @can('create parts')
                                        <p class="text-muted d-none d-sm-flex align-items-center mb-0">
                                            <a href="#"
                                                data-url="{{ route('wosinvoice.create', ['wo_id' => $Workorder->id]) }}"
                                                data-bs-toggle="modal" class="btn btn-sm btn-primary btn-icon m-1"
                                                data-bs-target="#exampleoverModal"
                                                data-bs-whatever="{{ __('Create Invoice') }}"> <span
                                                    class="text-white">
                                                    <i class="ti ti-plus text-white" data-bs-toggle="tooltip"
                                                        data-bs-original-title="{{ __('Create') }}"></i></span>
                                            </a>
                                        </p>
                                    @endcan
                                </div>
                                <h5 class="mb-0">{{ __('Invoice') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="pc-dt-simple">
                                        <thead>
                                            <tr>
                                                <th>{{ __('Invoice Cost') }}</th>
                                                <th>{{ __('Description') }}</th>
                                                <th>{{ __('Action') }}</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($wosinvoice as $wosinvoice_val)
                                                <tr>
                                                    <td style="width: 10%">
                                                        <a>{{ $wosinvoice_val->invoice_cost }}</a>
                                                    </td>
                                                    <td style="white-space: inherit">
                                                        <a>{{ $wosinvoice_val->description }}</a>
                                                    </td>

                                                    <td class="action" style="width: 10%">
                                                        <div class="action-btn bg-warning ms-2">
                                                            <a href="{{ asset(Storage::url('wos_invoice/' . $wosinvoice_val->invoice_file)) }}"
                                                                class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                                download="workorder invoice">
                                                                <i class="ti ti-download text-white"></i>
                                                            </a>
                                                        </div>

                                                        <div class="action-btn bg-info ms-2">
                                                            <a href="#"
                                                                data-url="{{ route('wosinvoice.edit', $wosinvoice_val->id) }}"
                                                                data-bs-toggle="modal" data-bs-target="#exampleoverModal"
                                                                data-bs-whatever="{{ __('Edit Invoice') }}"
                                                                class="mx-3 btn btn-sm d-inline-flex align-items-center">
                                                                <i class="ti ti-edit text-white"></i>
                                                            </a>
                                                        </div>

                                                        <div class="action-btn bg-danger ms-2">
                                                            {!! Form::open(['method' => 'DELETE', 'route' => ['wosinvoice.destroy', $wosinvoice_val->id] , 'class' => 'm-0']) !!}
                                                            <a href="#!"
                                                                class="mx-3 btn btn-sm  align-items-center show_confirm ">
                                                                <i class="ti ti-trash text-white" data-bs-toggle="tooltip"
                                                                    data-bs-original-title="{{ __('Delete') }}"></i>
                                                            </a>
                                                            {!! Form::close() !!}
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

                    <div class="useradd-7">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">{{ __('Documents and Picture') }}</h5>
                            </div>
                            <div class="col-md-12">
                                <div class="card height-450">
                                    <div class="card-body bg-none top-5-scroll responsive_padding">
                                        <div class="col-md-12 dropzone browse-file" id="dropzonewidget"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="useradd-8">
                        <div class="card">
                            <div class="card-header">
                                <div class="float-end">
                                    @can('create parts')
                                        <p class="text-muted d-none d-sm-flex align-items-center mb-0">
                                            <a href="#"
                                                data-url="{{ route('woscomment.create', ['wo_id' => $Workorder->id]) }}"
                                                data-bs-toggle="modal" class="btn btn-sm btn-primary btn-icon m-1"
                                                data-bs-target="#exampleoverModal"
                                                data-bs-whatever="{{ __('Create Comment') }}"> <span
                                                    class="text-white">
                                                    <i class="ti ti-plus text-white" data-bs-toggle="tooltip"
                                                        data-bs-original-title="{{ __('Create') }}"></i></span>
                                            </a>
                                        </p>
                                    @endcan
                                </div>
                                <h5 class="mb-0"> {{ __('Comment') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="pc-dt-simple">
                                        <thead>
                                            <tr>
                                                <th>{{ __('Image') }}</th>
                                                <th> {{ __('Description') }}</th>
                                                <th> {{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($woscomment as $woscomment_val)
                                                <tr>

                                                    <a href="#">
                                                        <div class="comment_section">
                                                            <td>
                                                                <span class="arrow"></span>
                                                                @php
                                                                    $file = App\Models\WosCommentImage::getFile($woscomment_val->id);
                                                                @endphp
                                                                @if ($file)
                                                                    <div>
                                                                        @foreach ($file as $file)
                                                                            @php
                                                                                $image = !empty($file->file) ? 'wos_comment/' . $file->file : 'avatar/placeholder.jpg';
                                                                            @endphp
                                                                            <img src="{{ asset(Storage::url($image)) }}"
                                                                                class="img-fluid" width="70">
                                                                        @endforeach
                                                                    </div>
                                                                @endif
                                                            </td>
                                                            <td style="white-space: inherit"> 
                                                                <p class="">
                                                                    {{ $woscomment_val->description }}
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <div class="action-btn bg-danger ms-2">
                                                                    {!! Form::open(['method' => 'DELETE', 'class' => 'm-0','route' => ['woscomment.destroy', $woscomment_val->id]]) !!}
                                                                    <a href="#!"
                                                                        class="mx-3 btn btn-sm  align-items-center show_confirm ">
                                                                        <i class="ti ti-trash text-white"
                                                                            data-bs-toggle="tooltip"
                                                                            data-bs-original-title="{{ __('Delete') }}"></i>
                                                                    </a>
                                                                    {!! Form::close() !!}
                                                                </div>
                                                            </td>
                                                        </div>
                                                    </a>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

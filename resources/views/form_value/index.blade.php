@extends('layouts.main')
@section('title', 'Submitted Forms')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Submitted Forms') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Submitted Forms') }}</div>
                </div>
            </div>
            <div class="section-body filter">
                <div class="row">
                    <div class="col-lg-6  custom_left"></div>
                    <div class="col-lg-6  custom_right">
                        @can('manage-submitted-form')
                            <input type="text"
                                class="form-control form-control-sm w-auto d-inline custom_padding form-control-light"
                                id="duration1" name="duration" value="{{ __('Select Date Range') }}" />
                            <input type="hidden" name="start_date1" id="start_date1" />
                            <input type="hidden" name="due_date1" id="end_date1" />
                            <button class="btn btn-primary btn-lg ml-2" id="filter">{{ __('Filter') }}</button>
                        @endcan
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive py-4">
                                            {{ $dataTable->table(['width' => '100%']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/daterangepicker/daterangepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/select2/dist/css/select2.min.css') }}">
    @include('layouts.includes.datatable_css')
@endpush
@push('script')
    <script type="text/javascript" src="{{ asset('vendor/daterangepicker/daterangepicker.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/dist/js/select2.full.min.js') }}"></script>
    @include('layouts.includes.datatable_js')
    <script>
        $(document).ready(function() {
            $('.custom_select').select2();
            $(document).on("click", "#filter", function() {
                getData();
            });
            window.LaravelDataTables = null;

            function getData() {
                if (window.LaravelDataTables == null) {
                    window.LaravelDataTables = $("#forms-table").DataTable({
                            "serverSide": true,
                            "processing": true,
                            "ajax": {
                                "url": "{{ route('formvalues.index') }}",
                                "type": "GET",
                                "data": function(data) {
                                    for (var i = 0, len = data.columns.length; i < len; i++) {
                                        if (!data.columns[i].search.value) delete data.columns[i].search;
                                        if (data.columns[i].searchable === true) delete data.columns[i]
                                            .searchable;
                                        if (data.columns[i].orderable === true) delete data.columns[i]
                                            .orderable;
                                        if (data.columns[i].data === data.columns[i].name) delete data
                                            .columns[i]
                                            .name;
                                    }
                                    delete data.search.regex;
                                    data.form = $("#form").val();
                                    data.start_date = $("#start_date1").val();
                                    data.end_date = $("#end_date1").val();
                                }
                            },
                            "columns": [{
                                "name": "id",
                                "data": "DT_RowIndex",
                                "title": "No",
                                "orderable": true,
                                "searchable": true
                            }, {
                                "data": "title",
                                "name": "forms.title",
                                "title": "Title",
                                "orderable": true,
                                "searchable": true
                            }, {
                                "data": "user",
                                "name": "user",
                                "title": "User",
                                "orderable": true,
                                "searchable": true
                            }, {
                                "data": "created_at",
                                "name": "created_at",
                                "title": "Created At",
                                "orderable": true,
                                "searchable": true
                            }, {
                                "data": "action",
                                "name": "action",
                                "title": "Action",
                                "orderable": false,
                                "searchable": false,
                                "className": "text-right"
                            }],
                            "dom": "Bfrtip",
                            "order": [
                                [3, "desc"]
                            ],
                            "language": {
                                "paginate": {
                                    "next": "<i class=\"fas fa-angle-right\"><\/i>",
                                    "previous": "<i class=\"fas fa-angle-left\"><\/i>"
                                }
                            },
                            "language": {
                                "buttons": {
                                    "export": "{{ __('Export') }}",
                                    "print": "{{ __('Print') }}",
                                    "reset": "{{ __('Reset') }}",
                                    "reload": "{{ __('Reload') }}",
                                    "excel": "{{ __('Excel') }}",
                                    "csv": "{{ __('CSV') }}",
                                    "pageLength": "{{ __('Show %d rows') }}"
                                }
                            },
                            "dom": "\n<'row'<'col-sm-12'><'col-sm-9 'B><'col-sm-3'f>>\n<'row'<'col-sm-12'tr>>\n<'row mt-3'<'col-sm-5'i><'col-sm-7'p>>\n",
                            "buttons": [{
                                "extend": "export",
                                "className": "btn btn-primary btn-sm no-corner"
                            }, {
                                "extend": "print",
                                "className": "btn btn-primary btn-sm no-corner"
                            }, {
                                "extend": "reset",
                                "className": "btn btn-primary btn-sm no-corner"
                            }, {
                                "extend": "reload",
                                "className": "btn btn-primary btn-sm no-corner"
                            }, {
                                "extend": "pageLength",
                                "className": "btn btn-danger btn-sm no-corner"
                            }],
                            "scrollX": true
                        });
                } else {
                    window.LaravelDataTables.ajax.reload();
                }
            }
            getData();
            $(function() {
                function cb(start, end) {
                    $("#duration1").val(start.format('MMM D, YY hh:mm A') + ' - ' + end.format(
                        'MMM D, YY hh:mm A'));
                    $('input[name="start_date1"]').val(start.format('YYYY-MM-DD HH:mm:ss'));
                    $('input[name="due_date1"]').val(end.format('YYYY-MM-DD HH:mm:ss'));
                }
                $('#duration1').daterangepicker({
                    timePicker: true,
                    autoUpdateInput: false,
                    locale: {
                        format: 'MMM D, YY hh:mm A',
                        applyLabel: "{{ __('Apply') }}",
                        cancelLabel: "{{ __('Cancel') }}",
                        fromLabel: "{{ __('From') }}",
                        toLabel: "{{ __('To') }}",
                        daysOfWeek: [
                            "{{ __('Sun') }}",
                            "{{ __('Mon') }}",
                            "{{ __('Tue') }}",
                            "{{ __('Wed') }}",
                            "{{ __('Thu') }}",
                            "{{ __('Fri') }}",
                            "{{ __('Sat') }}"
                        ],
                        monthNames: [
                            "{{ __('January') }}",
                            "{{ __('February') }}",
                            "{{ __('March') }}",
                            "{{ __('April') }}",
                            "{{ __('May') }}",
                            "{{ __('June') }}",
                            "{{ __('July') }}",
                            "{{ __('August') }}",
                            "{{ __('September') }}",
                            "{{ __('October') }}",
                            "{{ __('November') }}",
                            "{{ __('December') }}"
                        ],
                    }
                }, cb);
            });
        });
    </script>
@endpush

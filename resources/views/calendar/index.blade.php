@extends('layouts.admin')

@section('page-title')
    {{ __('Calendar') }}

@endsection
@push('css-page')
    <style>
        .fc-event-container {
            display: block !important;
        }

    </style>
@endpush
@section('action-button')
@endsection

@section('content')

<div class="row">
    <!-- [ sample-page ] start -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5>{{ __('Calendar') }}</h5>
            </div>
            <div class="card-body">
                <div id='calendar' class='calendar'></div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">{{ __('Current Month Events') }}</h4>
                <ul class="event-cards list-group list-group-flush mt-3 w-100">
                    @foreach ($events_current_month as $event)
                    <li class="list-group-item card mb-3">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-auto mb-3 mb-sm-0">
                                <div class="d-flex align-items-center">
                                  
                                    <div class="ms-3">
                                        <h6 class="m-0">{{ $event->wo_name }}</h6>
                                        <small class="text-muted">{{ $event->date }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <a href="#" class="badge bg-primary p-2 px-3 rounded">{{ $event->priority}}</a>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>


    <!-- [ sample-page ] end -->
</div>

@endsection

@push('script-page')
<script src="{{ asset('assets/js/plugins/main.min.js') }}"></script>
  
    <script type="text/javascript">

        (function () {
            var etitle;
            var etype;
            var etypeclass;
            var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                themeSystem: 'bootstrap',
                initialDate: '{{ $transdate }}',
                slotDuration: '00:10:00',
                navLinks: true,
                droppable: true,
                selectable: true,
                selectMirror: true,
                editable: true,
                dayMaxEvents: true,
                handleWindowResize: true,
                events:{!! json_encode($arrEvents) !!},
            });
            calendar.render();
        })();
    </script>

@endpush

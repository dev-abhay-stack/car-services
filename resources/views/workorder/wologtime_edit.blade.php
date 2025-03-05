
    {{ Form::model($woslogtime, ['route' => ['woslogtime.update', $woslogtime->id], 'method' => 'PUT']) }}
    <input type="hidden" name="wo_id" value="{{ $woslogtime->wo_id }}">
    <div class="row">
        @if ($woslogtime->created_by == Auth::user()->id)
            <div class="col-md-6 form-group">
                {{ Form::label('hours', __('Hours'),['class' => 'col-form-label']) }}
                {{ Form::number('hours', null, ['class' => 'form-control', 'placeholder' => __('Enter Hours'), 'required' => 'required']) }}
            </div>
            <div class="col-md-6 form-group">
                {{ Form::label('minute', __('Minute'),['class' => 'col-form-label']) }}
                {{ Form::number('minute', null, ['class' => 'form-control', 'placeholder' => __('Enter Minute'), 'required' => 'required']) }}
            </div>
            @if (Auth::user()->user_type == 'company')
                <div class="col-md-6 form-group">
                    {{ Form::label('date', __('Date'),['class' => 'col-form-label']) }}
                    {{ Form::date('date', null, ['class' => 'form-control', 'placeholder' => __('Enter Date'), 'required' => 'required']) }}
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('user_id', __('User'),['class' => 'col-form-label']) }}
                        {{ Form::select('user_id', $users, null, ['class' => 'form-control select2', 'required' => 'required']) }}
                    </div>
                </div>
            @endif
            @if (Auth::user()->user_type == 'employee')
                <div class="col-md-12 form-group">
                    {{ Form::label('date', __('Date'),['class' => 'col-form-label']) }}
                    {{ Form::date('date', null, ['class' => 'form-control', 'placeholder' => __('Enter Date'), 'required' => 'required']) }}
                </div>
            @endif
            <div class="col-md-12 form-group">
                {{ Form::label('description', __('Description'),['class' => 'col-form-label']) }}
                {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => __('Enter Description'), 'required' => 'required']) }}
            </div>

            <div class="modal-footer pr-0">
                <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
                {{ Form::submit(__('Update'), ['class' => 'btn  btn-primary']) }}
            </div>
        @else
            <div class="col-md-6 form-group">
                {{ Form::label('hours', __('Hours'),['class' => 'col-form-label']) }}
                {{ Form::number('hours', null, ['class' => 'form-control', 'placeholder' => __('Enter Hours'), 'required' => 'required', 'disabled']) }}
            </div>
            <div class="col-md-6 form-group">
                {{ Form::label('minute', __('Minute'),['class' => 'col-form-label']) }}
                {{ Form::number('minute', null, ['class' => 'form-control', 'placeholder' => __('Enter Minute'), 'required' => 'required', 'disabled']) }}
            </div>
            <div class="col-md-12 form-group">
                {{ Form::label('date', __('Date'),['class' => 'col-form-label']) }}
                {{ Form::date('date', null, ['class' => 'form-control', 'placeholder' => __('Enter Date'), 'required' => 'required', 'disabled']) }}
            </div>

            <div class="col-md-12 form-group">
                {{ Form::label('description', __('Description'),['class' => 'col-form-label']) }}
                {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => __('Enter Description'), 'required' => 'required', 'disabled']) }}
            </div>
        @endif
    </div>
    {{ Form::close() }}



    {{ Form::model($partslogtime, ['route' => ['partslogtime.update', $partslogtime->id], 'method' => 'PUT']) }}
    <input type="hidden" name="parts_id" value="{{ $partslogtime->parts_id }}">
    <div class="row">
        @if (Auth::user()->id == $partslogtime->created_by)

            <div class="col-md-12 form-group">
                {{ Form::label('date', __('Date'),['class' => 'col-form-label']) }}
                {{ Form::date('date', null, ['class' => 'form-control', 'placeholder' => __('Enter Date'), 'required' => 'required']) }}
            </div>

            <div class="col-md-12 form-group">
                {{ Form::label('description', __('Description'),['class' => 'col-form-label']) }}
                {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => __('Enter Description'), 'required' => 'required']) }}
            </div>

            <div class="modal-footer">
                <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
                {{Form::submit(__('Update'),array('class'=>'btn btn-primary'))}}
            </div>
        @else
            <div class="col-md-12 form-group">
                {{ Form::label('date', __('Date'),['class' => 'col-form-label']) }}
                {{ Form::date('date', null, ['class' => 'form-control', 'placeholder' => __('Enter Date'), 'required' => 'required', 'disabled']) }}
            </div>

            <div class="col-md-12 form-group">
                {{ Form::label('description', __('Description'),['class' => 'col-form-label']) }}
                {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => __('Enter Description'), 'required' => 'required', 'disabled']) }}
            </div>

            <div class="modal-footer">
                <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
                {{Form::submit(__('Update'),array('class'=>'btn btn-primary'))}}
            </div>
        @endif
    </div>
    {{ Form::close() }}

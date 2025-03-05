
    {{Form::open(array('route'=>array('pmslogtime.store'),'method'=>'post'))}}

    <input type="hidden" name="pms_id" value="{{$pms_id}}">
    <div class="row">
        <div class="col-md-6 form-group">
            {{Form::label('hours',__('Hours'),['class' => 'col-form-label']) }}
            {{Form::number('hours',null,array('class'=>'form-control','placeholder'=>__('Enter Hours'),'required'=>'required'))}}
        </div>
        <div class="col-md-6 form-group">
            {{Form::label('minute',__('Minute'),['class' => 'col-form-label']) }}
            {{Form::number('minute',null,array('class'=>'form-control','placeholder'=>__('Enter Minute'),'required'=>'required'))}}
        </div>
        <div class="col-md-12 form-group">
            {{Form::label('date',__('Date'),['class' => 'col-form-label']) }}
            {{Form::date('date',null,array('class'=>'form-control','placeholder'=>__('Enter Date'),'required'=>'required'))}}
        </div>
        <div class="col-md-12 form-group">
            {{Form::label('description',__('Description'),['class' => 'col-form-label']) }}
            {{Form::textarea('description',null,array('class'=>'form-control','placeholder'=>__('Enter Description'),'required'=>'required'))}}
        </div>

        <div class="modal-footer pr-0">
            <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
            {{ Form::submit(__('Create'), ['class' => 'btn  btn-primary']) }}
        </div>
    </div>
    {{Form::close()}}



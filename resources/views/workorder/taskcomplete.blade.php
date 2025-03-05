<link rel="stylesheet" href="{{asset('assets/libs/dropzone/dist/dropzone.css')}}">

        {{ Form::open(array('route' => ['opentask.task.updatecomplete'], 'id' => 'assets_store', 'enctype' => 'multipart/form-data')) }}
        <div class="row">
            <input name="_token" value="{{ csrf_token() }}" type="hidden">
            <input type="hidden" name="task_id" value="{{$task_id}}">

            <div class="col-md-6 form-group">
                {{Form::label('hours',__('Hours'),['class'=>'col-form-label']) }}
                {{Form::number('hours',null,array('class'=>'form-control','placeholder'=>__('Enter Hours'),'required'=>'required'))}}
            </div>

            <div class="col-md-6 form-group">
                {{Form::label('minute',__('Minute'),['class'=>'col-form-label']) }}
                {{Form::number('minute',null,array('class'=>'form-control','placeholder'=>__('Enter Minute'),'required'=>'required'))}}
            </div>
        </div>

        <div class="modal-footer pr-0">
            <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
            {{ Form::submit(__('Create'), ['class' => 'btn  btn-primary']) }}
        </div>
        {{ Form::close() }}

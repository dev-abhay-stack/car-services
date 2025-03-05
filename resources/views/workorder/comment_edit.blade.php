<link rel="stylesheet" href="{{asset('assets/libs/dropzone/dist/dropzone.css')}}">
    {{Form::model($workorder,array('route' => array('woscomment.update', $workorder->id), 'method' => 'PUT')) }}

        <div class="row">
            <input name="_token" value="{{ csrf_token() }}" type="hidden">
            <input type="hidden" name="wo_id" value="{{$wo_id}}">


            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('description', __('Description'),['class' => 'col-form-label']) }}
                    {{ Form::textarea('description', null, ['class' => 'form-control','required'=>'required']) }}
                </div>
            </div>

            <div class="col-md-6">
                {{ Form::label('file', __('Attach File'),['class' => 'col-form-label']) }}
                <div class="choose-file">
                    <label for="Attach File">
                        <input type="file" class="form-control" name="file[]" id="file" data-filename="file" accept="image/*,.jpeg,.jpg,.png" required="required">
                    </label>
                </div>
            </div>

        </div>

        <div class="modal-footer pr-0">
            <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
            {{ Form::submit(__('Update'), ['class' => 'btn  btn-primary']) }}
        </div>
        {{ Form::close() }}
    </div>
</div>

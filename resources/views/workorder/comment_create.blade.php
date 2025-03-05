
        {{ Form::open(array('route' => ['woscomment.store'], 'id' => 'assets_store', 'enctype' => 'multipart/form-data')) }}
        <div class="row">
            <input name="_token" value="{{ csrf_token() }}" type="hidden">
            <input type="hidden" name="wo_id" value="{{$wo_id}}">
            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('description', __('Description'),['class' => 'col-form-label']) }}
                    {{ Form::textarea('description', null, ['class' => 'form-control','required'=>'required']) }}
                </div>
            </div>


            <div class="col-md-12">
                {{ Form::label('file', __('Attach File'),['class' => 'col-form-label']) }}
                <div class="choose-file">
                    <label for="Attach File">
                        <div class="file">{{__('Choose file here')}}</div>
                        <input type="file" class="form-control" name="file[]" id="file" data-filename="file" accept="image/*,.jpeg,.jpg,.png"  multiple>
                    </label>
                </div>
            </div>
        </div>

        <div class="modal-footer pr-0">
            <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
            {{ Form::submit(__('Create'), ['class' => 'btn  btn-primary']) }}
        </div>
        {{ Form::close() }}


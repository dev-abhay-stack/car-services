<link rel="stylesheet" href="{{asset('assets/libs/dropzone/dist/dropzone.css')}}">

        {{ Form::open(array('route' => ['wos.assetsupdate'])) }}
            <div class="row">
                <input name="wo_id" value="{{ $id }}" type="hidden">

                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('assets_id', __('Assets'),['class' => 'col-form-label']) }}
                        {{ Form::select('assets_id',$assets,$id, ['class' => 'form-control select2','required'=>'required']) }}
                    </div>
                </div>
            </div>
            <div class="modal-footer pr-0">
                <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
                {{ Form::submit(__('Create'), ['class' => 'btn  btn-primary']) }}
            </div>
        {{ Form::close() }}



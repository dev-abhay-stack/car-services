
    {{ Form::open(array('route' => array('opentask.importcreate'),'method'=>'post', 'enctype' => "multipart/form-data")) }}
    <div class="row">
        <div class="col-md-12 mb-6">
            {{Form::label('file',__('Download sample customer CSV file'),['class'=>'col-form-label'])}}
            <a href="{{asset(Storage::url('uploads/sample')).'/Work_Order.csv'}}" class="btn btn-xs btn-white btn-icon-only width-auto">
                <i class="fa fa-download"></i> {{__('Download')}}
            </a>
        </div>
        <div class="col-md-12">
            {{Form::label('file',__('Select CSV File'),['class'=>'col-form-label'])}}
            <div class="choose-file form-group">
                <label for="file" class="form-control-label">
                    <div>{{__('Choose file here')}}</div>
                    <input type="file" class="form-control" name="file" id="file" data-filename="upload_file" required>
                </label>
                <p class="upload_file"></p>
            </div>
        </div>
        <div class="modal-footer pr-0">
            <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
            {{ Form::submit(__('Upload'), ['class' => 'btn  btn-primary']) }}
        </div>
    </div>
    {{ Form::close() }}

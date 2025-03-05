{{ Form::open(['route' => ['videos.store'], 'enctype' => 'multipart/form-data']) }}
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('title', __('Title'), ['class' => 'col-form-label']) }}
            {{ Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) }}
            <input name="_token" value="{{ csrf_token() }}" type="hidden">
          <!--   <input type="hidden" name="assets_id" value="{{ $assets_id }}">
            <input type="hidden" name="pms_id" value="{{ $pms_id }}">
            <input type="hidden" name="vendor_id" value="{{ $vendor_id }}">
            <input type="hidden" name="open_task_id" value="{{ $open_task_id }}"> -->
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('video', __('Video File'), ['class' => 'col-form-label']) }}
            <div class="choose-file">
                <label for="Asset Thumbnail">
                    <input type="file" class="form-control" name="video" required="required">
                </label>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('duration', __('Duration'), ['class' => 'col-form-label']) }}
            {{ Form::number('duration', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="form-group">
        <label class="col-form-label" for="status">Status</label>
        <select name="status" class="form-control" required>
            <option value="draft">Draft</option>
            <option value="published">Published</option>
            <option value="archived">Archived</option>
        </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
        <label class="col-form-label" for="status">Category</label>
         <select name="category" class="form-control" required>
                <option value="tutorial">Tutorial</option>
                <option value="entertainment">Entertainment</option>
                <option value="education">Education</option>
                <option value="music">Music</option>
            </select>
        </div>
    </div>
    
</div>

<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
    {{ Form::submit(__('Create'), ['class' => 'btn  btn-primary']) }}
</div>
{{ Form::close() }}

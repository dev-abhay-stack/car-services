{{ Form::open(['route' => ['parts.store'], 'enctype' => 'multipart/form-data']) }}
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('name', __('Name'), ['class' => 'col-form-label']) }}
            {{ Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) }}
            <input name="_token" value="{{ csrf_token() }}" type="hidden">
            <input type="hidden" name="assets_id" value="{{ $assets_id }}">
            <input type="hidden" name="pms_id" value="{{ $pms_id }}">
            <input type="hidden" name="vendor_id" value="{{ $vendor_id }}">
            <input type="hidden" name="open_task_id" value="{{ $open_task_id }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('thumbnail', __('Asset Thumbnail'), ['class' => 'col-form-label']) }}
            <div class="choose-file">
                <label for="Asset Thumbnail">
                    <input type="file" class="form-control" name="thumbnail" id="thumbnail" data-filename="thumbnail"
                        accept="image/*,.jpeg,.jpg,.png" required="required">
                </label>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('number', __('Part Number'), ['class' => 'col-form-label']) }}
            {{ Form::text('number', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('quantity', __('Part Quantity'), ['class' => 'col-form-label']) }}
            {{ Form::number('quantity', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('price', __('Price'), ['class' => 'col-form-label']) }}
            {{ Form::number('price', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('category', __('Category'), ['class' => 'col-form-label']) }}
            {{ Form::text('category', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
    </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
    {{ Form::submit(__('Create'), ['class' => 'btn  btn-primary']) }}
</div>
{{ Form::close() }}

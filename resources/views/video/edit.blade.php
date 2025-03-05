
        {{ Form::open(array('route' => array('parts.update', $parts->id) ,'method'=>'PUT' , 'enctype' => 'multipart/form-data')) }}
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('name', __('Name'),['class' => 'col-form-label']) }}
                    {{ Form::text('name', $parts->name, ['class' => 'form-control','required'=>'required']) }}
                    <input name="_token" value="{{ csrf_token() }}" type="hidden">
                </div>
            </div>
            <div class="col-md-6">
                {{ Form::label('thumbnail', __('Asset Thumbnail'),['class' => 'col-form-label']) }}
                <div class="choose-file">
                    <label for="Asset Thumbnail">   
                        <input type="file" class="form-control" name="thumbnail" id="thumbnail" data-filename="thumbnail" accept="image/*,.jpeg,.jpg,.png">
                    </label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('number', __('Part Number'),['class' => 'col-form-label']) }}
                    {{ Form::text('number', $parts->number, ['class' => 'form-control','required'=>'required']) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('quantity', __('Part Quantity'),['class' => 'col-form-label']) }}
                    {{ Form::number('quantity', $parts->quantity, ['class' => 'form-control','required'=>'required']) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('price', __('Price'),['class' => 'col-form-label']) }}
                    {{ Form::number('price', $parts->price, ['class' => 'form-control','required'=>'required']) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('category', __('Category'),['class' => 'col-form-label']) }}
                    {{ Form::text('category', $parts->category, ['class' => 'form-control','required'=>'required']) }}
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
            {{ Form::submit(__('Update'), ['class' => 'btn  btn-primary']) }}
        </div>
        {{ Form::close() }}
   
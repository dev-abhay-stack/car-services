
    {{Form::model($Vendor,array('route' => array('vendors.update', $Vendor->id), 'method' => 'PUT','enctype' => 'multipart/form-data')) }}
    <div class="row">

        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('name', __('Name'),['class' => 'col-form-label']) }}
                {{ Form::text('name', null, ['class' => 'form-control','required'=>'required']) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('contact', __('Contact'),['class' => 'col-form-label']) }}
                {{ Form::text('contact', null, ['class' => 'form-control','required'=>'required']) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('email', __('Email'),['class' => 'col-form-label']) }}
                {{ Form::email('email', null, ['class' => 'form-control','required'=>'required']) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('phone', __('Phone No.'),['class' => 'col-form-label']) }}
                {{ Form::text('phone', null, ['class' => 'form-control','required'=>'required']) }}
            </div>
        </div>
        <div class="col-md-6">
            {{ Form::label('image', __('Profile Image'),['class' => 'col-form-label']) }}
            <div class="choose-file">
                <label for="Profile Image">
                    <input type="file" class="form-control" name="image" id="image" data-filename="image" accept="image/*,.jpeg,.jpg,.png">
                </label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('address', __('Address'),['class' => 'col-form-label']) }}
                {{ Form::text('address', null, ['class' => 'form-control','required'=>'required']) }}
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
            {{ Form::submit(__('Update'), ['class' => 'btn  btn-primary']) }}
        </div>
    </div>
    {{Form::close()}}
<script src="{{ asset('assets/libs/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}"></script>

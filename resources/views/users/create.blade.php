
    {{Form::open(array('route'=>array('users.store'),'method'=>'post'))}}
    <div class="row">
        <div class="col-md-6 form-group">
            {{Form::label('name',__('First Name'),['class'=>'col-form-label']) }}
            {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter First Name'),'required'=>'required'))}}
        </div>
        <div class="col-md-6 form-group">
            {{Form::label('last_name',__('Last Name'),['class'=>'col-form-label']) }}
            {{Form::text('last_name',null,array('class'=>'form-control','placeholder'=>__('Enter Last Name'),'required'=>'required'))}}
        </div>
        <div class="col-md-6 form-group">
            {{Form::label('email',__('Email'),['class'=>'col-form-label'])}}
            {{Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter User Email'),'required'=>'required'))}}
        </div>
        <div class="col-md-6 form-group">
            {{Form::label('password',__('Password'),['class'=>'col-form-label'])}}
            {{Form::password('password',array('class'=>'form-control','placeholder'=>__('Enter User Password'),'required'=>'required','minlength'=>"6"))}}
        </div>
        <div class="col-md-6 form-group">
            {{Form::label('phone_no',__('Phone Number'),['class'=>'col-form-label']) }}
            {{Form::text('phone_no',null,array('class'=>'form-control','placeholder'=>__('Enter Phone Number'),'required'=>'required'))}}
        </div>
        @if(\Auth::user()->type != 'super admin')
            <div class="form-group col-md-6">
                {{ Form::label('role', __('User Role'),['class'=>'col-form-label']) }}
                {!! Form::select('role', $roles, null,array('class' => 'form-control select2','required'=>'required')) !!}
            </div>
        @endif
        <div class="modal-footer">
            <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
            {{Form::submit(__('Create'),array('class'=>'btn  btn-primary'))}}
        </div>
    </div>
    {{Form::close()}}


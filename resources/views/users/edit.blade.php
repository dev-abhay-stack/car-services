
    {{Form::open(array('route'=>array('users.update', $users[0]['id']),'method'=>'PUT'))}}
    <div class="row">
        <div class="col-md-6 form-group">
            {{Form::label('name',__('First Name'),['class'=>'col-form-label']) }}
            {{Form::text('name',$users[0]['name'],array('class'=>'form-control','placeholder'=>__('Enter First Name'),'required'=>'required'))}}
        </div>
        <div class="col-md-6 form-group">
            {{Form::label('last_name',__('Last Name'),['class'=>'col-form-label']) }}
            {{Form::text('last_name',$users[0]['last_name'],array('class'=>'form-control','placeholder'=>__('Enter Last Name'),'required'=>'required'))}}
        </div>
        <div class="col-md-12 form-group">
            {{Form::label('email',__('Email'),['class'=>'col-form-label,'])}}
            {{Form::text(null,$users[0]['email'],array('class'=>'form-control','placeholder'=>__('Enter User Email'),'readonly'))}}
        </div>
        <div class="col-md-6 form-group">
            {{Form::label('phone_no',__('Phone Number'),['class'=>'col-form-label']) }}
            {{Form::text('phone_no',$users[0]['phone_no'],array('class'=>'form-control','placeholder'=>__('Enter Phone Number'),'required'=>'required'))}}
        </div>
        @if(\Auth::user()->type != 'super admin')
            <div class="form-group col-md-6">
                {{ Form::label('role', __('User Role'),['class'=>'col-form-label']) }}
                {!! Form::text(null, $users[0]['user_type'],array('class' => 'form-control select2','readonly')) !!}
            </div>
        @endif
        <div class="modal-footer">
            <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
            {{Form::submit(__('Update'),array('class'=>'btn  btn-primary'))}}
        </div>
    </div>
    {{Form::close()}}


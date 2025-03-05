
    {{Form::open(array('route'=>array('pmsinvoice.store'),'method'=>'post','enctype' => 'multipart/form-data'))}}

    <input type="hidden" name="pms_id" value="{{$pms_id}}">
    <div class="row">
        <div class="col-md-6 form-group">
            {{Form::label('invoice_cost',__('Invoice Cost'),['class'=>'col-form-label']) }}
            {{Form::number('invoice_cost',null,array('class'=>'form-control','placeholder'=>__('Enter Invoice Cost'),'required'=>'required', 'stap'=>'any'))}}
        </div>
        <div class="col-md-6">
            {{ Form::label('invoive', __('Attach Invoice'),['class' => 'form-control-label']) }}
            <div class="choose-file">
                <label for="Invoice">
                    <div class="invoice">{{__('Choose Invoice')}}</div>
                    <input type="file" class="form-control" name="invoice" id="invoice" data-filename="invoice" accept="image/*,.jpeg,.jpg,.png,.pdf" required="required">
                </label>
            </div>
        </div>
        <div class="col-md-12 form-group">
            {{Form::label('description',__('Description'),['class'=>'col-form-label']) }}
            {{Form::text('description',null,array('class'=>'form-control','placeholder'=>__('Enter Description'),'required'=>'required'))}}
        </div>

        <div class="modal-footer pr-0">
            <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
            {{ Form::submit(__('Create'), ['class' => 'btn  btn-primary']) }}
        </div>

    </div>
    {{Form::close()}}



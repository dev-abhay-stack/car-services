<div class="card bg-none card-box">
    {{Form::model($pmsinvoice,array('route' => array('pmsinvoice.update', $pmsinvoice->id), 'method' => 'PUT','enctype' => 'multipart/form-data')) }}
    <input type="hidden" name="pms_id" value="{{$pmsinvoice->pms_id}}">
    <div class="row">
        <div class="col-md-6 form-group">
            {{Form::label('invoice_cost',__('Invoice Cost'),['class' => 'col-form-label']) }}
            {{Form::text('invoice_cost',null,array('class'=>'form-control','placeholder'=>__('Enter Invoice Cost'),'required'=>'required'))}}
        </div>
        <div class="col-md-6">
            {{ Form::label('invoive', __('Attach Invoice'),['class' => 'col-form-label']) }}
            <div class="choose-file">
                <label for="Invoice">
                    <input type="file" class="form-control" name="invoice" id="invoice" data-filename="invoice" accept="image/*,.jpeg,.jpg,.png,.pdf" required="required">
                </label>
            </div>
        </div>
        <div class="col-md-12 form-group">
            {{Form::label('description',__('Description'),['class' => 'col-form-label']) }}
            {{Form::text('description',null,array('class'=>'form-control','placeholder'=>__('Enter Description'),'required'=>'required'))}}
        </div>

        <div class="modal-footer">
            <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
            {{Form::submit(__('Update'),array('class'=>'btn btn-primary'))}}
        </div>


    </div>
    {{Form::close()}}
</div>


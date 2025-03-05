
    {{Form::model($wosinvoice,array('route' => array('wosinvoice.update', $wosinvoice->id), 'method' => 'PUT','enctype' => 'multipart/form-data')) }}
    <input type="hidden" name="pms_id" value="{{$wosinvoice->wo_id}}">
    <div class="row">
        <div class="col-md-6 form-group">
            {{Form::label('invoice_cost',__('Invoice Cost'),['class'=>'col-form-label']) }}
            {{Form::text('invoice_cost',null,array('class'=>'form-control','placeholder'=>__('Enter Invoice Cost'),'required'=>'required'))}}
        </div>
        <div class="col-md-6 form-group">
            {{ Form::label('invoive', __('Attach Invoice'),['class' => 'form-control-label']) }}
            <div class="choose-file">
                <label for="Invoice">
                    <input type="file" class="form-control" name="invoice" id="invoice" data-filename="invoice" accept="image/*,.jpeg,.jpg,.png,.pdf">
                </label>
            </div>
        </div>
        <div class="col-md-12 form-group">
            {{Form::label('description',__('Description'),['class'=>'col-form-label']) }}
            {{Form::text('description',null,array('class'=>'form-control','placeholder'=>__('Enter Description'),'required'=>'required'))}}
        </div>

        <div class="modal-footer pr-0">
            <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
            {{ Form::submit(__('Update'), ['class' => 'btn  btn-primary']) }}
        </div>
    </div>
    {{Form::close()}}



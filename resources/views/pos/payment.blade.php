
{{ Form::open(array('route' => array('invoice.payment', $invoice->id),'method'=>'post')) }}
<div class="row">
    <div class="form-group  col-md-6">
        {{ Form::label('date', __('Date')) }}
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fas fa-calendar"></i>
                </div>
            </div>
            {{ Form::text('date', '', array('class' => 'form-control datepicker','required'=>'required')) }}
        </div>
    </div>
    <div class="form-group  col-md-6">
        {{ Form::label('amount', __('Amount')) }}
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="far fa-money-bill-alt"></i>
                </div>
            </div>
            {{ Form::text('amount',$invoice->getDue(), array('class' => 'form-control','required'=>'required')) }}
        </div>
    </div>
    <div class="form-group  col-md-6">
        <div class="input-group">
            {{ Form::label('account_id', __('Account')) }}
            {{ Form::select('account_id',$accounts,null, array('class' => 'form-control select2','required'=>'required')) }}
        </div>
    </div>

    <div class="form-group  col-md-6">
        {{ Form::label('reference', __('Reference')) }}
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="far fa-sticky-note"></i>
                </div>
            </div>
            {{ Form::text('reference', '', array('class' => 'form-control')) }}
        </div>
    </div>
    <div class="form-group  col-md-12">
        {{ Form::label('description', __('Description')) }}
        {{ Form::textarea('description', '', array('class' => 'form-control','rows'=>3)) }}
    </div>
    <div class="modal-footer">
        <button type="button" class="btn  btn-light">{{ __('Close') }}</button>
        {{Form::submit(__('Add'),array('class'=>'btn btn-primary'))}}
    </div>
</div>
{{ Form::close() }}


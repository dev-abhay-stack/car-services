
        {{ Form::open(array('route' => array('assets.associate',[$module, $id]),'enctype' => 'multipart/form-data')) }}
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">

                    @if($module == 'parts')
                        {{ Form::label('associate_parts', __('Associate Parts'),['class' => 'col-form-label']) }}
                    @elseif($module == 'pms')
                        {{ Form::label('pms', __('PMs'),['class' => 'col-form-label']) }}
                    @endif

                    {{ Form::select('associate_parts[]',$assets,null, ['class' => 'form-control select2','required'=>'required', 'multiple' => 'multiple']) }}

                </div>
            </div>
        </div>
        <div class="row justify-content-between align-items-center">
                <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-start mb-3">
                    @if($module == 'parts_assets')
                    <button class="btn-create badge-blue d-inline-block"  data-url="{{ route('assets.create',['parts_id'=>$vendor_id])}}" data-size="lg" data-ajax-popup="true" data-title="{{__('Create Parts')}}">{{__('Create Assets')}}</button>
                    @endif
                </div>
                <div class="modal-footer pr-0">
                    <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
                    {{ Form::submit(__('Associate'), ['class' => 'btn  btn-primary']) }}
                </div>
            </div>
        </div>
        {{ Form::close() }}

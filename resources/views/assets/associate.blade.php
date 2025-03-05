
        {{ Form::open(['route' => ['assets.associate', [$module, $id]], 'enctype' => 'multipart/form-data']) }}
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    @if ($module == 'parts')
                        {{ Form::label('associate_parts', __('Associate Parts'),['class' => 'col-form-label']) }}
                    @elseif($module == 'pms')
                        {{ Form::label('pms', __('PMs'),['class' => 'col-form-label']) }}
                        @elseif($module=='vendors')
                        {{ Form::label('associate_assets', __('Associate Assets'),['class' => 'col-form-label']) }}
                    @endif
                    {{ Form::select('associate_parts[]', $assets,null, array('class' => 'form-control multi-select','id'=>'choices-multiple','multiple'=>'','required'=>'required')) }}

                </div>
            </div>
        </div>
        <div class="row justify-content-between align-items-center">
            <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-start mb-3">
                @if ($module == 'parts_assets')
                    @if (Gate::check('create assets'))
                        <button class="btn btn-primary"
                            data-url="{{ route('asset.create', ['parts_id' => $parts_id]) }}" data-size="lg" data-bs-whatever="{{ __('Create Assets') }}"
                            data-bs-toggle="modal" data-bs-target="#exampleoverModal"
                            data-bs-title="{{ __('Create Assets') }}">{{ __('Create Assets') }}</button>
                    @endif
                @endif
                @if ($module == 'vendors')
                    @if (Gate::check('create assets'))
                        <button class="btn btn-primary"
                            data-url="{{ route('assets.create', ['vendor_id' => $vendor_id]) }}" data-size="lg" data-bs-whatever="{{ __('Create Assets') }}"
                            data-bs-toggle="modal" data-bs-target="#exampleoverModal"
                            data-bs-title="{{ __('Create Assets') }}">{{ __('Create Assets') }}</button>
                    @endif
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
                {{Form::submit(__('Associate'),array('class'=>'btn btn-primary'))}}
            </div>
        </div>
    </div>
    {{ Form::close() }}

    <script src="{{asset('assets/js/plugins/choices.min.js')}}"></script>
<script>
    if ($(".multi-select").length > 0) {
              $( $(".multi-select") ).each(function( index,element ) {
                  var id = $(element).attr('id');
                     var multipleCancelButton = new Choices(
                          '#'+id, {
                              removeItemButton: true,
                          }
                      );
              });
         }
  </script>

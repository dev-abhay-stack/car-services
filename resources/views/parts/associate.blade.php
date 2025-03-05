{{ Form::open(['route' => ['parts.associate', [$module, $id]], 'enctype' => 'multipart/form-data']) }}
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            @if ($module == 'parts')
                {{ Form::label('associate_parts', __('Associate Parts'),['class' => 'col-form-label']) }}
            @elseif($module == 'pms')
                {{ Form::label('pms', __('PMs'),['class' => 'col-form-label']) }}
            @endif
            {{ Form::select('associate_parts[]', $parts,null, array('class' => 'form-control multi-select','id'=>'choices-multiple','multiple'=>'','required'=>'required')) }}

        </div>
    </div>
</div>
<div class="row justify-content-between align-items-center">
    <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-start mb-3">
        <div class="d-inline-block">
            <!--Asset detail page in parts associate for create parts -->
            @if ($module == 'parts')
                @can('create parts')
                    <button class="btn btn-primary"
                        data-url="{{ route('parts.create', ['assets_id' => $id]) }}" data-size="lg" data-bs-whatever="{{ __('Create Parts') }}" data-bs-toggle="modal" data-bs-target="#exampleoverModal"
                        data-title="{{ __('Create Parts') }}">{{ __('Create Part') }}</button>
                @endcan
                <!--Asset detail page in pms associate for create pms -->
            @elseif($module == 'pms')
                @can('create pms')
                    <button type="button" class="btn  btn-primary" data-bs-toggle="modal" data-bs-target="#exampleoverModal"  data-bs-whatever="{{ __('Create Parts') }}"
                    data-url="{{ route('pms.create', $id) }}" data-size="lg" title="{{ __('Create PMs') }}"  data-bs-original-title="{{__('Create PMs')}}"
                        data-bs-whatever="{{__('Create PMs')}}"
                        >{{ __('Create PMs') }}</button>
                @endcan

                <!--pms detail page in parts associate for create parts -->
            @elseif($module == 'pms_parts')
                @can('create parts')
                    <button class="btn btn-primary"
                        data-url="{{ route('parts.create', ['pms_id' => $pms_id]) }}" data-size="lg" data-bs-whatever="{{ __('Create Parts') }}"
                        data-bs-toggle="modal" data-bs-target="#exampleoverModal"  title="{{ __('Create Parts') }}">{{ __('Create Parts') }}</button>
                @endcan
                <!-- vendors detail page in associate parts for create parts-->
            @elseif($module == 'vendors')
                @can('create parts')
                    <button class="btn btn-primary"
                        data-url="{{ route('parts.create', ['vendor_id' => $data_id]) }}" data-size="lg" data-bs-whatever="{{ __('Create Parts') }}"
                        data-bs-toggle="modal" data-bs-target="#exampleoverModal"  data-title="{{ __('Create Parts') }}">{{ __('Create Parts') }}</button>
                @endcan
                <!-- work order detail page in associate parts for create parts -->
            @elseif($module == 'open_task')
                <button class="btn btn-primary"
                    data-url="{{ route('parts.create', ['open_task_id' => $data_id]) }}" data-size="lg" data-bs-whatever="{{ __('Create Parts') }}"
                    data-bs-toggle="modal" data-bs-target="#exampleoverModal"  data-title="{{ __('Create Parts') }}">{{ __('Create Parts') }}</button>
            @endif
        </div>
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

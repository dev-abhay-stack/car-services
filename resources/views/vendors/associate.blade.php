{{ Form::open(['route' => ['vendors.associate', [$module, $id]], 'enctype' => 'multipart/form-data']) }}
<div class="row">

    <div class="col-md-12">
        <div class="form-group">
            <!--Parts detail page in associate vendor -->
            @if ($module == 'parts_vendor')
                {{ Form::label('associate_vendor', __('Associate Vendor'),['class' => 'col-form-label']) }}
            @endif
            {{ Form::select('associate_vendor[]', $vendor,null, array('class' => 'form-control multi-select','id'=>'choices-multiple','multiple'=>'','required'=>'required')) }}
            {{-- {{ Form::select('associate_vendor[]', $vendor, null, ['class' => 'form-control select2','required' => 'required','multiple' => 'multiple']) }} --}}
        </div>
    </div>
</div>
<div class="row justify-content-between align-items-center">
    <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-start mb-3">
        @if ($module == 'parts_vendor')
            <button class="btn  btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
                data-bs-whatever="{{ __('Create Vendor') }}"
                data-url="{{ route('vendors.create', ['parts_id' => $parts_id]) }}" data-size="lg"
                data-ajax-popup="true" data-title="{{ __('Create Vendor') }}">{{ __('Create Vendor') }}</button>

            <!-- parts detail page in associate vendor in create vendor-->
        @elseif($module == 'assets_vendor')
            @can('create vendor')
                <button class="btn  btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
                    data-bs-whatever="{{ __('Create Vendor') }}"
                    data-url="{{ route('vendors.create', ['assets_id' => $parts_id]) }}" data-size="lg"
                    data-ajax-popup="true" data-title="{{ __('Create Vendor') }}">{{ __('Create Vendor') }}</button>
            @endcan
        @endif
    </div>
    <div class="text-end">
        <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
        {{ Form::submit(__('Associate'), ['class' => 'btn  btn-primary']) }}
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

{{ Form::open(['route' => ['pms.store'], 'method' => 'post']) }}

<input type="hidden" name="assets_id" value="{{ $assets_id }}">
<div class="row">
    <div class="col-md-12 form-group">
        {{ Form::label('name', __('Name'), ['class' => 'col-form-label']) }}
        {{ Form::text('name', null, ['class' => 'form-control','placeholder' => __('Enter Name'),'required' => 'required']) }}
    </div>
    <div class="col-md-12 form-group">
        {{ Form::label('description', __('Description'), ['class' => 'col-form-label']) }}
        {{ Form::textarea('description', null, ['class' => 'form-control','placeholder' => __('Enter Description'),'required' => 'required']) }}
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label('parts', __('Parts'), ['class' => 'col-form-label']) }}
            {{ Form::select('parts[]', $parts,null, array('class' => 'form-control multi-select','id'=>'choices-multiple','multiple'=>'','required'=>'required')) }}
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label('tags', __('Tags'), ['class' => 'col-form-label']) }}
            <input class="form-control" id="choices-text-remove-button" type="text" value="" placeholder="Enter something" />
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
        {{ Form::submit(__('Create'), ['class' => 'btn  btn-primary']) }}
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

         var textRemove = new Choices(
            document.getElementById('choices-text-remove-button'), {
                delimiter: ',',
                editItems: true,
                maxItemCount: 5,
                removeItemButton: true,
            }
        );
  </script>

{{-- <script src="{{ asset('assets/libs/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script> --}}


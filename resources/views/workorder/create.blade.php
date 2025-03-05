<link rel="stylesheet" href="{{ asset('assets/libs/dropzone/dist/dropzone.css') }}">
{{ Form::open(['route' => ['opentask.store'], 'id' => 'assets_store', 'enctype' => 'multipart/form-data']) }}
<div class="row">
    <input name="_token" value="{{ csrf_token() }}" type="hidden">

    @if ($assets_id == 0)
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('assets_id', __('Assets'),['class' => 'col-form-label']) }}
                {{ Form::select('assets_id', $assets, null, ['class' => 'form-control select2', 'required' => 'required']) }}
            </div>
        </div>
    @elseif($assets_id != 0)
        {{ Form::hidden('assets_id', $assets_id, ['class' => 'form-control', 'required' => 'required']) }}
    @endif

    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('wo_name', __('WO Name'),['class' => 'col-form-label']) }}
            {{ Form::text('wo_name', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
    </div>

    @php($prioritys = App\Models\WorkOrder::priority())


    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('priority', __('Priority'),['class' => 'col-form-label']) }}
            <select name="priority" class="form-control select2">
                @foreach ($prioritys as $priority)
                    <option value="{{ $priority['priority'] }}">{{ $priority['priority'] }}</option>
                @endforeach
            </select>
        </div>
    </div>


    @if (Auth::user()->user_type == 'employee')
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('date', __('Due Date'),['class' => 'col-form-label']) }}
                {{ Form::date('date', null, ['class' => 'form-control', 'required' => 'required']) }}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('time', __('Time'),['class' => 'col-form-label']) }}
                {{ Form::time('time', null, ['class' => 'form-control', 'required' => 'required']) }}
            </div>
        </div>
    @else
        <div class="col-md-3">
            <div class="form-group">
                {{ Form::label('date', __('Due Date'),['class' => 'col-form-label']) }}
                {{ Form::date('date', null, ['class' => 'form-control', 'required' => 'required']) }}
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {{ Form::label('time', __('Time'),['class' => 'col-form-label']) }}
                {{ Form::time('time', null, ['class' => 'form-control', 'required' => 'required']) }}
            </div>
        </div>
    @endif

    @if (Auth::user()->user_type == 'company')
        @if ($assets_id == 0)
            <div class="col-md-12">
            @else
                <div class="col-md-6">
        @endif
        <div class="form-group">
            {{ Form::label('user', __('User'),['class' => 'col-form-label']) }}
            {{ Form::select('user[]', $user,null, array('class' => 'form-control multi-select','id'=>'choices-multiple','multiple'=>'','required'=>'required')) }}
            {{-- {{ Form::select('user[]', $user, null, ['class' => 'form-control select2','required' => 'required','multiple' => 'multiple']) }} --}}
        </div>
</div>
@endif



<div class="col-md-12">
    <div class="form-group">
        {{ Form::label('instructions', __('Instructions'),['class' => 'col-form-label']) }}
        {{ Form::text('instructions', null, ['class' => 'form-control', 'required' => 'required']) }}
    </div>
</div>

<div class="col-md-12">
    {{ Form::label('tags', __('Tags'),['class' => 'col-form-label']) }}
    <input class="form-control" id="choices-text-remove-button" type="text" value=""/>
</div>
</div>

<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
    {{ Form::submit(__('Create'), ['class' => 'btn  btn-primary']) }}
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

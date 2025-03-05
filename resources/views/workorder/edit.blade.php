<link rel="stylesheet" href="{{ asset('assets/libs/dropzone/dist/dropzone.css') }}">
        {{ Form::model($workorder, ['route' => ['opentask.update', $workorder->id], 'method' => 'PUT']) }}

        <div class="row">
            <input name="_token" value="{{ csrf_token() }}" type="hidden">

            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('assets_id', __('Assets'),['class' => 'col-form-label']) }}
                    {{ Form::select('assets_id', $assets, null, ['class' => 'form-control select2', 'required' => 'required']) }}
                </div>
            </div>

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
                            <option {{ $workorder->priority == $priority['priority'] ? 'selected' : '' }}
                                value="{{ $priority['priority'] }}">{{ $priority['priority'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    {{ Form::label('date', __('Due Date'),['class' => 'col-form-label']) }}
                    {{ Form::date('date', null, ['class' => 'form-control', 'required' => 'required']) }}
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    {{ Form::label('', __('Time'),['class' => 'col-form-label']) }}
                    {{ Form::time('time', null, ['class' => 'form-control', 'required' => 'required']) }}
                </div>
            </div>

            @if (Auth::user()->user_type == 'company')
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('user', __('User'),['class' => 'col-form-label']) }}
                        {{ Form::select('user[]', $user,explode(',', $workorder->sand_to), array('class' => 'form-control multi-select','id'=>'choices-multiple','multiple'=>'','required'=>'required')) }}
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
                <input class="form-control" id="choices-text-remove-button" type="text" value="{{ $workorder->tags }}"/>

            </div>

        </div>

        <div class="modal-footer">
            <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
            {{ Form::submit(__('Update'), ['class' => 'btn  btn-primary']) }}
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

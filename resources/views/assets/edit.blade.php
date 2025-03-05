<link rel="stylesheet" href="{{asset('assets/libs/dropzone/dist/dropzone.css')}}">
        {{ Form::open(array('route' => array('asset.update', $Assets->id) ,'method'=>'PUT' , 'id' => 'assets_store', 'enctype' => 'multipart/form-data')) }}
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('name', __('Name'),['class' => 'col-form-label']) }}
                    {{ Form::text('name', $Assets->name, ['class' => 'form-control','required'=>'required']) }}
                    <input name="_token" value="{{ csrf_token() }}" type="hidden">
                </div>
            </div>
            <div class="col-md-6">
                {{ Form::label('thumbnail', __('Asset Thumbnail'),['class' => 'col-form-label']) }}
                <div class="choose-file">
                    <label for="Asset Thumbnail">

                        <input type="file" class="form-control" name="thumbnail" id="thumbnail" data-filename="thumbnail" accept="image/*,.jpeg,.jpg,.png">
                    </label>
                </div>
            </div>
            @if(count($AssetsField)>0)
                @foreach($AssetsField as $key => $value)
                    <div class="col-md-6">
                        <div class="form-group">
                            @if($value->type != 'multiple_files/document')
                                @php $field_name = $value->name.'['.$value->name.']'; @endphp
                                @php
                                    if(array_key_exists($value->name, $AssetsFieldValues)) {
                                        $fildval = $AssetsFieldValues[$value->name];
                                    }else {
                                        $fildval = null;
                                    }
                                @endphp


                                {{ Form::label($field_name, __($value->name),['class' => 'col-form-label']) }}
                                @if($value->type == 'text')
                                    {{ Form::text($field_name, $fildval, ['class' => 'form-control']) }}
                                @elseif($value->type == 'date')
                                    {{ Form::date($field_name, $fildval, ['class' => 'form-control']) }}
                                @elseif($value->type == 'time')
                                    {{ Form::time($field_name, $fildval, ['class' => 'form-control']) }}
                                @elseif($value->type == 'number')
                                    {{ Form::number($field_name, $fildval, ['class' => 'form-control']) }}
                                @elseif($value->type == 'dropdown')
                                    {{ Form::select($field_name, [],$fildval, ['class' => 'form-control']) }}
                                @elseif($value->type == 'file/document')
                                    <div class="choose-file">
                                        <label for="document{{$key}}">
                                            <div class="document{{$key}}">{{__('Choose document here')}}</div>
                                            <input type="file" class="form-control" name="{{$field_name}}" id="document{{$key}}" data-filename="document{{$key}}" accept="image/*,.jpeg,.jpg,.png,.pdf,.doc,.txt,.xls,.csv">
                                        </label>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="modal-footer">
            <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
            {{Form::submit(__('Update'),array('class'=>'btn  btn-primary'))}}
        </div>
        {{ Form::close() }}


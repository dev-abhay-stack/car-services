<link rel="stylesheet" href="{{asset('assets/libs/dropzone/dist/dropzone.css')}}">
        {{ Form::open(array('route' => ['asset.store'], 'id' => 'assets_store', 'enctype' => 'multipart/form-data')) }}
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('name', __('Name'),['class' => 'col-form-label']) }}
                    {{ Form::text('name', null, ['class' => 'form-control','required'=>'required']) }}
                    <input name="_token" value="{{ csrf_token() }}" type="hidden">
                    <input type="hidden" name="parts_id" value="{{$parts_id}}">
                    <input type="hidden" name="vendor_id" value="{{ $vendor_id }}">
                </div>
            </div>
            <div class="col-md-6">
                {{ Form::label('thumbnail', __('Asset Thumbnail'),['class' => 'col-form-label']) }}
                <div class="choose-file">
                    <label for="Asset Thumbnail">
                        <input type="file" class="form-control" name="thumbnail" id="thumbnail" data-filename="thumbnail" accept="image/*,.jpeg,.jpg,.png" required="required">
                    </label>
                </div>
            </div>
            @if(count($AssetsField)>0)
                @foreach($AssetsField as $key => $value)
                    <div class="col-md-6">
                        <div class="form-group">
                            @if($value->type != 'multiple_files/document')
                                @php $field_name = $value->name.'['.$value->name.']'; @endphp
                                {{ Form::label($field_name, __($value->name),['class' => 'col-form-label']) }}
                                @if($value->type == 'text')
                                    {{ Form::text($field_name, null, ['class' => 'form-control']) }}
                                @elseif($value->type == 'date')
                                    {{ Form::date($field_name, null, ['class' => 'form-control']) }}
                                @elseif($value->type == 'time')
                                    {{ Form::time($field_name, null, ['class' => 'form-control']) }}
                                @elseif($value->type == 'number')
                                    {{ Form::number($field_name, null, ['class' => 'form-control']) }}
                                @elseif($value->type == 'dropdown')
                                    {{ Form::select($field_name, [],null, ['class' => 'form-control']) }}
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
            {{Form::submit(__('Create'),array('class'=>'btn btn-primary'))}}
        </div>
        {{ Form::close() }}

{{-- <script src="{{asset('assets/libs/dropzone/dist/dropzone-min.js')}}"></script>
<script type="text/javascript">
    Dropzone.autoDiscover = false;
    myDropzone = $(".dropzonewidget").dropzone({
        maxFiles: 20,
        maxFilesize: 20,
        parallelUploads: 1,
        filename: false,
        paramName: 'Documents_and_Picture',
        acceptedFiles: ".jpeg,.jpg,.png,.pdf,.doc,.txt,.xls,.csv,application/octet-stream,audio/mpeg,mpga,mp3,wav",
        url: "{{route('assets.store')}}",
        autoProcessQueue: false,
        init: function () {

            var myDropzone = this;

            // Update selector to match your button
            $("#assets_store").submit(function (e) {
                e.preventDefault();
                if (myDropzone.getQueuedFiles().length > 0) {
                    myDropzone.processQueue();
                } else {
                    //myDropzone.uploadFile({ name: 'nofiles', upload: { filename: 'nofiles' } }); //send empty
                    myDropzone._uploadData([{ upload: { filename: '' } }], [{ filename: '', name: '', data: new Blob() }]);  //send empty
                }
            });

            this.on('sending', function(file, xhr, formData) {
                // Append all form inputs to the formData Dropzone will POST
                var data = $('#assets_store').serializeArray();
                $.each(data, function(key, el) {
                    formData.append(el.name, el.value);
                });

                var inputs = $('input[type="file"]');
                $.each(inputs, function (obj, v) {
                    var file = v.files[0];
                    var filename = $(v).attr("name");
                    var name = $(v).attr("id");
                    formData.append(filename, file);
                });
            });

            this.on("success", function(file, responseText) {
                if(responseText.is_success){
                    show_toastr('Success', responseText.message, 'success');
                    setTimeout(function () {
                        location.reload();
                    }, 500);
                }else{
                    show_toastr('Error', responseText.message, 'error');
                }
                $('#commonModal').modal('hide');
            });
        }
    });
</script> --}}

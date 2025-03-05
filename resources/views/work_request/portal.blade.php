<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
<link rel="stylesheet" href="{{ asset('assets/libs/@fortawesome/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/purpose.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/select2/dist/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/css/stylesheet.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

<div class="justify-content-center d-flex pt-4">

    <div class="card col-md-3 col-sm-6">
        <h3 class="text-center pt-4">Submit a Work Request</h3>
        <div class="card-body"> 
            {{ Form::open(array('route' => ['work_request.sand'], 'id' => 'assets_store', 'enctype' => 'multipart/form-data')) }}
            <div class="row">
                <input name="_token" value="{{ csrf_token() }}" type="hidden">
                <input name="location_id" value="{{ $id }}" type="hidden">

                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('wo_name', __('Work Request'),['class' => 'form-control-label']) }}
                        {{ Form::text('wo_name', null, ['class' => 'form-control','required'=>'required','placeholder'=>"Title of work request"]) }}
                    </div>
                </div>
                
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('instructions', __('Instructions'),['class' => 'form-control-label']) }}
                        {{ Form::textarea('instructions', null, ['class' => 'form-control','required'=>'required','placeholder'=>"Title of work request"]) }}
                    </div>
                </div>
    
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('name', __('Name'),['class' => 'form-control-label']) }}
                        {{ Form::text('user_name', null, ['class' => 'form-control','required'=>'required','placeholder'=>"Your Name"]) }}
                    </div>
                </div>
    
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('email', __('Email'),['class' => 'form-control-label']) }}
                        {{ Form::email('user_email', null, ['class' => 'form-control','required'=>'required','placeholder'=>"Your Email"]) }}
                    </div>
                </div>


                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('assets_id', __('Problem'),['class' => 'form-control-label']) }}
                        {{ Form::select('assets_id',$assets,null, ['class' => 'form-control select2','required'=>'required']) }}
                    </div>
                </div>
                
                <div class="col-md-12">
                    {{ Form::label('file', __('Add Picture and Document'),['class' => 'form-control-label']) }}
                    <div class="choose-file">
                        <label for="Asset File">
                            <div class="file">{{__('Add Pictures and Document')}}</div>
                            <input type="file" class="form-control" name="file[]" id="file" data-filename="file" accept="image/*,.jpeg,.jpg,.png" required="required" multiple>
                        </label>
                    </div>
                </div>
            </div>

            <div class="text-right pt-3">
                
                <input type="submit" value="{{__('Create')}}" class="btn-create badge-blue">
                <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/purpose.core.js')}}"></script>
<script src="{{ asset('assets/libs/select2/dist/js/select2.min.js')}}"></script>
<script src="{{ asset('assets/libs/bootstrap-notify/bootstrap-notify.min.js')}}"></script>

<script> var toster_pos="right"; </script>
@if(Session::has('success'))
    <script>
        show_toastr('{{__('Success')}}', "{!! session('success') !!}", 'success');
    </script>
    {{ Session::forget('success') }}
@endif
@if(Session::has('error'))
    <script>
        show_toastr('{{__('Error')}}', "{!! session('error') !!}", 'error');
    </script>
    {{ Session::forget('error') }}
@endif
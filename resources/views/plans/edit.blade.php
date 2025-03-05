
        <form class="px-3" method="post" enctype="multipart/form-data" action="{{ route('plans.update',$plan->id) }}">
            @csrf
            <div class="row">
                <div class="{{($plan->id == 1) ? 'col-12' : 'col-md-6' }}">
                    <div class="form-group">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $plan->name }}" required/>
                    </div>
                </div>

                @if($plan->id != 1)
                    <div class="form-group col-md-6">
                        <div class="custom-control custom-switch mt-5">
                            <input type="checkbox" class="custom-control-input" name="status" id="status" @if($plan->status) checked="checked" @endif>
                            <label class="custom-control-label form-label" for="status">{{ __('Status') }}</label>
                        </div>
                    </div>
                    {{-- <div class="form-group col-md-12">
                        <label for="image" class="form-label">{{__('Image')}}</label>
                        <div class="choose-file">
                            <label for="landing-logo">
                                <div>{{__('Choose file here')}}</div>
                                <input type="file" class="form-control" name="image" id="image" accept="image/*">
                            </label>
                        </div>
                        <span class="d-inline-block"><small class="ml-3">{{__('Please upload a valid image file. Size of image should not be more than 2MB.')}}</small></span>
                    </div> --}}
                    <div class="form-group col-md-4">
                        <label for="monthly_price" class="form-label">{{ __('Monthly Price') }}</label>
                        <div class="form-icon-user">
                            <span class="currency-icon">{{ (env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') }}</span>
                            <input class="form-control" type="number" min="0" id="monthly_price" name="monthly_price" value="{{ $plan->monthly_price }}" placeholder="{{ __('Monthly Price') }}">
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="annual_price" class="form-label">{{ __('Annual Price') }}</label>
                        <div class="form-icon-user">
                            <span class="currency-icon">{{ (env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') }}</span>
                            <input class="form-control" type="number" min="0" id="annual_price" name="annual_price" value="{{ $plan->annual_price }}" placeholder="{{ __('Annual Price') }}">
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="duration" class="form-label">{{ __('Trial Days') }} *</label>
                        <input type="number" class="form-control mb-0" id="trial_days" name="trial_days" value="{{$plan->trial_days}}" required/>
                        <span><small>{{__("Note: '-1' for Unlimited")}}</small></span>
                    </div>
                @endif
                <div class="form-group col-md-3">
                    <label for="max_locations" class="form-label">{{ __('Maximum Locations') }} *</label>
                    <input type="number" class="form-control mb-0" id="max_locations" name="max_locations" value="{{$plan->max_locations}}" required/>
                    <span><small>{{__("Note: '-1' for Unlimited")}}</small></span>
                </div>
                <div class="form-group col-md-4">
                    <div class="form-group">
                        <label for="max_users" class="form-label">{{ __('Maximum Users Per Location') }} *</label>
                        <input type="number" class="form-control mb-0" id="max_users" name="max_users" value="{{$plan->max_users}}" required/>
                        <span><small>{{__("Note: '-1' for Unlimited")}}</small></span>
                    </div>
                </div>
                <div class="form-group col-md-5">
                    <label for="max_wo" class="form-label">{{ __('Maximum Assets Per Location') }} *</label>
                    <input type="number" class="form-control mb-0" id="max_wo" name="max_wo" value="{{$plan->max_wo}}" required/>
                    <span><small>{{__("Note: '-1' for Unlimited")}}</small></span>
                </div>
                <div class="form-group col-md-12 mb-0">
                    <div class="form-group">
                        <label for="description" class="form-label">{{ __('Description') }}</label>
                        <textarea class="form-control" id="description" name="description">{{$plan->description}}</textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
                {{Form::submit(__('Update'),array('class'=>'btn  btn-primary'))}}
            </div>
        </form>


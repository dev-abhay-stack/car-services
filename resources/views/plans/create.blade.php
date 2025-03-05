
        <form class="px-3" method="post" action="{{ route('plans.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="name" class="col-form-label">{{ __('Name') }}</label>
                    <input type="text" class="form-control" id="name" name="name" required/>
                </div>
                <div class="form-group col-md-6 ps-3">
                    <div class="form-check form-switch custom-switch-v1">
                        <input type="checkbox" class="form-check-input input-primary" name="status"
                            id="status" checked>
                        <label class="form-check-label" for="status"></label>
                    </div>
                </div>

                {{-- <div class="form-group col-md-6">
                    <div class="custom-control custom-switch mt-5">
                        <input type="checkbox" class="custom-control-input" name="status" id="status" checked="checked">
                        <label class="custom-control-label col-form-label" for="status">{{ __('Status') }}</label>
                    </div>
                </div> --}}
                {{-- <div class="form-group col-md-12">
                    <label for="image" class="col-form-label">{{__('Image')}}</label>
                    <div class="choose-file">
                        <label for="landing-logo">
                            <input type="file" class="form-control" name="image" id="image" accept="image/*">
                        </label>
                    </div>
                    <span class="d-inline-block"><small class="ml-3">{{__('Please upload a valid image file. Size of image should not be more than 2MB.')}}</small></span>
                </div> --}}
                <div class="form-group col-md-4">
                    <label for="monthly_price" class="col-form-label">{{ __('Monthly Price') }}</label>
                    <div class="form-icon-user">
                        {{-- <span class="currency-icon">{{ (env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') }}</span> --}}
                        <input class="form-control" type="number" min="0" id="monthly_price" name="monthly_price" placeholder="{{ __('Monthly Price') }}">
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="annual_price" class="col-form-label">{{ __('Annual Price') }}</label>
                    <div class="form-icon-user">
                        {{-- <span class="currency-icon">{{ (env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') }}</span> --}}
                        <input class="form-control" type="number" min="0" id="annual_price" name="annual_price" placeholder="{{ __('Annual Price') }}">
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="duration" class="col-form-label">{{ __('Trial Days') }} *</label>
                    <input type="number" class="form-control mb-0" id="trial_days" name="trial_days" required/>
                    <span><small>{{__("Note: '-1' for Unlimited")}}</small></span>
                </div>
                <div class="form-group col-md-3">
                    <label for="max_locations" class="col-form-label">{{ __('Maximum Locations') }} *</label>
                    <input type="number" class="form-control mb-0" id="max_locations" name="max_locations" required/>
                    <span><small>{{__("Note: '-1' for Unlimited")}}</small></span>
                </div>
                <div class="form-group col-md-4">
                    <div class="form-group">
                        <label for="max_users" class="col-form-label">{{ __('Maximum Users Per Location') }} *</label>
                        <input type="number" class="form-control mb-0" id="max_users" name="max_users" required/>
                        <span><small>{{__("Note: '-1' for Unlimited")}}</small></span>
                    </div>
                </div>
                <div class="form-group col-md-5">
                    <label for="max_wo" class="col-form-label">{{ __('Maximum work order Per Location') }} *</label>
                    <input type="number" class="form-control mb-0" id="max_wo" name="max_wo" required/>
                    <span><small>{{__("Note: '-1' for Unlimited")}}</small></span>
                </div>
                <div class="form-group col-md-12 mb-0">
                    <div class="form-group">
                        <label for="description" class="col-form-label">{{ __('Description') }}</label>
                        <textarea class="form-control" id="description" name="description">{{$plan->description}}</textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
                {{Form::submit(__('Create'),array('class'=>'btn  btn-primary'))}}
            </div>
        </form>


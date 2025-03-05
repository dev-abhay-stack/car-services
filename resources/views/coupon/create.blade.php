
        <form method="post" action="{{ route('coupons.store') }}">
            @csrf
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="name" class="col-form-label">{{ __('Name') }}</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="form-group col-md-6">
                    <label for="discount" class="col-form-label">{{ __('Discount') }}</label>
                    <input type="number" name="discount" class="form-control" required step="0.01">
                    <span class="small">{{ __('Note: Discount in Percentage') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="limit" class="col-form-label">{{ __('Limit') }}</label>
                    <input type="number" name="limit" class="form-control" required>
                </div>
                <div class="form-group col-md-12" id="auto">
                    <div class="row">
                        <div class="col-md-10">
                            <input class="form-control" name="code" type="text" id="auto-code">
                        </div>
                        <div class="col-md-2">
                            <a href="#" class="btn btn-xs btn-icon-only width-auto" id="code-generate"><i
                                    class="fas fa-history"></i> {{ __('Generate') }}</a>
                        </div>
                    </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
                {{Form::submit(__('Create'),array('class'=>'btn  btn-primary'))}}
            </div>
            </div>
        </form>
  



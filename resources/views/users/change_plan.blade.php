<div class="table-responsive">
    <table class="table">
        <tbody>
        @foreach($plans as $plan)
            <tr>
                <td>
                    <div class="font-style font-weight-bold">{{$plan->name}}</div>
                </td>
                <td>
                    <div class="font-weight-bold">{{$plan->max_locations}}</div>
                    <div>{{__('Workspaces')}}</div>
                </td>
                <td>
                    <div class="font-weight-bold">{{$plan->max_users}}</div>
                    <div>{{__('Users')}}</div>
                </td>
                <td>
                    <div class="font-weight-bold">{{$plan->max_assets}}</div>
                    <div>{{__('Projects')}}</div>
                </td>
                <td>
                    @if($user->plan == $plan->id)
                        <button type="button" class="btn btn-xs btn-soft-success btn-icon">
                            <span class="btn-inner--icon"><i class="fas fa-check"></i></span>
                            <span class="btn-inner--text">{{__('Active')}}</span>
                        </button>
                    @else
                        <div>
                            <a href="{{route('manually.activate.plan',[$user->id,$plan->id, 'monthly'])}}" class="bg-primary text-white d-inline-block rounded-6 px-3 py-1" title="{{ __('Click to Upgrade Plan') }}"><i class="fas fa-cart-plus mr-2"></i> {{ __('One Month') }}</a>
                            <a href="{{route('manually.activate.plan',[$user->id,$plan->id, 'annual'])}}" class="bg-primary text-white d-inline-block rounded-6 px-3 py-1" title="{{ __('Click to Upgrade Plan') }}"><i class="fas fa-cart-plus mr-2"></i> {{ __('One Year') }}</a>
                        </div>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

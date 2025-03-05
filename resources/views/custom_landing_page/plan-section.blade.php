<section class="pricing-plan bg-gredient3" id="pricing">
    <div class="container our-system">
        <div class="row">
            @foreach($plans as $plan)
                <div class="col-lg-3 col-sm-6 mb-4">
                    <div class="plan-2">
                        <h6>{{$plan->name}}</h6>
                        <p class="price">
                            <small><h5>{{(env('CURRENCY_SYMBOL')) ? env('CURRENCY_SYMBOL') : '$'}}{{$plan->monthly_price}} Monthly Price</h5></small>
                        <small><h5>{{(env('CURRENCY_SYMBOL')) ? env('CURRENCY_SYMBOL') : '$'}}{{$plan->annual_price}} Annual Price</h5></small>
                        </p>
                        <p class="price-text">For companies that need a robust full-featured time tracker.</p>
                        <ul class="plan-detail">
                            <li>{{ ($plan->trial_days < 0)?__('Unlimited'):$plan->trial_days }} Trial Days</li>
                            <li>{{ ($plan->max_locations < 0)?__('Unlimited'):$plan->max_locations }} Locations</li>
                            <li>{{ ($plan->max_users < 0)?__('Unlimited'):$plan->max_users }} Users Per Location</li>
                            <li>{{ ($plan->max_wo < 0)?__('Unlimited'):$plan->max_wo }} Work Oreder Per Location</li>
                        </ul>
                        <a href="{{route('register')}}" class="button">Active</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<div id="ul-section">
    <ul class="list-group list-group-horizontal tooltip1text" style="z-index:1000;">
        <li class="list-group-item"><button class="btn btn-default" id="delete"><i class="fa fa-trash"></i></button></li>
        <li class="list-group-item"><button class="btn btn-default" onclick="copySection(this)" id="copy_btn"><i class="fa fa-copy"></i></button></li>
        <li class="list-group-item"><a class="btn btn-default handle"><i class="fa fa-arrows"></i></a></li>
    </ul>
</div>

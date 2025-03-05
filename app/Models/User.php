<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone_no',
        'password',
        'user_type',
        'created_by',
        'company_id',
        'location_id',
        'current_location',
        'avatar',
        'lang',
        'plan',
        'plan_type',
        'plan_expire_date',
        'payment_subscription_id',
        'is_trial_done',
        'is_plan_purchased',
        'interested_plan_id',
        'is_register_trial',
        'is_deleted',
        'referral_code',
        'referred_by',
        'otp',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getPlan()
    {
        return $this->hasOne('App\Models\Plan', 'id', 'plan');
    }

    public static function Company_ID()
    {
        $return = '';
        if (Auth::User()->user_type == 'employee' || Auth::User()->user_type == 'client') {
            $return = Auth::User()->company_id;
        }
        if (Auth::User()->user_type == 'company') {
            $return = Auth::User()->id;
        }
        return $return;
    }

    public function creatorId()
    {
        if ($this->user_type == 'company' || $this->user_type == 'super admin') {
            return $this->id;
        } else {
            return $this->created_by;
        }
    }

    public function createById()
    {
        
        if($this->user_type == 'super admin')
        {
            return $this->id;
        }
        else
        {
            return $this->created_by;
        }
    }

    public function location()
    {
        return $this->hasMany('App\Models\location', 'company_id', 'id');
    }

    public function currentlocation()
    {
        return $this->hasOne('App\Models\location', 'id', 'current_location');
    }

    public static function userCurrentLocation()
    {
        $company_id = Auth::User()->Company_ID();
        if (Auth::user()->user_type == 'company' ) {
            $location = location::where(['id' => Auth::User()->current_location, 'company_id' => $company_id, 'is_active' => 1])->first();
            if (!is_null($location)) {
                return $location->id;
            } else {
                return 0;
            }
        }
        elseif(Auth::user()->user_type == 'employee' )
        {
            $location=location::where('id',Auth::user()->location_id)->where('company_id',$company_id)->first();
            return $location->id;
            
        }
    
    }

    public static function userCurrentLocationDetail()
    {

        $company_id = Auth::User()->Company_ID();
        $location = location::where(['id' => Auth::User()->current_location, 'company_id' => $company_id, 'is_active' => 1])->first();
        if (!is_null($location)) {
            return $location;
        } else {
            return 0;
        }
    }

    public function countLocation()
    {
        return location::where('created_by', '=', $this->id)->count();
    }

    public function countWorkOrder()
    {
        // dd($this->id);
        return WorkOrder::where('created_by', '=', $this->id)->count();
     
    }


    public function countUsers($workspace_id)
    {
        $count = User::where('created_by', $this->id);
        return $count->count();
    }

    public function assignPlan($planID, $frequency = '')
    {

        $plan = Plan::find($planID);
        if($plan)
        {
            $locations      = location::where('created_by', '=', $this->Company_ID())->get();
            $locationsCount = 0;
            foreach($locations as $location)
            {
                $locationsCount++;
                $location->is_active = $plan->max_locations != -1 || $locationsCount <= $plan->max_locations ? 1 : 0;
                $location->save();

                $assetsCount = 0;
                foreach($location->workorder as $workorder)
                {
                    $assetsCount++;
                    $workorder->is_active = $plan->workorder == -1 || $assetsCount <= $plan->workorder ? 1 : 0;
                    $workorder->save();
                }

                $users = $location->users;

                if($plan->max_user == -1)
                {
                    foreach($users as $user)
                    {

                        $user->is_plan_purchased = 1;
                        $user->save();
                    }
                }
                else
                {
                    $userCount = 0;
                    foreach($users as $user)
                    {
                        $userCount++;
                        if($userCount <= $plan->max_user)
                        {
                            $user->is_plan_purchased = 1;
                            $user->save();
                        }
                        else
                        {
                            $user->is_plan_purchased = 0;
                            $user->save();
                        }
                    }
                }

                $userLocations      = UserLocation::where('location_id', '=', $location->id)->get();
                $userLocationCount = 0;
                foreach($userLocations as $userlocation)
                {
                    $userLocationCount++;
                    $userlocation->is_active = $plan->max_users == -1 || $userLocationCount <= $plan->max_users ? 1 : 0;
                    $userlocation->save();
                }
            }

            $this->plan = $plan->id;
            if($frequency == 'weekly')
            {
                $this->plan_expire_date = Carbon::now()->addWeeks(1)->isoFormat('YYYY-MM-DD');
            }
            elseif($frequency == 'monthly')
            {
               
                $this->plan_expire_date = Carbon::now()->addMonths(1)->isoFormat('YYYY-MM-DD');
            }
            elseif($frequency == 'annual')
            {
                $this->plan_expire_date = Carbon::now()->addYears(1)->isoFormat('YYYY-MM-DD');
            }
            else
            {
                $this->plan_expire_date = null;
            }
            $this->plan_type = $frequency;
            $this->save();

            return ['is_success' => true];
        }
        else
        {
            return [
                'is_success' => false,
                'error' => __('Plan is deleted.'),
            ];
        }
    }

    public function cancel_subscription($user_id = false)
    {
        $user = User::find($user_id);
        if(!$user_id && !$user && $user->payment_subscription_id != '' && $user->payment_subscription_id != null) {
            return true;
        }
        $data            = explode('###', $user->payment_subscription_id);
        $type            = strtolower($data[0]);
        $subscription_id = $data[1];
        switch($type)
        {
            case 'stripe':
                /* Initiate Stripe */
                \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                /* Cancel the Stripe Subscription */
                $subscription = \Stripe\Subscription::retrieve($subscription_id);
                $subscription->cancel();
                break;
            case 'paypal':
                /* Initiate paypal */
                $paypal = new \PayPal\Rest\ApiContext(new \PayPal\Auth\OAuthTokenCredential(env('PAYPAL_CLIENT_ID'), env('PAYPAL_SECRET_KEY')));
                $paypal->setConfig(['mode' => env('PAYPAL_MODE')]);
                /* Create an Agreement State Descriptor, explaining the reason to suspend. */
                $agreement_state_descriptior = new \PayPal\Api\AgreementStateDescriptor();
                $agreement_state_descriptior->setNote('Suspending the agreement');
                /* Get details about the executed agreement */
                $agreement = \PayPal\Api\Agreement::get($subscription_id, $paypal);
                /* Suspend */
                $agreement->suspend($agreement_state_descriptior, $paypal);
                break;
        }
        $user->payment_subscription_id = '';
        $user->save();
    }
    public function countLocationUser($location_id)
    {
        return User::join('locations', 'locations.id', '=', 'users.location_id')->where('locations.id', '=', $location_id)->where('users.user_type','!=','company')->count();
    }
    public function countLocationWo($location_id)
    {
        return WorkOrder::join('locations', 'locations.id', '=', 'work_orders.location_id')->where('locations.id', '=', $location_id)->count();
    }

    public function currentLanguage()
    {
        return $this->lang;
    }
    
}

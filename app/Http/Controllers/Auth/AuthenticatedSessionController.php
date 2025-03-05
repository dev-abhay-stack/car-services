<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Plan;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function __construct()
    {
        if(!file_exists(storage_path()."/installed")){
            header('location:install');
            die;
        }

        //$this->middleware('guest')->except('logout');
        // $this->middleware('guest:client')->except(['logout']);
    }
    
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();
        $sdsa = $request->session()->regenerate();  
        $user=\Auth::user();
      
        if($user->user_type == 'company')
        {
            
            if($user->plan != null){

                $plan=Plan::find($user->plan);

                if($plan)
                {
                    if($plan->duration != 'Unlimited')
                    {
                        $datetime1=new \Datetime($user->plan_expire_date);
                        $datetime2=new \Datetime(date('Y-m-d'));
                        $interval =$datetime2->diff($datetime1);
                        $days=$interval->format('%r%a');
                        if($days <= 0)
                        {
                            $user->assignPlan(1);
    
                            return redirect()->intended(RouteServiceProvider::HOME)->with('error',__('Your Plan is expired.'));
                        }
                        else{
                            return redirect()->intended(RouteServiceProvider::HOME)->with('error',__('Your Plan is expired.'));
                        }
                    }
                   
                }else{
                    return redirect()->intended(RouteServiceProvider::HOME)->with('error',__('Your Plan is expired.'));
                }
            }else{
                return redirect()->intended(RouteServiceProvider::HOME)->with('error',__('Your Plan is expired.'));
            }

         
        }elseif($user->user_type == 'super admin'){

            return redirect()->intended(RouteServiceProvider::HOME);
        }else {
            return redirect()->intended(RouteServiceProvider::HOME);
        }
        
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

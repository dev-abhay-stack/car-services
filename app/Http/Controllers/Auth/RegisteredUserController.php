<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\location;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
       
        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users',
            'phone_no' => 'required',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'referral_code' => 'nullable|string|exists:users,referral_code',
        ]);
        $referralCode = Str::random(10);
        $user = User::create([
            'name' => 'Demo',
            'email' => 'demo@gmail.com',
            'phone_no' => $request->phone_no,
            'password' => Hash::make($request->password),
            'referral_code' => $referralCode,
            'referred_by' => $request->referral_code != null?$this->getReferredById($request->referral_code):null,
            'user_type' => 'user',
            'lang' => 'en',
            'created_by' => 1,
        ]);
        if ($user->referred_by) {
            // Find the user who referred the new user
            $referringUser = User::find($user->referred_by);

            // Reward the referring user
            // This could be points, balance, or anything you choose
            $referringUser->increment('points', 10);  // Add 10 points to the referring user
        }
        if($user){
            $companyRole='company';
            
            $user->assignRole($companyRole);

            $Location = location::create([
                'name' =>'Company First Location',
                'address'=>'First Location',
                'slug'=>'First-location',
                'created_by'=>$user->id,
                'company_id'=>$user->id,
                'is_active'=>1,
    
            ]);

            if($Location)
            {
                $user->update(['location_id' => $Location->id, 'current_location' => $Location->id]);

            }


        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
    public function getReferredById($referralCode)
    {
        // Search for the user who has the given referral code
        $referringUser = User::where('referral_code','=', $referralCode)->first();
        dd($referringUser);
        // Return the ID of the referring user if found, otherwise return null
        return $referringUser ? $referringUser->id : null;
    }

}

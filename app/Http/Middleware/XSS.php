<?php

namespace App\Http\Middleware;

use App\Models\LandingPageSection;
use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Utility;

class XSS
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check())
        {   
            \App::setLocale(Auth::user()->lang);
            Utility::addNewData();
            Utility::addCustomFields();
            $landingData = LandingPageSection::all()->count();
            if($landingData == 0)
            {
                Utility::add_landing_page_data();
            }
        }

        if(!Auth::check())
        {
            return redirect()->route('login');
        }

        $input = $request->all();
        array_walk_recursive($input, function (&$input){
            $input = strip_tags($input);
        });
        $request->merge($input);
        return $next($request);
    }
}

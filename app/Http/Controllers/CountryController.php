<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function getCountries()
    {
        $countries = json_decode(file_get_contents('https://restcountries.com/v3.1/all'), true);

        $formattedCountries = collect($countries)->map(function ($country) {
            return [
                'name' => $country['name']['common'],
                'flag' => $country['flags']['svg'], // or use 'png' for a PNG flag
                'code' => $country['cca2'], // Country code (e.g., US, IN)
            ];
        });

        return response()->json([
            'status' => 'success',
            'data' => $formattedCountries,
        ]);
    }
}

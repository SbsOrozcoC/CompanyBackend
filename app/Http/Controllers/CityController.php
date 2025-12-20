<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\JsonResponse;

class CityController extends Controller
{
    public function byCountry(Country $country): JsonResponse
    {
        return response()->json(
            $country->cities()
                ->select('id', 'name')
                ->orderBy('name')
                ->get()
        );
    }
}


<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;
use App\Models\Country;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'Colombia' => [
                'Bogotá',
                'Medellín',
                'Cali',
                'Barranquilla',
            ],
            'México' => [
                'Ciudad de México',
                'Guadalajara',
                'Monterrey',
            ],
            'Argentina' => [
                'Buenos Aires',
                'Córdoba',
                'Rosario',
            ],
        ];

        foreach ($data as $countryName => $cities) {
            $country = Country::where('name', $countryName)->first();

            if (!$country) {
                continue;
            }

            foreach ($cities as $city) {
                City::firstOrCreate([
                    'name' => $city,
                    'country_id' => $country->id,
                ]);
            }
        }
    }
}

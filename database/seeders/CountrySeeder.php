<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $countries = [
            'Colombia',
            'México',
            'Argentina',
        ];

        foreach ($countries as $country) {
            Country::firstOrCreate([
                'name' => $country,
            ]);
        }
    }
}

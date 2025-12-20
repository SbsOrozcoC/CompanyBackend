<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\City;
use Illuminate\Database\Seeder;

class PresidentEmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $city = City::first();

        if (!$city) {
            return;
        }

        Employee::firstOrCreate(
            ['identification' => '0000000000'],
            [
                'first_name'   => 'Presidente',
                'last_name'    => 'Empresa',
                'address'      => 'Oficina Principal',
                'phone'        => '0000000000',
                'city_id'      => $city->id,
                'boss_id'      => null,
                'is_president' => true,
            ]
        );
    }
}

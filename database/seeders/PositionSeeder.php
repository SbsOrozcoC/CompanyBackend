<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Position;

class PositionSeeder extends Seeder
{
    public function run(): void
    {
        $positions = [
            'Gerente',
            'Jefe de Área',
            'Analista',
            'Desarrollador',
            'Soporte',
        ];

        foreach ($positions as $name) {
            Position::firstOrCreate(['name' => $name]);
        }
    }
}

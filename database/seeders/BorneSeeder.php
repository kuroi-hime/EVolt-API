<?php

namespace Database\Seeders;

use App\Models\Borne;
use Illuminate\Database\Seeder;

class BorneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Borne::create([
            'type_connecteur' => 'X',
            'puissance_borne' => 60,
            'latitude_borne' => 80.12345,
            'longitude_borne' => 70.12345,
        ]);
    }
}

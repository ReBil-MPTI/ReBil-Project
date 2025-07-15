<?php

namespace Database\Seeders;

use App\Models\CarType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //membuat seeder jenis mobil
        $carTypes = [
            'SUV',
            'Hatchback',
            'MPV',
            'Wagon',
            'Pickup',
            'Minibus'
        ];
        foreach ($carTypes as $type) {
            CarType::create([
                'type_name' => $type,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}

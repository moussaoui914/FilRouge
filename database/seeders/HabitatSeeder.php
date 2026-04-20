<?php

namespace Database\Seeders;

use App\Models\Habitat;
use Illuminate\Database\Seeder;

class HabitatSeeder extends Seeder
{
    public function run(): void
    {
        $habitats = [
            ['name' => 'African Savanna', 'type' => 'Savanna', 'description' => 'Home to giraffes, zebras, and lions', 'capacity' => 50, 'location' => 'Zone A'],
            ['name' => 'Amazon Rainforest', 'type' => 'Forest', 'description' => 'Tropical rainforest with diverse species', 'capacity' => 80, 'location' => 'Zone B'],
            ['name' => 'Arctic Tundra', 'type' => 'Tundra', 'description' => 'Cold climate habitat for polar bears', 'capacity' => 30, 'location' => 'Zone C'],
            ['name' => 'Great Ocean', 'type' => 'Aquatic', 'description' => 'Marine life exhibition', 'capacity' => 100, 'location' => 'Zone D'],
            ['name' => 'Desert Oasis', 'type' => 'Desert', 'description' => 'Arid climate for desert animals', 'capacity' => 40, 'location' => 'Zone E'],
        ];

        foreach ($habitats as $habitat) {
            Habitat::create($habitat);
        }
    }
}
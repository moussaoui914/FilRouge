<?php

namespace Database\Seeders;

use App\Models\Animal;
use Illuminate\Database\Seeder;

class AnimalSeeder extends Seeder
{
    public function run(): void
    {
        $animals = [
            ['name' => 'Simba', 'species' => 'Lion', 'birth_date' => '2018-05-15', 'health_status' => 'Excellent', 'habitat_id' => 1],
            ['name' => 'Ellie', 'species' => 'Elephant', 'birth_date' => '2015-08-22', 'health_status' => 'Good', 'habitat_id' => 1],
            ['name' => 'George', 'species' => 'Giraffe', 'birth_date' => '2019-03-10', 'health_status' => 'Excellent', 'habitat_id' => 1],
            ['name' => 'Paul', 'species' => 'Penguin', 'birth_date' => '2020-11-05', 'health_status' => 'Good', 'habitat_id' => 4],
            ['name' => 'Sandy', 'species' => 'Camel', 'birth_date' => '2017-07-19', 'health_status' => 'Fair', 'habitat_id' => 5],
            ['name' => 'Bubbles', 'species' => 'Dolphin', 'birth_date' => '2016-09-03', 'health_status' => 'Excellent', 'habitat_id' => 4],
        ];

        foreach ($animals as $animal) {
            Animal::create($animal);
        }
    }
}
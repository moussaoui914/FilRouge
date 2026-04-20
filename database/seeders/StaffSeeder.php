<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StaffSeeder extends Seeder
{
    public function run(): void
    {
        $staff = [
            ['name' => 'John Keeper', 'email' => 'keeper@zoo.com', 'password' => Hash::make('password'), 'role' => 'soigneur', 'phone' => '123456789'],
            ['name' => 'Dr. Smith', 'email' => 'vet@zoo.com', 'password' => Hash::make('password'), 'role' => 'veterinaire', 'phone' => '123456790'],
            ['name' => 'Sarah Manager', 'email' => 'manager@zoo.com', 'password' => Hash::make('password'), 'role' => 'responsable', 'phone' => '123456791'],
            ['name' => 'Tom Ticket', 'email' => 'ticket@zoo.com', 'password' => Hash::make('password'), 'role' => 'billetterie', 'phone' => '123456792'],
            ['name' => 'Mike Maintenance', 'email' => 'maintenance@zoo.com', 'password' => Hash::make('password'), 'role' => 'maintenance', 'phone' => '123456793'],
        ];

        foreach ($staff as $staffMember) {
            User::create($staffMember);
        }
    }
}
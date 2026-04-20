<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 0; $i < 20; $i++) {
            Ticket::create([
                'visitor_name' => 'Visitor ' . ($i + 1),
                'visitor_email' => 'visitor' . ($i + 1) . '@example.com',
                'ticket_type' => collect(['adult', 'child', 'senior'])->random(),
                'price' => rand(8, 35),
                'purchase_date' => now()->subDays(rand(0, 30)),
                'visit_date' => now()->addDays(rand(1, 60)),
                'qr_code' => 'TICKET_' . uniqid(),
                'status' => 'active',
            ]);
        }
    }
}
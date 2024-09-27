<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customer = User::where('email', 'hmmehedi55@gmail.com')->first();
        $department = Department::where('name', 'Support')->first();

        Ticket::create([
            'user_id' => $customer->id,
            'department_id' => $department->id,
            'subject' => 'Test Support Request',
            'description' => 'Test Description support ticket.',
            'status' => 'open',
            'priority' => 'medium',
            'ticket_no' => rand(100000,999999),
        ]);
    }
}

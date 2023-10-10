<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Message;
use App\Models\TicketCategory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // create 1 user with the employee role
        User::factory()->create([
            'name' => 'Employee User',
            'email' => 'employee.user@test.com',
            'is_employee' => true,
        ]);

        // create 1 regular user with the employee role
        User::factory()->create([
            'name' => 'Regular User',
            'email' => 'regular.user@test.com',
            'is_employee' => false,
        ]);



        User::factory(2)->create();

        collect([
            'Technical support', 'Financial', 'Doubts'
        ])->each(function ($category_name) {
            TicketCategory::create([
                  'name' => $category_name
              ]);
        });

        $tickets = Ticket::factory()->count(3)->create();
        $tickets->each(function ($ticket) {
            $messages = Message::factory()->count(5)->make();
            $ticket->messages()->saveMany($messages);
        });
    }
}

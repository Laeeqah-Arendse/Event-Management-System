<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\LAEvent;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create 2 random admins using the factory
        User::factory()->count(2)->state(['role' => 'admin'])->create();

        // Create a fixed admin user with known credentials
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'), // ensure proper bcrypt hashing
            'role' => 'admin',
        ]);

        // Create organizers and attendees
        $organizers = User::factory()->count(3)->state(['role' => 'organizer'])->create();
        $attendees = User::factory()->count(5)->state(['role' => 'attendee'])->create();

        // Create events associated with random organizers
        $events = LAEvent::factory()->count(5)->create([
            'user_id' => $organizers->random()->id,
        ]);

        // Register each attendee to a random event (both attendees and registrations tables)
        foreach ($attendees as $attendee) {
            $randomEvent = $events->random();

            DB::table('l_a_attendees')->insert([
                'user_id' => $attendee->id,
                'l_a_event_id' => $randomEvent->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('l_a_registrations')->insert([
                'user_id' => $attendee->id,
                'l_a_event_id' => $randomEvent->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

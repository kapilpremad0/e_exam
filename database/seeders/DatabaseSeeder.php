<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        User::updateOrCreate(['email' => 'admin@gmail.com'],[
            'name' => 'Admin',
            'role' => 1,
            'mobile' => 0000000000,
            'password' => Hash::make('Admin@123'),
        ]);
    }
}

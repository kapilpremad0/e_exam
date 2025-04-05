<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = config('states');

        foreach ($states as $state) {
            State::updateOrCreate(
                ['code' => $state['iso2']], // Check for existing state using code
                ['name' => $state['name']],  // Insert or update the name
            );
        }
    }
}

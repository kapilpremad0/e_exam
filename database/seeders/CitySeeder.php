<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = config('cities');

        foreach ($states as $city) {
            $state = State::where('code', $city['state_code'])->first();
            City::updateOrCreate(
                [
                    'state_code' => $state->code, 
                    'name' => $city['name']],
                [
                    'state_id' => $state->id, 
                    'latitude' => $city['latitude'], 
                    'longitude' => $city['longitude']
                ],
            );
        }
    }
}

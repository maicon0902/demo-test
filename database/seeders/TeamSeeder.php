<?php

namespace Database\Seeders;

use App\Models\Competition;
use App\Models\Country;
use App\Models\Team;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $competitions = Competition::pluck('id');
        $countries = Country::pluck('id');

        foreach (range(1, 10) as $index) {
            Team::create([
                'id' => $faker->uuid,
                'competition_id' => $faker->randomElement($competitions),
                'country_id' => $faker->randomElement($countries),
                'name' => $faker->name,
                'logo' => $faker->imageUrl(200, 200, 'sports', true, 'team'),
            ]);
        }
    }
}

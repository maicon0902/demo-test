<?php

namespace Database\Seeders;

use App\Models\Competition;
use App\Models\Country;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CompetitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $countries = Country::pluck('id');
        foreach (range(1, 3) as $index) {
            Competition::create([
                'id' => $faker->uuid,
                'country_id' => $faker->randomElement($countries),
                'name' => $faker->word(),
                'logo' => $faker->imageUrl(200, 200, 'sports', true, 'competition'),
            ]);
        }
    }
}

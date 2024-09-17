<?php

namespace Database\Seeders;

use App\Models\Country;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        foreach (range(1, 5) as $index) {
            Country::create([
                'id' => $faker->uuid,
                'name' => $faker->country(),
                'logo' => $faker->imageUrl(200, 200, 'flag', true, 'logo'),
            ]);
        }
    }
}

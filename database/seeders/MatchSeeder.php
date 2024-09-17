<?php

namespace Database\Seeders;

use App\Models\Competition;
use App\Models\Country;
use App\Models\Matches;
use App\Models\Team;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class MatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $teams = Team::pluck('id');
        $competitions = Competition::pluck('id');

        foreach (range(1, 5) as $index) {
            Matches::create([
                'id' => $faker->uuid,
                'competition_id' => $faker->randomElement($competitions),
                'home_team_id' => $faker->randomElement($teams),
                'away_team_id' => $faker->randomElement($teams),
                'status_id' => $faker->numberBetween(1, 9),
                'started_at' => now()->subMinutes($faker->numberBetween(1, 90)),
                'match_time' => now()->addMinutes($faker->numberBetween(1, 90))->unix(),
                'home_scores' => json_encode([
                    $faker->numberBetween(0, 5),
                    $faker->numberBetween(0, 5),
                    $faker->numberBetween(0, 5),
                    $faker->numberBetween(0, 5),
                    $faker->numberBetween(-1, 5),
                    $faker->numberBetween(0, 5),
                    $faker->numberBetween(0, 5)
                ]),
                'away_scores' => json_encode([
                    $faker->numberBetween(0, 5),
                    $faker->numberBetween(0, 5),
                    $faker->numberBetween(0, 5),
                    $faker->numberBetween(0, 5),
                    $faker->numberBetween(-1, 5),
                    $faker->numberBetween(0, 5),
                    $faker->numberBetween(0, 5)
                ]),
            ]);
        }
    }
}

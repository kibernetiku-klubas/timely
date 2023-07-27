<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Date;
use App\Models\Meeting;
use App\Models\Vote;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Meeting::factory()
            ->has(Date::factory()
                ->count(5)
                ->has(Vote::factory()->count(3))
            )
            ->count(10)
            ->create();
    }
}

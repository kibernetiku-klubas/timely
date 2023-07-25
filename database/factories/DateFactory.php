<?php

namespace Database\Factories;

use App\Models\Date;
use App\Models\Meeting;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class DateFactory extends Factory
{
    protected $model = Date::class;

    public function definition(): array
    {
        return [
            'meeting_id' => Meeting::factory(),
            'date_and_time' => $this->faker->dateTimeBetween('now', '+1 month'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}

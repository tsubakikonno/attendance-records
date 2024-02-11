<?php

namespace Database\Factories;

use App\Models\PureDate;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PureDateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $startDate = $this->faker->dateTimeBetween('-2 years', 'now');
$breakIn = Carbon::parse($startDate)->addMinutes($this->faker->numberBetween(10, 120));
$breakOut = Carbon::parse($breakIn)->addMinutes($this->faker->numberBetween(10, 60));
$endDate = Carbon::parse($startDate)->addMinutes($this->faker->numberBetween(180, 840)); // 3 to 14 hours
$workTotalMinutes = $endDate->diffInMinutes($startDate);
$breakTotalMinutes = $breakOut->diffInMinutes($breakIn);

return [
    'user_id' => function () {
        return \App\Models\User::factory()->create()->id;
    },
    'start_time' => $startDate,
    'end_time' => $endDate,
    'break_in' => $breakIn,
    'break_out' => $breakOut,
    'work_total' => $workTotalMinutes,
    'break_total' => $breakTotalMinutes,
];
    }
}
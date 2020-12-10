<?php

namespace Database\Factories;

use App\Models\SchoolYear;
use Illuminate\Database\Eloquent\Factories\Factory;

class SchoolYearFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SchoolYear::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $startYear = $this->faker->year();
        $endYear = intval($startYear)+1;
        return [
            'startYear' => $startYear,
            'endYear' => $endYear,
        ];
    }
}

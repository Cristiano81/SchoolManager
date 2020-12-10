<?php

namespace Database\Factories;

use App\Models\Classroom;
use App\Models\SchoolYear;
use Illuminate\Database\Eloquent\Factories\Factory;
use phpDocumentor\Reflection\DocBlock\Tags\Factory\StaticMethod;

class ClassroomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Classroom::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'schoolyear_id'=>SchoolYear::factory(),
            'name'=>$this->faker->word(),
        ];
    }
}

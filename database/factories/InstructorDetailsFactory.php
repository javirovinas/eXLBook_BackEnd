<?php

namespace Database\Factories;

use App\Models\Instructor_details;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Instructor_details>
 */
class InstructorDetailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Instructor_details::class;
    
    public function definition(): array
    {
        return [
            //
        ];
    }
}

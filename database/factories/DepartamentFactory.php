<?php

namespace Database\Factories;

use App\Models\Contractor;
use App\Models\Departament;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepartamentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Departament::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            //'contractor_id' => Contractor::factory(),
            'street' => $this->faker->streetAddress . ", " . $this->faker->buildingNumber,
            'city' => $this->faker->city,
            'postal_code' => $this->faker->postcode,
            'country' => $this->faker->country
        ];
    }
}

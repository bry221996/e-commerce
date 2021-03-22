<?php

namespace Database\Factories;

use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StoreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Store::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $company = $this->faker->unique()->company;

        return [
            'id' => $this->faker->unique()->uuid,
            'owner_id' => User::factory()->create()->id,
            'name' => $company,
            'identifier' => Str::slug($company)
        ];
    }
}

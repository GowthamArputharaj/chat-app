<?php

namespace Database\Factories;

use App\Models\Messages;
use App\Models\User;
use Facade\Ignition\Support\FakeComposer;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessagesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Messages::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $sent_id = rand(1, 5);
        $sent_by = User::find($sent_id)->name;
        $faker = Faker::create();
        return [
            'sent_id' => $sent_id,
            'sent_by' => $sent_by,
            'content' => $faker->text(30),
        ];

    }
}

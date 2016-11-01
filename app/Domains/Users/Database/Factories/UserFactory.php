<?php

namespace LaravelApi\Domains\Users\Database\Factories;

use LaravelApi\Core\Database\ModelFactory;
use LaravelApi\Domains\Users\Models\User;

class UserFactory extends ModelFactory
{
    protected $model = User::class;

    public function fields()
    {
        static $password;

        $fields = [
            'name'           => $this->faker->name,
            'email'          => $this->faker->safeEmail,
            'password'       => $password ?: $password = bcrypt('secret'),
            'remember_token' => str_random(10),
        ];

        return $fields;
    }
}
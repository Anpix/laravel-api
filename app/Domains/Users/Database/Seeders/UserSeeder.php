<?php

namespace LaravelApi\Domains\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use LaravelApi\Domains\Users\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        factory(User::class)
            ->create()
            ->times(5);
    }
}
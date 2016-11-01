<?php

namespace LaravelApi\Domains\Users\Providers;

use LaravelApi\Core\Domain\ServiceProvider;
use LaravelApi\Domains\Users\Database\Factories\UserFactory;
use LaravelApi\Domains\Users\Database\Migrations\CreatePasswordResetsTable;
use LaravelApi\Domains\Users\Database\Migrations\CreateUsersTable;
use LaravelApi\Domains\Users\Database\Seeders\UserSeeder;

class DomainServiceProvider extends ServiceProvider
{
    protected $alias = 'users';

    protected $migrations = [
        CreateUsersTable::class,
        CreatePasswordResetsTable::class,
    ];

    protected $factories = [
        UserFactory::class,
    ];

    protected $seeders = [
        UserSeeder::class,
    ];
}
<?php

namespace LaravelApi\Units\Auth\Providers;

use LaravelApi\Core\Unit\ServiceProvider;

class UnitServiceProvider extends ServiceProvider
{
    protected $alias = 'auth';

    protected $providers = [
        AuthServiceProvider::class,
        EventServiceProvider::class,
        RouteServiceProvider::class,
    ];
}
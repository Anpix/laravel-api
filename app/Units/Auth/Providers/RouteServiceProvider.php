<?php

namespace LaravelApi\Units\Auth\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use LaravelApi\Units\Auth\Http\Routes\Api;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'LaravelApi\Units\Auth\Http\Controllers';

    public function map()
    {
        $this->mapApiRoutes();
    }

    protected function mapApiRoutes()
    {
        $options = [
            'middleware' => 'api',
            'namespace' => $this->namespace,
        ];

        (new Api($options))->register();
    }
}
<?php

namespace LaravelApi\Units\Auth\Http\Routes;

use Illuminate\Http\Request;
use LaravelApi\Core\Unit\Http\Router;

class Api extends Router
{
    public function routes()
    {
        $this->registerDefaultRoutes();
        $this->registerV1Routes();
    }

    protected function registerDefaultRoutes()
    {
        // user routes
        $this->router->get('user', function (Request $request) {
            return $request->user();
        });

        // login routes
        $this->router->post('login', 'LoginController@login');

        // sign up routes
        $this->router->post('register', 'RegisterController@register');
    }

    protected function registerV1Routes()
    {
        $options = ['prefix' => 'v1'];
        $this->router->group($options, function () {
            $this->registerDefaultRoutes();
        });
    }
}
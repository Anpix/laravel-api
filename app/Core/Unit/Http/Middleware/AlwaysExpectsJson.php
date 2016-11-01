<?php

namespace LaravelApi\Core\Unit\Http\Middleware;

use Illuminate\Http\Request;

class AlwaysExpectsJson
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, \Closure $next)
    {
        $options = ['Accept' => 'application/json'];

        $request->headers->add($options);

        return $next($request);
    }
}
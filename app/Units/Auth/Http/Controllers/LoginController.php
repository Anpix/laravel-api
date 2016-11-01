<?php

namespace LaravelApi\Units\Auth\Http\Controllers;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Lang;
use LaravelApi\Core\Unit\Http\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;

class LoginController extends Controller
{
    use ThrottlesLogins;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = $request->only('email', 'password');

        try {
            if (! $token = app('tymon.jwt.auth')->attempt($credentials)) {
                $this->incrementLoginAttempts($request);

                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            $this->incrementLoginAttempts($request);

            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));
    }

    /**
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    /**
     * Redirect the user after determining they are locked out.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );

        $message = Lang::get('auth.throttle', ['seconds' => $seconds]);

        return response()->json(['error' => $message], Response::HTTP_TOO_MANY_REQUESTS);
    }
}

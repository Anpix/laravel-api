<?php

use \Illuminate\Http\Response;
use \LaravelApi\Domains\Users\Models\User;

class ExampleTest extends TestCase
{
    protected $user = [
        'name' => 'Fake User',
        'email' => 'fake@email.test',
        'password' => 'fakepassword',
    ];

    /** @test */
    public function testRegisterWithoutData()
    {
        $this->json('POST', '/register')
            ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->seeJsonEquals([
                'name' => ['The name field is required.'],
                'email' => ['The email field is required.'],
                'password' => ['The password field is required.']
            ]);
    }

    /** @test */
    public function testRegisterWithData()
    {
        $this->json('POST', '/register', $this->user)
            ->seeJsonStructure(['token']);
    }

    public function testRegisterWithExistingEmail()
    {
        $this->json('POST', '/register', $this->user)
            ->seeJsonEquals([
                'email' => ['The email has already been taken.']
            ]);
    }

    /** @test */
    public function testLoginWithoutCredentials()
    {
        $this->json('POST', '/login')
            ->assertResponseStatus(Response::HTTP_UNAUTHORIZED);
    }

    /** @test */
    public function testLoginWithData()
    {
        $fields = collect($this->user)->only('email', 'password');
        $this->json('POST', '/login', $fields->toArray())
            ->seeJsonStructure(['token']);
    }

    /** @test */
    public function testLoginWithWrongCredentials()
    {
        $fields = [
            'email' => 'not@this.email',
            'password' => 'NotThisPassword',
        ];

        $this->json('POST', '/login', $fields)
            ->seeJsonEquals([
                'error' => 'invalid_credentials',
            ]);
    }

    /** @test */
    public function testRequestWithoutAuth()
    {
        $this->json('GET', '/user')
            ->seeJsonEquals([
                'error' => 'Unauthenticated.',
            ]);
    }

    /** @test */
    public function testRequestWithAuth()
    {
        $user = User::where(['email' => $this->user['email']])->first();

        $token = app('tymon.jwt.auth')->fromUser($user);

        $this->json('GET', '/user?token=' . $token)
            ->seeJsonContains([
                'name' => $this->user['name'],
                'email' => $this->user['email']
            ]);

        $user->delete();
    }
}

<?php
namespace App\Tests;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class LoginTest extends ApiTestCase
{
    const API_URL = '127.0.0.1:8000/login';
    const RESIDENT_API_URL = '127.0.0.1:8000/api/residents';

    /**
     * @test
     * Testing login with a valid email and password
     */
    public function TestLoginWithEmail(): void
    {
        $resident = ['email' => 'email@email.com', 'plainPassword' => 'password'];
        static::createClient()->request('POST', self::RESIDENT_API_URL, ['json' => $resident]);


        $loginCredentials = ['username' => 'email@email.com', 'password' => 'password'];
        static::createClient()->request('POST', self::API_URL, ['json' => $loginCredentials]);

        $this->assertResponseStatusCodeSame(200);
        $this->arrayHasKey('token');
    }

    /**
     * @test
     * Testing login with a valid phone and password
     */
    public function TestLoginWithPhone(): void
    {
        $resident = ['phone' => '3064448888', 'plainPassword' => 'password'];
        static::createClient()->request('POST', self::RESIDENT_API_URL, ['json' => $resident]);

        $loginCredentials = ['username' => '3064448888', 'password' => 'password'];
        static::createClient()->request('POST', self::API_URL, ['json' => $loginCredentials]);

        $this->assertResponseStatusCodeSame(200);
        $this->arrayHasKey('token');
    }

    /**
     * @test
     * Testing login with an invalid phone and password
     */
    public function TestInvalidPhone(): void
    {
        $loginCredentials = ['username' => '333', 'password' => 'password'];
        static::createClient()->request('POST', self::API_URL, ['json' => $loginCredentials]);
        $this->assertResponseStatusCodeSame(401);
    }

    /**
     * @test
     * Testing login with an invalid email and password
     */
    public function TestInvalidEmail(): void
    {
        $loginCredentials = ['username' => 'hellotestcom', 'password' => 'password'];
        static::createClient()->request('POST', self::API_URL, ['json' => $loginCredentials]);
        $this->assertResponseStatusCodeSame(401);
    }

    /**
     * @test
     * Testing login with an invalid password
     */
    public function TestInvalidPassword(): void
    {
        $loginCredentials = ['username' => 'email8@email.com', 'password' => 'pass'];
        static::createClient()->request('POST', self::API_URL, ['json' => $loginCredentials]);
        $this->assertResponseStatusCodeSame(401);
    }

    /**
     * @test
     * Testing login with no information entered in
     */
    public function TestInvalidLoginNoInfo(): void
    {
        $loginCredentials = ['username' => '', 'password' => ''];
        static::createClient()->request('POST', self::API_URL, ['json' => $loginCredentials]);
        $this->assertResponseStatusCodeSame(401);
    }
}
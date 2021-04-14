<?php
namespace App\Tests;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class LoginTest extends ApiTestCase
{
    const API_URL = '127.0.0.1:8000/login';

    /**
     * @test
     * Testing login with a valid email and password
     */
    public function TestLoginWithEmail(): void
    {
        $loginCredentials = ['username' => 'email8@email.com', 'password' => 'password'];
        static::createClient()->request('POST', self::API_URL, ['json' => $loginCredentials]);
        $this->assertResponseStatusCodeSame(204);
        $this->assertResponseHasHeader('Set-Cookie', 'PHPSESSID');
        $this->assertJsonContains(['Location' => '/api/residents/8']);
    }

    /**
     * @test
     * Testing login with a valid phone and password
     */
    public function TestLoginWithPhone(): void
    {
        $loginCredentials = ['username' => '3065558888', 'password' => 'password'];
        static::createClient()->request('POST', self::API_URL, ['json' => $loginCredentials]);
        $this->assertResponseStatusCodeSame(204);
        $this->assertResponseHasHeader('Set-Cookie', 'PHPSESSID');
        $this->assertJsonContains(['Location' => '/api/residents/8']);
    }

    /**
     * @test
     * Testing login with an invalid phone and password
     */
    public function TestInvalidPhone(): void
    {
        $loginCredentials = ['username' => '333', 'password' => 'password'];
        static::createClient()->request('POST', self::API_URL, ['json' => $loginCredentials]);
        $this->assertResponseStatusCodeSame(400);
    }

    /**
     * @test
     * Testing login with an invalid email and password
     */
    public function TestInvalidEmail(): void
    {
        $loginCredentials = ['username' => 'hellotestcom', 'password' => 'password'];
        static::createClient()->request('POST', self::API_URL, ['json' => $loginCredentials]);
        $this->assertResponseStatusCodeSame(400);
    }

    /**
     * @test
     * Testing login with an invalid password
     */
    public function TestInvalidPassword(): void
    {
        $loginCredentials = ['username' => 'email8@email.com', 'password' => 'pass'];
        static::createClient()->request('POST', self::API_URL, ['json' => $loginCredentials]);
        $this->assertResponseStatusCodeSame(400);
    }

    /**
     * @test
     * Testing login with no information entered in
     */
    public function TestInvalidLoginNoInfo(): void
    {
        $loginCredentials = ['username' => '', 'password' => ''];
        static::createClient()->request('POST', self::API_URL, ['json' => $loginCredentials]);
        $this->assertResponseStatusCodeSame(400);
    }
}
<?php
namespace App\Tests;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Resident;

class LoginTest extends ApiTestCase
{
    private array $dataArray;
    const VIOLATION_ARRAY=[
        '@context' => '/contexts/ConstraintViolationList',
        '@type' => 'ConstraintViolationList',
        'hydra:title' => 'An error occurred'
    ];

    const API_URL = '127.0.0.1:8000/api/residents';

    /**
     * @before
     */
    public function Setup(): void
    {
        //Setup an array that contains information to create a resident account.
        $this->dataArray = [
            'email' => 'hello@test.com',
            'phone' => '3065558888',
            'password' => 'password',
        ];
    }

    /**
     * @test
     */
    public function TestLoginWithEmail(): void
    {
        $this->dataArray['phone'] = '';
        $response = $response = static::createClient()->request('GET', self::API_URL, ['json' => [
            'email' => 'hello@test.com',
            'phone' => '',
            'password' => 'password',
        ]]);

        $this->assertResponseStatusCodeSame(200);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            '@context' => '/api/contexts/Resident',
            '@type' => 'Resident',
            'email' => 'hello@test.com',
            'phone' => '3065558888',
            'password' => 'password',
        ]);
        $this->assertMatchesRegularExpression('~^/api/residents/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(Resident::class);
    }

    /**
     * @test
     */
    public function TestLoginWithPhone(): void
    {
        $this->dataArray['email'] = '';
        $response = $response = static::createClient()->request('GET', self::API_URL, ['json' => [
            'email' => '',
            'phone' => '3065558888',
            'password' => 'password',
        ]]);

        $this->assertResponseStatusCodeSame(200);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            '@context' => '/api/contexts/Resident',
            '@type' => 'Resident',
            'email' => 'hello@test.com',
            'phone' => '3065558888',
            'password' => 'password',
        ]);
        $this->assertMatchesRegularExpression('~^/api/residents/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(Resident::class);
    }

    /**
     * @test
     */
    public function TestInvalidPhone(): void
    {
        $this->dataArray['email'] = '';
        $this->dataArray['phone'] = '333';
        $response = $response = static::createClient()->request('GET', self::API_URL, ['json' => [
            'email' => '',
            'phone' => '333',
            'password' => 'password',
        ]]);

        $this->assertResponseStatusCodeSame(404);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            '@context' => '/api/contexts/Resident',
            '@type' => 'Resident',
            'email' => 'hello@test.com',
            'phone' => '3065558888',
            'password' => 'password',
        ]);
        $this->assertMatchesRegularExpression('~^/api/residents/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(Resident::class);
    }

    /**
     * @test
     */
    public function TestInvalidEmail(): void
    {
        $this->dataArray['phone'] = '';
        $this->dataArray['email'] = 'hellotestcom';
        $response = $response = static::createClient()->request('GET', self::API_URL, ['json' => [
            'email' => 'hellotestcom',
            'phone' => '',
            'password' => 'password',
        ]]);

        $this->assertResponseStatusCodeSame(404);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            '@context' => '/api/contexts/Resident',
            '@type' => 'Resident',
            'email' => 'hello@test.com',
            'phone' => '3065558888',
            'password' => 'password',
        ]);
        $this->assertMatchesRegularExpression('~^/api/residents/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(Resident::class);
    }

    /**
     * @test
     */
    public function TestInvalidPassword(): void
    {
        $this->dataArray['password'] = 'pass';
        $response = $response = static::createClient()->request('GET', self::API_URL, ['json' => [
            'email' => 'hello@test.com',
            'phone' => '3065558888',
            'password' => 'pass',
        ]]);

        $this->assertResponseStatusCodeSame(404);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            '@context' => '/api/contexts/Resident',
            '@type' => 'Resident',
            'email' => 'hello@test.com',
            'phone' => '3065558888',
            'password' => 'password',
        ]);
        $this->assertMatchesRegularExpression('~^/api/residents/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(Resident::class);
    }

    /**
     * @test
     */
    public function TestInvalidLoginNoInfo(): void
    {
        $this->dataArray['password'] = '';
        $this->dataArray['email'] = '';
        $this->dataArray['phone'] = '';

        $response = $response = static::createClient()->request('GET', self::API_URL, ['json' => [
            'email' => '',
            'phone' => '',
            'password' => '',
        ]]);

        $this->assertResponseStatusCodeSame(404);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            '@context' => '/api/contexts/Resident',
            '@type' => 'Resident',
            'email' => 'hello@test.com',
            'phone' => '3065558888',
            'password' => 'password',
        ]);
        $this->assertMatchesRegularExpression('~^/api/residents/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(Resident::class);
    }

}

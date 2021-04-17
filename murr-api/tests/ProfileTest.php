<?php

 
namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Profile;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

class ProfileTest extends ApiTestCase
{
    use RefreshDatabaseTrait;

    private static $client;
    private array $dataArray;
    const VIOLATION_ARRAY=[
        '@context' => '/contexts/ConstraintViolationList',
        '@type' => 'ConstraintViolationList',
        'hydra:title' => 'An error occurred'
    ];

    const API_URL = '127.0.0.1:8000/api/profiles';

    /**
     * @before
     */
    public function Setup(): void
    {
        //Setup an array that contains information to create a resident profile.
        $this->dataArray = [
            'resident' => 'api/residents/1',
            'firstName' => '',
            'lastName' => '',
            'profilePic' => ''
        ];
    }

    /**
     * @test
     */
    public function TestValidFirstName(): void
    {
        $this->dataArray['firstName'] = 'Tom';
        $response = static::createClient()->request('PUT', self::API_URL . '/1', ['json' => $this->dataArray ]);

        $this->assertResponseStatusCodeSame(200);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            '@context' => '/api/contexts/Profile',
            '@id' => '/api/profiles/1',
            '@type' => 'Profile',
            'id' => 1,
            'resident' => '/api/residents/1',
            'firstName' => 'Tom',
            'lastName' => '',
            'profilePic' => '',
        ]);
        $this->assertMatchesRegularExpression('~^/api/profiles/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(Profile::class);
    }

    /**
     * @test
     */
    public function TestInvalidFirstNameLength(): void
    {
        $this->dataArray['firstName'] = str_repeat('f', 21);
        $response = static::createClient()->request('PUT', self::API_URL . '/1', ['json' => $this->dataArray ]);

        $this->assertResponseStatusCodeSame(422);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context' => '/api/contexts/ConstraintViolationList',
            '@type' => 'ConstraintViolationList',
            'hydra:title' => 'An error occurred',
            'hydra:description' => 'firstName: First Name cannot be longer than 20 characters.'
        ]);
    }

    /**
     * @test
     */
    public function TestValidLastName(): void
    {
        $this->dataArray['lastName'] = 'Andrews';
        $response = static::createClient()->request('PUT', self::API_URL . '/1', ['json' => $this->dataArray ]);

        $this->assertResponseStatusCodeSame(200);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            '@context' => '/api/contexts/Profile',
            '@id' => '/api/profiles/1',
            '@type' => 'Profile',
            'id' => 1,
            'resident' => '/api/residents/1',
            'firstName' => '',
            'lastName' => 'Andrews',
            'profilePic' => '',
        ]);
        $this->assertMatchesRegularExpression('~^/api/profiles/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(Profile::class);
    }

    /**
     * @test
     */
    public function TestInvalidLastNameLength(): void
    {
        $this->dataArray['lastName'] = str_repeat('n', 21);
        $response = static::createClient()->request('PUT', self::API_URL . '/1', ['json' => $this->dataArray ]);

        $this->assertResponseStatusCodeSame(422);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context' => '/api/contexts/ConstraintViolationList',
            '@type' => 'ConstraintViolationList',
            'hydra:title' => 'An error occurred',
            'hydra:description' => 'lastName: Last Name cannot be longer than 20 characters.'
        ]);
    }
}
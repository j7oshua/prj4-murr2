<?php


namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Account;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

class AccountTest extends ApiTestCase
{
    use RefreshDatabaseTrait;

    private static $client;
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
            'residentID' => '1',
            'firstName' => 'Bill',
            'lastName' => 'Jones',
            'profilePic' => ''
        ];
    }

    /**
     * @test
     */
    public function TestValidFirstNamePost(): void
    {
        $response = $response = static::createClient()->request('POST', self::API_URL, ['json' => [
            'firstName' => 'Tom',
        ]]);

        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            'residentID' => '1',
            'firstName' => 'Tom',
            'lastName' => 'Jones',
            'profilePic' => '',
        ]);
        $this->assertMatchesRegularExpression('~^/api/resident/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(Account::class);
    }

    /**
     * @test
     */
    public function TestInvalidFirstNamePost(): void
    {
        $this->dataArray['firstName'] = 'T';
        $response = $response = static::createClient()->request('POST', self::API_URL, ['json' => $this->dataArray ]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context' => '/api/contexts/ConstraintViolationList',
            '@type' => 'ConstraintViolationList',
            'hydra:title' => 'An error occurred',
            'hydra:description' => 'firstName: First Name must be more than 1 character.'
        ]);
    }

    /**
     * @test
     */
    public function TestValidLastNamePost(): void
    {
        $response = $response = static::createClient()->request('POST', self::API_URL, ['json' => [
            'lastName' => 'Andrews',
        ]]);

        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            'residentID' => '1',
            'firstName' => 'Tom',
            'lastName' => 'Andrews',
            'profilePic' => '',
        ]);
        $this->assertMatchesRegularExpression('~^/api/resident/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(Account::class);
    }

    /**
     * @test
     */
    public function TestInvalidLastNamePost(): void
    {
        $this->dataArray['lastName'] = str_repeat('n', 21);
        $response = $response = static::createClient()->request('POST', self::API_URL, ['json' => $this->dataArray ]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context' => '/api/contexts/ConstraintViolationList',
            '@type' => 'ConstraintViolationList',
            'hydra:title' => 'An error occurred',
            'hydra:description' => 'lastName: Last Name cannot be longer than 20 characters.'
        ]);
    }

    /**
     * @test
     */
    public function TestValidPicturePost(): void
    {
        $response = $response = static::createClient()->request('POST', self::API_URL, ['json' => [
            'profilePic' => 'C:\image.jpg',
        ]]);

        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            'residentID' => '1',
            'firstName' => 'Tom',
            'lastName' => 'Andrews',
            'profilePic' => 'C:\image.jpg',
        ]);
        $this->assertMatchesRegularExpression('~^/api/resident/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(Account::class);
    }

    /**
     * @test
     */
    public function TestInvalidPicturePost(): void
    {
        $this->dataArray['profilePic'] = 'C:\image.txt';
        $response = $response = static::createClient()->request('POST', self::API_URL, ['json' => $this->dataArray ]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context' => '/api/contexts/ConstraintViolationList',
            '@type' => 'ConstraintViolationList',
            'hydra:title' => 'An error occurred',
            'hydra:description' => 'profilePic: This file is not a valid image.'
        ]);
    }


    /**
     * @test
     */
    public function TestValidFirstNamePut(): void
    {
        $response = $response = static::createClient()->request('PUT', self::API_URL, ['json' => [
            'firstName' => 'Tom',
        ]]);

        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            'residentID' => '1',
            'firstName' => 'Tom',
            'lastName' => 'Jones',
            'profilePic' => '',
        ]);
        $this->assertMatchesRegularExpression('~^/api/resident/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(Account::class);
    }

    /**
     * @test
     */
    public function TestInvalidFirstNamePut(): void
    {
        $this->dataArray['firstName'] = 'T';
        $response = $response = static::createClient()->request('PUT', self::API_URL, ['json' => $this->dataArray ]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context' => '/api/contexts/ConstraintViolationList',
            '@type' => 'ConstraintViolationList',
            'hydra:title' => 'An error occurred',
            'hydra:description' => 'firstName: First Name must be more than 1 character.'
        ]);
    }

    /**
     * @test
     */
    public function TestValidLastNamePut(): void
    {
        $response = $response = static::createClient()->request('PUT', self::API_URL, ['json' => [
            'lastName' => 'Andrews',
        ]]);

        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            'residentID' => '1',
            'firstName' => 'Tom',
            'lastName' => 'Andrews',
            'profilePic' => '',
        ]);
        $this->assertMatchesRegularExpression('~^/api/resident/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(Account::class);
    }

    /**
     * @test
     */
    public function TestInvalidLastNamePut(): void
    {
        $this->dataArray['lastName'] = str_repeat('n', 21);
        $response = $response = static::createClient()->request('PUT', self::API_URL, ['json' => $this->dataArray ]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context' => '/api/contexts/ConstraintViolationList',
            '@type' => 'ConstraintViolationList',
            'hydra:title' => 'An error occurred',
            'hydra:description' => 'lastName: Last Name cannot be longer than 20 characters.'
        ]);
    }

    /**
     * @test
     */
    public function TestValidPicturePut(): void
    {
        $this->dataArray['profilePic'] = 'C:\image.txt';
        $response = $response = static::createClient()->request('PUT', self::API_URL, ['json' => $this->dataArray ]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context' => '/api/contexts/ConstraintViolationList',
            '@type' => 'ConstraintViolationList',
            'hydra:title' => 'An error occurred',
            'hydra:description' => 'profilePic: This file is not a valid image.'
        ]);
    }

    /**
     * @test
     */
    public function TestInvalidPicturePut(): void
    {
        $this->dataArray['profilePic'] = 'C:\image.txt';
        $response = $response = static::createClient()->request('PUT', self::API_URL, ['json' => $this->dataArray ]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context' => '/api/contexts/ConstraintViolationList',
            '@type' => 'ConstraintViolationList',
            'hydra:title' => 'An error occurred',
            'hydra:description' => 'profilePic: This file is not a valid image.'
        ]);
    }
}
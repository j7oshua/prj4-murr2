<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

use App\Entity\ResidentProfile;

class ResidentProfileTest extends ApiTestCase
{
    use RefreshDatabaseTrait;

    private  $client;
    private  $repo;
    private $dataArray;
    const VIOLATION_ARRAY=[
        '@context' => '/contexts/ConstraintViolationList',
        '@type' => 'ConstraintViolationList',
        'hydra:title' => 'An error occurred'
    ];

    const API_URL = 'http://127.0.0.1:8000/api/resident_profiles';

    /**
     * @beforeClass
     */
    public  function setUpBeforeClass()
    {
        self::$client = static::createClient();
        self::$repo = static::$container->get('doctrine')->getRepository(ResidentProfile::class);
    }

    /**
     * @before
     */
    public function setUp(): void
    {
        $this->dataArray = [
            'firstName' => 'John',
            'lastName' => 'Doe',
            'streetAddress' => '123 Street Street',
            'city' => 'Saskatoon',
            'province' => 'SK',
            'postalCode' => 'S0K 2W7',
            'resident' => 2
        ];
    }

    /**
     * @test
     * Test residentProfile creation with valid information
     *
     */
    public function testCreateResidentProfile():void
    {
        $response = self::$client->request('POST', self::API_URL, ['json' => $this->dataArray]);
        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            '@context' => '/contexts/ResidentProfile',
            '@type' => 'ResidentProfile',
            ...$this->dataArray,
        ]);
        $this->assertRegExp('~^/resident_profiles/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(ResidentProfile::class);
    }

   /**
    * @test
    * Boundary test for firstName length by repeating 'a' 21 times
    *
    */
    public  function testCreateResidentProfile_Invalid_firstName_Length():void
    {
        $this->dataArray['firstName'] = str_repeat('a', 21);
        $response = self::$client->request('POST', self::API_URL, ['json' => $this->dataArray ]);
        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            ...self::VIOLATION_ARRAY,
            'hydra:description' => 'firstName: First name must not exceed 20 characters'
        ]);
    }

    /**
     * @test
     * Boundary test for firstName length by repeating 'a' 20 times
     */
    public  function testCreateResidentProfile_Success_firstName_Max_Length():void
    {
        $this->dataArray['firstName'] = str_repeat('a', 0);
        $response = self::$client->request('POST', self::API_URL, ['json' => $this->dataArray ]);
        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context' => '/contexts/ResidentProfile',
            '@type' => 'ResidentProfile',
            ...$this->dataArray,
        ]);
        $this->assertRegExp('~^/resident_profiles/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(ResidentProfile::class);
    }


    /**
     * @test
     * Test for lastName length by repeating 'a' 21 times
     */
    public  function testCreateResidentProfile_Invalid_lastName_Length():void
    {
        $this->dataArray['lastName'] = str_repeat('a', 21);
        $response = self::$client->request('POST', self::API_URL, ['json' => $this->dataArray ]);
        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            ...self::VIOLATION_ARRAY,
            'hydra:description' => 'lastName: Last name must not exceed 20 characters'
        ]);
    }

    /**
     * @test
     * Test for lastName length by repeating 'a' 20 times
     */
    public  function testCreateResidentProfile_Success_lastName_Max_Length():void
    {
        $this->dataArray['lastName'] = str_repeat('a', 20);
        $response = self::$client->request('POST', self::API_URL, ['json' => $this->dataArray ]);
        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context' => '/contexts/ResidentProfile',
            '@type' => 'ResidentProfile',
            ...$this->dataArray,
        ]);
        $this->assertRegExp('~^/resident_profiles/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(ResidentProfile::class);
    }

    /**
     * @test
     * Testing streetAddress boundary by repeating 'a' 51 times
     */
    public  function testCreateResidentProfile_Invalid_streetAddress_Length():void
    {
        $this->dataArray['streetAddress'] = str_repeat('a', 51);
        $response = self::$client->request('POST', self::API_URL, ['json' => $this->dataArray ]);
        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            ...self::VIOLATION_ARRAY,
            'hydra:description' => 'streetAddress: Street address must not exceed 50 characters'
        ]);
    }

    /**
     * @test
     * Testing streetAddress boundary by repeating 'a' 50 times
     */
    public  function testCreateResidentProfile_Success_streetAddress_Max_Length():void
    {
        $this->dataArray['streetAddress'] = str_repeat('a', 50);
        $response = self::$client->request('POST', self::API_URL, ['json' => $this->dataArray ]);
        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context' => '/contexts/ResidentProfile',
            '@type' => 'ResidentProfile',
            ...$this->dataArray,
        ]);
        $this->assertRegExp('~^/resident_profiles/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(ResidentProfile::class);
    }

    /**
     * @test
     * Testing city boundary by repeating 'a' 31 times
     */
    public  function testCreateResidentProfile_Invalid_city_Length():void
    {
        $this->dataArray['city'] = str_repeat('a', 31);
        $response = self::$client->request('POST', self::API_URL, ['json' => $this->dataArray ]);
        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            ...self::VIOLATION_ARRAY,
            'hydra:description' => 'city: City must not exceed 30 characters'
        ]);
    }

    /**
     * @test
     * Testing city boundary by repeating 'a' 30 times
     */
    public  function testCreateResidentProfile_Success_city_Max_Length():void
    {
        $this->dataArray['city'] = str_repeat('a', 30);
        $response = self::$client->request('POST', self::API_URL, ['json' => $this->dataArray ]);
        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context' => '/contexts/ResidentProfile',
            '@type' => 'ResidentProfile',
            ...$this->dataArray,
        ]);
        $this->assertRegExp('~^/resident_profiles/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(ResidentProfile::class);
    }

    /**
     * @test
     * Boundary test for province. province set to 'a' repeated 31 times.
     */
    public  function testCreateResidentProfile_Invalid_province_Length():void
    {
        $this->dataArray['province'] = str_repeat('a', 3);
        $response = self::$client->request('POST', self::API_URL, ['json' => $this->dataArray ]);
        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            ...self::VIOLATION_ARRAY,
            'hydra:description' => 'province: Province Initials must not exceed 2 characters'
        ]);
    }

    /**
     * @test
     *  Boundary test for province. province set to 'a' repeated 30 times.
     */
    public  function testCreateResidentProfile_Success_province_Max_Length():void
    {
        $this->dataArray['province'] = str_repeat('a', 2);
        $response = self::$client->request('POST', self::API_URL, ['json' => $this->dataArray ]);
        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context' => '/contexts/ResidentProfile',
            '@type' => 'ResidentProfile',
            ...$this->dataArray,
        ]);
        $this->assertRegExp('~^/resident_profiles/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(ResidentProfile::class);
    }

    /**
     * @test
     * Testing postalCode pattern (L#L#L#).
     */
    public  function testCreateResidentProfile_Invalid_postalCode_Format():void
    {
        $this->dataArray['postalCode'] = 'SLN2WD';
        $response = self::$client->request('POST', self::API_URL, ['json' => $this->dataArray ]);
        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            ...self::VIOLATION_ARRAY,
            'hydra:description' => 'postalCode: Postal code must follow the format L#L#L#'
        ]);
    }

    /**
     * @test
     * Testing postalCode pattern (L#L#L#).
     */
    public  function testCreateResidentProfile_Success_postalCode_No_Space():void
    {
        $this->dataArray['postalCode'] = 'S0K2W7';
        $response = self::$client->request('POST', self::API_URL, ['json' => $this->dataArray ]);
        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context' => '/contexts/ResidentProfile',
            '@type' => 'ResidentProfile',
            ...$this->dataArray,
        ]);
        $this->assertRegExp('~^/resident_profiles/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(ResidentProfile::class);
    }

    /**
     * @test
     * Testing postalCode pattern (L#L#L# or L#L #L#).
     */
    public  function testCreateResidentProfile_Success_postalCode_With_Space():void
    {
        $this->dataArray['postalCode'] = 'S0K 2W7';
        $response = self::$client->request('POST', self::API_URL, ['json' => $this->dataArray ]);
        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context' => '/contexts/ResidentProfile',
            '@type' => 'ResidentProfile',
            ...$this->dataArray,
        ]);
        $this->assertRegExp('~^/resident_profiles/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(ResidentProfile::class);
    }

    /**
     * @test
     * Test for everything invalid
     */
    public function testCreateResidentProfile_All_Invalid():void
    {
        $this->dataArray['firstName'] = str_repeat('a', 21);
        $this->dataArray['lastName'] = str_repeat('a', 21);
        $this->dataArray['streetAddress'] = str_repeat('a', 51);
        $this->dataArray['city'] = str_repeat('a', 31);
        $this->dataArray['province'] = str_repeat('a', 3);
        $this->dataArray['postalCode'] = 'SLN2WD';
        $response = self::$client->request('POST', self::API_URL, ['json' => $this->dataArray ]);
        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            ...self::VIOLATION_ARRAY,
            'hydra:description' => 'firstName: First name must not exceed 20 characters',
            'lastName: Last name must not exceed 20 characters',
            'streetAddress: Street address must not exceed 50 characters',
            'city: City must not exceed 50 characters',
            'province: Province must not exceed 30 characters',
            'postalCode: Postal code must follow the format L#L#L#'

        ]);
    }



}
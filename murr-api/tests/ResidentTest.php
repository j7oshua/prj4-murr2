<?php


namespace App\Tests;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;
use App\Entity\Resident;

class ResidentTest extends ApiTestCase
{
    use RefreshDatabaseTrait;

    private static $client;
    private static $repo;
    private $dataArray;
    const VIOLATION_ARRAY=[
        '@context' => '/contexts/ConstraintViolationList',
        '@type' => 'ConstraintViolationList',
        'hydra:title' => 'An error occurred'
    ];

    const API_URL = '127.0.0.1:8000/api/residents';

    /**
     * @beforeClass
     */
    public static function setUpBeforeClass()
    {
        self::$client = static::createClient();
        self::$repo = static::$container->get('doctrine')->getRepository(Resident::class);
    }

    /**
     * @before
     */
    public function setUp(): void
    {
        $this->dataArray = [
          'email' => 'test@hello.com',
          'phone' => '3333333333',
          'password' => 'password@1'
        ];
    }

    /**
     * @test
     */
    public function testCreateResidentAccount(): void
    {
        $response = self::$client->request('POST', self::API_URL, ['json' => $this->dataArray]);

        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            '@context' => '/contexts/Resident',
            '@type' => 'Resident',
            ...$this->dataArray,
        ]);
        $this->assertRegExp('~^/residents/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(Resident::class);
    }

    /**
     * @test
     */
    public function testCreateResidentAccount_Success_No_Email(): void
    {
        unset($this->dataArray['email']);
        $response = self::$client->request('POST', self::API_URL, ['json' => $this->dataArray]);

        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            '@context' => '/contexts/Resident',
            '@type' => 'Resident',
            ...$this->dataArray,
        ]);
        $this->assertRegExp('~^/residents/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(Resident::class);
    }

    /**
     * @test
     */
    public function testCreateResidentAccount_Invalid_Email_Format(): void
    {
        $this->dataArray['email'] = 'hellotestcom';
        $response = self::$client->request('POST', self::API_URL, ['json' => $this->dataArray ]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            ...self::VIOLATION_ARRAY,
            'hydra:description' => 'email: The email is not a valid email.'
        ]);

    }

    /**
     * @test
     */
    public function testCreateResidentAccount_Invalid_Email_Over_150Characters(): void
    {
        $this->dataArray['email'] = 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa@test.com';
        $response = self::$client->request('POST', self::API_URL, ['json' => $this->dataArray ]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            ...self::VIOLATION_ARRAY,
            'hydra:description' => 'email: The email has too many characters.'
        ]);

    }

    /**
     * @test
     */
    public function testCreateResidentAccount_Success_No_phoneNumber(): void
    {
        unset($this->dataArray['phone']);
        $response = self::$client->request('POST', self::API_URL, ['json' => $this->dataArray]);

        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            '@context' => '/contexts/Resident',
            '@type' => 'Resident',
            ...$this->dataArray,
        ]);
        $this->assertRegExp('~^/residents/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(Resident::class);
    }

    /**
     * @test
     */
    public function testCreateResidentAccount_Invalid_Phone_Under_10Characters(): void
    {
        $this->dataArray['phone'] = '333333333';
        $response = self::$client->request('POST', self::API_URL, ['json' => $this->dataArray ]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            ...self::VIOLATION_ARRAY,
            'hydra:description' => 'phone: Phone Number has less than 10 digits.'
        ]);

    }

    /**
     * @test
     */
    public function testCreateResidentAccount_Invalid_Phone_Over_10Characters(): void
    {
        $this->dataArray['phone'] = '33333333333';
        $response = self::$client->request('POST', self::API_URL, ['json' => $this->dataArray ]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            ...self::VIOLATION_ARRAY,
            'hydra:description' => 'phone: Phone Number has more than 10 digits.'
        ]);

    }

    /**
     * @test
     */
    public function testCreateResidentAccount_Invalid_Password_Over_30Characters(): void
    {
        $this->dataArray['password'] = 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
        $response = self::$client->request('POST', self::API_URL, ['json' => $this->dataArray ]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            ...self::VIOLATION_ARRAY,
            'hydra:description' => 'password: Password has more than 30 characters.'
        ]);

    }

    /**
     * @test
     */
    public function testCreateResidentAccount_Invalid_Email_Phone_Empty(): void
    {
        //***Need to create a custom validator for this test***
        unset($this->dataArray['email']);
        unset($this->dataArray['phone']);
        $response = self::$client->request('POST', self::API_URL, ['json' => $this->dataArray ]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            ...self::VIOLATION_ARRAY,
            'hydra:description' => 'phone & email: Phone and Email should not be blank.'
        ]);
    }

    /**
     * @test
     */
    public function testCreateResidentAccount_Invalid_Password_Empty(): void
    {

        unset($this->dataArray['password']);
        $response = self::$client->request('POST', self::API_URL, ['json' => $this->dataArray ]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            ...self::VIOLATION_ARRAY,
            'hydra:description' => 'password: Password should not be blank.'
        ]);
    }

}
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
    public static function SetupBeforeClass()
    {
        self::$client = static::createClient();
        self::$repo = static::$container->get('murr')->getRepository(Resident::class);
    }

    /**
     * @before
     */
    public function Setup(): void
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
    public function TestCreateResidentAccount(): void
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
    public function TestCreateResidentAccountSuccessNoEmail(): void
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
    public function TestCreateResidentAccountInvalidEmailFormat(): void
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
    public function TestCreateResidentAccountInvalidEmailOver150Characters(): void
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
    public function TestCreateResidentAccountSuccessNoPhoneNumber(): void
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
    public function TestCreateResidentAccountInvalidPhoneUnder10Digits(): void
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
    public function TestCreateResidentAccountInvalidPhoneOver10Digits(): void
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
    public function TestCreateResidentAccountInvalidPasswordOver30Characters(): void
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
    public function TestCreateResidentAccountInvalidEmailPhoneEmpty(): void
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
    public function TestCreateResidentAccountInvalidPasswordEmpty(): void
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
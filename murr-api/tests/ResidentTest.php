<?php


namespace App\Tests;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Resident;

class ResidentTest extends ApiTestCase
{
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
            'email' => 'hello@test.com',
            'phone' => '3333333333',
            'password' => '#4hs&3j2h',
        ];
    }

    /**
     * @test
     */
    public function TestCreateResidentAccount(): void
    {
        $response = $response = static::createClient()->request('POST', self::API_URL, ['json' => [
            'email' => 'hello@test.com',
            'phone' => '3333333333',
            'password' => '#4hs&3j2h',
        ]]);

        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            '@context' => '/api/contexts/Resident',
            '@type' => 'Resident',
            'email' => 'hello@test.com',
            'phone' => '3333333333',
            'password' => '#4hs&3j2h',
        ]);
        $this->assertMatchesRegularExpression('~^/api/residents/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(Resident::class);
    }


    /**
     * @test
     */
    public function TestCreateResidentAccountSuccessNoEmail(): void
    {
        $response = $response = static::createClient()->request('POST', self::API_URL, ['json' => [
            'email' => '',
            'phone' => '3333333333',
            'password' => '#4hs&3j2h',
        ]]);

        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            '@context' => '/api/contexts/Resident',
            '@type' => 'Resident',
            'email' => '',
            'phone' => '3333333333',
            'password' => '#4hs&3j2h',
        ]);
        $this->assertMatchesRegularExpression('~^/api/residents/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(Resident::class);

    }

    /**
     * @test
     */
    public function TestCreateResidentAccountSuccessNoPhoneNumber(): void
    {
        $response = static::createClient()->request('POST', self::API_URL, ['json' => [
            'email' => 'hello@test.com',
            'phone' => '',
            'password' => '#4hs&3j2h',
        ]]);

        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            '@context' => '/api/contexts/Resident',
            '@type' => 'Resident',
            'email' => 'hello@test.com',
            'phone' => '',
            'password' => '#4hs&3j2h',
        ]);
        $this->assertMatchesRegularExpression('~^/api/residents/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(Resident::class);
    }

    /**
     * @test
     */
    public function TestCreateResidentAccountInvalidEmailFormat(): void
    {
        $this->dataArray['email'] = 'hellotestcom';
        $response = $response = static::createClient()->request('POST', self::API_URL, ['json' => $this->dataArray ]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context' => '/api/contexts/ConstraintViolationList',
            '@type' => 'ConstraintViolationList',
            'hydra:title' => 'An error occurred',
            'hydra:description' => 'email: The email is not a valid email.'
        ]);
    }

    /**
     * @test
     */
    public function TestCreateResidentAccountInvalidEmailOver150Characters(): void
    {
        $this->dataArray['email'] = str_repeat('a', 142) . '@test.com';
        $response = $response = static::createClient()->request('POST', self::API_URL, ['json' => $this->dataArray ]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context' => '/api/contexts/ConstraintViolationList',
            '@type' => 'ConstraintViolationList',
            'hydra:title' => 'An error occurred',
            'hydra:description' => 'email: Email has more than 150 characters.'
        ]);

        $this->dataArray['email'] = 'hello@test.com';
    }

    /**
     * @test
     */
    public function TestCreateResidentAccountValidEmail150Characters(): void
    {
        $this->dataArray['email'] = str_repeat('a', 141) . '@test.com';
        $response = $response = static::createClient()->request('POST', self::API_URL, ['json' => $this->dataArray ]);

        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context' => '/api/contexts/Resident',
            '@type' => 'Resident',
            'email' => str_repeat('a', 141).'@test.com',
            'phone' => '3333333333',
            'password' => '#4hs&3j2h',
        ]);
        $this->assertMatchesRegularExpression('~^/api/residents/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(Resident::class);

        $this->dataArray['email'] = 'hello@test.com';
    }



    /**
     * @test
     */
    public function TestCreateResidentAccountInvalidPhoneUnder10Digits(): void
    {
        $this->dataArray['phone'] = str_repeat('3', 9);
        $response = static::createClient()->request('POST', self::API_URL, ['json' => $this->dataArray ]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context' => '/api/contexts/ConstraintViolationList',
            '@type' => 'ConstraintViolationList',
            'hydra:title' => 'An error occurred',
            'hydra:description' => 'phone: Phone needs to be 10 digits.'
        ]);

    }

    /**
     * @test
     */
    public function TestCreateResidentAccountInvalidPhoneOver10Digits(): void
    {
        $this->dataArray['phone'] = str_repeat('3',11);
        $response = static::createClient()->request('POST', self::API_URL, ['json' => $this->dataArray ]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context' => '/api/contexts/ConstraintViolationList',
            '@type' => 'ConstraintViolationList',
            'hydra:title' => 'An error occurred',
            'hydra:description' => 'phone: Phone needs to be 10 digits.'
        ]);

        $this->dataArray['phone'] = str_repeat('3',10);

    }

    /**
     * @test
     */
    public function TestCreateResidentAccountInvalidPasswordOver30Characters(): void
    {
        $this->dataArray['password'] = str_repeat('a', 31);
        $response = static::createClient()->request('POST', self::API_URL, ['json' => $this->dataArray ]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context' => '/api/contexts/ConstraintViolationList',
            '@type' => 'ConstraintViolationList',
            'hydra:title' => 'An error occurred',
            'hydra:description' => 'password: Password has to be 30 characters or less.'
        ]);

    }

    /**
     * @test
     */
    public function TestCreateResidentAccountInvalidPasswordLessThan7Characters(): void
    {
        $this->dataArray['password'] = str_repeat('a', 6);
        $response = static::createClient()->request('POST', self::API_URL, ['json' => $this->dataArray ]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context' => '/api/contexts/ConstraintViolationList',
            '@type' => 'ConstraintViolationList',
            'hydra:title' => 'An error occurred',
            'hydra:description' => 'password: Password has to be at least 7 characters.'
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

        $response = static::createClient()->request('POST', self::API_URL, ['json' => $this->dataArray ]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context' => '/api/contexts/ConstraintViolationList',
            '@type' => 'ConstraintViolationList',
            'hydra:title' => 'An error occurred',
            "violations" => [
                ["propertyPath" => "email",
                    "message" => "Phone and Email cannot be both left blank. Only one is required."],
                ["propertyPath" => "phone",
                    "message" => "Phone and Email cannot be both left blank. Only one is required."],
            ]
        ]);
    }



    /**
     * @test
     */
    public function TestCreateResidentAccountInvalidPasswordEmpty(): void
    {

        unset($this->dataArray['password']);
        $response = static::createClient()->request('POST', self::API_URL, ['json' => $this->dataArray ]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context' => '/api/contexts/ConstraintViolationList',
            '@type' => 'ConstraintViolationList',
            'hydra:title' => 'An error occurred',
            'hydra:description' => 'password: Password should not be left blank.',
        ]);
    }

}
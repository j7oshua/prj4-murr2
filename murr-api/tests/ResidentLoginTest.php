<?php


namespace App\Tests;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Resident;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;


class ResidentLoginTest
{
    // TODO Will have to add tests for security per Wade's suggestion
    use RefreshDatabaseTrait;
    const API_URL = '127.0.0.1:8000/login';

    private array $dataArray;

    /**
     * @before
     * Setup the dataArray to be used for the test
     */
    public function Setup(): void
    {
        $this->dataArray = [
            'loginInfo' => 'email8@email.com',
            'password' => 'password'
        ];
    }

    /**
     * @test
     * Purpose: This test will check if the API will return the object and a status code of 200 using a phone and password.
     * Expected Result: Success -- Response Code 200
     * Return JSONLD resident
    */
    public function testResidentLoginSuccessfulWithAPhoneAndPassword()
    {
        $this->dataArray['loginInfo'] = '3065558888';
        static::creatClient()->request('GET', self::API_URL, ['json' => $this->dataArray]);
        $this->assertResponseStatusCodeSame(200);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            '@context' => '/api/contexts/Resident',
            '@type' => 'Resident',
            'phone' => '3065558888',
            'password' => 'password'
        ]);
        $this->assertMatchesResourceItemJsonSchema(Resident::class);
    }

    /**
     * @test
     * Purpose: This test will check if the API will return the object and a status code of 200 using an email and password.
     * Expected Result: Success -- Response Code 200
     * Return JSONLD resident
     */
    public function testResidentLoginSuccessfulWithAnEmailAndPassword()
    {
        $this->dataArray['loginInfo'] = 'email8@email.com';
        static::creatClient()->request('GET', self::API_URL, ['json' => $this->dataArray]);
        $this->assertResponseStatusCodeSame(200);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            '@context' => '/api/contexts/Resident',
            '@type' => 'Resident',
            'email' => 'email8@email.com',
            'password' => 'password'
        ]);
        $this->assertMatchesResourceItemJsonSchema(Resident::class);
    }

    /**
     * @test
     * Purpose: This test will check if the API will return the a status code of 404 when the password is valid and the loginInfo is invalid
     * Expected Result -- Response Code 404
     * Return: Invalid Login: Fields do not match
     */
    public function testResidentLoginInvalidLoginInfoPhone()
    {
        $this->dataArray['loginInfo'] = '333';
        static::creatClient()->request('GET', self::API_URL, ['json' => $this->dataArray]);
        $this->assertResponseStatusCodeSame(404);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            '@context' => '/api/contexts/ConstraintViolationList',
            '@type' => 'ConstraintViolationList',
            'hydra:title' => 'An error occurred',
            'hydra:description' => 'Invalid Login: Fields do not match'
        ]);
    }

    /**
     * @test
     * Purpose: This test will check if the API will return the a status code of 404 when the password is valid and the loginInfo is invalid
     * Expected Result -- Response Code 404
     * Return: Invalid Login: Fields do not match
     */
    public function testResidentLoginInvalidLoginInfoEmail()
    {
        $this->dataArray['loginInfo'] = 'hellotestcom';
        static::creatClient()->request('GET', self::API_URL, ['json' => $this->dataArray]);
        $this->assertResponseStatusCodeSame(404);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            '@context' => '/api/contexts/ConstraintViolationList',
            '@type' => 'ConstraintViolationList',
            'hydra:title' => 'An error occurred',
            'hydra:description' => 'Invalid Login: Fields do not match'
        ]);
    }

    /**
     * @test
     * Purpose: This test will check if the API will return the a status code of 404 when the password is invalid and the loginInfo is valid
     * Expected Result -- Response Code 404
     * Return: Invalid Login: Fields do not match
     */
    public function testResidentLoginInvalidLoginInfo()
    {
        $this->dataArray['password'] = 'passw';
        static::creatClient()->request('GET', self::API_URL, ['json' => $this->dataArray]);
        $this->assertResponseStatusCodeSame(404);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            '@context' => '/api/contexts/ConstraintViolationList',
            '@type' => 'ConstraintViolationList',
            'hydra:title' => 'An error occurred',
            'hydra:description' => 'Invalid Login: Fields do not match'
        ]);
    }

    /**
     * @test
     * Purpose: This test will check if the API will return the a status code of 404 when the password is valid and the loginInfo is an empty string
     * Expected Result -- Response Code 404
     * Return: Invalid Login: Fields do not match
     */
    public function testResidentLoginOnlyPassword()
    {
        $this->dataArray['loginInfo'] = '';
        static::creatClient()->request('GET', self::API_URL, ['json' => $this->dataArray]);
        $this->assertResponseStatusCodeSame(404);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            '@context' => '/api/contexts/ConstraintViolationList',
            '@type' => 'ConstraintViolationList',
            'hydra:title' => 'An error occurred',
            'hydra:description' => 'Invalid Login: Fields do not match'
        ]);
    }

    /**
     * @test
     * Purpose: This test will check if the API will return the a status code of 404 when the password is empty and the loginInfo is empty
     * Expected Result -- Response Code 404
     * Return: Invalid Login: Fields do not match
     */
    public function testResidentLoginEmptyLoginInfoAndEmptyPassword()
    {
        $this->dataArray['password'] = '';
        $this->dataArray['loginInfo'] = '';
        static::creatClient()->request('GET', self::API_URL, ['json' => $this->dataArray]);
        $this->assertResponseStatusCodeSame(404);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            '@context' => '/api/contexts/ConstraintViolationList',
            '@type' => 'ConstraintViolationList',
            'hydra:title' => 'An error occurred',
            'hydra:description' => 'Invalid Login: Fields do not match'
        ]);
    }

    /**
     * @test
     * Purpose: This test will check if the API will return the a status code of 404 when the password is empty and the loginInfo is valid
     * Expected Result -- Response Code 404
     * Return: Invalid Login: Fields do not match
     */
    public function testResidentLoginValidEmailEmptyPassword()
    {
        $this->dataArray['password'] = '';
        static::creatClient()->request('GET', self::API_URL, ['json' => $this->dataArray]);
        $this->assertResponseStatusCodeSame(404);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            '@context' => '/api/contexts/ConstraintViolationList',
            '@type' => 'ConstraintViolationList',
            'hydra:title' => 'An error occurred',
            'hydra:description' => 'Invalid Login: Fields do not match'
        ]);
    }

    /**
     * @test
     * Purpose: This test will check if the API will return the a status code of 404 when the password is empty and the loginInfo is valid
     * Expected Result -- Response Code 404
     * Return: Invalid Login: Fields do not match
     */
    public function testResidentLoginValidPhoneAndEmptyPassword()
    {
        $this->dataArray['password'] = '';

        static::creatClient()->request('GET', self::API_URL, ['json' => $this->dataArray]);
        $this->assertResponseStatusCodeSame(404);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            '@context' => '/api/contexts/ConstraintViolationList',
            '@type' => 'ConstraintViolationList',
            'hydra:title' => 'An error occurred',
            'hydra:description' => 'Invalid Login: Fields do not match'
        ]);
    }


}
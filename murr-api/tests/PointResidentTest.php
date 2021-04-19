<?php
namespace App\Tests;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;
class PointResidentTest extends ApiTestCase
{
    use RefreshDatabaseTrait;

    const API_URL_6 = '127.0.0.1:8000/cusapi/points/6';
    const API_URL_7 = '127.0.0.1:8000/cusapi/points/7';
    const API_URL_8 = '127.0.0.1:8000/cusapi/points/8';
    const API_URL_NO_ID = '127.0.0.1:8000/cusapi/points/-1';
    const API_URL_LOGIN = '127.0.0.1:8000/login';

    /**
     * Purpose: This test will check if API gets 1000 points for resident with an id of 6
     * Expected Result: Success -- Status Response 200
     * Return: JSON of number of points
     */
    public function testResidentWithOneThousandPoints()
    {
        $client = self::createClient();

        $response = $client->request('POST', self::API_URL_LOGIN, [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [
                'username' => 'email6@email.com',
                'password' => 'password'
            ],
        ]);

        $content = $response->getContent();
        $getToken = json_decode($content);
        $token = $getToken->{'token'};

        static::createClient()->request('GET', self::API_URL_6, ['headers' => ['Authorization' => 'Bearer ' . $token]]);
        $this->assertResponseStatusCodeSame(200);
        $this->assertJsonContains([
            'content' => '1000'
        ]);
    }

    /**
     * Purpose: This test will check if API gets 80 points for resident with an id of 7
     *          from two transactions
     * Expected Result: Success -- Status Response 200
     * Return: JSON of number of points
     */
    public function testResidentWithSumPointsOfEighty()
    {
        $client = self::createClient();

        $response = $client->request('POST', self::API_URL_LOGIN, [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [
                'username' => '3065557777',
                'password' => 'password'
            ],
        ]);

        $content = $response->getContent();
        $getToken = json_decode($content);
        $token = $getToken->{'token'};

        static::createClient()->request('GET', self::API_URL_7, ['headers' => ['Authorization' => 'Bearer ' . $token]]);
        $this->assertResponseStatusCodeSame(200);
        $this->assertJsonContains([
            'content' => '80'
        ]);
    }

    /**
     * Purpose: This test will check if API gets 0 points for resident with an id of 8
     * Expected Result: Success -- Status Response 200
     * Return: JSON of number of points
     */
    public function testResidentWithZeroPoints(): void
    {
        $client = self::createClient();

        $response = $client->request('POST', self::API_URL_LOGIN, [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [
                'username' => 'email8@email.com',
                'password' => 'password'
            ],
        ]);

        $content = $response->getContent();
        $getToken = json_decode($content);
        $token = $getToken->{'token'};

        static::createClient()->request('GET', self::API_URL_8, ['headers' => ['Authorization' => 'Bearer ' . $token]]);
        $this->assertResponseStatusCodeSame(200);
        $this->assertJsonContains([
            'content' => '0'
        ]);
    }

    /**
     * Purpose: This test will check if API gets points for resident who does not exist in the system
     * Expected Result: Failure -- Status Response 404
     * Return: null
     */
    public function testResidentWithNoResidentID(): void
    {
        static::createClient()->request('GET', self::API_URL_NO_ID);
        $this->assertResponseStatusCodeSame(401);
    }
}








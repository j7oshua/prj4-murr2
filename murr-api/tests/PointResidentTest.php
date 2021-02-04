<?php
namespace App\Tests;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;
class PointResidentTest extends ApiTestCase
{
    use RefreshDatabaseTrait;

    const API_URL_6 = '127.0.0.1:8000/point/resident/6';
    const API_URL_7 = '127.0.0.1:8000/point/resident/7';
    const API_URL_8 = '127.0.0.1:8000/point/resident/8';
    const API_URL_NO_ID = '127.0.0.1:8000/point/resident/-1';

    /**
     * Purpose: This test will check if API gets 1000 points for resident with an id of 6
     * Expected Result: Success -- Status Response 200
     * Return: JSON of number of points
     */
    public function testResidentWithOneThousandPoints()
    {
        static::createClient()->request('GET', self::API_URL_6);
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
        static::createClient()->request('GET', self::API_URL_7);
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
        static::createClient()->request('GET', self::API_URL_8);
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
        $this->assertResponseStatusCodeSame(404);
    }
}








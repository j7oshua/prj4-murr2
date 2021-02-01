<?php
namespace App\Tests;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;
class PointResidentTest extends ApiTestCase
{
    use RefreshDatabaseTrait;
    const API_URL_1 = '127.0.0.1:8000/point/resident/1';
    const API_URL_2 = '127.0.0.1:8000/point/resident/2';
    const API_URL_3 = '127.0.0.1:8000/point/resident/3';
    const API_URL_NO_ID = '127.0.0.1:8000/point/resident/-1';

    /**
     * Purpose: This test will check if API gets 0 points for resident with an id of 1
     * Expected Result: Success -- Status Response 200
     * Return: JSON of number of points
     */
    public function testPointForResidentOne(): void
    {
        static::createClient()->request('GET', self::API_URL_1);
        $this->assertResponseStatusCodeSame(200);
        $this->assertJsonContains([
            'content' => '0'
        ]);
    }

    /**
     * Purpose: This test will check if API gets 3 points for resident with an id of 2
     * Expected Result: Success -- Status Response 200
     * Return: JSON of number of points
     */
    public function testUserWithThreePoints()
    {
        static::createClient()->request('GET', self::API_URL_2);
        $this->assertJsonContains([
            'content' => '3'
        ]);
    }

    /**
     * Purpose: This test will check if API gets 80 points for resident with an id of 3
     *  from two transactions
     * Expected Result: Success -- Status Response 200
     * Return: JSON of number of points
     */
    public function testUserWithEightyPoints()
    {
        static::createClient()->request('GET', self::API_URL_3);
        $this->assertResponseStatusCodeSame(200);
        $this->assertJsonContains([
            'content' => '80'
        ]);
    }

    /**
     * Purpose: This test will check if API gets points for resident who does not exist in the system
     * Expected Result: Failure -- Status Response 404
     * Return: null
     */
    public function testUserWithNoResidentID(): void
    {
        static::createClient()->request('GET', self::API_URL_NO_ID);
        $this->assertResponseStatusCodeSame(404);
    }
}








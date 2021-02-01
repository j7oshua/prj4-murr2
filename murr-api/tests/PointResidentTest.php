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
     * API successfully gets point information for zero points and residentid 1
     */
    public function testPointForResidentOne(): void
    {
        $response = static::createClient()->request('GET', self::API_URL_1);
        $this->assertResponseStatusCodeSame(200);
        $this->assertJsonContains([
            'content' => '0'
        ]);
    }
    /**
     * API successfully gets point information for three points and residentid 2
     */
    public function testUserWithThreePoints()
    {
        $response = static::createClient()->request('GET', self::API_URL_2);
        $this->assertJsonContains([
            'content' => '3'
        ]);
    }
    /**
     * API successfully gets point information for eighty points and residentid 3
     */
    public function testUserWithEightyPoints()
    {
        $response = static::createClient()->request('GET', self::API_URL_3);
        $this->assertResponseStatusCodeSame(200);
        $this->assertJsonContains([
            'content' => '80'
        ]);
    }
    /**
     * API Fails to gets point information for  residentid -1
     */
    public function testUserWithNoResidentID(): void
    {
        $response = static::createClient()->request('GET', self::API_URL_NO_ID);
        $this->assertResponseStatusCodeSame(404);
    }
}








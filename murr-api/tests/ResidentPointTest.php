<?php

namespace App\Tests;


use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

class ResidentPointTest extends ApiTestCase
{
    use RefreshDatabaseTrait;

    const API_URL_1 = '127.0.0.1:8000/resident/point/1';
    const API_URL_2 = '127.0.0.1:8000/resident/point/2';
    const API_URL_3 = '127.0.0.1:8000/resident/point/3';
    const API_URL_NO_ID = '127.0.0.1:8000/resident/point/-1';




    /**
     *
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
     *
     */
    public function testUserWithThreePoints()
    {
        $response = static::createClient()->request('GET', self::API_URL_2);

        $this->assertJsonContains([
            'content' => '3'
        ]);
    }

    /**
     *
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
     *
     */
    public function testUserWithNoResidentID(): void
    {

        $response = static::createClient()->request('GET', self::API_URL_NO_ID);

        $this->assertResponseStatusCodeSame(404);

    }
}

<?php

namespace App\Tests;


use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

use App\Entity\Point;
class PointTest extends ApiTestCase
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

    const API_URL = '127.0.0.1:800/api/points';

    /**
     * @beforeClass
     */
    public static function setUpBeforeClass()
    {
        self::$client = static::createClient();
        self::$repo = static::$container->get('doctrine')->getRepository(Point::class);
    }

    /**
     * @before
     */
    public function setUp(): void
    {
        //fill the data array with all valid data
        $this->dataArray = [
            'resident_id' => '1',
            'point' => '0'
        ];
    }


    /**
     * this test will test will a user with zero points
     */
    public function testUserWithZeroPoints(): void
    {
        $response = self::$client->request('GET', self::API_URL, ['json' => $this->dataArray]);

        $this->assertResponseStatusCodeSame(200);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            '@context' => '/contexts/Point',
            '@type' => 'Point',
            ...$this->dataArray,
            'reviews' => [],
        ]);
        $this->assertRegExp('~^/points/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(Point::class);
    }

    /**
     * this test will test will a user with three points
     */
    public function testUserWithThreePoints()
    {

        unset($this->dataArray['resident_id']);
        unset($this->dataArray['point']);

        $response = self::$client->request('GET', self::API_URL, ['json' => $this->dataArray]);

        $this->dataArray['resident_id'] = '2';
        $this->dataArray['point'] = '3';

        $this->assertResponseStatusCodeSame(200);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context' => '/contexts/Point',
            '@type' => 'Point',
            ...$this->dataArray,
            'reviews' => [],
        ]);

        $this->assertRegExp('~^/points/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(Point::class);
    }

    /**
     * this test will test will a user with eighty points
     */
    public function testUserWithEightyPoints()
    {
        unset($this->dataArray['resident_id']);
        unset($this->dataArray['point']);

        $response = self::$client->request('GET', self::API_URL, ['json' => $this->dataArray]);

        $this->dataArray['resident_id'] = '3';
        $this->dataArray['point'] = '80';

        $this->assertResponseStatusCodeSame(200);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context' => '/contexts/Point',
            '@type' => 'Point',
            ...$this->dataArray,
            'reviews' => [],
        ]);

        $this->assertRegExp('~^/points/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(Point::class);
    }
}

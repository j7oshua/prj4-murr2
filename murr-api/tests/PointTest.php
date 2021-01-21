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
    const VIOLATION_ARRAY = [
        '@context' => '/contexts/ConstraintViolationList',
        '@type' => 'ConstraintViolationList',
        'hydra:title' => 'An error occurred'
    ];

    const API_URL = '127.0.0.1:8000/api/points';

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

        $this->dataArray = [
            'numPoints' => 1,
        ];
    }

    /**
     * @test
     */
    public function TestAddOnePointUserWithThreePoints(): void
    {
        $response = self::$client->request('POST', self::API_URL, ['json' => $this->dataArray]);

        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            '@context' => '/contexts/Point',
            '@type' => 'Point',
            ...$this->dataArray,
            'numPoints' => 1,
        ]);
        $this->assertRegExp('~^/points/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(Point::class);
    }

    /**
     * @test
     */
    public function TestAddOnePointUserWithNoPoints(): void
    {

        $response = self::$client->request('POST', self::API_URL_RESIDENT_TWO, ['json' => $this->dataArray]);
        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            '@context' => '/contexts/Point',
            '@type' => 'Point',
            ...$this->dataArray,
            'numPoints' => 1,
        ]);

        $this->assertRegExp('~^/points/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(Point::class);

    }

    /**
     * @test
     */
    public function TestAddOnePointUserWithNoID(): void
    {

        $response = self::$client->request('POST', self::API_URL_RESIDENT_NO_ID, ['json' => $this->dataArray]);

        $this->assertResponseStatusCodeSame(404);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');


        $this->assertJsonContains([
            ...self::VIOLATION_ARRAY,
            'hydra:description' => 'residentID: ResidentID has not been created.'
        ]);
    }

    /**
     * @test
     */
    public
    function TestAddZeroPointUserWithPoints(): void
    {
            //set numPoints as Zero
            $this->dataArray['numPoints'] = 0;

            $response = self::$client->request('POST', self::API_URL_RESIDENT_THREE, ['json' => $this->dataArray]);

            $this->assertResponseStatusCodeSame(404);
            $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

            $this->assertJsonContains([
                ...self::VIOLATION_ARRAY,
                'hydra:description' => 'numPoints: The points has to be greater than zero.'
            ]);
    }

    /**
     * @test
     */
    public
    function TestAddZeroPointUserWithNoPoints(): void
    {
        //set numPoints as Zero
        $this->dataArray['numPoints'] = 0;

        $response = self::$client->request('POST', self::API_URL_RESIDENT_FOUR, ['json' => $this->dataArray]);

        $this->assertResponseStatusCodeSame(404);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            ...self::VIOLATION_ARRAY,
            'hydra:description' => 'numPoints: The points has to be greater than zero.'
        ]);
    }

    /**
     * @test
     */
    public
    function TestAddOnePointUserIDNinetyNineDoesNotExist(): void
    {
            //set numPoints as One
            $this->dataArray['numPoints'] = 1;

            $response = self::$client->request('POST', self::API_URL_RESIDENT_NINETYNINE, ['json' => $this->dataArray]);

            $this->assertResponseStatusCodeSame(400);
            $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

            $this->assertJsonContains([
                ...self::VIOLATION_ARRAY,
                'hydra:description' => 'residentID: ResidentID has not been created.'
            ]);
    }

    /**
     * @test
     */
    public
    function testLeavePointsBlank(): void
    {
        //set numPoints as Null
        unset($this->dataArray['numPoints']);

        $response = self::$client->request('POST', self::API_URL_RESIDENT_FIVE, ['json' => $this->dataArray]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            ...self::VIOLATION_ARRAY,
            'hydra:description' => 'numPoints: Points cannot be left null'
        ]);
    }

}

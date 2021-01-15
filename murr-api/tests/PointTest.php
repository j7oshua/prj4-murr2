<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

use App\Entity\Point;

class PointTest extends ApiTestCase
{
    // This trait provided by HautelookAliceBundle will take care of refreshing the database content to a known state before each test
    use RefreshDatabaseTrait;

    private static $client;
    private static $repo;
    private $dataArray;
    const VIOLATION_ARRAY = [
        '@context' => '/contexts/ConstraintViolationList',
        '@type' => 'ConstraintViolationList',
        'hydra:title' => 'An error occurred'
    ];

    const API_URL_RESIDENT_ONE = 'api/points/1';
    const API_URL_RESIDENT_TWO = 'api/points/2';
    const API_URL_RESIDENT_NO_ID = 'api/points/-1';
    const API_URL_RESIDENT_THREE = 'api/points/3';
    const API_URL_RESIDENT_FOUR = 'api/points/4';
    const API_URL_RESIDENT_NINETYNINE = 'api/points/99';
    const API_URL_RESIDENT_FIVE = 'api/points/5';

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
    public function testAddOnePointUserWithThreePoints(): void
    {
        $response = self::$client->request('POST', self::API_URL_RESIDENT_ONE, ['json' => $this->dataArray]);

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
    public function testAddOnePointUserWithNoPoints(): void
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
    public function testAddOnePointUserWithNoID(): void
    {
        //set one value as invalid

        $response = self::$client->request('POST', self::API_URL_RESIDENT_NO_ID, ['json' => $this->dataArray]);

        $this->assertResponseStatusCodeSame(404);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');


        $this->assertJsonContains([
            ...self::VIOLATION_ARRAY,
            'hydra:description' => 'ResidentID has not been created.'
        ]);
    }

        /**
         * @test
         */
        public
        function testAddZeroPointUserWithPoints(): void
        {
            //set one value as Zero
            $this->dataArray['numPoints'] = 0;

            unset($this->dataArray['description']);
            $response = self::$client->request('POST', self::API_URL_RESIDENT_THREE, ['json' => $this->dataArray]);

            $this->assertResponseStatusCodeSame(404);
            $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

            $this->assertJsonContains([
                ...self::VIOLATION_ARRAY,
                'hydra:description' => 'The points has to be greater than zero.'
            ]);
        }

    /**
     * @test
     */
    public
    function testAddZeroPointUserWithNoPoints(): void
    {
        //set one value as Zero
        $this->dataArray['numPoints'] = 0;

        unset($this->dataArray['description']);
        $respongitse = self::$client->request('POST', self::API_URL_RESIDENT_FOUR, ['json' => $this->dataArray]);

        $this->assertResponseStatusCodeSame(404);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            ...self::VIOLATION_ARRAY,
            'hydra:description' => 'The points has to be greater than zero.'
        ]);
    }


        public
        function testAddOnePointUserIDNinetyNineDoesNotExist(): void
        {
            //set one value as One
            $this->dataArray['numPoints'] = 1;

            unset($this->dataArray['description']);
            $response = self::$client->request('POST', self::API_URL_RESIDENT_NINETYNINE, ['json' => $this->dataArray]);

            $this->assertResponseStatusCodeSame(400);
            $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

            $this->assertJsonContains([
                ...self::VIOLATION_ARRAY,
                'hydra:description' => 'description: This value should not be blank.'
            ]);
        }
    public
    function testLeavePointsBlank(): void
    {
        //set one value as Null
        unset($this->dataArray['numPoints']);

        $response = self::$client->request('POST', self::API_URL_RESIDENT_FIVE, ['json' => $this->dataArray]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            ...self::VIOLATION_ARRAY,
            'hydra:description' => 'description: This value should not be blank.'
        ]);
    }

    }

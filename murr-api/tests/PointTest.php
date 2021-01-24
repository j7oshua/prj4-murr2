<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

use App\Entity\Point;

class PointTest extends ApiTestCase
{

    use RefreshDatabaseTrait;

    private static $repo;
    private $residentOne;
    private $residentTwo;
    private $noResidentID;
    const VIOLATION_ARRAY = [
        '@context' => '/api/contexts/ConstraintViolationList',
        '@type' => 'ConstraintViolationList',
        'hydra:title' => 'An error occurred'
    ];

    const API_URL = '127.0.0.1:8000/api/points';

    /**
     * @before
     *
     */
    public function setUp(): void
    {

        $this->residentOne = [
            'numPoints' => 1,
            'resident' => ["/api/residents/1"]
        ];

        $this->residentTwo = [
            'numPoints' => 1,
            'resident' => ["/api/residents/2"]
        ];

        $this->noResidentID = [
          'numPoints' => 1
        ];

    }

    /**
     * @test
     */
    public function TestAddOnePointResidentWithThreePoints(): void
    {
        $response = static::createClient()->request('POST', self::API_URL, ['json' => $this->residentOne]);

        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertRegExp('/^\/api\/points\/\d+$/', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(Point::class);

    }

    /**
     * @test
     */
    public function TestAddOnePointResidentWithNoPoints(): void
    {
        $response = static::createClient()->request('POST', self::API_URL, ['json' => $this->residentTwo]);
        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertRegExp('/^\/api\/points\/\d+$/', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(Point::class);

    }

    /**
     * @test
     */
    public function TestAddOnePointUserWithNoID(): void
    {

        static::createClient()->request('POST', self::API_URL, ['json' => $this->noResidentID]);
        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            'hydra:description' => 'resident: You must add at least one Resident'
        ]);
    }

//    /**
//     * @test
//     */
//    public
//    function TestAddZeroPointUserWithPoints(): void
//    {
//            //set numPoints as Zero
//            $this->dataArray['numPoints'] = 0;
//
//            $response = self::$client->request('POST', self::API_URL, ['json' => $this->dataArray]);
//
//            $this->assertResponseStatusCodeSame(404);
//            $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
//
//            $this->assertJsonContains([
//                ...self::VIOLATION_ARRAY,
//                'hydra:description' => 'numPoints: The points has to be greater than zero.'
//            ]);
//    }
//
//    /**
//     * @test
//     */
//    public
//    function TestAddZeroPointUserWithNoPoints(): void
//    {
//        //set numPoints as Zero
//        $this->dataArray['numPoints'] = 0;
//
//        $response = self::$client->request('POST', self::API_URL, ['json' => $this->dataArray]);
//
//        $this->assertResponseStatusCodeSame(404);
//        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
//
//        $this->assertJsonContains([
//            ...self::VIOLATION_ARRAY,
//            'hydra:description' => 'numPoints: The points has to be greater than zero.'
//        ]);
//    }
//
//    /**
//     * @test
//     */
//    public
//    function TestAddOnePointUserIDNinetyNineDoesNotExist(): void
//    {
//            //set numPoints as One
//            $this->dataArray['numPoints'] = 1;
//
//            $response = self::$client->request('POST', self::API_URL, ['json' => $this->dataArray]);
//
//            $this->assertResponseStatusCodeSame(400);
//            $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
//
//            $this->assertJsonContains([
//                ...self::VIOLATION_ARRAY,
//                'hydra:description' => 'residentID: ResidentID has not been created.'
//            ]);
//    }
//
//    /**
//     * @test
//     */
//    public
//    function testLeavePointsBlank(): void
//    {
//        //set numPoints as Null
//        unset($this->dataArray['numPoints']);
//
//        $response = self::$client->request('POST', self::API_URL, ['json' => $this->dataArray]);
//
//        $this->assertResponseStatusCodeSame(400);
//        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
//
//        $this->assertJsonContains([
//            ...self::VIOLATION_ARRAY,
//            'hydra:description' => 'numPoints: Points cannot be left null'
//        ]);
//    }


}

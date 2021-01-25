<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

use App\Entity\Point;

class PointTest extends ApiTestCase
{

    use RefreshDatabaseTrait;

    private $residentOne;
    private $residentTwo;
    private $residentThree;
    private $noResidentID;
    private $residentNinetyNine;

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

        $this->residentThree = [
            'numPoints' => 0,
            'resident' => ["/api/residents/3"]
        ];

        $this->residentNinetyNine = [
            'numPoints' => 1,
            'resident' => ["/api/residents/99"]
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

        $this->assertJsonContains([
            '@context' => '/api/contexts/Point',
            '@type' => 'Point',
            'numPoints' => 1,
            'resident' => array(0 => '/api/residents/1')
        ]);
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

        $this->assertJsonContains([
            '@context' => '/api/contexts/Point',
            '@type' => 'Point',
            'numPoints' => 1,
            'resident' => array(0 => '/api/residents/2')
        ]);
    }

    /**
     * @test
     */
    public function TestAddOnePointResidentWithNoID(): void
    {

        static::createClient()->request('POST', self::API_URL, ['json' => $this->noResidentID]);
        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            'hydra:description' => 'resident: You must add at least one Resident'
        ]);
    }

    /**
     * @test
     */
    public
    function TestAddZeroPointsToResidentWithPoints(): void
    {
            $this->residentOne['numPoints'] = 0;

            self::createClient()->request('POST', self::API_URL, ['json' => $this->residentOne]);

            $this->assertResponseStatusCodeSame(400);
            $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

            $this->assertJsonContains([
                'hydra:description' => 'numPoints: The points has to be greater than zero'
            ]);
    }

    /**
     * @test
     */
    public
    function TestAddZeroPointsToResidentWithNoPoints(): void
    {


        self::createClient()->request('POST', self::API_URL, ['json' => $this->residentThree]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            'hydra:description' => 'numPoints: The points has to be greater than zero'
        ]);
    }

    /**
     * @test
     */
    public
    function TestAddOnePointToResidentIDNinetyNineDoesNotExist(): void
    {

            self::createClient()->request('POST', self::API_URL, ['json' => $this->residentNinetyNine]);

            $this->assertResponseStatusCodeSame(400);
            $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

            $this->assertJsonContains([
                'hydra:description' => 'resident: You must add at least one Resident',
                'hydra:description' => 'Item not found for "/api/residents/99".'
            ]);
    }

    /**
     * @test
     */
    public
    function testLeavePointsBlank(): void
    {
        //set numPoints as Null
        unset($this->residentOne['numPoints']);

        self::createClient()->request('POST', self::API_URL, ['json' => $this->residentOne]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            'hydra:description' => 'numPoints: Points cannot be left null'
        ]);
    }


}

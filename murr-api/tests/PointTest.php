<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

use App\Entity\Point;

class PointTest extends ApiTestCase
{
    //php bin/console doctrine:database:drop --force
    //php bin/console doctrine:schema:update --force

    //Refreshes the database for every test
    use RefreshDatabaseTrait;

    //Private list of empty residents variables
    private $residentOne;
    private $residentTwo;
    private $residentThree;
    private $noResidentID;
    private $residentNinetyNine;


    //static URL
    const API_URL = '127.0.0.1:8000/api/points';

    /**
     * This sets up the Resident and Point objects for the fixtures and test to use while running
     * @before
     */
    public function setUp(): void
    {

        $this->residentOne = [
            'num_points' => 1,
            'resident' => ["/api/residents/1"]
        ];

        $this->residentTwo = [
            'num_points' => 1,
            'resident' => ["/api/residents/2"]
        ];

        $this->noResidentID = [
          'num_points' => 1
        ];

        $this->residentThree = [
            'num_points' => 0,
            'resident' => ["/api/residents/3"]
        ];

        $this->residentNinetyNine = [
            'num_points' => 1,
            'resident' => ["/api/residents/99"]
        ];

    }

    /**
     * Purpose: This test will test adding a single point to Resident One.
     *           Resident One already has 3 points.
     * Expected Result: Success -- Status Response 201
     * Return: JSONLD of a single point transaction.
     * @test
     */
    public function TestAddOnePointResidentWithThreePoints(): void
    {
        //creates a client
        //Request a HTTP POST Request to the static API URL using Resident One
        $response = static::createClient()->request('POST', self::API_URL, ['json' => $this->residentOne]);

        //Return a status code 201("created")
        $this->assertResponseStatusCodeSame(201);

        //Returns the headers for the status code
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        //validates the URL and makes sure the is an ID
        $this->assertMatchesRegularExpression('/^\/api\/points\/\d+$/', $response->toArray()['@id']);

        //validates the JSONLD schema
        $this->assertMatchesResourceItemJsonSchema(Point::class);

        //JSONLD expected result should be this:
        $this->assertJsonContains([
            '@context' => '/api/contexts/Point',
            '@type' => 'Point',
            'num_points' => 1,
            'resident' => array(0 => '/api/residents/1')
        ]);
    }

    /**
     * Purpose: This test will test adding a single point to Resident Two.
     *           Resident Two has 0 points.
     * Expected Result: Success -- Status Response 201
     * Return: JSONLD of a single point transaction.
     * @test
     */
    public function TestAddOnePointResidentWithNoPoints(): void
    {
        $response = static::createClient()->request('POST', self::API_URL, ['json' => $this->residentTwo]);
        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertMatchesRegularExpression('/^\/api\/points\/\d+$/', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(Point::class);

        $this->assertJsonContains([
            '@context' => '/api/contexts/Point',
            '@type' => 'Point',
            'num_points' => 1,
            'resident' => array(0 => '/api/residents/2')
        ]);
    }

    /**
     * Purpose: This test will test adding a single point to noResidentID.
     *           Resident do not exist.
     * Expected Result: Failure -- Status Response 400
     * Return: hydra description of: 'resident: You must add at least one Resident'.
     * @test
     */
    public function TestAddOnePointResidentWithNoID(): void
    {
        //creates a client
        //Request a HTTP POST Request to the static API URL using noResidentID
        static::createClient()->request('POST', self::API_URL, ['json' => $this->noResidentID]);

        //Returns a status code of 400 ("Bad Request")
        $this->assertResponseStatusCodeSame(400);

       //Returns the headers
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        //JSONLD sends back the hydra description:
        $this->assertJsonContains([
            'hydra:description' => 'resident: You must add at least one Resident'
        ]);
    }

    /**
     * Purpose: This test will test adding Zero points to Resident One.
     *           Resident One has 3 points .
     * Expected Result: Failure -- Status Response 400
     * Return: hydra description of: 'num_points: The points has to be greater than zero'.
     * @test
     */
    public
    function TestAddZeroPointsToResidentWithPoints(): void
    {
           //reset numPoint to equal 0
            $this->residentOne['num_points'] = 0;

            self::createClient()->request('POST', self::API_URL, ['json' => $this->residentOne]);

            $this->assertResponseStatusCodeSame(400);
            $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

            $this->assertJsonContains([
                'hydra:description' => 'num_points: The points has to be greater than zero'
            ]);
    }

    /**
     * Purpose: This test will test adding a Zero points to Resident Three.
     *           Resident Three has 0 points.
     * Expected Result: Failure -- Status Response 400
     * Return: hydra description of: 'num_points: The points has to be greater than zero'.
     * @test
     */
    public
    function TestAddZeroPointsToResidentWithNoPoints(): void
    {
        self::createClient()->request('POST', self::API_URL, ['json' => $this->residentThree]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            'hydra:description' => 'num_points: The points has to be greater than zero'
        ]);
    }

    /**
     * Purpose: This test will test adding a 1 point to Resident Ninety-nine.
     *           Resident Ninety-nine does not exist.
     * Expected Result: Failure -- Status Response 400
     * Return: hydra description of: 'num_points: The points has to be greater than zero' and
     *                               'Item not found for "/api/residents/99".'.
     * @test
     */
    public
    function TestAddOnePointToResidentIDNinetyNineDoesNotExist(): void
    {

            self::createClient()->request('POST', self::API_URL, ['json' => $this->residentNinetyNine]);

            $this->assertResponseStatusCodeSame(400);
            $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

            //Returns 2 hydra description for 2 violations:
            $this->assertJsonContains([
                'hydra:description' => 'resident: You must add at least one Resident',
                'hydra:description' => 'Item not found for "/api/residents/99".'
            ]);
    }

    /**
     * Purpose: This test will test adding a null for the points to Resident One.
     *           Resident One has 3 points.
     * Expected Result: Failure -- Status Response 400
     * Return: hydra description of:  'num_points: Points cannot be left null'.
     * @test
     */
    public
    function testLeavePointsBlank(): void
    {
        //set num_points as Null
        unset($this->residentOne['num_points']);

        self::createClient()->request('POST', self::API_URL, ['json' => $this->residentOne]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            'hydra:description' => 'num_points: Points cannot be left null'
        ]);
    }


}

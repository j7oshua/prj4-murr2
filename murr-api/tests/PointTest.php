<?php

namespace App\Tests;


use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

use App\Entity\Point;
class PointTest extends ApiTestCase
{
   //refreshes the database with each test
    use RefreshDatabaseTrait;

    //Declare Variables
    private static $client;
    private static $repo;
    private $dataArray;

   //Display Constraints
    const VIOLATION_ARRAY=[
        '@context' => '/contexts/ConstraintViolationList',
        '@type' => 'ConstraintViolationList',
        'hydra:title' => 'An error occurred'
    ];

    //calls API URL
    const API_URL = '127.0.0.1:800/api/points';

    /**
     * @beforeClass
     */
    public static function setUpBeforeClass()
    {
        // creates client
        self::$client = static::createClient();

        //creates repository
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
     * this test will test will display resident_id =1 with point=0
     */
    public function testUserWithZeroPoints(): void
    {
        //call client to do a get request and get the json from dataArray
        $response = self::$client->request('GET', self::API_URL, ['json' => $this->dataArray]);

        //Validate the Get request
        $this->assertResponseStatusCodeSame(200);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            '@context' => '/contexts/Point',
            '@type' => 'Point',
            ...$this->dataArray
        ]);
        $this->assertRegExp('~^/points/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(Point::class);
    }

    /**
     * this test will test will display resident_id =2 with point=3
     */
    public function testUserWithThreePoints()
    {
        //clear the values for the variables of the dataArray
        unset($this->dataArray['resident_id']);
        unset($this->dataArray['point']);

        //set new values
        $this->dataArray['resident_id'] = '2';
        $this->dataArray['point'] = '3';

        //call client to do a get request and get the json from dataArray
        $response = self::$client->request('GET', self::API_URL, ['json' => $this->dataArray]);

        //Validate the Get request
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
     * this test will test will display resident_id =2 with point=80
     */
    public function testUserWithEightyPoints()
    {
        //clear the values for the variables of the dataArray
        unset($this->dataArray['resident_id']);
        unset($this->dataArray['point']);

        //set new values
        $this->dataArray['resident_id'] = '3';
        $this->dataArray['point'] = '80';

        //call client to do a get request and get the json from dataArray
        $response = self::$client->request('GET', self::API_URL, ['json' => $this->dataArray]);

        //Validate the Get request
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

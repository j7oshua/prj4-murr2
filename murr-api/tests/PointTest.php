<?php
//PHP Fatal error:  Uncaught Error: Class 'PHPUnit_TextUI_ResultPrinter' not found in C:\Users\dattw\AppData\Local\Temp\ide-phpunit.php:231
//Attempting to figure why the tests do not run properly

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
    const VIOLATION_ARRAY=[
        '@context' => '/contexts/ConstraintViolationList',
        '@type' => 'ConstraintViolationList',
        'hydra:title' => 'An error occurred'
    ];

    const API_URL_RESIDENT_ONE = '127.0.0.1:8000/api/points/1';
    const API_URL_RESIDENT_TWO = '127.0.0.1:8000/api/points/2';
    const API_URL_RESIDENT_THREE = '127.0.0.1:8000/api/points/3';
    const API_URL_RESIDENT_FOUR = '127.0.0.1:8000/api/points/4';
    const API_URL_RESIDENT_NO_ID = '127.0.0.1:8000/api/points/-1';

    /**
     * @beforeClass
     * set up the client to get the GET request
     */
    public static function setUpBeforeClass() : void
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

    //well i got a basic thing to pass
    public function testworks(): void {
        $this->assertTrue(true);
    }

    /**
     * @test
     * originally this was a post request test but when using alice we have generated data.
     */
    public function testPointForResidentOne(): void
    {
        $response = self::$client->request('GET', self::API_URL_RESIDENT_ONE, ['json' => $this->dataArray]);

        $this->assertResponseStatusCodeSame(200); //this needs to be the code for success with finding it
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
     * this test will test will display resident_id = id1+1 with point=3
     */
    public function testUserWithThreePoints()
    {
        //call client to do a get request and get the json from dataArray
        $response = static::createClient()->request('GET', self::API_URL_RESIDENT_TWO, ['json' => $this->dataArray]);

        //Validate the Get request
        $this->assertResponseStatusCodeSame(200);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context' => '/contexts/Point',
            '@type' => 'Point',
            ...$this->dataArray,
            'resident_id' => '2', //this will move cause it is generated.
            'numPoints' => '3',
        ]);

        $this->assertRegExp('~^/points/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(Point::class);
    }

    /**
     * this needs a fixture
     * this test will test will display resident_id =2 with point=80
     */
    public function testUserWithEightyPoints()
    {


        //call client to do a get request and get the json from dataArray
        $response = self::$client->request('GET', self::API_URL_RESIDENT_THREE, ['json' => $this->dataArray]);

        //Validate the Get request
        $this->assertResponseStatusCodeSame(200);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context' => '/contexts/Point',
            '@type' => 'Point',
            ...$this->dataArray,
            'resident_id' => '3',
            'numPoint' => '80'
        ]);

        $this->assertRegExp('~^/points/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(Point::class);
    }

    /**
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     * not sure how to handle this type of error exception
     * it says client is not set? guess I can set it in this test?
     */
    public function testUserWithNoResidentID(): void //this one if for default but test anyways
    {
        //call client to do a get request and get the json from dataArray
        //$response = self::$client->request('GET', self::API_URL_RESIDENT_FOUR, ['json' => $this->dataArray]);

        //why do i need to generate it to pass?
        $response = static::createClient()->request('GET', self::API_URL_RESIDENT_FOUR, ['json' => $this->dataArray]);

        //Validate the Get request
        $this->assertResponseStatusCodeSame(404);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

    }
}

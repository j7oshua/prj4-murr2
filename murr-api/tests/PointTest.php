<?php
//PHP Fatal error:  Uncaught Error: Class 'PHPUnit_TextUI_ResultPrinter' not found in C:\Users\dattw\AppData\Local\Temp\ide-phpunit.php:231
//Attempting to figure why the tests do not run properly
//wonder if something got updated when it shouldn't.
//trying POSTMAN to see if i could test.
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

    //why will this return nothing??? idk
    //schema is generating new residents and points cause the id keeps going up and i keep indexing up.
    //some thing is wrong with the link request


    //const API_URL_RESIDENT_ONE = 'api/points/0';
    //const API_URL_RESIDENT_ONE = 'localhost:8080/api/points/44'; //for testing with created schema data
    const API_URL_RESIDENT_ONE = '127.0.0.1:8000/api/points/67'; //for testing with created schema data
    const API_URL_RESIDENT_TWO = '127.0.0.1:8000/api/points/51'; //for testing with created schema data
    //const API_URL_RESIDENT_TWO = 'api/points/1';
    const API_URL_RESIDENT_THREE = 'api/points/2';
    const API_URL_RESIDENT_FOUR = '127.0.0.1:8000/api/points/100';
const API_URL_RESIDENTS = '127.0.0.1:8000/api/points';

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
        //$response = self::$client->request('GET', self::API_URL_RESIDENT_ONE, ['json' => $this->dataArray]);

        //maybe generating it will pass?
        $response = static::createClient()->request('GET', self::API_URL_RESIDENT_FOUR, ['json' => $this->dataArray]);

        $this->assertResponseStatusCodeSame(404); //this needs to be the code for success with finding it
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            '@context' => '/contexts/Point',
            '@type' => 'Point',
            ...$this->dataArray,
            'numPoints' => 1,
        ]);
        //$this->assertRegExp('~^/points/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(Point::class);
    }


    public function testgetAll(): void {
        $response = static::createClient()->request('GET', self::API_URL_RESIDENTS, ['json' => $this->dataArray]);

        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        //needs more testing
        var_dump($response);
    }

//    //there is some thing wrong when i uncomment resident2
//    /**
//     * this test will test will display resident_id = id1+1 with point=3
//     */
//    public function testUserWithThreePoints()
//    {
//
//        //call client to do a get request and get the json from dataArray
//        $response = self::$client->request('GET', self::API_URL_RESIDENT_TWO, ['json' => $this->dataArray]);
//
//        //Validate the Get request
//        $this->assertResponseStatusCodeSame(200);
//        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
//
//        $this->assertJsonContains([
//            '@context' => '/contexts/Point',
//            '@type' => 'Point',
//            ...$this->dataArray,
//            //'resident_id' => '2', //this will move cause it is generated.
//            'numPoint' => '3',
//        ]);
//
//        $this->assertRegExp('~^/points/\d+$~', $response->toArray()['@id']);
//        $this->assertMatchesResourceItemJsonSchema(Point::class);
//    }
//
//    /**
//     * this needs a fixture
//     * this test will test will display resident_id =2 with point=80
//     */
//    public function testUserWithEightyPoints()
//    {
//
//
//        //call client to do a get request and get the json from dataArray
//        $response = self::$client->request('GET', self::API_URL_RES3, ['json' => $this->dataArray]);
//
//        //Validate the Get request
//        $this->assertResponseStatusCodeSame(200);
//        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
//
//        $this->assertJsonContains([
//            '@context' => '/contexts/Point',
//            '@type' => 'Point',
//            ...$this->dataArray,
//            'resident_id' => '2',
//            'numPoint' => '80'
//        ]);
//
//        $this->assertRegExp('~^/points/\d+$~', $response->toArray()['@id']);
//        $this->assertMatchesResourceItemJsonSchema(Point::class);
//    }
//
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

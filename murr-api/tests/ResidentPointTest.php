<?php
//PHP Fatal error:  Uncaught Error: Class 'PHPUnit_TextUI_ResultPrinter' not found in C:\Users\dattw\AppData\Local\Temp\ide-phpunit.php:231
//Attempting to figure why the tests do not run properly

namespace App\Tests;


use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

use App\Entity\Point;

class ResidentPointTest extends ApiTestCase
{
    // This trait provided by HautelookAliceBundle will take care of refreshing the database content to a known state before each test
    use RefreshDatabaseTrait;

    private $resident1;
    private $resident2;
    private $resident3;

    const API_URL = '127.0.0.1:8000/resident/point/3';

    //  'content' => '[{"numPoints":40},{"numPoints":40}]',

    private static $client;
    private static $repo;
//    private $dataArray;
//    const VIOLATION_ARRAY=[
//        '@context' => '/contexts/ConstraintViolationList',
//        '@type' => 'ConstraintViolationList',
//        'hydra:title' => 'An error occurred'
//    ];

    //IMPORTANT (CUSTOM ROUTE)
    //@route // '/api/point/resident/{id}'

//    const API_URL_RESIDENT_ONE = '127.0.0.1:8000/api/points/1';
//    const API_URL_RESIDENT_TWO = '127.0.0.1:8000/api/points/2';
//    const API_URL_RESIDENT_THREE = '127.0.0.1:8000/api/points/3';
//    const API_URL_RESIDENT_FOUR = '127.0.0.1:8000/api/points/4';
//    const API_URL_RESIDENT_NO_ID = '127.0.0.1:8000/api/points/-1';

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
//    public function setUp(): void
//    {
//        $this->resident1 = [
//            'numPoint' => 0,
//            'resident' => ["/api/residents/1"]
//        ];
//    }

    //well i got a basic thing to pass
//    public function testworks(): void {
//        $this->assertTrue(true);
//    }

    /**
     * @test
     * originally this was a post request test but when using alice we have generated data.
     */
    public function testPointForResidentOne(): void
    {
//        $response = static::createClient()->request('GET', self::API_URL, ['json' => $this->resident1]);
//
//        $this->assertResponseStatusCodeSame(200);
//        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
//
//        $this->assertMatchesResourceItemJsonSchema(Point::class);
//        $this->assertMatchesRegularExpression('~^/api/points/\d+$~', $response->toArray()['@id']);
//
//        $this->assertJsonContains([
//            '@context' => '/api/contexts/Point',
//            '@id'=>'/api/points/1',
//            '@type' => 'Point',
//            'id'=> 1,
//            'numPoints' => 0
//        ]);

        //$response = self::$client->request('GET', self::API_URL_RESIDENT_ONE);

        $response = static::createClient()->request('GET', self::API_URL);

        //var_dump($response);

        $this->assertResponseStatusCodeSame(200); //this needs to be the code for success with finding it
        //$this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
//        $this->assertJsonContains([
//            '@context' => '/api/contexts/Point',
//            '@id'=>'/api/points/1',
//            '@type' => 'Point',
//            'id'=> 1,
//            'numPoints' => 1
//        ]);

        //$this->assertMatchesRegularExpression('~^/api/points/\d+$~', $response->toArray()['@id']);
        //$this->assertMatchesResourceItemJsonSchema(Point::class);

        //only thing that is certain below
        $this->assertJsonContains([
            'content' => '[{"numPoints":1}]'
        ]);
        //we will need to make it cleaner and to work with sum
    }


    /**
     * this test will test will display id = with point=3
     */
    public function testUserWithThreePoints()
    {
        //call client to do a get request and get the json from dataArray
        $response = static::createClient()->request('GET', self::API_URL_RESIDENT_TWO);

        //Validate the Get request
        $this->assertResponseStatusCodeSame(200);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context' => '/api/contexts/Point',
            '@id'=>'/api/points/2',
            '@type' => 'Point',
            'id'=> 2,
            'numPoints' => 3
        ]);

        $this->assertMatchesRegularExpression('~^/api/points/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(Point::class);
    }

    /**
     * this needs a fixture and sum function
     * this test will test will display resident_id =2 with point=80
     */
    public function testUserWithEightyPoints()
    {


        //call client to do a get request and get the json from dataArray
        //$response = self::$client->request('GET', self::API_URL_RESIDENT_THREE);

        $response = static::createClient()->request('GET', self::API_URL_RESIDENT_THREE);

        //Validate the Get request
        $this->assertResponseStatusCodeSame(200);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        //need to look for a combined
        $this->assertJsonContains([
            '@context' => '/api/contexts/Point',
            '@id'=>'/api/points/3',
            '@type' => 'Point',
            'numPoints' => 80
        ]);

        $this->assertMatchesRegularExpression('~^/api/points/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(Point::class);
    }

    /**
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     * not sure how to handle this type of error exception
     * it says client is not set? guess I can set it in this test?
     */
    public function testUserWithNoResidentID(): void //this one if for default but test anyways
    {

        //why do i need to generate it to pass?
        $response = static::createClient()->request('GET', self::API_URL_RESIDENT_FOUR);

        //Validate the Get request
        $this->assertResponseStatusCodeSame(404);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

    }
}

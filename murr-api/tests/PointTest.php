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
   //refreshes the database with each test.. this will load my fixtures
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
    const API_URL_RES1 = '127.0.0.1:800/api/points';
    const API_URL_RES2 = '127.0.0.1:800/api/points';
    const API_URL_RES3 = '127.0.0.1:800/api/points';
    const API_URL_RES4 = '127.0.0.1:800/api/points';
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
            'numPoint' => '0'
        ];
    }

    /**
     * this test will test will display resident_id =1 with point=0
     */
    public function testUserWithZeroPoints(): void
    {
        //call client to do a get request and get the json from dataArray
        $response = self::$client->request('GET', self::API_URL_RES1, ['json' => $this->dataArray]);

        //Validate the Get request
        $this->assertResponseStatusCodeSame(200);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            '@context' => '/contexts/Point',
            '@type' => 'Point',
            ...$this->dataArray,
            'resident_id' => '1',
            'numPoint' => '0'
        ]);

        $this->assertRegExp('~^/points/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(Point::class);
    }

    /**
     * this test will test will display resident_id =2 with point=3
     */
    public function testUserWithThreePoints()
    {

        //call client to do a get request and get the json from dataArray
        $response = self::$client->request('GET', self::API_URL_RES2, ['json' => $this->dataArray]);

        //Validate the Get request
        $this->assertResponseStatusCodeSame(200);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context' => '/contexts/Point',
            '@type' => 'Point',
            ...$this->dataArray,
            'resident_id' => '2',
            'numPoint' => '3'
        ]);

        $this->assertRegExp('~^/points/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(Point::class);
    }

    /**
     * this test will test will display resident_id =2 with point=80
     */
    public function testUserWithEightyPoints()
    {


        //call client to do a get request and get the json from dataArray
        $response = self::$client->request('GET', self::API_URL_RES3, ['json' => $this->dataArray]);

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

    public function testUserWithNoResidentID()
    {


        //call client to do a get request and get the json from dataArray
        $response = self::$client->request('GET', self::API_URL_RES3, ['json' => $this->dataArray]);

        //Validate the Get request
        $this->assertResponseStatusCodeSame(404);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');


        $this->assertRegExp('~^/points/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(Point::class);
    }
}

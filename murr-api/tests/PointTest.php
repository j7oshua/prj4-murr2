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

    const API_URL_RESIDENT_ONE = 'api/points/0';
    const API_URL_RESIDENT_TWO = 'api/points/1';
    const API_URL_RESIDENT_THREE = 'api/points/2';
    const API_URL_RESIDENT_FOUR = 'api/points/3';

    /**
     * @beforeClass
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

    /**
     * @test
     */
    public function testCreatePointForResidentOne(): void
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

//    /**
//     * this needs a fixture
//     * this test will test will display resident_id =2 with point=3
//     */
//    public function testUserWithThreePoints()
//    {
//
//        //call client to do a get request and get the json from dataArray
//        $response = self::$client->request('GET', self::API_URL_RES2, ['json' => $this->dataArray]);
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
//            'numPoint' => '3'
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
//    public function testUserWithNoResidentID()
//    {
//
//
//        //call client to do a get request and get the json from dataArray
//        $response = self::$client->request('GET', self::API_URL_RES3, ['json' => $this->dataArray]);
//
//        //Validate the Get request
//        $this->assertResponseStatusCodeSame(404);
//        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
//
//
//        $this->assertRegExp('~^/points/\d+$~', $response->toArray()['@id']);
//        $this->assertMatchesResourceItemJsonSchema(Point::class);
//    }
}

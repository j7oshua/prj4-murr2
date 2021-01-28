<?php
//Attempting to figure why the tests do not run properly

namespace App\Tests;


use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

use App\Entity\Point;

class ResidentPointTest extends ApiTestCase
{
    // This trait provided by HautelookAliceBundle will take care of refreshing the database content to a known state before each test
    use RefreshDatabaseTrait;

    const API_URL_1 = '127.0.0.1:8000/resident/point/1';
    const API_URL_2 = '127.0.0.1:8000/resident/point/2';
    const API_URL_3 = '127.0.0.1:8000/resident/point/3';
    const API_URL_NO_ID = '127.0.0.1:8000/resident/point/-1';

    private static $client;
    private static $repo;

    /**
     * @beforeClass
     * set up the client to get the GET request
     */
    public static function setUpBeforeClass() : void
    {
//        self::$client = static::createClient();
//        self::$repo = static::$container->get('doctrine')->getRepository(Point::class);
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

    /**
     * @test
     * originally this was a post request test but when using alice we have generated data.
     */
    public function testPointForResidentOne(): void
    {
        $response = static::createClient()->request('GET', self::API_URL_1);

        $this->assertResponseStatusCodeSame(200);

        $this->assertJsonContains([
            'content' => '1'
        ]);
    }


    /**
     * this test will test will display id = with point=3
     */
    public function testUserWithThreePoints()
    {
        $response = static::createClient()->request('GET', self::API_URL_2);

        $this->assertJsonContains([
            'content' => '3'
        ]);
    }

    /**
     * this needs a fixture and sum function
     * this test will test will display resident_id =2 with point=80
     */
    public function testUserWithEightyPoints()
    {
        $response = static::createClient()->request('GET', self::API_URL_3);

        $this->assertResponseStatusCodeSame(200);
//        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            'content' => '80'
        ]);


//        //call client to do a get request and get the json from dataArray
//        //$response = self::$client->request('GET', self::API_URL_RESIDENT_THREE);
//
//        $response = static::createClient()->request('GET', self::API_URL_RESIDENT_THREE);
//
//        //Validate the Get request
//        $this->assertResponseStatusCodeSame(200);
//        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
//
//        //need to look for a combined
//        $this->assertJsonContains([
//            '@context' => '/api/contexts/Point',
//            '@id'=>'/api/points/3',
//            '@type' => 'Point',
//            'numPoints' => 80
//        ]);
//
//        $this->assertMatchesRegularExpression('~^/api/points/\d+$~', $response->toArray()['@id']);
//        $this->assertMatchesResourceItemJsonSchema(Point::class);
    }

    /**
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     * not sure how to handle this type of error exception
     * it says client is not set? guess I can set it in this test?
     */
    public function testUserWithNoResidentID(): void //this one if for default but test anyways
    {
        $response = static::createClient()->request('GET', self::API_URL_NO_ID);

        $this->assertResponseStatusCodeSame(404);

        $this->assertJsonContains([
            'content' => '0'
        ]);

        //why do i need to generate it to pass?
//        $response = static::createClient()->request('GET', self::API_URL_RESIDENT_FOUR);
//
//        //Validate the Get request

//        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

    }
}

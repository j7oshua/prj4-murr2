<?php
namespace App\Tests;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\PickUp;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

class PickUpSiteTest extends ApiTestCase
{
    //refreshes the database for every test
    use RefreshDatabaseTrait;


    private $pickUp;

    //static URL
    //const API_URL = '127.0.0.1:8000/api/pick_ups';
    const API_URL = 'localhost:8000/api/pick_ups';

    //Sets up each test with the variable that will be inputted into the test

    /**
     * @before
     */
    public function setup(): void
    {
        //all bins collected
        $this->pickUp = [
            'numCollect' => 5,
            'numContaminated' => 0,
            'numObstructed' => 0,
            'dateTime' => "2021-03-08",
            'site' => ["/api/sites/1"]
        ];
    }


    /**
    -     * Purpose: Test All 4 bins marked as collected
    -     * Expected Result: Success
    -     * Return: JSONLD of a Pickup transaction history object
    -     * @test
    -     */
   public function TestBinsCollected(): void
    {
        //this will index for site one
        $response = static::createClient()->request('POST', self::API_URL, ['json' => $this->pickUp]);
        //this status code means "Created"
        $this->assertResponseStatusCodeSame(201);
        //this will check if the header has a content type of a json ld object
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        //this will will check if the url has the proper pattern and id
        $this->assertMatchesRegularExpression('/^\/api\/pickup\/\d+$/', $response->toArray()['@id']);
        //this will check if the item returned is a PickUp object class
        $this->assertMatchesResourceItemJsonSchema(PickUp::class);
        //JSONLD expected result should be this:
        $this->assertJsonContains([
            '@context' => '/api/contexts/PickUp',
            '@type' => 'PickUp',
            'numCollected' => 5,
            'numObstructed' => 0,
            'numContaminated' => 0,
            'dateTime' => "",
            'site' => array(0 => 'api/site/1')
        ]);
    }


}
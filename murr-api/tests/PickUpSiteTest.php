<?php
namespace App\Tests;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\PickUp;
use App\Entity\Resident;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;
use http\Header;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class PickUpSiteTest extends ApiTestCase
{
    //refreshes the database for every test
    use RefreshDatabaseTrait;

    private $pickUp;
    private $client;

    //static URL
    const API_URL = 'localhost:8000/cusapi/pickups';
    const API_URL_LOGIN = '127.0.0.1:8000/login';

    /**
     * @before
     */
    public function setup(): void
    {
        //all bins collected
        $this->pickUp = [
            'siteId' => 1,
            'numCollected' => 5,
            'numContaminated' => 0,
            'numObstructed' => 0,
            'date' => "2021-03-26"
        ];

    }


    /**
    * Purpose: Test All 5 bins marked as collected
    * Expected Result: Success
    * Return: JSONLD of a Pickup transaction history object
    * @test
     */
    public function TestBinsCollected(): void
    {
        $client = self::createClient();

        $response = $client->request('POST', self::API_URL_LOGIN, [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [
                'username' => 'email8@email.com',
                'password' => 'password'
            ],
        ]);

        $content = $response->getContent();
        $getToken = json_decode($content);
        $token = $getToken->{'token'};

        //this will index for site one
        static::createClient()->request('POST', self::API_URL, [
            'headers' => ['Authorization' => 'Bearer ' . $token],
            'json' => $this->pickUp]);
//        //this status code means "OK"
        $this->assertResponseStatusCodeSame(200);
        //this will check if the item returned is a PickUp object class
        $this->assertMatchesResourceItemJsonSchema(PickUp::class);
        //JSONLD expected result should be this:
        $this->assertJsonContains([
            'siteObject' => "/api/sites/1",
            'id' => 4,
            'numCollected' => 5,
            'numContaminated' => 0,
            'numObstructed' => 0,
            'date' => date("Y-m-d")
        ]);
    }

    /**
     * Purpose: Test All 5 bins marked as all bin types
     * Expected Result: Success
     * Return: JSONLD of a Pickup transaction history object
     * @test
     */
    public function TestTestBinsCollectedObstructedContaminated(): void
    {
        $client = self::createClient();

        $response = $client->request('POST', self::API_URL_LOGIN, [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [
                'username' => 'email8@email.com',
                'password' => 'password'
            ],
        ]);

        $content = $response->getContent();
        $getToken = json_decode($content);
        $token = $getToken->{'token'};

        $this->pickUp['numCollected'] = 2;
        $this->pickUp['numObstructed'] = 1;
        $this->pickUp['numContaminated'] = 2;

        static::createClient()->request('POST', self::API_URL, [
            'headers' => ['Authorization' => 'Bearer ' . $token],
            'json' => $this->pickUp]);
        //this status code means "OK"
        $this->assertResponseStatusCodeSame(200);
        $this->assertMatchesResourceItemJsonSchema(PickUp::class);

        //JSONLD expected result should be this:
        $this->assertJsonContains([
            'siteObject' => "/api/sites/1",
            'id' => 4,
            'numCollected' => 2,
            'numContaminated' => 2,
            'numObstructed' => 1,
            'date' => date("Y-m-d")
        ]);

    }

    /**
     * Purpose: Test if the bin input is less than the number of bins to a site (5)
     * Expected Result: Failure -- Status Response 400
     * Return: "site: Number of bins do not match."
     * @test
     */
   public function TestValidNumberOfBinsLessThanFour(): void
   {
       $client = self::createClient();

       $response = $client->request('POST', self::API_URL_LOGIN, [
           'headers' => ['Content-Type' => 'application/json'],
           'json' => [
               'username' => 'email8@email.com',
               'password' => 'password'
           ],
       ]);

       $content = $response->getContent();
       $getToken = json_decode($content);
       $token = $getToken->{'token'};

       $this->pickUp['numCollected'] = 2;
       $this->pickUp['numObstructed'] = 1;
       $this->pickUp['numContaminated'] = 1;

       static::createClient()->request('POST', self::API_URL, [
           'headers' => ['Authorization' => 'Bearer ' . $token],
           'json' => $this->pickUp]);
       $this->assertResponseStatusCodeSame(400);

           $this->assertJsonContains([
               '0' => "site: Number of bins do not match."
           ]);

   }

    /**
     * Purpose: Test if the bin input is more than the number of bins to a site (5)
     * Expected Result: Failure -- Status Response 400
     * Return: "site: Number of bins do not match."
     * @test
     */
    public function TestInvalidNumberOfBinsMoreThanFive (): void
    {
        $client = self::createClient();

        $response = $client->request('POST', self::API_URL_LOGIN, [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [
                'username' => 'email8@email.com',
                'password' => 'password'
            ],
        ]);

        $content = $response->getContent();
        $getToken = json_decode($content);
        $token = $getToken->{'token'};

        $this->pickUp['numCollected'] = 2;
        $this->pickUp['numObstructed'] = 2;
        $this->pickUp['numContaminated'] = 2;
        static::createClient()->request('POST', self::API_URL, [
            'headers' => ['Authorization' => 'Bearer ' . $token],
            'json' => $this->pickUp]);
        $this->assertResponseStatusCodeSame(400);

        $this->assertJsonContains([
            '0' => "site: Number of bins do not match."
        ]);

    }

    /**
     * Purpose: Test if the site sent is negative
     * Expected Result: Failure -- Status Response 400
     * Return: “Item not found for site -1.”
     * @test
     */
    public function TestSiteDoesNotExistsNegativeOutofBounds(): void
    {
        $client = self::createClient();

        $response = $client->request('POST', self::API_URL_LOGIN, [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [
                'username' => 'email8@email.com',
                'password' => 'password'
            ],
        ]);

        $content = $response->getContent();
        $getToken = json_decode($content);
        $token = $getToken->{'token'};

        $this->pickUp['siteId'] = -1;

        static::createClient()->request('POST', self::API_URL, [
            'headers' => ['Authorization' => 'Bearer ' . $token],
            'json' => $this->pickUp]);
        $this->assertResponseStatusCodeSame(404);

        //expected hydra result
        $this->assertJsonContains([
            '0' => "Item not found for site -1."
        ]);

    }

    /**
     * Purpose: Test if the site sent does not exist
     * Expected Result: Failure -- Status Response 400
     * Return: “Item not found for site 99.”
     * @test
     */
    public function TestSiteDoesNotExist(): void
    {
        $client = self::createClient();

        $response = $client->request('POST', self::API_URL_LOGIN, [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [
                'username' => 'email8@email.com',
                'password' => 'password'
            ],
        ]);

        $content = $response->getContent();
        $getToken = json_decode($content);
        $token = $getToken->{'token'};

        $this->pickUp['siteId'] = 99;

        static::createClient()->request('POST', self::API_URL, [
            'headers' => ['Authorization' => 'Bearer ' . $token],
            'json' => $this->pickUp]);
        $this->assertResponseStatusCodeSame(404);

        $this->assertJsonContains([
            '0' => "Item not found for site 99."
        ]);

    }


    /**
     * Purpose: Test if the site sent null
     * Expected Result: Failure -- Status Response 404
     * Return: “Invalid: Site required"
     * @test
     */
    public function TestNullSite(): void
    {
        $client = self::createClient();

        $response = $client->request('POST', self::API_URL_LOGIN, [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [
                'username' => 'email8@email.com',
                'password' => 'password'
            ],
        ]);

        $content = $response->getContent();
        $getToken = json_decode($content);
        $token = $getToken->{'token'};

        $this->pickUp['siteId'] = null;

        static::createClient()->request('POST', self::API_URL, [
            'headers' => ['Authorization' => 'Bearer ' . $token],
            'json' => $this->pickUp]);
        $this->assertResponseStatusCodeSame(404);

        $this->assertJsonContains([
            '0' => "Invalid: site required."
        ]);

    }


    /**
     * Purpose: Test if the bin input is null
     * Expected Result: Failure -- Status Response 400
     * Return: "hydra:description":"A non-numeric value encountered"
     * @test
     */
    public function TestNullBins(): void
    {
        $client = self::createClient();

        $response = $client->request('POST', self::API_URL_LOGIN, [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [
                'username' => 'email8@email.com',
                'password' => 'password'
            ],
        ]);

        $content = $response->getContent();
        $getToken = json_decode($content);
        $token = $getToken->{'token'};

        $this->pickUp['numCollected'] = null;
        $this->pickUp['numObstructed'] = null;
        $this->pickUp['numContaminated'] = null;
        static::createClient()->request('POST', self::API_URL, [
            'headers' => ['Authorization' => 'Bearer ' . $token],
            'json' => $this->pickUp]);
        $this->assertResponseStatusCodeSame(400);

        $this->assertJsonContains([
            '0' => 'Invalid: Bin input required.'
        ]);

    }



}
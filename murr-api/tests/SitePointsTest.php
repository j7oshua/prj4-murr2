<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;


class SitePointsTest extends ApiTestCase
{
    use RefreshDatabaseTrait;

    //declare pickups
    private $pickupOne;
    private $pickupTwo;
    private $pickupThree;
    private $noPickupID;
    private $invalidPickupID;

    //API URLS used in the tests.
    const API_URL_SITE_ONE = '127.0.0.1:8000/cusapi/site/1';
    const API_URL_SITE_TWO = '127.0.0.1:8000/cusapi/site/2';
    // The below URLs will return the sum of the points for the resident
    const API_URL_RESIDENT_ONE = '127.0.0.1:8000/cusapi/points/1';
    const API_URL_RESIDENT_TWO = '127.0.0.1:8000/cusapi/points/2';
    const API_URL_RESIDENT_FOUR = '127.0.0.1:8000/cusapi/points/4';

    const API_URL_LOGIN = '127.0.0.1:8000/login';

    //Does the beginning setup before the tests are run. Initializes the json to be sent to API
    /**
     * @before
    */
    public function setUp(): void
    {
        //initialize pickups
        $this->pickupOne = [
            'pickupID' => 1
        ];

        $this->pickupTwo = [
            'pickupID' => 2
        ];

        $this->pickupThree = [
            'pickupID' => 3
        ];

        $this->noPickupID = [

        ];

        $this->invalidPickupID = [
            'pickupID' => 99
        ];

        $this->residentOne = [
            'num_points' => 100,
            'resident' => ["/api/residents/1"]
        ];
    }

    /**
     * @test
     * Purpose: This test will check if the API successfully adds points to the site with all the
     * containers collected.
     * Expected Result: Success -- Status Response 201
     * Return: success message: "Points successfully added to Wascana"
     */
    public function TestAddPointsToSiteOneWith100PercentContainerPickup(): void
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

        //Request a HTTP POST Request to the static API URL using Site One
        $response = static::createClient()->request('POST', self::API_URL_SITE_ONE, [
            'headers' => ['Authorization' => 'Bearer ' . $token],
            'json' => $this->pickupOne]);

        //Return a status code 201("created")
        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseIsSuccessful();
        //Check the response if it contains the success message
        $this->assertSame('100 Points successfully added to Wascana', $response->getContent());
    }

    /**
     * @test
     * Purpose: This test will check if the API successfully adds points to the site with half of the
     * containers collected.
     * Expected Result: Success -- Status Response 201
     * Return: success message: "Points successfully added to Brighton"
     */
    public function TestAddPointsToSiteTwoWith50PercentContainerPickup(): void
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

        //Request a HTTP POST Request to the static API URL using Site Two
        $response = static::createClient()->request('POST', self::API_URL_SITE_TWO, [
            'headers' => ['Authorization' => 'Bearer ' . $token],
            'json' => $this->pickupThree]);

        //Return a status code 201("created")
        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseIsSuccessful();
        //Check the response if it contains the success message
        $this->assertSame("50 Points successfully added to Brighton", $response->getContent());
    }

    /**
     * @test
     * Purpose: This test will check if the API successfully checks and adds no points to the site with zero
     * containers collected.
     * Expected Result: Success -- Status Response 200
     * Return: success message: "No points were added to Wascana"
     */
    public function TestAddNoPointsToSiteOneWithZeroContainerPickup(): void
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

        //Request a HTTP POST Request to the static API URL using Site One
        $response = static::createClient()->request('POST', self::API_URL_SITE_TWO, [
            'headers' => ['Authorization' => 'Bearer ' . $token],
            'json' => $this->pickupTwo]);

        //Return a status code 200("success")
        $this->assertResponseStatusCodeSame(200);
        $this->assertResponseIsSuccessful();
        //Check the response if it contains the success message
        $this->assertSame("No points were added to Brighton", $response->getContent());

    }

    /**
     * @test
     * Purpose: This test will check if the API unsuccessfully adds points to the site when there is no
     * pickup id provided
     * Expected Result: Error -- Status Response 500
     */
    public function TestAddPointsToSiteWithNoPickupId(): void
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
        //Request a HTTP POST Request to the static API URL using Resident One
        //Return a status code 500("Internal Server Error") causes API Platform to error out
        $this->assertResponseStatusCodeSame(500, static::createClient()->request('POST', self::API_URL_SITE_ONE,[
            'headers' => ['Authorization' => 'Bearer ' . $token],
            'json' => $this->noPickupID])->getStatusCode());
    }

    /**
     * @test
     * Purpose: This test will check if the API unsuccessfully adds points to the site when there is an invalid
     * pickup id provided
     * Expected Result: Error -- Status Response 422
     * Return: success message: "PickUp Id was not found"
     */
    public function TestAddPointToSiteWithInvalidPickupId(): void
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
        //Request an HTTP POST request to the static API URL using resident One
        $response = static::createClient()->request('POST', self::API_URL_SITE_ONE, [
            'headers' => ['Authorization' => 'Bearer ' . $token],
            'json' => $this->invalidPickupID]);

        //Check response to be equal to 422
        $this->assertResponseStatusCodeSame(422);
        //Check the response if it contains the error message
        $this->assertSame("error: PickUp ID not found", $response->getInfo()['response_headers'][2]);

    }

    public function TestUnauthorizedUser(): void
    {
        $client = self::createClient();

        $response = $client->request('POST', self::API_URL_LOGIN, [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [
                'username' => 'email6@email.com',
                'password' => 'password'
            ],
        ]);

        $content = $response->getContent();
        $getToken = json_decode($content);
        $token = $getToken->{'token'};

        //Request a HTTP POST Request to the static API URL using Site One
        $response = static::createClient()->request('POST', self::API_URL_SITE_TWO, [
            'headers' => ['Authorization' => 'Bearer ' . $token],
            'json' => $this->pickupTwo]);

        //Return a status code 200("success")
        $this->assertResponseStatusCodeSame(401);


    }


}
<?php


namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

use App\Entity\Site;
use App\Entity\Point;
use App\Entity\Pickup;
use App\Entity\Resident;

class SitePointsTest extends ApiTestCase
{
    use RefreshDatabaseTrait;

    //declare pickups
    private $pickupOne;
    private $pickupTwo;
    private $noPickupID;
    private $invalidPickupID;

    //API URLS used in the tests.
    const API_URL_SITE_ONE = 'http://127.0.0.1:8000/site/1';
    const API_URL_SITE_TWO = 'http://127.0.0.1:8000/site/2';
    // The below URLs will return the sum of the points for the resident
    const API_URL_RESIDENT_ONE = '127.0.0.1:8000/point/resident/1';
    const API_URL_RESIDENT_TWO = '127.0.0.1:8000/point/resident/2';
    const API_URL_RESIDENT_FOUR = '127.0.0.1:8000/point/resident/4';

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

        $this->noPickupID = [];

        $this->invalidPickupID = [
            'pickupID' => 99
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
        // Check resident for current points
//        static::createClient()->request('GET', self::API_URL_RESIDENT_TWO);
//        $this->assertJsonContains([
//            'content' => '0'
//        ]);
//
//        //This is for residentOne which contains 3 points
//        static::createClient()->request('GET', self::API_URL_RESIDENT_ONE);
//        $this->assertJsonContains([
//            'content' => '3'
//        ]);


        //Request a HTTP POST Request to the static API URL using Site One
        $response = static::createClient()->request('POST', self::API_URL_SITE_ONE, ['json' => $this->pickupOne]);

        //Return a status code 201("created")
        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseIsSuccessful();
        //Check the response if it contains the success message
        $this->assertContains("100 Points successfully added to Wascana", $response);

//        // Re-check resident for points. Expect it to be 100.
//        static::createClient()->request('GET', self::API_URL_RESIDENT_TWO);
//        $this->assertJsonContains([
//            'content' => '100'
//        ]);


//        // Re-check resident for points. Expect it to be 103.
//        static::createClient()->request('GET', self::API_URL_RESIDENT_ONE);
//        $this->assertJsonContains([
//            'content' => '103'
//        ]);
    }

//    /**
//     * @test
//     * Purpose: This test will check if the API successfully adds points to the site with half of the
//     * containers collected.
//     * Expected Result: Success -- Status Response 201
//     * Return: success message: "Points successfully added to Brighton"
//     */
//    public function TestAddPointsToSiteTwoWith50PercentContainerPickup(): void
//    {
//        // Check resident for current points
//        static::createClient()->request('GET', self::API_URL_RESIDENT_FOUR);
//        $this->assertJsonContains([
//            'content' => '25'
//        ]);
//
//        //Request a HTTP POST Request to the static API URL using Site Two
//        $response = static::createClient()->request('POST', self::API_URL_SITE_TWO, ['json' => $this->pickupOne]);
//
//        //Return a status code 201("created")
//        $this->assertResponseStatusCodeSame(201);
//        $this->assertResponseIsSuccessful();
//        //Check the response if it contains the success message
//        $this->assertContains("Points successfully added to Brighton", $response);
//
//        // Re-check resident for points. Expect it to be 50.
//        static::createClient()->request('GET', self::API_URL_RESIDENT_FOUR);
//        $this->assertJsonContains([
//            'content' => '75'
//        ]);
//
//
//    }
//
//    /**
//     * @test
//     * Purpose: This test will check if the API successfully checks and adds no points to the site with zero
//     * containers collected.
//     * Expected Result: Success -- Status Response 200
//     * Return: success message: "No points were added to Wascana"
//     */
//    public function TestAddNoPointsToSiteOneWithZeroContainerPickup(): void
//    {
//        // Check resident for current points
//        static::createClient()->request('GET', self::API_URL_RESIDENT_ONE);
//        $this->assertJsonContains([
//            'content' => '3'
//        ]);
//
//        //Request a HTTP POST Request to the static API URL using Site One
//        $response = static::createClient()->request('POST', self::API_URL_SITE_ONE, ['json' => $this->pickupOne]);
//
//        //Return a status code 200("success")
//        $this->assertResponseStatusCodeSame(200);
//        $this->assertResponseIsSuccessful();
//        //Check the response if it contains the success message
//        $this->assertContains("No points were added to Wascana", $response);
//
//
//        // Re-check resident for points. Expect it to be still at 0.
//        static::createClient()->request('GET', self::API_URL_RESIDENT_ONE);
//        $this->assertJsonContains([
//            'content' => '3'
//        ]);
//
//    }
//
//    /**
//     * @test
//     * Purpose: This test will check if the API unsuccessfully adds points to the site when there is no
//     * pickup id provided
//     * Expected Result: Error -- Status Response 400
//     * Return: success message: "Pickup Id was not found"
//     */
//    public function TestAddPointsToSiteWithNoPickupId(): void
//    {
//        //Request a HTTP POST Request to the static API URL using Resident One
//        $response = static::createClient()->request('POST', self::API_URL_SITE_ONE, ['json' => $this->noPickupID]);
//
//        //Return a status code 400("created")
//        $this->assertResponseStatusCodeSame(400);
//        //Check the response if it contains the error message
//        $this->assertContains("Pickup Id was not found", $response);
//    }
//
//    /**
//     * @test
//     * Purpose: This test will check if the API unsuccessfully adds points to the site when there is an invalid
//     * pickup id provided
//     * Expected Result: Error -- Status Response 400
//     * Return: success message: "Pickup Id was not found"
//     */
//    public function TestAddPointToSiteWithInvalidPickupId(): void
//    {
//        //Request an HTTP POST request to the static API URL using resident One
//        $response = static::createClient()->request('POST', self::API_URL_SITE_ONE, ['json' => $this->invalidPickupID]);
//
//        //Check response to be equal to 400
//        $this->assertResponseStatusCodeSame(400);
//        //Check the response if it contains the error message
//        $this->assertContains("Pickup Id was not found", $response);
//
//    }


}
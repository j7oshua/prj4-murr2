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

    private $pickupOne;
    private $pickupTwo;
    private $noPickupID;

    //API URLS
    const API_URL_SITE_ONE = '127.0.0.1:8000/api/site/1';
    const API_URL_SITE_TWO = '127.0.0.1:8000/api/site/2';
    const API_URL_RESIDENT_TWO = '127.0.0.1:8000/point/resident/2';
    const API_URL_RESIDENT_THREE = '127.0.0.1:8000/point/resident/3';
    const API_URL_RESIDENT_FOUR = '127.0.0.1:8000/point/resident/4';


    public function setUp(): void
    {
        $this->pickupOne = [
            'pickup_id' => 1
        ];

        $this->pickupTwo = [
            'pickup_id' => 2
        ];

        $this->noPickupID = [];
    }

    public function TestAddPointsToSiteOneResidentsWith100PercentContainerPickup(): void
    {
        // Check resident for current points
        static::createClient()->request('GET', self::API_URL_RESIDENT_TWO);
        $this->assertJsonContains([
            'content' => '0'
        ]);

        //Request a HTTP POST Request to the static API URL using Site One
        $response = static::createClient()->request('POST', self::API_URL_SITE_ONE, ['json' => $this->pickupOne]);

        //Return a status code 201("created")
        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseIsSuccessful();


        // Re-check resident for points. Expect it to be 100.
        static::createClient()->request('GET', self::API_URL_RESIDENT_TWO);
        $this->assertJsonContains([
            'content' => '100'
        ]);

    }

    public function TestAddPointsToSiteTwoResidentsWith50PercentContainerPickup(): void
    {
        // Check resident for current points
        static::createClient()->request('GET', self::API_URL_RESIDENT_FOUR);
        $this->assertJsonContains([
            'content' => '0'
        ]);

        //Request a HTTP POST Request to the static API URL using Site Two
        $response = static::createClient()->request('POST', self::API_URL_SITE_TWO, ['json' => $this->pickupOne]);

        //Return a status code 201("created")
        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseIsSuccessful();


        // Re-check resident for points. Expect it to be 50.
        static::createClient()->request('GET', self::API_URL_RESIDENT_FOUR);
        $this->assertJsonContains([
            'content' => '50'
        ]);

    }

    public function TestAddNoPointsToSiteOneResidentsWith0PercentContainerPickup(): void
    {
        // Check resident for current points
        static::createClient()->request('GET', self::API_URL_RESIDENT_THREE);
        $this->assertJsonContains([
            'content' => '0'
        ]);

        //Request a HTTP POST Request to the static API URL using Site One
        $response = static::createClient()->request('POST', self::API_URL_SITE_ONE, ['json' => $this->pickupOne]);

        //Return a status code 200("success")
        $this->assertResponseStatusCodeSame(200);
        $this->assertResponseIsSuccessful();


        // Re-check resident for points. Expect it to be still at 0.
        static::createClient()->request('GET', self::API_URL_RESIDENT_FOUR);
        $this->assertJsonContains([
            'content' => '0'
        ]);

    }

    public function TestAddPointToSiteWithNoPickupObject(): void
    {

        //Request a HTTP POST Request to the static API URL using Resident One
        $response = static::createClient()->request('POST', self::API_URL_SITE_ONE, ['json' => $this->noPickupID]);

        //Return a status code 400("created")
        $this->assertResponseStatusCodeSame(400);

        //Return a error message
        $this->assertContains('Error', $response->getContent());

        //Returns the headers for the status code
        $this->assertResponseHeaderSame('content-type', 'text/plain; charset=utf-8');
    }
}
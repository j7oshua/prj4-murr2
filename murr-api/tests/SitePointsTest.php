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

    public function TestAddPointToSiteOne(): void
    {
        //creates a client
        //Request a HTTP POST Request to the static API URL using Resident One
        $response = static::createClient()->request('POST', self::API_URL_SITE_ONE, ['json' => $this->pickupOne]);

        //Return a status code 201("created")
        $this->assertResponseStatusCodeSame(201);

        //Return a success message
        $this->assertResponseIsSuccessful('Success');
        $this->assertContains('Success', $response->getContent());

        //Returns the headers for the status code
        $this->assertResponseHeaderSame('content-type', 'text/plain; charset=utf-8');

    }

    public function TestAddPointToSiteWithNoPickupID(): void
    {
        //creates a client
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
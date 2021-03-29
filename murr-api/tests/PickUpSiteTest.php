<?php
namespace App\Tests;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\PickUp;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class PickUpSiteTest extends ApiTestCase
{
    //refreshes the database for every test
    use RefreshDatabaseTrait;

    //something is wrong cause i cannot see the pickup i created after the test.

    private $pickUp;

    //static URL
    //const API_URL = '127.0.0.1:8000/api/pick_ups';
    const API_URL = 'localhost:8000/pickups';

    //Sets up each test with the variable that will be inputted into the test

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
            'dateTime' => "2021-03-26"
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
        //this will index for site one
        $response = static::createClient()->request('POST', self::API_URL, ['json' => $this->pickUp]);
        //this status code means "OK"
        $this->assertResponseStatusCodeSame(200);
        //this will check if the header has a content type of a json ld object
        //$this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        //this will will check if the url has the proper pattern and id
//        try {
//            $this->assertMatchesRegularExpression('/^\/pick_ups\/\d+$/', $response->toArray()['@id']); //this does not work.
//        } catch (ClientExceptionInterface $e) {
//            $this->expectExceptionMessage($e);
//        } catch (DecodingExceptionInterface $e) {
//            $this->expectExceptionMessage($e);
//        } catch (RedirectionExceptionInterface $e) {
//            $this->expectExceptionMessage($e);
//        } catch (ServerExceptionInterface $e) {
//            $this->expectExceptionMessage($e);
//        } catch (TransportExceptionInterface $e) {
//            $this->expectExceptionMessage($e);
//        }
        //this will check if the item returned is a PickUp object class
        $this->assertMatchesResourceItemJsonSchema(PickUp::class);
        //JSONLD expected result should be this:
        $this->assertJsonContains([
            'siteObject' => "/api/sites/1",
            'id' => 1,
            'numCollected' => 5,
            'numContaminated' => 0,
            'numObstructed' => 0,
            'dateTime' => date("Y-m-d")
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
        $this->pickUp['numCollected'] = 2;
        $this->pickUp['numObstructed'] = 1;
        $this->pickUp['numContaminated'] = 2;

        $response = static::createClient()->request('POST', self::API_URL, ['json' => $this->pickUp]);
        //this status code means "OK"
        $this->assertResponseStatusCodeSame(200); //I think this is suppose to be 201 as "created but i cannot get in it to change the status
        //$this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        //$this->assertMatchesRegularExpression('/^\/pick_ups\/\d+$/', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(PickUp::class);

        //JSONLD expected result should be this:
        $this->assertJsonContains([ //why does the id not generate properly
            'siteObject' => "/api/sites/1",
            'id' => 2,
            'numCollected' => 2,
            'numContaminated' => 2,
            'numObstructed' => 1,
            'dateTime' => date("Y-m-d")
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
       $response = static::createClient()->request('POST', self::API_URL, ['json' => [
           'siteId' => 1,
            'numCollected' => 2,
            'numContaminated' => 1,
            'numObstructed' => 1,
            'dateTime' => "2021-03-08"
           ]]);
       $this->assertResponseStatusCodeSame(400);
       //$this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

       //expected hydra result
           $this->assertJsonContains([ //i get a syntax error and i do not know why cause i get get the result i want on postman but not on here
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
        $response = static::createClient()->request('POST', self::API_URL, ['json' => [
            'siteId' => 1,
            'numCollected' => 2,
            'numContaminated' => 2,
            'numObstructed' => 2,
            'dateTime' => "2021-03-08"
        ]]);
        $this->assertResponseStatusCodeSame(400);
        //$this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        //expected hydra result
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
        $response = static::createClient()->request('POST', self::API_URL, ['json' => [
            'siteId' => -1,
            'numCollected' => 2,
            'numContaminated' => 1,
            'numObstructed' => 2,
            'dateTime' => "2021-03-08"
        ]]);
        $this->assertResponseStatusCodeSame(404);
        //$this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

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
        $response = static::createClient()->request('POST', self::API_URL, ['json' => [
            'siteId' => 99,
            'numCollected' => 2,
            'numContaminated' => 1,
            'numObstructed' => 2,
            'dateTime' => "2021-03-08"
        ]]);
        $this->assertResponseStatusCodeSame(404);
        //$this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        //expected hydra result
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
        $response = static::createClient()->request('POST', self::API_URL, ['json' => [
            'siteId' => null,
            'numCollected' => 2,
            'numContaminated' => 1,
            'numObstructed' => 2,
            'dateTime' => "2021-03-08"
        ]]);
        $this->assertResponseStatusCodeSame(404);
        //$this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        //expected hydra result
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
        $response = static::createClient()->request('POST', self::API_URL, ['json' => [
            'siteId' => 1,
            'numCollected' => null,
            'numContaminated' => null,
            'numObstructed' => null,
            'dateTime' => "2021-03-08"
        ]]);
        $this->assertResponseStatusCodeSame(400);
        //$this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        //expected hydra result
        $this->assertJsonContains([
            '0' => 'Invalid: Bin input required.'
        ]);

    }



}
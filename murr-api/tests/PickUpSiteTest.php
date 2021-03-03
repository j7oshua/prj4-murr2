<?php
namespace App\Tests;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\PickUp;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

class PickUpSiteTest extends ApiTestCase
{

    //refreshes the database for every test
    use RefreshDatabaseTrait;

    //site variables
    private $siteOne;
    private $siteNegOne;
    private $siteNinetyNine;
    private $siteNull;

    //static URL
    const API_URL = '127.0.0.1:8000/api/pickup';

    //Sets up each test with the variable that will be inputted into the test
    public function setup(): void{
        //all bins collected
        $this -> siteOne = [
            'numCollect' => 4,
            'numContaminated' => 0,
            'numObstructed' => 0,
            'dateTime' => "2021-03-08",
            'siteObject' => ["/api/site/1"]
        ];

        //all bins Obstructed
        $this -> siteOne = [
            'numCollect' => 0,
            'numContaminated' => 4,
            'numObstructed' => 0,
            'dateTime' => "2021-03-08",
            'siteObject' => ["/api/site/1"]
        ];

        //all bins contaminated
        $this -> siteOne = [
            'numCollect' => 0,
            'numContaminated' => 0,
            'numObstructed' => 4,
            'dateTime' => "2021-03-08",
            'siteObject' => ["/api/site/1"]
        ];

        $this -> siteOne = [
            'numCollect' => 2,
            'numContaminated' => 0,
            'numObstructed' => 2,
            'dateTime' => "2021-03-08",
            'siteObject' => ["/api/site/1"]
        ];

        $this -> siteOne = [
            'numCollect' => 2,
            'numContaminated' => 2,
            'numObstructed' => 0,
            'dateTime' => "2021-03-08"
        ];

        $this -> siteOne = [
            'numCollect' => 0,
            'numContaminated' => 2,
            'numObstructed' => 2,
            'dateTime' => "2021-03-08",
            'siteObject' => ["/api/site/1"]
        ];

        $this -> siteOne = [
            'numCollect' => 2,
            'numContaminated' => 1,
            'numObstructed' => 1,
            'dateTime' => "2021-03-08",
            'siteObject' => ["/api/site/1"]

        ];

        $this -> siteNegOne = [
            'numCollect' => 4,
            'numContaminated' => 0,
            'numObstructed' => 0,
            'dateTime' => "2021-03-08",
            'siteObject' => ["/api/site/-1"]
        ];

        $this -> siteNinetyNine = [
            'numCollect' => 4,
            'numContaminated' => 0,
            'numObstructed' => 0,
            'dateTime' => "2021-03-08",
            'siteObject' => ["/api/site/99"]
        ];

        //null site
        $this -> siteNull = [
            'numCollect' => 4,
            'numContaminated' => 0,
            'numObstructed' => 0,
            'dateTime' => "2021-03-08"
        ];

        $this -> siteOne = [
            'numCollect' => 2,
            'numContaminated' => 1,
            'numObstructed' => 0,
            'dateTime' => "2021-03-08",
            'siteObject' => ["/api/site/1"]
        ];

        $this -> siteOne = [
            'numCollect' => 3,
            'numContaminated' => 1,
            'numObstructed' => 1,
            'dateTime' => "2021-03-08",
            'siteObject' => ["/api/site/1"]
        ];
        //future date
        $this -> siteOne = [
            'numCollect' => 4,
            'numContaminated' => 0,
            'numObstructed' => 0,
            'dateTime' => "2021-03-08",
            'siteObject' => ["/api/site/1"]
        ];
        //past date
        $this -> siteOne = [
            'numCollect' => 4,
            'numContaminated' => 0,
            'numObstructed' => 0,
            'dateTime' => "2021-03-08",
            'siteObject' => ["/api/site/1"]
        ];
        //all bins are zero
        $this -> siteOne = [
            'numCollect' => 0,
            'numContaminated' => 0,
            'numObstructed' => 0,
            'dateTime' => "2021-03-08",
            'siteObject' => ["/api/site/1"]
        ];
        //date null
        $this -> siteOne = [
            'numCollect' => 4,
            'numContaminated' => 0,
            'numObstructed' => 0,
            'siteObject' => ["/api/site/1"]
        ];
        //null bins and date
        $this -> siteOne = [

            'dateTime' => "2021-03-08",
            'siteObject' => ["/api/site/1"]
        ];

        //all fields null
        $this -> siteOne = [
            'siteObject' => ["/api/site/1"]
        ];

    }

    /**
     * Purpose: Test All 4 bins marked as collected
     * Expected Result: Success
     * Return: JSONLD of a Pickup transaction history object
     * @test
     */
    protected function TestBinsCollected(): void
    {
        //this will index for site one
        $response = static::createClient()->request('POST', self::API_URL, ['json' => $this->siteOne]);
        //this status code means "OK"
        $this->assertResponseStatusCodeSame(200);
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
            'numCollected' => 4,
            'numObstructed' => 0,
            'numContaminated' => 0,
            'dateTime' => "",
            'site' => array(0 => 'api/site/1')
        ]);
    }

    /**
     * Purpose: Test All 4 bins marked as contaminated
     * Expected Result: Success
     * Return: JSONLD of a Pickup transaction history object
     * @test
     */
    protected function TestBinsContaminated(): void
    {
        $response = static::createClient()->request('POST', self::API_URL, ['json' => $this->siteOne]);
        $this->assertResponseStatusCodeSame(200);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertMatchesRegularExpression('/^\/api\/pickup\/\d+$/', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(PickUp::class);

        //JSONLD expected result should be this:
        $this->assertJsonContains([
            '@context' => '/api/contexts/PickUp',
            '@type' => 'PickUp',
            'numCollected' => 0,
            'numObstructed' => 0,
            'numContaminated' => 4,
            'dateTime' => "",
            'site' => array(0 => 'api/site/1')
        ]);

    }

    /**
     * Purpose: Test All 4 bins marked as obstructed
     * Expected Result: Success
     * Return: JSONLD of a Pickup transaction history object
     * @test
     */
    protected function TestBinsObstructed(): void
    {
        $response = static::createClient()->request('POST', self::API_URL, ['json' => $this->siteOne]);
        $this->assertResponseStatusCodeSame(200);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertMatchesRegularExpression('/^\/api\/pickup\/\d+$/', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(PickUp::class);

        //JSONLD expected result should be this:
        $this->assertJsonContains([
            '@context' => '/api/contexts/PickUp',
            '@type' => 'PickUp',
            'numCollected' => 0,
            'numObstructed' => 4,
            'numContaminated' => 0,
            'dateTime' => "",
            'site' => array(0 => 'api/site/1')
        ]);

    }

    /**
     * Purpose: Test All 4 bins marked as collected and obstructed
     * Expected Result: Success
     * Return: JSONLD of a Pickup transaction history object
     * @test
     */
    protected function TestBinsCollectedAndObstructed(): void
    {
        $response = static::createClient()->request('POST', self::API_URL, ['json' => $this->siteOne]);
        $this->assertResponseStatusCodeSame(200);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertMatchesRegularExpression('/^\/api\/pickup\/\d+$/', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(PickUp::class);

        //JSONLD expected result should be this:
        $this->assertJsonContains([
            '@context' => '/api/contexts/PickUp',
            '@type' => 'PickUp',
            'numCollected' => 2,
            'numObstructed' => 2,
            'numContaminated' => 0,
            'dateTime' => "",
            'site' => array(0 => 'api/site/1')
        ]);
    }

    /**
     * Purpose: Test All 4 bins marked as collected and contaminated
     * Expected Result: Success
     * Return: JSONLD of a Pickup transaction history object
     * @test
     */
    protected function TestBinsCollectedAndContaminated(): void
    {
        $response = static::createClient()->request('POST', self::API_URL, ['json' => $this->siteOne]);
        $this->assertResponseStatusCodeSame(200);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertMatchesRegularExpression('/^\/api\/pickup\/\d+$/', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(PickUp::class);

        //JSONLD expected result should be this:
        $this->assertJsonContains([
            '@context' => '/api/contexts/PickUp',
            '@type' => 'PickUp',
            'numCollected' => 2,
            'numObstructed' => 0,
            'numContaminated' => 2,
            'dateTime' => "",
            'site' => array(0 => 'api/site/1')
        ]);
    }

    /**
     * Purpose: Test All 4 bins marked as obstructed and contaminated
     * Expected Result: Success
     * Return: JSONLD of a Pickup transaction history object
     * @test
     */
    protected function TestBinsObstructAndContaminated(): void
    {
        $response = static::createClient()->request('POST', self::API_URL, ['json' => $this->siteOne]);
        $this->assertResponseStatusCodeSame(200);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertMatchesRegularExpression('/^\/api\/pickup\/\d+$/', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(PickUp::class);

        //JSONLD expected result should be this:
        $this->assertJsonContains([
            '@context' => '/api/contexts/PickUp',
            '@type' => 'PickUp',
            'numCollected' => 0,
            'numObstructed' => 2,
            'numContaminated' => 2,
            'dateTime' => "",
            'site' => array(0 => 'api/site/1')
        ]);
    }

    /**
     * Purpose: Test All 4 bins marked as all bin types
     * Expected Result: Success
     * Return: JSONLD of a Pickup transaction history object
     * @test
     */
    protected function TestTestBinsCollectedObstructedContaminated(): void
    {
        $response = static::createClient()->request('POST', self::API_URL, ['json' => $this->siteOne]);
        $this->assertResponseStatusCodeSame(200);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertMatchesRegularExpression('/^\/api\/pickup\/\d+$/', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(PickUp::class);

        //JSONLD expected result should be this:
        $this->assertJsonContains([
            '@context' => '/api/contexts/PickUp',
            '@type' => 'PickUp',
            'numCollected' => 2,
            'numObstructed' => 1,
            'numContaminated' => 1,
            'dateTime' => "",
            'site' => array(0 => 'api/site/1')
        ]);
    }

    /**
     * Purpose: Test SiteID -1 -- Negative out of bounds
     * Expected Result: Failure -- Status Response 400
     * Return: hydra description of: 'Item not found for ‘api/site/-1’'.
     * @test
     */
    protected function TestSiteDoesNotExistNegativeOutOfBounds(): void
    {
        //this will index the -1 site id,
        self::createClient()->request('POST', self::API_URL, ['json' => $this->siteNegOne]);

        //this returns a status code that means "Not Found"
        $this->assertResponseStatusCodeSame(404);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        //expected hydra result
        $this->assertJsonContains([
            'hydra:description' => 'Item not found for ‘api/site/-1’'
        ]);
    }

    /**
     * Purpose: Test siteID 99 -- Positive out of bound
     * Expected Result: Failure -- Status Response 400
     * Return: hydra description of: 'Item not found for ‘api/site/99’'.
     * @test
     */
    protected function TestSiteDoesExistPositiveOutOfBounds(): void
    {
        //this will index the 99 site id, which does not exists
        self::createClient()->request('POST', self::API_URL, ['json' => $this->siteNinetyNine]);
        $this->assertResponseStatusCodeSame(404);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        //expected hydra result
        $this->assertJsonContains([
            'hydra:description' => 'Item not found for ‘api/site/99’'
        ]);

    }

    /**
     * Purpose: Test if site is null
     * Expected Result: Failure -- Status Response 400
     * Return: hydra description of: 'site: Invalid site required.'.
     * @test
     */
    protected function TestNullSite(): void
    {
        //this will index the null site id, which does not exists
        self::createClient()->request('POST', self::API_URL, ['json' => $this->siteNull]);
        $this->assertResponseStatusCodeSame(404);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        //expected hydra result
        $this->assertJsonContains([
            'hydra:description' => 'site: Invalid site required.'
        ]);

    }

    /**
     * Purpose: Test if the bin input is less than the number of bins to a site (4)
     * Expected Result: Failure -- Status Response 400
     * Return: hydra description of: 'site: Number of bins do not match.'.
     * @test
     */
    protected function TestValidNumberOfBinsLessThanFour(): void
    {
        self::createClient()->request('POST', self::API_URL, ['json' => $this->siteOne]);
        $this->assertResponseStatusCodeSame(404);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        //expected hydra result
        $this->assertJsonContains([
            'hydra:description' => 'site: Number of bins do not match.'
        ]);
    }

    /**
     * Purpose: Test if the bin input is more than the number of bins to a site (4)
     * Expected Result: Failure -- Status Response 400
     * Return: hydra description of: 'site: Number of bins do not match.'.
     * @test
     */
    protected function TestValidNumberOfBinsMoreThanFour(): void
    {
        self::createClient()->request('POST', self::API_URL, ['json' => $this->siteOne]);
        $this->assertResponseStatusCodeSame(404);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        //expected hydra result
        $this->assertJsonContains([
            'hydra:description' => 'site: Number of bins do not match.'
        ]);
    }

    /**
     * Purpose: Test future date input
     * Expected Result: Failure -- Status Response 400
     * Return: hydra description of: 'dateTime: Invalid Date. This is a future Date'.
     * @test
     */
    protected function TestValidDateFutureDate(): void
    {
        self::createClient()->request('POST', self::API_URL, ['json' => $this->siteOne]);
        $this->assertResponseStatusCodeSame(404);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        //expected hydra result
        $this->assertJsonContains([
            'hydra:description' => 'dateTime: Invalid Date. This is a future Date'
        ]);

    }

    /**
     * Purpose: Test past date input
     * Expected Result: Failure -- Status Response 400
     * Return: hydra description of: 'dateTime: Invalid Date. This is a past Date'.
     * @test
     */
    protected function TestNameValidDatePastDate(): void
    {
        self::createClient()->request('POST', self::API_URL, ['json' => $this->siteOne]);
        $this->assertResponseStatusCodeSame(404);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        //expected hydra result
        $this->assertJsonContains([
            'hydra:description' => 'dateTime: Invalid Date. This is a past Date'
        ]);
    }

    /**
     * Purpose: Test if all bins are left at 0
     * Expected Result: Failure -- Status Response 400
     * Return: hydra description of: 'Invalid: bin input required'.
     * @test
     */
    protected function TestAllBinsZero(): void
    {
        self::createClient()->request('POST', self::API_URL, ['json' => $this->siteOne]);
        $this->assertResponseStatusCodeSame(404);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        //expected hydra result
        $this->assertJsonContains([
            'hydra:description' => 'Invalid: bin input required'
        ]);
    }

    /**
     * Purpose: Test null date input
     * Expected Result: Failure -- Status Response 400
     * Return: hydra description of: 'dateTime: Invalid date required'.
     * @test
     */
    protected function TestNullDate(): void
    {
        self::createClient()->request('POST', self::API_URL, ['json' => $this->siteOne]);
        $this->assertResponseStatusCodeSame(404);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        //expected hydra result
        $this->assertJsonContains([
            'hydra:description' => 'dateTime: Invalid date required'
        ]);
    }

    /**
     * Purpose: Test null bin input and Today's date input
     * Expected Result: Failure -- Status Response 400
     * Return: hydra description of: 'Invalid: bin input required.'.
     * @test
     */
    protected function TestNullBinsWithDate(): void
    {
        self::createClient()->request('POST', self::API_URL, ['json' => $this->siteOne]);
        $this->assertResponseStatusCodeSame(404);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        //expected hydra result
        $this->assertJsonContains([
            'hydra:description' => 'Invalid: bin input required.'
        ]);

    }

    /**
     * Purpose: Test if all fields are left null
     * Expected Result: Failure -- Status Response 400
     * Return: hydra description of: 'Invalid bin input required.'.
     *         hydra description of: 'Invalid date required.'
     * @test
     */
    protected function TestAllFieldsNull(): void
    {
        self::createClient()->request('POST', self::API_URL, ['json' => $this->siteOne]);
        $this->assertResponseStatusCodeSame(404);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        //expected result with two hydras
        $this->assertJsonContains([
            'hydra:description' => 'site: Invalid bin input required.',
            'hydra:description' => 'dateTime: Invalid date required.'

        ]);
    }



}
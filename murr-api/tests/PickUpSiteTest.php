<?php
namespace App\Tests;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Resident;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

class PickUpSiteTest extends ApiTestCase
{

    use RefreshDatabaseTrait;


    private $siteOne;
    private $siteNegOne;
    private $siteNinetyNine;

    const API_URL = '127.0.0.1:8000/api/PickUp';

    public function setup(): void{

    }

    /**
     * Purpose: Test All 4 bins marked as collected
     * Expected Result: Success
     * Return: JSONLD of a Pickup transaction history object
     * @test
     */
    protected function TestContainersCollected(): void
    {

    }

    /**
     * Purpose: Test All 4 bins marked as contaminated
     * Expected Result: Success
     * Return: JSONLD of a Pickup transaction history object
     * @test
     */
    protected function TestContainersContaminated(): void
    {

    }

    /**
     * Purpose: Test All 4 bins marked as obstructed
     * Expected Result: Success
     * Return: JSONLD of a Pickup transaction history object
     * @test
     */
    protected function TestContainersObstructed(): void
    {

    }

    /**
     * Purpose: Test All 4 bins marked as collected and obstructed
     * Expected Result: Success
     * Return: JSONLD of a Pickup transaction history object
     * @test
     */
    protected function TestContainersCollectedAndObstructed(): void
    {

    }

    /**
     * Purpose: Test All 4 bins marked as collected and contaminated
     * Expected Result: Success
     * Return: JSONLD of a Pickup transaction history object
     * @test
     */
    protected function TestContainersCollectedAndContaminated(): void
    {

    }

    /**
     * Purpose: Test All 4 bins marked as obstructed and contaminated
     * Expected Result: Success
     * Return: JSONLD of a Pickup transaction history object
     * @test
     */
    protected function TestContainersObstructAndContaminated(): void
    {

    }

    /**
     * Purpose: Test All 4 bins marked as all bin types
     * Expected Result: Success
     * Return: JSONLD of a Pickup transaction history object
     * @test
     */
    protected function TestTestContainersCollectedObstructedContaminated(): void
    {

    }

    /**
     * Purpose: Test SiteID -1 -- Negative out of bounds
     * Expected Result: Failure -- Status Response 400
     * Return: hydra description of: “Item not found for ‘api/site/-1’'.
     * @test
     */
    protected function TestSiteDoesNotExistNegativeOutOfBounds(): void
    {

    }

    /**
     * Purpose: Test siteID 99 -- Positive out of bound
     * Expected Result: Failure -- Status Response 400
     * Return: hydra description of: 'Item not found for ‘api/site/99’'.
     * @test
     */
    protected function TestSiteDoesExistPositiveOutOfBounds(): void
    {

    }

    /**
     * Purpose: Test if site is null
     * Expected Result: Failure -- Status Response 400
     * Return: hydra description of: 'Invalid: site required.'.
     * @test
     */
    protected function TestNullSite(): void
    {

    }

    /**
     * Purpose: Test if the bin input is less than the number of bins to a site (4)
     * Expected Result: Failure -- Status Response 400
     * Return: hydra description of: 'site: Number of bins do not match.'.
     * @test
     */
    protected function TestValidNumberOfBinsLessThanFour(): void
    {

    }

    /**
     * Purpose: Test if the bin input is more than the number of bins to a site (4)
     * Expected Result: Failure -- Status Response 400
     * Return: hydra description of: 'site: Number of bins do not match.'.
     * @test
     */
    protected function TestValidNumberOfBinsMoreThanFour(): void
    {

    }

    /**
     * Purpose: Test future date input
     * Expected Result: Failure -- Status Response 400
     * Return: hydra description of: 'dateTime”: “Invalid Date.'.
     * @test
     */
    protected function TestValidDateFutureDate(): void
    {

    }

    /**
     * Purpose: Test past date input
     * Expected Result: Failure -- Status Response 400
     * Return: hydra description of: 'dateTime”: “Invalid Date.'.
     * @test
     */
    protected function TestNameValidDatePastDate(): void
    {

    }

    /**
     * Purpose: Test if all bins are left at 0
     * Expected Result: Failure -- Status Response 400
     * Return: hydra description of: 'Invalid: bin input required'.
     * @test
     */
    protected function TestAllBinsZero(): void
    {

    }

    /**
     * Purpose: Test null date input
     * Expected Result: Failure -- Status Response 400
     * Return: hydra description of: 'dateTime”: “Invalid date required'.
     * @test
     */
    protected function TestNullDate(): void
    {

    }

    /**
     * Purpose: Test null bin input and Today's date input
     * Expected Result: Failure -- Status Response 400
     * Return: hydra description of: 'Invalid: bin input required.'.
     * @test
     */
    protected function TestNullBinsWithDate(): void
    {

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

    }



}
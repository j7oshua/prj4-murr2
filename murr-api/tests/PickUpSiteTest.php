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

    protected function TestContainersCollected(): void
    {

    }

    protected function TestContainersContaminated(): void
    {

    }

    protected function TestContainersObstructed(): void
    {

    }

    protected function TestContainersCollectedAndObstructed(): void
    {

    }

    protected function TestContainersCollectedAndContaminated(): void
    {

    }

    protected function TestContainersObstructAndContaminated(): void
    {

    }

    protected function TestTestContainersCollectedObstructedContaminated(): void
    {

    }

    protected function TestSiteDoesNotExistNegativeOutOfBounds(): void
    {

    }

    protected function TestSiteDoesExistPositiveOutOfBounds(): void
    {

    }

    protected function TestNullSite(): void
    {

    }

    protected function TestValidNumberOfBinsLessThanFour(): void
    {

    }

    protected function TestValidNumberOfBinsMoreThanFour(): void
    {

    }

    protected function TestValidDateFutureDate(): void
    {

    }

    protected function TestNameValidDatePastDate(): void
    {

    }

    protected function TestAllBinsZero(): void
    {

    }

    protected function TestNullDate(): void
    {

    }

    protected function TestNullBinsWithDate(): void
    {

    }

    protected function TestAllFieldsNull(): void
    {

    }



}
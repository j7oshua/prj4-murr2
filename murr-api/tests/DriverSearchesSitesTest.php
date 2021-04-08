<?php


namespace App\Tests;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

class DriverSearchesSitesTest extends ApiTestCase
{
    //This refreshes the database for every test
    use RefreshDatabaseTrait;

    // The URLs need to test
    const API_URL_SITE_TWO = 'http://localhost:8000/api/sites?order[siteName=Brighton]=desc&page=1';
    const API_URL_SITE_FULL = 'http://localhost:8000/api/sites?order[siteName=]=desc&page=1';
    const API_URL_SITE_FULL2 = 'http://localhost:8000/api/sites?order[siteName=]=desc&page=2';
    const API_URL_SITE_PART = 'http://localhost:8000/api/sites?order[siteName=Bri]=desc&page=1';
    const API_URL_SITE_NOT_EXIST = 'http://localhost:8000/api/sites?order[siteName=Wellington]=desc&page=1';

    /**
     * Title: TestFullSiteList
     * Purpose: Check full list page 1
     * Return: Response code 200 (OK)
     *          Site objects returned: Applewood bridge, Applewood Gate, Brighton, Britney Manor, Cellsullo Gate, Lucas Caswell Manor, Rosa Towers, Vendetta Suites, Vermont Crossing
     * @test
     */
    public function TestFullSiteListAPI() : void
    {
        $response = static::createClient()->request('GET', self::API_URL_SITE_FULL);

        $this->assertResponseStatusCodeSame(200);
        $this->assertJsonContains([
            '@context' => '/contexts/Site',
            '@id' => '/Site',
            '@type' => 'hydra:Collection',
            'hydra:member' => [
     {
         '@context' => '/api/contexts/Site',
   '@id' => '/api/sites/8',
   '@type' => 'Site',
   'id' => 8,
   'siteName' => 'Applewood Bridge',
   'numBins' => 7
 },
{
    '@context' => '/api/contexts/Site',
   '@id' => '/api/sites/10',
   '@type' => 'Site',
   'id' => 10,
   'siteName' => 'Applewood Gate',
   'numBins' => 4
 },
{
    '@context' => '/api/contexts/Site',
   '@id' => '/api/sites/2',
   '@type' => 'Site',
   'id' => 2,
   'siteName' => 'Brighton',
   'numBins' => 5
},
{
    '@context' => '/api/contexts/Site',
   '@id' => '/api/sites/3',
   '@type' => 'Site',
   'id' => 3,
   'siteName' => 'Britney Manor',
   'numBins' => 5
},
{
    '@context' => '/api/contexts/Site',
   '@id' => '/api/sites/9',
   '@type' => 'Site',
   'id' => 9,
   'siteName' => 'Cellsullo Gate',
   'numBins' => 3
 },
{
    '@context' => '/api/contexts/Site',
   '@id' => '/api/sites/12',
   '@type' => 'Site',
   'id' => 12,
   'siteName' => 'Lucas Caswell Manor',
   'numBins' => 2
 },
{
    '@context' => '/api/contexts/Site',
   '@id' => '/api/sites/4',
   '@type' => 'Site',
   'id' => 4,
   'siteName' => 'Rosa Towers',
   'numBins' => 1
 }, {
            '@context' => '/api/contexts/Site',
   '@id' => '/api/sites/6',
   '@type' => 'Site',
   'id' => 6,
   'siteName' => 'Roswell Evergreen',
   'numBins' => 1
 },
{
    '@context' => '/api/contexts/Site',
   '@id' => '/api/sites/5',
   '@type' => 'Site',
   'id' => 5,
   'siteName' => 'Vendetta Suites',
   'numBins' => 5
 },
{
    '@context' => '/api/contexts/Site',
   '@id' => '/api/sites/11',
   '@type' => 'Site',
   'id' => 11,
   'siteName' => 'Vermont Crossing',
   'numBins' => 4
 }],
'hydra:totalItems' => 12,
        'hydra:view' => {
        '@id' => '/sites?page=1',
    '@type' => 'hydra:PartialCollectionView',
    'hydra:first' => '/sites?page=1',
        'hydra:last' => '/sites?page=2',
        'hydra:next' => '/sites?page=2'
  }
        ]);

    }

    /**
     * Title: TestFullSiteList2
     * Purpose: Check full list page 2
     * Return: Response code 200 (OK)
     *          Site objects returned: Wascana and Willowgrove Towers
     * @test
     */
    public function TestFullSiteListAPI2() : void
    {
        $response = static::createClient()->request('GET', self::API_URL_SITE_FULL2);

        $this->assertResponseStatusCodeSame(200);
        $this->assertJsonContains([
            '@context' => '/contexts/Site',
            '@id' => '/Site',
            '@type' => 'hydra:Collection',
            'hydra:member' => [
     {
         '@context' => '/api/contexts/Site',
         '@id' => '/api/sites/1',
   '@type' => 'Site',
   'id' => 1,
   'siteName' => 'Wascana',
   'numBins' => 5
 },
{
    '@context' => '/api/contexts/Site',
   '@id' => '/api/sites/7',
   '@type' => 'Site',
   'id' => 7,
   'siteName' => 'Willowgrove Tower',
   'numBins' => 2
            }],
    'hydra:totalItems' => 12,
    'hydra:view' => {
    '@id' => '/sites?page=2',
    '@type' => 'hydra:PartialCollectionView',
    'hydra:first' => '/sites?page=1',
    'hydra:last' => '/sites?page=2',
    'hydra:next' => '/sites?page=2'
        }]);
    }

    /**
     * Title: TestFullSiteName
     * Purpose: To search the full name Brighton and have it return the Site object for Bright
     * Return: Response code 200 (OK) and Brighton site object
     * @test
     */
    public function TestFullSiteName() : void
    {
        $response = static::createClient()->request('GET', self::API_URL_SITE_TWO);

        $this->assertResponseStatusCodeSame(200);
        $this->assertJsonContains([
            '@context' => '/contexts/Site',
            '@id' => '/Site',
            '@type' => 'hydra:Collection',
            'hydra:member' => [
     {
         '@context' => '/api/contexts/Site',
         '@id' => '/api/sites/2',
         '@type' => 'Site',
         'id' => 2,
         'siteName' => 'Brighton',
         'numBins' => 5
     }],
    'hydra:totalItems' => 1,
    'hydra:view' => {
        '@id' => '/sites?page=1',
    '@type' => 'hydra:PartialCollectionView',
    'hydra:first' => '/sites?page=1',
    'hydra:last' => '/sites?page=1',
    'hydra:next' => '/sites?page=1'
        }]);

    }

    /**
     * Title: TestPartialName
     * Purpose: Check a partial Site Name
     * Return : Response code 200 (OK)
     *          Site objects returned: Applewood Bridge, Brighton and Britney Manor
     * @test
    */
    public function TestPartialName() : void
    {
        $response = static::createClient()->request('GET', self::API_URL_SITE_PART);
        $this->assertResponseStatusCodeSame(200);
        $this->assertJsonContains([
            '@context' => '/contexts/Site',
            '@id' => '/Site',
            '@type' => 'hydra:Collection',
            'hydra:member' => [
     {
         '@context' => '/api/contexts/Site',
         '@id' => '/api/sites/8',
   '@type' => 'Site',
   'id' => 8,
   'siteName' => 'Applewood Bridge',
   'numBins' => 7
 },
{
    '@context' => '/api/contexts/Site',
   '@id' => '/api/sites/2',
   '@type' => 'Site',
   'id' => 2,
   'siteName' => 'Brighton',
   'numBins' => 5
            },
        {
            '@context' => '/api/contexts/Site',
   '@id' => '/api/sites/3',
   '@type' => 'Site',
   'id' => 3,
   'siteName' => 'Britney Manor',
   'numBins' => 5
        }],
    'hydra:totalItems' => 3,
    'hydra:view' => {
        '@id' => '/sites?page=1',
    '@type' => 'hydra:PartialCollectionView',
    'hydra:first' => '/sites?page=1',
    'hydra:last' => '/sites?page=1',
    'hydra:next' => '/sites?page=1'
        }]);
    }

    /**
     * Title: TestSiteNameDoesNotExist
     *  Purpose: Check if the Site Name enter exists
     *  Return: Response code 404 (Item not Found)
     *          Hydra description: 'Item not found for ‘/api/sites?siteName=Wellington’
     * @test
     */
    public function TestSiteNameDoesNotExist() : void
    {
        $response = static::createClient()->request('GET', self::API_URL_SITE_NOT_EXIST);

        $this->assertResponseStatusCodeSame(404);
        $this->assertJsonContains([
            'hydra:description'=> 'Item not found for ‘/api/sites?siteName=Wellington’'
        ]);
    }

}
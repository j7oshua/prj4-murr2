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
        '@context' => '/api/context/Site',
            '@id'=> '/api/sites',
            '@type' => 'hydra:Collection',
            'hydra:totalItems' => 10,
            'hydra:view' => [
                // here is where we need to figure out how to put an array of sites in
                '@id' => 'api/sites/8'
            ],
        ]);
    }
//
//    /**
//     * Title: TestFullSiteList2
//     * Purpose: Check full list page 2
//     * Return: Response code 200 (OK)
//     *          Site objects returned: Wascana and Willowgrove Towers
//     * @test
//     */
//    public function TestFullSiteListAPI2() : void
//    {
//        $response = static::createClient()->request('GET', self::API_URL_SITE_FULL2);
//
//        $this->assertResponseStatusCodeSame(200);
//        $this->assertJsonContains([
//            '@context' => '/contexts/Site',
//            '@id' => '/Site',
//            '@type' => 'hydra:Collection',
//            'hydra:member' => [
//     {
//         '@context' => '/api/contexts/Site',
//         '@id' => '/api/sites/1',
//   '@type' => 'Site',
//   'id' => 1,
//   'siteName' => 'Wascana',
//   'numBins' => 5
// },
//{
//    '@context' => '/api/contexts/Site',
//   '@id' => '/api/sites/7',
//   '@type' => 'Site',
//   'id' => 7,
//   'siteName' => 'Willowgrove Tower',
//   'numBins' => 2
//            }],
//    'hydra:totalItems' => 12,
//    'hydra:view' => {
//    '@id' => '/sites?page=2',
//    '@type' => 'hydra:PartialCollectionView',
//    'hydra:first' => '/sites?page=1',
//    'hydra:last' => '/sites?page=2',
//    'hydra:next' => '/sites?page=2'
//        }]);
//    }
//
//    /**
//     * Title: TestFullSiteName
//     * Purpose: To search the full name Brighton and have it return the Site object for Bright
//     * Return: Response code 200 (OK) and Brighton site object
//     * @test
//     */
//    public function TestFullSiteName() : void
//    {
//        $response = static::createClient()->request('GET', self::API_URL_SITE_TWO);
//
//        $this->assertResponseStatusCodeSame(200);
//        $this->assertJsonContains([
//            '@context' => '/contexts/Site',
//            '@id' => '/Site',
//            '@type' => 'hydra:Collection',
//            'hydra:member' => [
//     {
//         '@context' => '/api/contexts/Site',
//         '@id' => '/api/sites/2',
//         '@type' => 'Site',
//         'id' => 2,
//         'siteName' => 'Brighton',
//         'numBins' => 5
//     }],
//    'hydra:totalItems' => 1,
//    'hydra:view' => {
//        '@id' => '/sites?page=1',
//    '@type' => 'hydra:PartialCollectionView',
//    'hydra:first' => '/sites?page=1',
//    'hydra:last' => '/sites?page=1',
//    'hydra:next' => '/sites?page=1'
//        }]);
//
//    }
//
//    /**
//     * Title: TestPartialName
//     * Purpose: Check a partial Site Name
//     * Return : Response code 200 (OK)
//     *          Site objects returned: Applewood Bridge, Brighton and Britney Manor
//     * @test
//    */
//    public function TestPartialName() : void
//    {
//        $response = static::createClient()->request('GET', self::API_URL_SITE_PART);
//        $this->assertResponseStatusCodeSame(200);
//        $this->assertJsonContains([
//            '@context' => '/contexts/Site',
//            '@id' => '/Site',
//            '@type' => 'hydra:Collection',
//            'hydra:member' => [
//     {
//         '@context' => '/api/contexts/Site',
//         '@id' => '/api/sites/8',
//   '@type' => 'Site',
//   'id' => 8,
//   'siteName' => 'Applewood Bridge',
//   'numBins' => 7
// },
//{
//    '@context' => '/api/contexts/Site',
//   '@id' => '/api/sites/2',
//   '@type' => 'Site',
//   'id' => 2,
//   'siteName' => 'Brighton',
//   'numBins' => 5
//            },
//        {
//            '@context' => '/api/contexts/Site',
//   '@id' => '/api/sites/3',
//   '@type' => 'Site',
//   'id' => 3,
//   'siteName' => 'Britney Manor',
//   'numBins' => 5
//        }],
//    'hydra:totalItems' => 3,
//    'hydra:view' => {
//        '@id' => '/sites?page=1',
//    '@type' => 'hydra:PartialCollectionView',
//    'hydra:first' => '/sites?page=1',
//    'hydra:last' => '/sites?page=1',
//    'hydra:next' => '/sites?page=1'
//        }]);
//    }
//
//    /**
//     * Title: TestSiteNameDoesNotExist
//     *  Purpose: Check if the Site Name enter exists
//     *  Return: Response code 404 (Item not Found)
//     *          Hydra description: 'Item not found for ‘/api/sites?siteName=Wellington’
//     * @test
//     */
//    public function TestSiteNameDoesNotExist() : void
//    {
//        $response = static::createClient()->request('GET', self::API_URL_SITE_NOT_EXIST);
//
//        $this->assertResponseStatusCodeSame(404);
//        $this->assertJsonContains([
//            'hydra:description'=> 'Item not found for ‘/api/sites?siteName=Wellington’'
//        ]);
//    }

}
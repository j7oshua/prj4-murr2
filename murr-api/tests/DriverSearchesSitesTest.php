<?php


namespace App\Tests;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

class DriverSearchesSitesTest extends ApiTestCase
{
    use RefreshDatabaseTrait;

    const API_URL_SITE_TWO = 'http://localhost:8000/api/sites?siteName=Brighton';
    const API_URL_SITE_NULL = 'http://localhost:8000/api/sites?siteName=';
    const API_URL_SITE_PART = 'http://localhost:8000/api/sites?siteName=Bri';
    const API_URL_SITE_NOT_EXIST = 'http://localhost:8000/api/sites?siteName=Wellington';

    /**
     * @test
     */
    public function TestFullSiteName() : void
    {
        $response = static::createClient()->request('GET', self::API_URL_SITE_TWO);

        $this->assertResponseStatusCodeSame(200);
        $this->assertJsonContains([
        '@context'=> '/api/contexts/Site',
        '@id'=> '/api/sites/2',
        '@type'=> 'Site',
        'id'=> 2,
        'siteName'=> 'Brighton',
        'numBins'=> 5,
        ]);

    }

    /**
     * @test
     */
    public function TestNullSite() : void
    {
        $response = static::createClient()->request('GET', self::API_URL_SITE_NULL);

        $this->assertResponseStatusCodeSame(404);
        $this->assertJsonContains([
            'hydra:description'=> 'Item not found for ‘/api/sites?siteName=’'
        ]);
    }

    /**
     * @test
    */
    public function TestPartialName() : void
    {
        $response = static::createClient()->request('GET', self::API_URL_SITE_PART);
        $this->assertResponseStatusCodeSame(200);
        $this->assertJsonContains([[
            '@context'=> '/api/contexts/Site',
            '@id'=> '/api/sites/2',
            '@type'=> 'Site',
            'id'=> 2,
            'siteName'=> 'Brighton',
            'numBins'=> 5,
            ],[
            '@context'=> '/api/contexts/Site',
            '@id'=> '/api/sites/3',
            '@type'=> 'Site',
            'id'=> 3,
            'siteName'=> 'Britney Manor',
            'numBins'=> 5
            ]
        ]);
    }

    /**
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
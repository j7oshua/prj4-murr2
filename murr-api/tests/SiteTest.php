<?php


namespace App\Tests;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

class SiteTest extends ApiTestCase
{
    //This refreshes the database for every test
    use RefreshDatabaseTrait;

    /**
     * Title: TestFullSiteList
     * Purpose: Check full list page 1
     * Return: Response code 200 (OK)
     *          Site objects returned: Applewood bridge, Applewood Gate, Brighton, Britney Manor, Cellsullo Gate, Lucas Caswell Manor, Rosa Towers, Vendetta Suites, Vermont Crossing
     * @test
     */
    public function TestFullSiteListAPI() : void
    {
        $response = static::createClient()->request('GET', 'http://localhost:8000/api/sites?order[siteName]&siteName=&page=1');

        $this->assertResponseStatusCodeSame(200);
        $this->assertJsonContains([
            '@context' => '/api/contexts/Site',
            '@id' => '/api/sites',
            '@type' => 'hydra:Collection',
            'hydra:member' => [
        [
         '@id' => '/api/sites/8',
         '@type' => 'Site',
         'id' => 8,
         'siteName' => 'Applewood Bridge',
         'numBins' => 7,
         'residents' => [],
         'pickupCollection' => []
    ],
    [
        '@id' => '/api/sites/10',
        '@type' => 'Site',
        'id' => 10,
        'siteName' => 'Applewood Gate',
        'numBins' => 4,
        'residents' => [],
        'pickupCollection' => []
    ],
    [
        '@id' => '/api/sites/2',
        '@type' => 'Site',
        'id' => 2,
        'siteName' => 'Brighton',
        'numBins' => 6,
        'residents' => [
            [
                '@id' => '/api/residents/4',
                '@type' => 'Resident',
                'id' => 4,
                'email' => null,
                'phone' => null,
                'points' => [],
                'password' => 'Password'
            ],
           [
               '@id' => '/api/residents/5',
               '@type' => 'Resident',
               'id' => 5,
               'email' => null,
               'phone' => null,
               'points' => [],
               'password' => 'Password'
          ]
       ],
        'pickupCollection' => [
        ]
    ],
    [
        '@id' => '/api/sites/3',
        '@type' => 'Site',
        'id' => 3,
        'siteName' => 'Britney Manor',
        'numBins' => 3,
        'residents' => [],
        'pickupCollection' => []
    ],
    [
        '@id' => '/api/sites/9',
        '@type' => 'Site',
        'id' => 9,
        'siteName' => 'Censullo Gate',
        'numBins' => 3,
        'residents' => [],
        'pickupCollection' => []
    ],
    [

        '@id' => '/api/sites/12',
        '@type' => 'Site',
        'id' => 12,
        'siteName' => 'Lucas Caswell Manor',
        'numBins' => 2,
        'residents' => [],
        'pickupCollection' => []
    ],
    [
        '@id' => '/api/sites/4',
        '@type' => 'Site',
        'id' => 4,
        'siteName' => 'Rosa Towers',
        'numBins' => 1,
        'residents' => [],
        'pickupCollection' => []
    ],
    [
        '@id' => '/api/sites/6',
        '@type' => 'Site',
        'id' => 6,
        'siteName' => 'Roswell Evergreen',
        'numBins' => 1,
        'residents' => [],
        'pickupCollection' => []
    ],
    [
        '@id' => '/api/sites/5',
        '@type' => 'Site',
        'id' => 5,
        'siteName' => 'Vendetta Suites',
        'numBins' => 5,
        'residents' => [],
        'pickupCollection' => []
    ],
    [
        '@id' => '/api/sites/11',
        '@type' => 'Site',
        'id' => 11,
        'siteName' => 'Vermont Crossing',
        'numBins' => 4,
        'residents' => [],
        'pickupCollection' => []
    ]],
        'hydra:view' => [
            '@id' => '/api/sites?order%5BsiteName%5D=&siteName=&page=1',
            '@type' => 'hydra:PartialCollectionView'
        ],
       'hydra:search' => [
        '@type' => 'hydra:IriTemplate',
        'hydra:template' => '/api/sites{?order[siteName],siteName}',
        'hydra:variableRepresentation'=> 'BasicRepresentation',
        'hydra:mapping'=> [
            [
                '@type' => 'IriTemplateMapping',
                'variable'=> 'order[siteName]',
                'property'=> 'siteName',
                'required' => false
            ],
            [
                '@type' => 'IriTemplateMapping',
                'variable' => 'siteName',
                'property' => 'siteName',
                'required'=> false
            ]
          ]
       ]
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
        $response = static::createClient()->request('GET', 'http://localhost:8000/api/sites?order[siteName]&siteName=&page=2');

        $this->assertResponseStatusCodeSame(200);
        $this->assertJsonContains([
            '@context' => '/api/contexts/Site',
            '@id' => '/api/sites',
            '@type' => 'hydra:Collection',
            'hydra:member' => [
        [
            '@id' => '/api/sites/1',
            '@type' => 'Site',
            'id' => 1,
            'siteName' => 'Wascana',
            'numBins' => 5,
            'residents' => [
                [
                    '@id' => '/api/residents/1',
                    '@type' => 'Resident',
                    'id' => 1,
                    'email' => null,
                    'phone' => null,
                    'points' => [],
                    'password' => 'Password'
                ],
                [
                    '@id' => '/api/residents/2',
                    '@type' => 'Resident',
                    'id' => 2,
                    'email' => null,
                    'phone' => null,
                    'points' => [],
                    'password' => 'Password'
                ],
                [
                    '@id' => '/api/residents/3',
                    '@type' => 'Resident',
                    'id' => 3,
                    'email' => null,
                    'phone' => null,
                    'points' => [],
                    'password' => 'Password'
                ]
            ],
            'pickupCollection' => [
                '/api/pick_ups/1'
            ]
        ],
        [
            '@id' => '/api/sites/7',
            '@type' => 'Site',
            'id' => 7,
            'siteName' => 'Willowgrove Towers',
            'numBins' => 2,
            'residents' => [],
            'pickupCollection' => []
            ]
          ],
            'hydra:view' => [
                '@id' => '/api/sites?order%5BsiteName%5D=&siteName=&page=2',
                '@type' => 'hydra:PartialCollectionView',
                'hydra:previous' => '/api/sites?order%5BsiteName%5D=&siteName=&page=1'
            ],
            'hydra:search' => [
                '@type' => 'hydra:IriTemplate',
                'hydra:template' => '/api/sites{?order[siteName],siteName}',
                'hydra:variableRepresentation'=> 'BasicRepresentation',
                'hydra:mapping'=> [
                    [
                        '@type' => 'IriTemplateMapping',
                        'variable'=> 'order[siteName]',
                        'property'=> 'siteName',
                        'required' => false
                    ],
                    [
                        '@type' => 'IriTemplateMapping',
                        'variable' => 'siteName',
                        'property' => 'siteName',
                        'required'=> false
                    ]
                ]
            ]
        ]);
    }

    /**
     * Title: TestFullSiteName
     * Purpose: To search the full name Brighton and have it return the Site object for Bright
     * Return: Response code 200 (OK) and Brighton site object
     * @test
     */
    public function TestFullSiteName() : void
    {
        $response = static::createClient()->request('GET', 'http://localhost:8000/api/sites?order[siteName]&siteName=Brighton&page=1');

        $this->assertResponseStatusCodeSame(200);
        $this->assertJsonContains([
            '@context' => '/api/contexts/Site',
            '@id' => '/api/sites',
            '@type' => 'hydra:Collection',
            'hydra:member' => [
        [
         '@id' => '/api/sites/2',
         '@type' => 'Site',
         'id' => 2,
         'siteName' => 'Brighton',
         'numBins' => 6,
         'residents' => [
                [
                    '@id' => '/api/residents/4',
                    '@type' => 'Resident',
                    'id' => 4,
                    'email' => null,
                    'phone' => null,
                    'points' => [],
                    'password' => 'Password'
                ],
                [
                    '@id' => '/api/residents/5',
                    '@type' => 'Resident',
                    'id' => 5,
                    'email' => null,
                    'phone' => null,
                    'points' => [],
                    'password' => 'Password'
                ]
            ],
            'pickupCollection' => [
                '/api/pick_ups/2',
                '/api/pick_ups/3'
            ]
        ]],
            'hydra:view' => [
                '@id' => '/api/sites?order%5BsiteName%5D=&siteName=Brighton&page=1',
                '@type' => 'hydra:PartialCollectionView'
            ],
            'hydra:search' => [
                '@type' => 'hydra:IriTemplate',
                'hydra:template' => '/api/sites{?order[siteName],siteName}',
                'hydra:variableRepresentation'=> 'BasicRepresentation',
                'hydra:mapping'=> [
                    [
                        '@type' => 'IriTemplateMapping',
                        'variable'=> 'order[siteName]',
                        'property'=> 'siteName',
                        'required' => false
                    ],
                    [
                        '@type' => 'IriTemplateMapping',
                        'variable' => 'siteName',
                        'property' => 'siteName',
                        'required'=> false
                    ]
                ]
            ]
        ]);
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
        $response = static::createClient()->request('GET', 'http://localhost:8000/api/sites?order[siteName]&siteName=Bri&page=1');
        $this->assertResponseStatusCodeSame(200);
        $this->assertJsonContains([
            '@context' => '/api/contexts/Site',
            '@id' => '/api/sites',
            '@type' => 'hydra:Collection',
            'hydra:member' => [
        [
            '@id' => '/api/sites/8',
            '@type' => 'Site',
            'id' => 8,
            'siteName' => 'Applewood Bridge',
            'numBins' => 7,
            'residents' => [],
            'pickupCollection' => []
        ],
        [
            '@id' => '/api/sites/2',
            '@type' => 'Site',
            'id' => 2,
            'siteName' => 'Brighton',
            'numBins' => 6,
            'residents' => [
                [
                    '@id' => '/api/residents/4',
                    '@type' => 'Resident',
                    'id' => 4,
                    'email' => null,
                    'phone' => null,
                    'points' => [],
                    'password' => 'Password'
                ],
                [
                    '@id' => '/api/residents/5',
                    '@type' => 'Resident',
                    'id' => 5,
                    'email' => null,
                    'phone' => null,
                    'points' => [],
                    'password' => 'Password'
                ]
            ],
            'pickupCollection' => [
                '/api/pick_ups/2',
                '/api/pick_ups/3'
            ]
        ],
        [
            '@id' => '/api/sites/3',
            '@type' => 'Site',
            'id' => 3,
            'siteName' => 'Britney Manor',
            'numBins' => 3,
            'residents' => [],
            'pickupCollection' => []
        ]],
            'hydra:view' => [
                '@id' => '/api/sites?order%5BsiteName%5D=&siteName=Bri&page=1',
                '@type' => 'hydra:PartialCollectionView'
            ],
            'hydra:search' => [
                '@type' => 'hydra:IriTemplate',
                'hydra:template' => '/api/sites{?order[siteName],siteName}',
                'hydra:variableRepresentation'=> 'BasicRepresentation',
                'hydra:mapping'=> [
                    [
                        '@type' => 'IriTemplateMapping',
                        'variable'=> 'order[siteName]',
                        'property'=> 'siteName',
                        'required' => false
                    ],
                    [
                        '@type' => 'IriTemplateMapping',
                        'variable' => 'siteName',
                        'property' => 'siteName',
                        'required'=> false
                    ]
                ]
            ]
        ]);
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
        $response = static::createClient()->request('GET', 'http://localhost:8000/api/sites?order[siteName]&siteName=Wellington');

        $this->assertResponseStatusCodeSame(404);
        $this->assertJsonContains([
            'hydra:description'=> 'Item not found for ‘/api/sites?siteName=Wellington’'
        ]);
        // {"@context":"\/api\/contexts\/Site","@id":"\/api\/sites","@type":"hydra:Collection","hydra:member":[],"hydra:view":{"@id":"\/api\/sites?order%5BsiteName%5D=\u0026siteName=Wellington\u0026page=1","@type":"hydra:PartialCollectionView"},"hydra:search":{"@type":"hydra:IriTemplate","hydra:template":"\/api\/sites{?order[siteName],siteName}","hydra:variableRepresentation":"BasicRepresentation","hydra:mapping":[{"@type":"IriTemplateMapping","variable":"order[siteName]","property":"siteName","required":false},{"@type":"IriTemplateMapping","variable":"siteName","property":"siteName","required":false}]}}
    }

}
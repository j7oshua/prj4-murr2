<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Article;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;
class ArticleTest extends ApiTestCase
{
    use RefreshDatabaseTrait;

    private static $client;
    private array $dataArray;
    const VIOLATION_ARRAY=[
        '@context' => '/contexts/ConstraintViolationList',
        '@type' => 'ConstraintViolationList',
        'hydra:title' => 'An error occurred'
    ];

    const API_URL = '127.0.0.1:8000/api/articles';

    /**
     * @before
     */
    public function Setup(): void
    {
        //Setup an array that contains information to create a resident account.
        $this->dataArray = [
            'title' => 'What Can You Recycle',
            'image' => 'http://image1url.jpg',
            'info' => 'Paper, Plastic, and Cardboard',
        ];
    }

    const API_URL_EDU = '127.0.0.1:8000/api/articles';
    const API_URL_EDU_ARTICLE = '127.0.0.1:8000/api/articles/1';
    const API_URL_NO_ID = '127.0.0.1:8000/api/articles/-1';


    /**
     * @test
     * Testing to see a valid post
     */
    public function TestValidPost(): void
    {
        $response = $response = static::createClient()->request('POST', self::API_URL, ['json' => [
            'title' => 'What Can You Recycle',
            'image' => 'http://image1url.jpg',
            'info' => 'Paper, Plastic, and Cardboard',
        ]]);

        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            'title' => 'What Can You Recycle',
            'image' => 'http://image1url.jpg',
            'info' => 'Paper, Plastic, and Cardboard',
        ]);
        $this->assertMatchesRegularExpression('~^/api/articles/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(Article::class);
    }

    /**
     * @test
     * Testing for an invalid image
     */
    public function TestInvalidImageURL(): void
    {
        $this->dataArray['image'] = 'not url';
        $response = $response = static::createClient()->request('POST', self::API_URL, ['json' => $this->dataArray ]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context' => '/api/contexts/ConstraintViolationList',
            '@type' => 'ConstraintViolationList',
            'hydra:title' => 'An error occurred',
            'hydra:description' => 'image: Must be valid image url.'
        ]);
    }

    /**
     * @test
     * testing for a title longer than 200 character max
     */
    public function TestInvalidTitle(): void
    {
        $this->dataArray['title'] = str_repeat('a', 201);
        $response = $response = static::createClient()->request('POST', self::API_URL, ['json' => $this->dataArray ]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context' => '/api/contexts/ConstraintViolationList',
            '@type' => 'ConstraintViolationList',
            'hydra:title' => 'An error occurred',
            'hydra:description' => 'title: Title cannot be longer than 200 characters.'
        ]);
    }

    /**
     * @test
     * Testing empty Title
     */
    public function TestInvalidTitleEmpty(): void
    {
        $this->dataArray['title'] = '';
        $response = $response = static::createClient()->request('POST', self::API_URL, ['json' => $this->dataArray ]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context' => '/api/contexts/ConstraintViolationList',
            '@type' => 'ConstraintViolationList',
            'hydra:title' => 'An error occurred',
            'hydra:description' => 'title: Title cannot be blank.'
        ]);
    }

    /**
     * @test
     * Testing article info that is shorter than 20 characters
     */
    public function TestInvalidInfoTooShort(): void
    {
        $this->dataArray['info'] = str_repeat('a', 19);
        $response = $response = static::createClient()->request('POST', self::API_URL, ['json' => $this->dataArray ]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context' => '/api/contexts/ConstraintViolationList',
            '@type' => 'ConstraintViolationList',
            'hydra:title' => 'An error occurred',
            'hydra:description' => 'info: An Article must be at least 20 characters long.'
        ]);
    }

    /**
     * @test
     * Testing article info that is longer than 3000 characters
     */
    public function TestInvalidInfoTooLong(): void
    {
        $this->dataArray['info'] = str_repeat('a', 3001);
        $response = $response = static::createClient()->request('POST', self::API_URL, ['json' => $this->dataArray ]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context' => '/api/contexts/ConstraintViolationList',
            '@type' => 'ConstraintViolationList',
            'hydra:title' => 'An error occurred',
            'hydra:description' => 'info: An Article must be less than 3000 characters long.'
        ]);
    }

    /**
     * @test
     * this test is handling the get request and making sure it gets all the articles back
     * it will return a list of all article titles and images
     */
    public function testAPIReceivesGetRequestOfAllArticles()
    {
        static::createClient()->request('GET', self::API_URL_EDU);
        $this->assertResponseStatusCodeSame(200);
        $this->assertJsonContains([
            '@context' => '/api/contexts/Article',
            '@id' => '/api/articles',
            '@type' => 'hydra:Collection',
            'hydra:member' => array (
                0 =>
                    array (
                            '@id' => '/api/articles/1',
                '@type' => 'Article',
                'id' => 1,
                'title' => 'What Can You Recycle',
                'image' => 'http://image1url.jpg',
                'info' => 'Paper, Plastic, and Cardboard',
            ),
                1 =>
                    array (
                        '@id' => '/api/articles/2',
                        '@type' => 'Article',
                        'id' => 2,
                        'title' => 'How to Recycle',
                        'image' => 'http://image2url.jpg',
                        'info' => 'Put in bin',
                    ),
                2 =>
                    array (
                        '@id' => '/api/articles/3',
                        '@type' => 'Article',
                        'id' => 3,
                        'title' => 'Hours and Location',
                        'image' => 'http://image3url.jpg',
                        'info' => 'Saskatoon',
                    ),
            ),
            'hydra:totalItems' => 3,
        ]);
    }

    /**
     * @test
     * this test is the get request for one specific article and will return the status code
     * and the article details
     */
    public function testAPIReceivesGetRequestOfArticleSelected()
    {
        static::createClient()->request('GET', self::API_URL_EDU_ARTICLE);
        $this->assertResponseStatusCodeSame(200);
        $this->assertJsonContains([
            'title'=> 'What Can You Recycle',
            'image'=> 'http://image1url.jpg',
            'info' => 'Paper, Plastic, and Cardboard'
        ]);
    }

    /**
     * @test
     * this test is handling the error if the user enters an invalid article in the url
     */
    public function testAPIReceivesGetRequestOfInvalidArticleSelected()
    {
        static::createClient()->request('GET', self::API_URL_NO_ID);
        $this->assertResponseStatusCodeSame(404);
    }

}
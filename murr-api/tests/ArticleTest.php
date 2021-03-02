<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;
class ArticleTest extends ApiTestCase
{
    use RefreshDatabaseTrait;

    const API_URL_EDU = '127.0.0.1:8000/api/articles';
    const API_URL_EDU_ARTICLE = '127.0.0.1:8000/api/articles/1';
    const API_URL_NO_ID = '127.0.0.1:8000/api/articles/-1';

    //this test is handling the get request and making sure it gets all the articles back
    //it will return a list of all article titles and images
    public function testAPIReceivesGetRequestOfAllArticles()
    {
        static::createClient()->request('GET', self::API_URL_EDU);
        $this->assertResponseStatusCodeSame(200);
        $this->assertJsonContains([
            'id' => 1, 2, 3,
            'title'=> 'What Can You Recycle', 'How to Recycle', 'Hours and Locations',
            'image'=> 'image1url', 'image2url', 'image3url'
        ]);
    }

    //this test is the get request for one specific article and will return the status code
    //and the article details
    public function testAPIReceivesGetRequestOfArticleSelected()
    {
        static::createClient()->request('GET', self::API_URL_EDU_ARTICLE);
        $this->assertResponseStatusCodeSame(200);
        $this->assertJsonContains([
            'id' => 1,
            'title'=> 'What Can You Recycle',
            'image'=> 'image1url',
            'info' => 'Paper, Plastic'
        ]);
    }

    //this test is handling the error if the user enters an invalid article in the url
    public function testAPIReceivesGetRequestOfInvalidArticleSelected()
    {
        static::createClient()->request('GET', self::API_URL_NO_ID);
        $this->assertResponseStatusCodeSame(404);
    }

}
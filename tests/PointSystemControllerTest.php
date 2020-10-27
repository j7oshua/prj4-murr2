<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PointSystemControllerTest extends WebTestCase
{
    public function testAddingUserToPointSystemSuccessfully()
    {
        $client = static::createClient();
        $response = $client->request('POST','/residentapi', [
            'json' => ['id'=> 1, 'siteID'=>1, 'password'=>'password', 'firstName'=>'John',
                'lastName'=>'Doe', 'phoneNumber'=>'333-333-3333', 'email'=>'hello@test.com', 'points'=>0]
        ]);

        $this->assertSame(201, $response);
    }

    public function testAddingUserToPointSystemWithNoFirstName()
    {
        $client = static::createClient();
        $response = $client->request('POST','/residentapi', [
            'json' => ['id'=> 1, 'siteID'=>1, 'password'=>'password',
                'lastName'=>'Doe', 'phoneNumber'=>'333-333-3333', 'email'=>'hello@test.com', 'points'=>0]
        ]);

        $this->assertSame(201, $response);
    }

    public function testAddingUserToPointSystemWithFirstNameAt20Chars()
    {
        $client = static::createClient();
        $response = $client->request('POST','/residentapi', [
            'json' => ['id'=> 1, 'siteID'=>1, 'password'=>'password', 'firstName'=>'aaaaaaaaaaaaaaaaaaaa',
                'lastName'=>'Doe', 'phoneNumber'=>'333-333-3333', 'email'=>'hello@test.com', 'points'=>0]
        ]);

        $this->assertSame(201, $response);
    }

    public function testAddingUserToPointSystemWithFirstNameWithOver20Chars()
    {
        $client = static::createClient();
        $response = $client->request('POST','/residentapi', [
            'json' => ['id'=> 1, 'siteID'=>1, 'password'=>'password', 'firstName'=>'aaaaaaaaaaaaaaaaaaaaa',
                'lastName'=>'Doe', 'phoneNumber'=>'333-333-3333', 'email'=>'hello@test.com', 'points'=>0]
        ]);

        $this->assertSame(422, $response);
    }

    public function testAddingUserToPointSystemWithNoLastName()
    {
        $client = static::createClient();
        $response = $client->request('POST','/residentapi', [
            'json' => ['id'=> 1, 'siteID'=>1, 'password'=>'password', 'phoneNumber'=>'333-333-3333',
                'email'=>'hello@test.com', 'points'=>0]
        ]);

        $this->assertSame(201, $response);
    }

    public function testAddingUserToPointSystemWithLastNameAt20Chars()
    {
        $client = static::createClient();
        $response = $client->request('POST','/residentapi', [
            'json' => ['id'=> 1, 'siteID'=>1, 'password'=>'password', 'firstName'=>'John',
                'lastName'=>'aaaaaaaaaaaaaaaaaaaa', 'phoneNumber'=>'333-333-3333', 'email'=>'hello@test.com', 'points'=>0]
        ]);

        $this->assertSame(201, $response);
    }

    public function testAddingUserToPointSystemWithLastNameOver20Chars()
    {
        $client = static::createClient();
        $response = $client->request('POST','/residentapi', [
            'json' => ['id'=> 1, 'siteID'=>1, 'password'=>'password', 'firstName'=>'John',
                'lastName'=>'aaaaaaaaaaaaaaaaaaaaa', 'phoneNumber'=>'333-333-3333', 'email'=>'hello@test.com', 'points'=>0]
        ]);

        $this->assertSame(422, $response);
    }

    public function testAddingUserToPointSystemWithNoPhoneNumber()
    {
        $client = static::createClient();
        $response = $client->request('POST','/residentapi', [
            'json' => ['id'=> 1, 'siteID'=>1, 'password'=>'password', 'firstName'=>'John',
                'lastName'=>'Doe', 'email'=>'hello@test.com', 'points'=>0]
        ]);

        $this->assertSame(422, $response);
    }

    public function testAddingUserToPointSystemWithWrongPhoneNumberFormat()
    {
        $client = static::createClient();
        $response = $client->request('POST','/residentapi', [
            'json' => ['id'=> 1, 'siteID'=>1, 'password'=>'password', 'firstName'=>'John',
                'lastName'=>'Doe', 'phoneNumber'=>'33-333-3333', 'email'=>'hello@test.com', 'points'=>0]
        ]);

        $this->assertSame(422, $response);
    }

    public function testAddingUserToPointSystemWithEmailAt50Chars()
    {
        $client = static::createClient();
        $response = $client->request('POST','/residentapi', [
            'json' => ['id'=> 1, 'siteID'=>1, 'password'=>'password', 'firstName'=>'John',
                'lastName'=>'Doe', 'phoneNumber'=>'333-333-3333',
                'email'=>'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa@email.com', 'points'=>0]
        ]);

        $this->assertSame(201, $response);
    }

    public function testAddingUserToPointSystemWithEmailOver50Chars()
    {
        $client = static::createClient();
        $response = $client->request('POST','/residentapi', [
            'json' => ['id'=> 1, 'siteID'=>1, 'password'=>'password', 'firstName'=>'John',
                'lastName'=>'Doe', 'phoneNumber'=>'333-333-3333',
                'email'=>'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa@email.com', 'points'=>0]
        ]);

        $this->assertSame(422, $response);
    }

    public function testAddingUserToPointSystemWithEmailWrongFormat()
    {
        $client = static::createClient();
        $response = $client->request('POST','/residentapi', [
            'json' => ['id'=> 1, 'siteID'=>1, 'password'=>'password', 'firstName'=>'John',
                'lastName'=>'Doe', 'phoneNumber'=>'333-333-3333',
                'email'=>'helloemailcom', 'points'=>0]
        ]);

        $this->assertSame(422, $response);
    }

    public function testAddingUserToPointSystemWithNoPassword()
    {
        $client = static::createClient();
        $response = $client->request('POST','/residentapi', [
            'json' => ['id'=> 1, 'siteID'=>1, 'firstName'=>'John',
                'lastName'=>'Doe', 'phoneNumber'=>'333-333-3333', 'email'=>'hello@test.com', 'points'=>0]
        ]);

        $this->assertSame(422, $response);
    }

    public function testAddingUserToPointSystemWithPasswordWith50Chars()
    {
        $client = static::createClient();
        $response = $client->request('POST','/residentapi', [
            'json' => ['id'=> 1, 'siteID'=>1, 'password'=>'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
                'firstName'=>'John',
                'lastName'=>'Doe', 'phoneNumber'=>'333-333-3333', 'email'=>'hello@test.com', 'points'=>0]
        ]);

        $this->assertSame(201, $response);
    }

    public function testAddingUserToPointSystemWithPasswordOver50Chars()
    {
        $client = static::createClient();
        $response = $client->request('POST','/residentapi', [
            'json' => ['id'=> 1, 'siteID'=>1, 'password'=>'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
                'firstName'=>'John',
                'lastName'=>'Doe', 'phoneNumber'=>'333-333-3333', 'email'=>'hello@test.com', 'points'=>0]
        ]);

        $this->assertSame(422, $response);
    }
}

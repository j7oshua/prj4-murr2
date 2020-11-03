<?php

namespace App\Tests;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\Resident;

class PointSystemControllerTest extends WebTestCase
{

    /**
     * @var EntityManager
     */
    private $entityManager;

    protected function setUp():void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testAddingUserToPointSystemSuccessfully()
    {

        $client = static::createClient();
        $response = $client->request('POST','/residentapi', [
            'json' => ['siteID'=>1, 'password'=>'password', 'firstName'=>'John',
                'lastName'=>'Doe', 'phoneNumber'=>'333-333-3333', 'email'=>'hello@test.com', 'points'=>0]
        ]);

        $this->assertSame(201, $response);

        $resident = $this->entityManager
            ->getRepository(Resident::class)
            ->findOneBy(['email' => 'hello@test.com']);

        $this->assertSame('hello@test.com', $resident->getEmail());

    }

    public function testAddingUserToPointSystemWithNoFirstName()
    {
        $client = static::createClient();
        $response = $client->request('POST','/residentapi', [
            'json' => ['siteID'=>1, 'password'=>'password',
                'lastName'=>'Doe', 'phoneNumber'=>'333-333-3333', 'email'=>'hello1@test.com', 'points'=>0]
        ]);

        $this->assertSame(201, $response);

        $resident = $this->entityManager
            ->getRepository(Resident::class)
            ->findOneBy(['email' => 'hello1@test.com']);

        $this->assertSame('hello1@test.com', $resident->getEmail());
    }

    public function testAddingUserToPointSystemWithFirstNameAt20Chars()
    {
        $client = static::createClient();
        $response = $client->request('POST','/residentapi', [
            'json' => ['siteID'=>1, 'password'=>'password', 'firstName'=>'aaaaaaaaaaaaaaaaaaaa',
                'lastName'=>'Doe', 'phoneNumber'=>'333-333-3333', 'email'=>'hello2@test.com', 'points'=>0]
        ]);

        $this->assertSame(201, $response);

        $resident = $this->entityManager
            ->getRepository(Resident::class)
            ->findOneBy(['email' => 'hello2@test.com']);

        $this->assertSame('hello2@test.com', $resident->getEmail());
    }

    public function testAddingUserToPointSystemWithFirstNameWithOver20Chars()
    {
        $client = static::createClient();
        $response = $client->request('POST','/residentapi', [
            'json' => ['siteID'=>1, 'password'=>'password', 'firstName'=>'aaaaaaaaaaaaaaaaaaaaa',
                'lastName'=>'Doe', 'phoneNumber'=>'333-333-3333', 'email'=>'hello3@test.com', 'points'=>0]
        ]);

        $this->assertSame(422, $response);



    }

    public function testAddingUserToPointSystemWithNoLastName()
    {
        $client = static::createClient();
        $response = $client->request('POST','/residentapi', [
            'json' => ['siteID'=>1, 'password'=>'password', 'phoneNumber'=>'333-333-3333',
                'email'=>'hello4@test.com', 'points'=>0]
        ]);

        $this->assertSame(201, $response);

        $resident = $this->entityManager
            ->getRepository(Resident::class)
            ->findOneBy(['email' => 'hello4@test.com']);

        $this->assertSame('hello4@test.com', $resident->getEmail());

    }

    public function testAddingUserToPointSystemWithLastNameAt20Chars()
    {
        $client = static::createClient();
        $response = $client->request('POST','/residentapi', [
            'json' => ['siteID'=>1, 'password'=>'password', 'firstName'=>'John',
                'lastName'=>'aaaaaaaaaaaaaaaaaaaa', 'phoneNumber'=>'333-333-3333', 'email'=>'hello5@test.com', 'points'=>0]
        ]);

        $this->assertSame(201, $response);

        $resident = $this->entityManager
            ->getRepository(Resident::class)
            ->findOneBy(['email' => 'hello5@test.com']);

        $this->assertSame('hello5@test.com', $resident->getEmail());
    }

    public function testAddingUserToPointSystemWithLastNameOver20Chars()
    {
        $client = static::createClient();
        $response = $client->request('POST','/residentapi', [
            'json' => ['siteID'=>1, 'password'=>'password', 'firstName'=>'John',
                'lastName'=>'aaaaaaaaaaaaaaaaaaaaa', 'phoneNumber'=>'333-333-3333', 'email'=>'hello6@test.com', 'points'=>0]
        ]);

        $this->assertSame(422, $response);
    }

    public function testAddingUserToPointSystemWithNoPhoneNumber()
    {
        $client = static::createClient();
        $response = $client->request('POST','/residentapi', [
            'json' => ['siteID'=>1, 'password'=>'password', 'firstName'=>'John',
                'lastName'=>'Doe', 'email'=>'hello7@test.com', 'points'=>0]
        ]);

        $this->assertSame(422, $response);
    }

    public function testAddingUserToPointSystemWithWrongPhoneNumberFormat()
    {
        $client = static::createClient();
        $response = $client->request('POST','/residentapi', [
            'json' => ['siteID'=>1, 'password'=>'password', 'firstName'=>'John',
                'lastName'=>'Doe', 'phoneNumber'=>'33-333-3333', 'email'=>'hello8@test.com', 'points'=>0]
        ]);

        $this->assertSame(422, $response);
    }

    public function testAddingUserToPointSystemWithEmailAt50Chars()
    {
        $client = static::createClient();
        $response = $client->request('POST','/residentapi', [
            'json' => ['siteID'=>1, 'password'=>'password', 'firstName'=>'John',
                'lastName'=>'Doe', 'phoneNumber'=>'333-333-3333',
                'email'=>'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa@email.com', 'points'=>0]
        ]);

        $this->assertSame(201, $response);

        $resident = $this->entityManager
            ->getRepository(Resident::class)
            ->findOneBy(['email' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa@email.com']);

        $this->assertSame('aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa@email.com', $resident->getEmail());
    }

    public function testAddingUserToPointSystemWithEmailOver50Chars()
    {
        $client = static::createClient();
        $response = $client->request('POST','/residentapi', [
            'json' => ['siteID'=>1, 'password'=>'password', 'firstName'=>'John',
                'lastName'=>'Doe', 'phoneNumber'=>'333-333-3333',
                'email'=>'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa@email.com', 'points'=>0]
        ]);

        $this->assertSame(422, $response);
    }

    public function testAddingUserToPointSystemWithEmailWrongFormat()
    {
        $client = static::createClient();
        $response = $client->request('POST','/residentapi', [
            'json' => ['siteID'=>1, 'password'=>'password', 'firstName'=>'John',
                'lastName'=>'Doe', 'phoneNumber'=>'333-333-3333',
                'email'=>'helloemailcom', 'points'=>0]
        ]);

        $this->assertSame(422, $response);
    }

    public function testAddingUserToPointSystemWithNoPassword()
    {
        $client = static::createClient();
        $response = $client->request('POST','/residentapi', [
            'json' => ['siteID'=>1, 'firstName'=>'John',
                'lastName'=>'Doe', 'phoneNumber'=>'333-333-3333', 'email'=>'hello9@test.com', 'points'=>0]
        ]);

        $this->assertSame(422, $response);
    }

    public function testAddingUserToPointSystemWithPasswordWith50Chars()
    {
        $client = static::createClient();
        $response = $client->request('POST','/residentapi', [
            'json' => ['siteID'=>1, 'password'=>'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
                'firstName'=>'John',
                'lastName'=>'Doe', 'phoneNumber'=>'333-333-3333', 'email'=>'hello10@test.com', 'points'=>0]
        ]);

        $this->assertSame(201, $response);

        $resident = $this->entityManager
            ->getRepository(Resident::class)
            ->findOneBy(['email' => 'hello10@test.com']);

        $this->assertSame('hello10@test.com', $resident->getEmail());
    }

    public function testAddingUserToPointSystemWithPasswordOver50Chars()
    {
        $client = static::createClient();
        $response = $client->request('POST','/residentapi', [
            'json' => ['siteID'=>1, 'password'=>'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
                'firstName'=>'John',
                'lastName'=>'Doe', 'phoneNumber'=>'333-333-3333', 'email'=>'hello11@test.com', 'points'=>0]
        ]);

        $this->assertSame(422, $response);
    }

    public function testAddingUserToPointSystemWithADuplicateEmailAddress()
    {
        $client = static::createClient();
        $response = $client->request('POST','/residentapi', [
            'json' => ['siteID'=>1, 'password'=>'password', 'firstName'=>'John',
                'lastName'=>'Doe', 'phoneNumber'=>'333-333-3333', 'email'=>'hello@test.com', 'points'=>0]
        ]);

        $this->assertSame(422, $response);

    }

    protected function tearDown():void
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null;
    }
}

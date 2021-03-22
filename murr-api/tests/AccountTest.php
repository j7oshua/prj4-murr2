<?php


namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Account;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

class AccountTest
{
    /**
     * @test
     */
    public function TestValidFirstNamePost(): void
    {

    }

    //describe("POST /airports/distance", function () {
    //    it("calculates the distance between two airports", async function () {
    //        const response = await request
    //        .post("/airports/distance")
    //        .send({ from: "KIX", to: "SFO" });
    //
    //    expect(response.status).to.eql(200);
    //
    //    const attributes = response.body.data.attributes;
    //    expect(attributes).to.include.keys("kilometers", "miles", "nautical_miles");
    //    expect(attributes.kilometers).to.eql(8692.066508240026);
    //    expect(attributes.miles).to.eql(5397.239853492001);
    //    expect(attributes.nautical_miles).to.eql(4690.070954910584);
    //  });
    //});

    /**
     * @test
     */
    public function TestInvalidFirstNamePost(): void
    {

    }

    /**
     * @test
     */
    public function TestValidLastNamePost(): void
    {

    }

    /**
     * @test
     */
    public function TestInvalidLastNamePost(): void
    {

    }

    /**
     * @test
     */
    public function TestValidPicturePost(): void
    {

    }

    /**
     * @test
     */
    public function TestInalidPicturePost(): void
    {

    }


    /**
     * @test
     */
    public function TestValidFirstNamePut(): void
    {

    }

    /**
     * @test
     */
    public function TestInvalidFirstNamePut(): void
    {

    }

    /**
     * @test
     */
    public function TestValidLastNamePut(): void
    {

    }

    /**
     * @test
     */
    public function TestInvalidLastNamePut(): void
    {

    }

    /**
     * @test
     */
    public function TestValidPicturePut(): void
    {

    }

    /**
     * @test
     */
    public function TestInalidPicturePut(): void
    {

    }
}
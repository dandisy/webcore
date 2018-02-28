<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProfileApiTest extends TestCase
{
    use MakeProfileTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateProfile()
    {
        $profile = $this->fakeProfileData();
        $this->json('POST', '/api/v1/profiles', $profile);

        $this->assertApiResponse($profile);
    }

    /**
     * @test
     */
    public function testReadProfile()
    {
        $profile = $this->makeProfile();
        $this->json('GET', '/api/v1/profiles/'.$profile->id);

        $this->assertApiResponse($profile->toArray());
    }

    /**
     * @test
     */
    public function testUpdateProfile()
    {
        $profile = $this->makeProfile();
        $editedProfile = $this->fakeProfileData();

        $this->json('PUT', '/api/v1/profiles/'.$profile->id, $editedProfile);

        $this->assertApiResponse($editedProfile);
    }

    /**
     * @test
     */
    public function testDeleteProfile()
    {
        $profile = $this->makeProfile();
        $this->json('DELETE', '/api/v1/profiles/'.$profile->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/profiles/'.$profile->id);

        $this->assertResponseStatus(404);
    }
}

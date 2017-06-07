<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserApiTest extends TestCase
{
    use MakeUserTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateUser()
    {
        $user = $this->fakeUserData();
        $this->json('POST', '/api/v1/users', $user);

        $this->assertApiResponse($user);
    }

    /**
     * @test
     */
    public function testReadUser()
    {
        $user = $this->makeUser();
        $this->json('GET', '/api/v1/users/'.$user->id);

        $this->assertApiResponse($user->toArray());
    }

    /**
     * @test
     */
    public function testUpdateUser()
    {
        $user = $this->makeUser();
        $editedUser = $this->fakeUserData();

        $this->json('PUT', '/api/v1/users/'.$user->id, $editedUser);

        $this->assertApiResponse($editedUser);
    }

    /**
     * @test
     */
    public function testDeleteUser()
    {
        $user = $this->makeUser();
        $this->json('DELETE', '/api/v1/users/'.$user->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/users/'.$user->id);

        $this->assertResponseStatus(404);
    }
}

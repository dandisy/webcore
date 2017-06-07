<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RoleApiTest extends TestCase
{
    use MakeRoleTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateRole()
    {
        $role = $this->fakeRoleData();
        $this->json('POST', '/api/v1/roles', $role);

        $this->assertApiResponse($role);
    }

    /**
     * @test
     */
    public function testReadRole()
    {
        $role = $this->makeRole();
        $this->json('GET', '/api/v1/roles/'.$role->id);

        $this->assertApiResponse($role->toArray());
    }

    /**
     * @test
     */
    public function testUpdateRole()
    {
        $role = $this->makeRole();
        $editedRole = $this->fakeRoleData();

        $this->json('PUT', '/api/v1/roles/'.$role->id, $editedRole);

        $this->assertApiResponse($editedRole);
    }

    /**
     * @test
     */
    public function testDeleteRole()
    {
        $role = $this->makeRole();
        $this->json('DELETE', '/api/v1/roles/'.$role->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/roles/'.$role->id);

        $this->assertResponseStatus(404);
    }
}

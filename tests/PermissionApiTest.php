<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PermissionApiTest extends TestCase
{
    use MakePermissionTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatePermission()
    {
        $permission = $this->fakePermissionData();
        $this->json('POST', '/api/v1/permissions', $permission);

        $this->assertApiResponse($permission);
    }

    /**
     * @test
     */
    public function testReadPermission()
    {
        $permission = $this->makePermission();
        $this->json('GET', '/api/v1/permissions/'.$permission->id);

        $this->assertApiResponse($permission->toArray());
    }

    /**
     * @test
     */
    public function testUpdatePermission()
    {
        $permission = $this->makePermission();
        $editedPermission = $this->fakePermissionData();

        $this->json('PUT', '/api/v1/permissions/'.$permission->id, $editedPermission);

        $this->assertApiResponse($editedPermission);
    }

    /**
     * @test
     */
    public function testDeletePermission()
    {
        $permission = $this->makePermission();
        $this->json('DELETE', '/api/v1/permissions/'.$permission->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/permissions/'.$permission->id);

        $this->assertResponseStatus(404);
    }
}

<?php

use App\Models\Permission;
use App\Repositories\PermissionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PermissionRepositoryTest extends TestCase
{
    use MakePermissionTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PermissionRepository
     */
    protected $permissionRepo;

    public function setUp()
    {
        parent::setUp();
        $this->permissionRepo = App::make(PermissionRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatePermission()
    {
        $permission = $this->fakePermissionData();
        $createdPermission = $this->permissionRepo->create($permission);
        $createdPermission = $createdPermission->toArray();
        $this->assertArrayHasKey('id', $createdPermission);
        $this->assertNotNull($createdPermission['id'], 'Created Permission must have id specified');
        $this->assertNotNull(Permission::find($createdPermission['id']), 'Permission with given id must be in DB');
        $this->assertModelData($permission, $createdPermission);
    }

    /**
     * @test read
     */
    public function testReadPermission()
    {
        $permission = $this->makePermission();
        $dbPermission = $this->permissionRepo->find($permission->id);
        $dbPermission = $dbPermission->toArray();
        $this->assertModelData($permission->toArray(), $dbPermission);
    }

    /**
     * @test update
     */
    public function testUpdatePermission()
    {
        $permission = $this->makePermission();
        $fakePermission = $this->fakePermissionData();
        $updatedPermission = $this->permissionRepo->update($fakePermission, $permission->id);
        $this->assertModelData($fakePermission, $updatedPermission->toArray());
        $dbPermission = $this->permissionRepo->find($permission->id);
        $this->assertModelData($fakePermission, $dbPermission->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletePermission()
    {
        $permission = $this->makePermission();
        $resp = $this->permissionRepo->delete($permission->id);
        $this->assertTrue($resp);
        $this->assertNull(Permission::find($permission->id), 'Permission should not exist in DB');
    }
}

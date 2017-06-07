<?php

use App\Models\Role;
use App\Repositories\RoleRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RoleRepositoryTest extends TestCase
{
    use MakeRoleTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var RoleRepository
     */
    protected $roleRepo;

    public function setUp()
    {
        parent::setUp();
        $this->roleRepo = App::make(RoleRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateRole()
    {
        $role = $this->fakeRoleData();
        $createdRole = $this->roleRepo->create($role);
        $createdRole = $createdRole->toArray();
        $this->assertArrayHasKey('id', $createdRole);
        $this->assertNotNull($createdRole['id'], 'Created Role must have id specified');
        $this->assertNotNull(Role::find($createdRole['id']), 'Role with given id must be in DB');
        $this->assertModelData($role, $createdRole);
    }

    /**
     * @test read
     */
    public function testReadRole()
    {
        $role = $this->makeRole();
        $dbRole = $this->roleRepo->find($role->id);
        $dbRole = $dbRole->toArray();
        $this->assertModelData($role->toArray(), $dbRole);
    }

    /**
     * @test update
     */
    public function testUpdateRole()
    {
        $role = $this->makeRole();
        $fakeRole = $this->fakeRoleData();
        $updatedRole = $this->roleRepo->update($fakeRole, $role->id);
        $this->assertModelData($fakeRole, $updatedRole->toArray());
        $dbRole = $this->roleRepo->find($role->id);
        $this->assertModelData($fakeRole, $dbRole->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteRole()
    {
        $role = $this->makeRole();
        $resp = $this->roleRepo->delete($role->id);
        $this->assertTrue($resp);
        $this->assertNull(Role::find($role->id), 'Role should not exist in DB');
    }
}

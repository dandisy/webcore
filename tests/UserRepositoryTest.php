<?php

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserRepositoryTest extends TestCase
{
    use MakeUserTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var UserRepository
     */
    protected $userRepo;

    public function setUp()
    {
        parent::setUp();
        $this->userRepo = App::make(UserRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateUser()
    {
        $user = $this->fakeUserData();
        $createdUser = $this->userRepo->create($user);
        $createdUser = $createdUser->toArray();
        $this->assertArrayHasKey('id', $createdUser);
        $this->assertNotNull($createdUser['id'], 'Created User must have id specified');
        $this->assertNotNull(User::find($createdUser['id']), 'User with given id must be in DB');
        $this->assertModelData($user, $createdUser);
    }

    /**
     * @test read
     */
    public function testReadUser()
    {
        $user = $this->makeUser();
        $dbUser = $this->userRepo->find($user->id);
        $dbUser = $dbUser->toArray();
        $this->assertModelData($user->toArray(), $dbUser);
    }

    /**
     * @test update
     */
    public function testUpdateUser()
    {
        $user = $this->makeUser();
        $fakeUser = $this->fakeUserData();
        $updatedUser = $this->userRepo->update($fakeUser, $user->id);
        $this->assertModelData($fakeUser, $updatedUser->toArray());
        $dbUser = $this->userRepo->find($user->id);
        $this->assertModelData($fakeUser, $dbUser->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteUser()
    {
        $user = $this->makeUser();
        $resp = $this->userRepo->delete($user->id);
        $this->assertTrue($resp);
        $this->assertNull(User::find($user->id), 'User should not exist in DB');
    }
}

<?php

use App\Models\Profile;
use App\Repositories\ProfileRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProfileRepositoryTest extends TestCase
{
    use MakeProfileTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ProfileRepository
     */
    protected $profileRepo;

    public function setUp()
    {
        parent::setUp();
        $this->profileRepo = App::make(ProfileRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateProfile()
    {
        $profile = $this->fakeProfileData();
        $createdProfile = $this->profileRepo->create($profile);
        $createdProfile = $createdProfile->toArray();
        $this->assertArrayHasKey('id', $createdProfile);
        $this->assertNotNull($createdProfile['id'], 'Created Profile must have id specified');
        $this->assertNotNull(Profile::find($createdProfile['id']), 'Profile with given id must be in DB');
        $this->assertModelData($profile, $createdProfile);
    }

    /**
     * @test read
     */
    public function testReadProfile()
    {
        $profile = $this->makeProfile();
        $dbProfile = $this->profileRepo->find($profile->id);
        $dbProfile = $dbProfile->toArray();
        $this->assertModelData($profile->toArray(), $dbProfile);
    }

    /**
     * @test update
     */
    public function testUpdateProfile()
    {
        $profile = $this->makeProfile();
        $fakeProfile = $this->fakeProfileData();
        $updatedProfile = $this->profileRepo->update($fakeProfile, $profile->id);
        $this->assertModelData($fakeProfile, $updatedProfile->toArray());
        $dbProfile = $this->profileRepo->find($profile->id);
        $this->assertModelData($fakeProfile, $dbProfile->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteProfile()
    {
        $profile = $this->makeProfile();
        $resp = $this->profileRepo->delete($profile->id);
        $this->assertTrue($resp);
        $this->assertNull(Profile::find($profile->id), 'Profile should not exist in DB');
    }
}

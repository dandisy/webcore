<?php

use App\Models\Setting;
use App\Repositories\SettingRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SettingRepositoryTest extends TestCase
{
    use MakeSettingTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var SettingRepository
     */
    protected $settingRepo;

    public function setUp()
    {
        parent::setUp();
        $this->settingRepo = App::make(SettingRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateSetting()
    {
        $setting = $this->fakeSettingData();
        $createdSetting = $this->settingRepo->create($setting);
        $createdSetting = $createdSetting->toArray();
        $this->assertArrayHasKey('id', $createdSetting);
        $this->assertNotNull($createdSetting['id'], 'Created Setting must have id specified');
        $this->assertNotNull(Setting::find($createdSetting['id']), 'Setting with given id must be in DB');
        $this->assertModelData($setting, $createdSetting);
    }

    /**
     * @test read
     */
    public function testReadSetting()
    {
        $setting = $this->makeSetting();
        $dbSetting = $this->settingRepo->find($setting->id);
        $dbSetting = $dbSetting->toArray();
        $this->assertModelData($setting->toArray(), $dbSetting);
    }

    /**
     * @test update
     */
    public function testUpdateSetting()
    {
        $setting = $this->makeSetting();
        $fakeSetting = $this->fakeSettingData();
        $updatedSetting = $this->settingRepo->update($fakeSetting, $setting->id);
        $this->assertModelData($fakeSetting, $updatedSetting->toArray());
        $dbSetting = $this->settingRepo->find($setting->id);
        $this->assertModelData($fakeSetting, $dbSetting->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteSetting()
    {
        $setting = $this->makeSetting();
        $resp = $this->settingRepo->delete($setting->id);
        $this->assertTrue($resp);
        $this->assertNull(Setting::find($setting->id), 'Setting should not exist in DB');
    }
}

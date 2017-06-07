<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SettingApiTest extends TestCase
{
    use MakeSettingTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateSetting()
    {
        $setting = $this->fakeSettingData();
        $this->json('POST', '/api/v1/settings', $setting);

        $this->assertApiResponse($setting);
    }

    /**
     * @test
     */
    public function testReadSetting()
    {
        $setting = $this->makeSetting();
        $this->json('GET', '/api/v1/settings/'.$setting->id);

        $this->assertApiResponse($setting->toArray());
    }

    /**
     * @test
     */
    public function testUpdateSetting()
    {
        $setting = $this->makeSetting();
        $editedSetting = $this->fakeSettingData();

        $this->json('PUT', '/api/v1/settings/'.$setting->id, $editedSetting);

        $this->assertApiResponse($editedSetting);
    }

    /**
     * @test
     */
    public function testDeleteSetting()
    {
        $setting = $this->makeSetting();
        $this->json('DELETE', '/api/v1/settings/'.$setting->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/settings/'.$setting->id);

        $this->assertResponseStatus(404);
    }
}

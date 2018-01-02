<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BannerApiTest extends TestCase
{
    use MakeBannerTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateBanner()
    {
        $banner = $this->fakeBannerData();
        $this->json('POST', '/api/v1/banners', $banner);

        $this->assertApiResponse($banner);
    }

    /**
     * @test
     */
    public function testReadBanner()
    {
        $banner = $this->makeBanner();
        $this->json('GET', '/api/v1/banners/'.$banner->id);

        $this->assertApiResponse($banner->toArray());
    }

    /**
     * @test
     */
    public function testUpdateBanner()
    {
        $banner = $this->makeBanner();
        $editedBanner = $this->fakeBannerData();

        $this->json('PUT', '/api/v1/banners/'.$banner->id, $editedBanner);

        $this->assertApiResponse($editedBanner);
    }

    /**
     * @test
     */
    public function testDeleteBanner()
    {
        $banner = $this->makeBanner();
        $this->json('DELETE', '/api/v1/banners/'.$banner->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/banners/'.$banner->id);

        $this->assertResponseStatus(404);
    }
}

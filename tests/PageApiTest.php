<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PageApiTest extends TestCase
{
    use MakePageTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatePage()
    {
        $page = $this->fakePageData();
        $this->json('POST', '/api/v1/pages', $page);

        $this->assertApiResponse($page);
    }

    /**
     * @test
     */
    public function testReadPage()
    {
        $page = $this->makePage();
        $this->json('GET', '/api/v1/pages/'.$page->id);

        $this->assertApiResponse($page->toArray());
    }

    /**
     * @test
     */
    public function testUpdatePage()
    {
        $page = $this->makePage();
        $editedPage = $this->fakePageData();

        $this->json('PUT', '/api/v1/pages/'.$page->id, $editedPage);

        $this->assertApiResponse($editedPage);
    }

    /**
     * @test
     */
    public function testDeletePage()
    {
        $page = $this->makePage();
        $this->json('DELETE', '/api/v1/pages/'.$page->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/pages/'.$page->id);

        $this->assertResponseStatus(404);
    }
}

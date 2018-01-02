<?php

use App\Models\Page;
use App\Repositories\PageRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PageRepositoryTest extends TestCase
{
    use MakePageTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PageRepository
     */
    protected $pageRepo;

    public function setUp()
    {
        parent::setUp();
        $this->pageRepo = App::make(PageRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatePage()
    {
        $page = $this->fakePageData();
        $createdPage = $this->pageRepo->create($page);
        $createdPage = $createdPage->toArray();
        $this->assertArrayHasKey('id', $createdPage);
        $this->assertNotNull($createdPage['id'], 'Created Page must have id specified');
        $this->assertNotNull(Page::find($createdPage['id']), 'Page with given id must be in DB');
        $this->assertModelData($page, $createdPage);
    }

    /**
     * @test read
     */
    public function testReadPage()
    {
        $page = $this->makePage();
        $dbPage = $this->pageRepo->find($page->id);
        $dbPage = $dbPage->toArray();
        $this->assertModelData($page->toArray(), $dbPage);
    }

    /**
     * @test update
     */
    public function testUpdatePage()
    {
        $page = $this->makePage();
        $fakePage = $this->fakePageData();
        $updatedPage = $this->pageRepo->update($fakePage, $page->id);
        $this->assertModelData($fakePage, $updatedPage->toArray());
        $dbPage = $this->pageRepo->find($page->id);
        $this->assertModelData($fakePage, $dbPage->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletePage()
    {
        $page = $this->makePage();
        $resp = $this->pageRepo->delete($page->id);
        $this->assertTrue($resp);
        $this->assertNull(Page::find($page->id), 'Page should not exist in DB');
    }
}

<?php

use App\Models\Menu;
use App\Repositories\MenuRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MenuRepositoryTest extends TestCase
{
    use MakeMenuTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var MenuRepository
     */
    protected $menuRepo;

    public function setUp()
    {
        parent::setUp();
        $this->menuRepo = App::make(MenuRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateMenu()
    {
        $menu = $this->fakeMenuData();
        $createdMenu = $this->menuRepo->create($menu);
        $createdMenu = $createdMenu->toArray();
        $this->assertArrayHasKey('id', $createdMenu);
        $this->assertNotNull($createdMenu['id'], 'Created Menu must have id specified');
        $this->assertNotNull(Menu::find($createdMenu['id']), 'Menu with given id must be in DB');
        $this->assertModelData($menu, $createdMenu);
    }

    /**
     * @test read
     */
    public function testReadMenu()
    {
        $menu = $this->makeMenu();
        $dbMenu = $this->menuRepo->find($menu->id);
        $dbMenu = $dbMenu->toArray();
        $this->assertModelData($menu->toArray(), $dbMenu);
    }

    /**
     * @test update
     */
    public function testUpdateMenu()
    {
        $menu = $this->makeMenu();
        $fakeMenu = $this->fakeMenuData();
        $updatedMenu = $this->menuRepo->update($fakeMenu, $menu->id);
        $this->assertModelData($fakeMenu, $updatedMenu->toArray());
        $dbMenu = $this->menuRepo->find($menu->id);
        $this->assertModelData($fakeMenu, $dbMenu->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteMenu()
    {
        $menu = $this->makeMenu();
        $resp = $this->menuRepo->delete($menu->id);
        $this->assertTrue($resp);
        $this->assertNull(Menu::find($menu->id), 'Menu should not exist in DB');
    }
}

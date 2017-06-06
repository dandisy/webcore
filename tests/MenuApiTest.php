<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MenuApiTest extends TestCase
{
    use MakeMenuTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateMenu()
    {
        $menu = $this->fakeMenuData();
        $this->json('POST', '/api/v1/menus', $menu);

        $this->assertApiResponse($menu);
    }

    /**
     * @test
     */
    public function testReadMenu()
    {
        $menu = $this->makeMenu();
        $this->json('GET', '/api/v1/menus/'.$menu->id);

        $this->assertApiResponse($menu->toArray());
    }

    /**
     * @test
     */
    public function testUpdateMenu()
    {
        $menu = $this->makeMenu();
        $editedMenu = $this->fakeMenuData();

        $this->json('PUT', '/api/v1/menus/'.$menu->id, $editedMenu);

        $this->assertApiResponse($editedMenu);
    }

    /**
     * @test
     */
    public function testDeleteMenu()
    {
        $menu = $this->makeMenu();
        $this->json('DELETE', '/api/v1/menus/'.$menu->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/menus/'.$menu->id);

        $this->assertResponseStatus(404);
    }
}

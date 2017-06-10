<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ComponentApiTest extends TestCase
{
    use MakeComponentTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateComponent()
    {
        $component = $this->fakeComponentData();
        $this->json('POST', '/api/v1/components', $component);

        $this->assertApiResponse($component);
    }

    /**
     * @test
     */
    public function testReadComponent()
    {
        $component = $this->makeComponent();
        $this->json('GET', '/api/v1/components/'.$component->id);

        $this->assertApiResponse($component->toArray());
    }

    /**
     * @test
     */
    public function testUpdateComponent()
    {
        $component = $this->makeComponent();
        $editedComponent = $this->fakeComponentData();

        $this->json('PUT', '/api/v1/components/'.$component->id, $editedComponent);

        $this->assertApiResponse($editedComponent);
    }

    /**
     * @test
     */
    public function testDeleteComponent()
    {
        $component = $this->makeComponent();
        $this->json('DELETE', '/api/v1/components/'.$component->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/components/'.$component->id);

        $this->assertResponseStatus(404);
    }
}

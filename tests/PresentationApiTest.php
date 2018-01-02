<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PresentationApiTest extends TestCase
{
    use MakePresentationTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatePresentation()
    {
        $presentation = $this->fakePresentationData();
        $this->json('POST', '/api/v1/presentations', $presentation);

        $this->assertApiResponse($presentation);
    }

    /**
     * @test
     */
    public function testReadPresentation()
    {
        $presentation = $this->makePresentation();
        $this->json('GET', '/api/v1/presentations/'.$presentation->id);

        $this->assertApiResponse($presentation->toArray());
    }

    /**
     * @test
     */
    public function testUpdatePresentation()
    {
        $presentation = $this->makePresentation();
        $editedPresentation = $this->fakePresentationData();

        $this->json('PUT', '/api/v1/presentations/'.$presentation->id, $editedPresentation);

        $this->assertApiResponse($editedPresentation);
    }

    /**
     * @test
     */
    public function testDeletePresentation()
    {
        $presentation = $this->makePresentation();
        $this->json('DELETE', '/api/v1/presentations/'.$presentation->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/presentations/'.$presentation->id);

        $this->assertResponseStatus(404);
    }
}

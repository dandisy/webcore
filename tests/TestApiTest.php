<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TestApiTest extends TestCase
{
    use MakeTestTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateTest()
    {
        $test = $this->fakeTestData();
        $this->json('POST', '/api/v1/tests', $test);

        $this->assertApiResponse($test);
    }

    /**
     * @test
     */
    public function testReadTest()
    {
        $test = $this->makeTest();
        $this->json('GET', '/api/v1/tests/'.$test->id);

        $this->assertApiResponse($test->toArray());
    }

    /**
     * @test
     */
    public function testUpdateTest()
    {
        $test = $this->makeTest();
        $editedTest = $this->fakeTestData();

        $this->json('PUT', '/api/v1/tests/'.$test->id, $editedTest);

        $this->assertApiResponse($editedTest);
    }

    /**
     * @test
     */
    public function testDeleteTest()
    {
        $test = $this->makeTest();
        $this->json('DELETE', '/api/v1/tests/'.$test->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/tests/'.$test->id);

        $this->assertResponseStatus(404);
    }
}

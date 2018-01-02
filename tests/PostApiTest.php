<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostApiTest extends TestCase
{
    use MakePostTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatePost()
    {
        $post = $this->fakePostData();
        $this->json('POST', '/api/v1/posts', $post);

        $this->assertApiResponse($post);
    }

    /**
     * @test
     */
    public function testReadPost()
    {
        $post = $this->makePost();
        $this->json('GET', '/api/v1/posts/'.$post->id);

        $this->assertApiResponse($post->toArray());
    }

    /**
     * @test
     */
    public function testUpdatePost()
    {
        $post = $this->makePost();
        $editedPost = $this->fakePostData();

        $this->json('PUT', '/api/v1/posts/'.$post->id, $editedPost);

        $this->assertApiResponse($editedPost);
    }

    /**
     * @test
     */
    public function testDeletePost()
    {
        $post = $this->makePost();
        $this->json('DELETE', '/api/v1/posts/'.$post->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/posts/'.$post->id);

        $this->assertResponseStatus(404);
    }
}

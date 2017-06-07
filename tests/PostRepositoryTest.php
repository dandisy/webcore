<?php

use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostRepositoryTest extends TestCase
{
    use MakePostTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PostRepository
     */
    protected $postRepo;

    public function setUp()
    {
        parent::setUp();
        $this->postRepo = App::make(PostRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatePost()
    {
        $post = $this->fakePostData();
        $createdPost = $this->postRepo->create($post);
        $createdPost = $createdPost->toArray();
        $this->assertArrayHasKey('id', $createdPost);
        $this->assertNotNull($createdPost['id'], 'Created Post must have id specified');
        $this->assertNotNull(Post::find($createdPost['id']), 'Post with given id must be in DB');
        $this->assertModelData($post, $createdPost);
    }

    /**
     * @test read
     */
    public function testReadPost()
    {
        $post = $this->makePost();
        $dbPost = $this->postRepo->find($post->id);
        $dbPost = $dbPost->toArray();
        $this->assertModelData($post->toArray(), $dbPost);
    }

    /**
     * @test update
     */
    public function testUpdatePost()
    {
        $post = $this->makePost();
        $fakePost = $this->fakePostData();
        $updatedPost = $this->postRepo->update($fakePost, $post->id);
        $this->assertModelData($fakePost, $updatedPost->toArray());
        $dbPost = $this->postRepo->find($post->id);
        $this->assertModelData($fakePost, $dbPost->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletePost()
    {
        $post = $this->makePost();
        $resp = $this->postRepo->delete($post->id);
        $this->assertTrue($resp);
        $this->assertNull(Post::find($post->id), 'Post should not exist in DB');
    }
}

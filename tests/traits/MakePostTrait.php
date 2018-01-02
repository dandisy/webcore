<?php

use Faker\Factory as Faker;
use App\Models\Post;
use App\Repositories\PostRepository;

trait MakePostTrait
{
    /**
     * Create fake instance of Post and save it in database
     *
     * @param array $postFields
     * @return Post
     */
    public function makePost($postFields = [])
    {
        /** @var PostRepository $postRepo */
        $postRepo = App::make(PostRepository::class);
        $theme = $this->fakePostData($postFields);
        return $postRepo->create($theme);
    }

    /**
     * Get fake instance of Post
     *
     * @param array $postFields
     * @return Post
     */
    public function fakePost($postFields = [])
    {
        return new Post($this->fakePostData($postFields));
    }

    /**
     * Get fake data of Post
     *
     * @param array $postFields
     * @return array
     */
    public function fakePostData($postFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'post' => $fake->word,
            'title' => $fake->word,
            'slug' => $fake->word,
            'summary' => $fake->text,
            'description' => $fake->text,
            'tag' => $fake->word,
            'category' => $fake->randomDigitNotNull,
            'cover' => $fake->word,
            'version' => $fake->word,
            'language' => $fake->word,
            'status' => $fake->word,
            'created_by' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $postFields);
    }
}

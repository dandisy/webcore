<?php

use Faker\Factory as Faker;
use App\Models\Test;
use App\Repositories\TestRepository;

trait MakeTestTrait
{
    /**
     * Create fake instance of Test and save it in database
     *
     * @param array $testFields
     * @return Test
     */
    public function makeTest($testFields = [])
    {
        /** @var TestRepository $testRepo */
        $testRepo = App::make(TestRepository::class);
        $theme = $this->fakeTestData($testFields);
        return $testRepo->create($theme);
    }

    /**
     * Get fake instance of Test
     *
     * @param array $testFields
     * @return Test
     */
    public function fakeTest($testFields = [])
    {
        return new Test($this->fakeTestData($testFields));
    }

    /**
     * Get fake data of Test
     *
     * @param array $postFields
     * @return array
     */
    public function fakeTestData($testFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'title' => $fake->word,
            'description' => $fake->text,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $testFields);
    }
}

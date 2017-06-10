<?php

use Faker\Factory as Faker;
use App\Models\Component;
use App\Repositories\ComponentRepository;

trait MakeComponentTrait
{
    /**
     * Create fake instance of Component and save it in database
     *
     * @param array $componentFields
     * @return Component
     */
    public function makeComponent($componentFields = [])
    {
        /** @var ComponentRepository $componentRepo */
        $componentRepo = App::make(ComponentRepository::class);
        $theme = $this->fakeComponentData($componentFields);
        return $componentRepo->create($theme);
    }

    /**
     * Get fake instance of Component
     *
     * @param array $componentFields
     * @return Component
     */
    public function fakeComponent($componentFields = [])
    {
        return new Component($this->fakeComponentData($componentFields));
    }

    /**
     * Get fake data of Component
     *
     * @param array $postFields
     * @return array
     */
    public function fakeComponentData($componentFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'title' => $fake->word,
            'description' => $fake->text,
            'module' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $componentFields);
    }
}

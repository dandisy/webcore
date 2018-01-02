<?php

use Faker\Factory as Faker;
use App\Models\Presentation;
use App\Repositories\PresentationRepository;

trait MakePresentationTrait
{
    /**
     * Create fake instance of Presentation and save it in database
     *
     * @param array $presentationFields
     * @return Presentation
     */
    public function makePresentation($presentationFields = [])
    {
        /** @var PresentationRepository $presentationRepo */
        $presentationRepo = App::make(PresentationRepository::class);
        $theme = $this->fakePresentationData($presentationFields);
        return $presentationRepo->create($theme);
    }

    /**
     * Get fake instance of Presentation
     *
     * @param array $presentationFields
     * @return Presentation
     */
    public function fakePresentation($presentationFields = [])
    {
        return new Presentation($this->fakePresentationData($presentationFields));
    }

    /**
     * Get fake data of Presentation
     *
     * @param array $postFields
     * @return array
     */
    public function fakePresentationData($presentationFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'component' => $fake->word,
            'position' => $fake->word,
            'order' => $fake->randomDigitNotNull,
            'page_id' => $fake->randomDigitNotNull,
            'created_by' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $presentationFields);
    }
}

<?php

use App\Models\Presentation;
use App\Repositories\PresentationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PresentationRepositoryTest extends TestCase
{
    use MakePresentationTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PresentationRepository
     */
    protected $presentationRepo;

    public function setUp()
    {
        parent::setUp();
        $this->presentationRepo = App::make(PresentationRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatePresentation()
    {
        $presentation = $this->fakePresentationData();
        $createdPresentation = $this->presentationRepo->create($presentation);
        $createdPresentation = $createdPresentation->toArray();
        $this->assertArrayHasKey('id', $createdPresentation);
        $this->assertNotNull($createdPresentation['id'], 'Created Presentation must have id specified');
        $this->assertNotNull(Presentation::find($createdPresentation['id']), 'Presentation with given id must be in DB');
        $this->assertModelData($presentation, $createdPresentation);
    }

    /**
     * @test read
     */
    public function testReadPresentation()
    {
        $presentation = $this->makePresentation();
        $dbPresentation = $this->presentationRepo->find($presentation->id);
        $dbPresentation = $dbPresentation->toArray();
        $this->assertModelData($presentation->toArray(), $dbPresentation);
    }

    /**
     * @test update
     */
    public function testUpdatePresentation()
    {
        $presentation = $this->makePresentation();
        $fakePresentation = $this->fakePresentationData();
        $updatedPresentation = $this->presentationRepo->update($fakePresentation, $presentation->id);
        $this->assertModelData($fakePresentation, $updatedPresentation->toArray());
        $dbPresentation = $this->presentationRepo->find($presentation->id);
        $this->assertModelData($fakePresentation, $dbPresentation->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletePresentation()
    {
        $presentation = $this->makePresentation();
        $resp = $this->presentationRepo->delete($presentation->id);
        $this->assertTrue($resp);
        $this->assertNull(Presentation::find($presentation->id), 'Presentation should not exist in DB');
    }
}

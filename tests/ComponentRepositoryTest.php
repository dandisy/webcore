<?php

use App\Models\Component;
use App\Repositories\ComponentRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ComponentRepositoryTest extends TestCase
{
    use MakeComponentTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ComponentRepository
     */
    protected $componentRepo;

    public function setUp()
    {
        parent::setUp();
        $this->componentRepo = App::make(ComponentRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateComponent()
    {
        $component = $this->fakeComponentData();
        $createdComponent = $this->componentRepo->create($component);
        $createdComponent = $createdComponent->toArray();
        $this->assertArrayHasKey('id', $createdComponent);
        $this->assertNotNull($createdComponent['id'], 'Created Component must have id specified');
        $this->assertNotNull(Component::find($createdComponent['id']), 'Component with given id must be in DB');
        $this->assertModelData($component, $createdComponent);
    }

    /**
     * @test read
     */
    public function testReadComponent()
    {
        $component = $this->makeComponent();
        $dbComponent = $this->componentRepo->find($component->id);
        $dbComponent = $dbComponent->toArray();
        $this->assertModelData($component->toArray(), $dbComponent);
    }

    /**
     * @test update
     */
    public function testUpdateComponent()
    {
        $component = $this->makeComponent();
        $fakeComponent = $this->fakeComponentData();
        $updatedComponent = $this->componentRepo->update($fakeComponent, $component->id);
        $this->assertModelData($fakeComponent, $updatedComponent->toArray());
        $dbComponent = $this->componentRepo->find($component->id);
        $this->assertModelData($fakeComponent, $dbComponent->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteComponent()
    {
        $component = $this->makeComponent();
        $resp = $this->componentRepo->delete($component->id);
        $this->assertTrue($resp);
        $this->assertNull(Component::find($component->id), 'Component should not exist in DB');
    }
}

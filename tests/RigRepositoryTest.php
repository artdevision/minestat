<?php

use App\Models\Rig;
use App\Repositories\RigRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RigRepositoryTest extends TestCase
{
    use MakeRigTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var RigRepository
     */
    protected $rigRepo;

    public function setUp()
    {
        parent::setUp();
        $this->rigRepo = App::make(RigRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateRig()
    {
        $rig = $this->fakeRigData();
        $createdRig = $this->rigRepo->create($rig);
        $createdRig = $createdRig->toArray();
        $this->assertArrayHasKey('id', $createdRig);
        $this->assertNotNull($createdRig['id'], 'Created Rig must have id specified');
        $this->assertNotNull(Rig::find($createdRig['id']), 'Rig with given id must be in DB');
        $this->assertModelData($rig, $createdRig);
    }

    /**
     * @test read
     */
    public function testReadRig()
    {
        $rig = $this->makeRig();
        $dbRig = $this->rigRepo->find($rig->id);
        $dbRig = $dbRig->toArray();
        $this->assertModelData($rig->toArray(), $dbRig);
    }

    /**
     * @test update
     */
    public function testUpdateRig()
    {
        $rig = $this->makeRig();
        $fakeRig = $this->fakeRigData();
        $updatedRig = $this->rigRepo->update($fakeRig, $rig->id);
        $this->assertModelData($fakeRig, $updatedRig->toArray());
        $dbRig = $this->rigRepo->find($rig->id);
        $this->assertModelData($fakeRig, $dbRig->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteRig()
    {
        $rig = $this->makeRig();
        $resp = $this->rigRepo->delete($rig->id);
        $this->assertTrue($resp);
        $this->assertNull(Rig::find($rig->id), 'Rig should not exist in DB');
    }
}

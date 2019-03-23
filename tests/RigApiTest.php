<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RigApiTest extends TestCase
{
    use MakeRigTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateRig()
    {
        $rig = $this->fakeRigData();
        $this->json('POST', '/api/v1/rigs', $rig);

        $this->assertApiResponse($rig);
    }

    /**
     * @test
     */
    public function testReadRig()
    {
        $rig = $this->makeRig();
        $this->json('GET', '/api/v1/rigs/'.$rig->id);

        $this->assertApiResponse($rig->toArray());
    }

    /**
     * @test
     */
    public function testUpdateRig()
    {
        $rig = $this->makeRig();
        $editedRig = $this->fakeRigData();

        $this->json('PUT', '/api/v1/rigs/'.$rig->id, $editedRig);

        $this->assertApiResponse($editedRig);
    }

    /**
     * @test
     */
    public function testDeleteRig()
    {
        $rig = $this->makeRig();
        $this->json('DELETE', '/api/v1/rigs/'.$rig->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/rigs/'.$rig->id);

        $this->assertResponseStatus(404);
    }
}

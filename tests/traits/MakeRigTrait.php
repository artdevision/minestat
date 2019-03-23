<?php

use Faker\Factory as Faker;
use App\Models\Rig;
use App\Repositories\RigRepository;

trait MakeRigTrait
{
    /**
     * Create fake instance of Rig and save it in database
     *
     * @param array $rigFields
     * @return Rig
     */
    public function makeRig($rigFields = [])
    {
        /** @var RigRepository $rigRepo */
        $rigRepo = App::make(RigRepository::class);
        $theme = $this->fakeRigData($rigFields);
        return $rigRepo->create($theme);
    }

    /**
     * Get fake instance of Rig
     *
     * @param array $rigFields
     * @return Rig
     */
    public function fakeRig($rigFields = [])
    {
        return new Rig($this->fakeRigData($rigFields));
    }

    /**
     * Get fake data of Rig
     *
     * @param array $postFields
     * @return array
     */
    public function fakeRigData($rigFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'uuid' => $fake->word,
            'kernel' => $fake->word,
            'mac' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $rigFields);
    }
}

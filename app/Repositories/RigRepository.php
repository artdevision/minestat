<?php

namespace App\Repositories;

use App\Rig;
use App\Repositories\BaseRepository;

/**
 * Class RigRepository
 * @package App\Repositories
 * @version March 22, 2019, 3:44 pm UTC
*/

class RigRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'uuid',
        'kernel',
        'mac'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Rig::class;
    }
}

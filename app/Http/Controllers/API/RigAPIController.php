<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRigAPIRequest;
use App\Http\Requests\API\UpdateRigAPIRequest;
use App\Models\Rig;
use App\Repositories\RigRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class RigController
 * @package App\Http\Controllers\API
 */

class RigAPIController extends AppBaseController
{
    /** @var  RigRepository */
    private $rigRepository;

    public function __construct(RigRepository $rigRepo)
    {
        $this->rigRepository = $rigRepo;
    }

    /**
     * Display a listing of the Rig.
     * GET|HEAD /rigs
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $rigs = $this->rigRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($rigs->toArray(), 'Rigs retrieved successfully');
    }

    /**
     * Store a newly created Rig in storage.
     * POST /rigs
     *
     * @param CreateRigAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateRigAPIRequest $request)
    {
        $input = $request->all();

        $rigs = $this->rigRepository->create($input);

        return $this->sendResponse($rigs->toArray(), 'Rig saved successfully');
    }

    /**
     * Display the specified Rig.
     * GET|HEAD /rigs/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Rig $rig */
        $rig = $this->rigRepository->find($id);

        if (empty($rig)) {
            return $this->sendError('Rig not found');
        }

        return $this->sendResponse($rig->toArray(), 'Rig retrieved successfully');
    }

    /**
     * Update the specified Rig in storage.
     * PUT/PATCH /rigs/{id}
     *
     * @param int $id
     * @param UpdateRigAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRigAPIRequest $request)
    {
        $input = $request->all();

        /** @var Rig $rig */
        $rig = $this->rigRepository->find($id);

        if (empty($rig)) {
            return $this->sendError('Rig not found');
        }

        $rig = $this->rigRepository->update($input, $id);

        return $this->sendResponse($rig->toArray(), 'Rig updated successfully');
    }

    /**
     * Remove the specified Rig from storage.
     * DELETE /rigs/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Rig $rig */
        $rig = $this->rigRepository->find($id);

        if (empty($rig)) {
            return $this->sendError('Rig not found');
        }

        $rig->delete();

        return $this->sendResponse($id, 'Rig deleted successfully');
    }
}

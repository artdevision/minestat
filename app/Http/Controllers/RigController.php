<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRigRequest;
use App\Http\Requests\UpdateRigRequest;
use App\Repositories\RigRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class RigController extends AppBaseController
{
    /** @var  RigRepository */
    private $rigRepository;

    public function __construct(RigRepository $rigRepo)
    {
        $this->rigRepository = $rigRepo;
    }

    /**
     * Display a listing of the Rig.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $rigs = $this->rigRepository->paginate(50);

        return view('rigs.index')
            ->with('rigs', $rigs);
    }

    /**
     * Show the form for creating a new Rig.
     *
     * @return Response
     */
    public function create()
    {
        return view('rigs.create');
    }

    /**
     * Store a newly created Rig in storage.
     *
     * @param CreateRigRequest $request
     *
     * @return Response
     */
    public function store(CreateRigRequest $request)
    {
        $input = $request->all();

        $rig = $this->rigRepository->create($input);

        Flash::success('Rig saved successfully.');

        return redirect(route('rigs.index'));
    }

    /**
     * Display the specified Rig.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $rig = $this->rigRepository->find($id);

        if (empty($rig)) {
            Flash::error('Rig not found');

            return redirect(route('rigs.index'));
        }

        return view('rigs.show')->with('rig', $rig);
    }

    /**
     * Show the form for editing the specified Rig.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $rig = $this->rigRepository->find($id);

        if (empty($rig)) {
            Flash::error('Rig not found');

            return redirect(route('rigs.index'));
        }

        return view('rigs.edit')->with('rig', $rig);
    }

    /**
     * Update the specified Rig in storage.
     *
     * @param int $id
     * @param UpdateRigRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRigRequest $request)
    {
        $rig = $this->rigRepository->find($id);

        if (empty($rig)) {
            Flash::error('Rig not found');

            return redirect(route('rigs.index'));
        }

        $rig = $this->rigRepository->update($request->all(), $id);

        Flash::success('Rig updated successfully.');

        return redirect(route('rigs.index'));
    }

    /**
     * Remove the specified Rig from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $rig = $this->rigRepository->find($id);

        if (empty($rig)) {
            Flash::error('Rig not found');

            return redirect(route('rigs.index'));
        }

        $this->rigRepository->delete($id);

        Flash::success('Rig deleted successfully.');

        return redirect(route('rigs.index'));
    }
}

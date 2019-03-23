<?php

namespace App\Http\Controllers\Cabinet;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\RigRepository;

class RigController extends Controller
{
    /** @var RigRepository */
    protected $repository;

    public function __construct(RigRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request) {

    }

    public function rigs(Request $request)
    {
        $rigs = $this->repository->paginate(50);
        return view('rigs.index')
            ->with('rigs', $rigs);
    }
}

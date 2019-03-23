<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Rig;
use App\RigStat;

class ApiController extends Controller
{
    /**
     * @var mixed
     */
    protected $data;

    public function __construct(Request $request)
    {
        $this->data = json_decode($request->getContent(false), true);
    }

    public function pushStat(Request $request)
    {
        if(!empty($this->data)) {
            $data = $this->data;
            //return response()->json(['error' => 'content is no json']);
        }
        else {
            $data = $request->all();
        }

        /** @var Rig $rig */
        $rig = Rig::updateOrCreate(['uuid' => $data['uuid']], $data);

        $data['uuid'] = $rig->getKey();

        /** @var RigStat $stat */
        $stat = RigStat::create($data);

        return dd($data, $rig->getAttributes(), $stat->getAttributes());
    }

}

<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessStat;
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
        $data = [];
        if(!empty($this->data)) {
            $data = $this->data;
            //return response()->json(['error' => 'content is no json']);
        }
        else {
            if($request->getMethod() == 'GET') {
                $urlString = $request->get('url_style');
                $data = json_decode($urlString, true);
            }
        }

        ProcessStat::dispatch($data);

        return Response::create("success", 200);
    }

}

<?php

namespace App\Http\Controllers\Cabinet;

use App\Rig;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\RigRepository;
use Flash;

class ChartController extends Controller
{
    /** @var RigRepository */
    protected $repository;

    public function __construct(RigRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index($id, $field)
    {
        /** @var Rig $rig */
        $rig = $this->repository->find($id);
        return view('chart.index', ['rig'=>$rig, 'field' => $field]);
    }

    public function dataset($id, $field)
    {
        /** @var Rig $rig */
        $rig = $this->repository->find($id);
        $stats = $rig
            ->stats()
            ->orderBy('created_at', 'asc')
            ->limit(1000)
            ->get(['created_at',$field])
            ->toArray();
        $datasets = [];

        foreach($stats as $item) {
            if(is_array($item[$field])) {
                foreach ($item[$field] as $key => $value) {

                    $datasets[$key]['data'][] = [
                        (int) round(strtotime($item['created_at']) * 1000),
                        $value,
                    ];
                    $datasets[$key]['label'] = "GPU-" . (string) ($key+1) . " " . ucfirst($field);
                }
            }
            else {
                $datasets[0]['data'][] = [
                    (int) round(strtotime($item['created_at']) * 1000),
                    $item[$field]
                ];
                $datasets[0]['label'] = ucfirst($field);
            }
        }

        return response()->json($datasets);
    }
}

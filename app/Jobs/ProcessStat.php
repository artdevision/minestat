<?php

namespace App\Jobs;

use App\Rig;
use App\RigStat;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessStat implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var array
     */
    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        //
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = $this->data;

            /** @var Rig $rig */
        $rig = Rig::updateOrCreate(['uuid' => $data['uuid']], $data);

        $data['uuid'] = $rig->getKey();

        /** @var RigStat $stat */
        $stat = RigStat::create($data);
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\RigStat;

class ClearStatCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stat:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date = strtotime('-3 day') * 1000;
        RigStat::raw(function (\Jenssegers\Mongodb\Collection $collection) use($date) {
            $collection->deleteMany([
                    'created_at' => [
                        '$lte' => $date
                    ]
            ]);
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRigStatsTable extends Migration
{

    protected $connection = 'mongodb';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection($this->connection)->create('rig_stats', function (Blueprint $table) {
            $table->index('uuid');
            $table->integer('defunct');
            $table->boolean('off');
            $table->boolean('overheat');
            $table->float('rx_kbps');
            $table->float('tx_kbps');
            $table->float('load');
            $table->float('cpu_temp');
            $table->float('freespace');
            $table->json('temp');
            $table->integer('miner_secs');
            $table->json('fanrpm');
            $table->json('fanpercent');
            $table->float('hash');
            $table->json('miner_hashes');
            $table->json('default_core');
            $table->json('default_mem');
            $table->json('vramsize');
            $table->json('core');
            $table->json('mem');
            $table->json('memstates');
            $table->json('voltage');
            $table->json('default_watts');
            $table->json('watts');
            $table->json('watt_min');
            $table->json('watt_max');
            $table->json('powertune');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection($this->connection)->drop('rig_stats');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRigsTable extends Migration
{
    protected $connection = 'mongodb';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::connection($this->connection)->create('rigs', function (Blueprint $collection) {
            $collection->uuid('uuid');
            $collection->integer('gpus');
            $collection->string('kernel');
            $collection->string('boot_mode');
            $collection->string('mac');
            $collection->string('hostname');
            $collection->string('rack_loc');
            $collection->string('ip');
            $collection->string('pool_info');
            $collection->string('pool');
            $collection->string('flags');
            $collection->string('manu');
            $collection->string('mobo');
            $collection->string('biosversion');
            $collection->string('lan_chip');
            $collection->string('ram');
            $collection->string('cpu_name');
            $collection->string('drive_name');
            $collection->string('version');
            $collection->string('status');
            $collection->string('acceptance');
            $collection->string('driver');
            $collection->string('miner');
            $collection->boolean('pool_switches');
            $collection->boolean('stub_flags_present');
            $collection->boolean('updating');
            $collection->boolean('autorebooted');
            $collection->json('models');
            $collection->json('bioses');
            $collection->json('meminfo');
            $collection->text('miner');
            $collection->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection($this->connection)->drop('rigs');
    }
}

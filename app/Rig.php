<?php

namespace App;

use Carbon\Carbon;

class Rig extends BaseModel
{
    protected $collection = 'rigs';

    protected $state = null;

    protected $fillable = [
        'uuid',
        'kernel',
        'boot_mode',
        'mac',
        'hostname',
        'rack_loc',
        'ip',
        'pool_info',
        'pool',
        'flags',
        'manu',
        'mobo',
        'biosversion',
        'lan_chip',
        'ram',
        'cpu_name',
        'drive_name',
        'version',
        'updating',
        'autorebooted',
        'status',
        'acceptance',
        'driver',
        'gpus',
        'miner',
        'pool_switches',
        'stub_flags_present',
        'models',
        'bioses',
        'meminfo',
        'miner'
    ];

    public function stats()
    {
        return $this->hasMany(\App\RigStat::class, 'uuid', '_id');
    }

    public function getStateAttribute()
    {
        if (is_null($this->state)) {
           $this->state = $this
                ->stats()
                ->orderBy('updated_at', 'desc')
                ->first();
        }
        return $this->state;
    }

    public function getOnlineAttribute()
    {
        return boolval(Carbon::createFromTimeString($this->getStateAttribute()->updated_at)->diffInMinutes() < 4);
    }

    public function setGpusAttribute($value)
    {
        $this->attributes['gpus'] = intval($value);
    }

    public function setPoolSwitchesAttribute($value)
    {
        $this->attributes['pool_switches'] = boolval($value);
    }

    public function setStubFlagsPresentAttribute($value)
    {
        $this->attributes['stub_flags_present'] = boolval($value);
    }

    public function setUpdatingAttribute($value)
    {
        $this->attributes['updating'] = boolval($value);
    }

    public function setAutorebootedAttribute($value)
    {
        $this->attributes['autorebooted'] = boolval($value);
    }

    public function setModelsAttribute($value)
    {
        $value = explode(PHP_EOL, $value);
        $this->attributes['models'] = $value;
    }

    public function setBiosesAttribute($value)
    {
        $value = explode(' ', $value);
        $this->attributes['bioses'] = $value;
    }

    public function setMeminfoAttribute($value)
    {
        $value = explode(PHP_EOL, $value);
        $this->attributes['meminfo'] = $value;
    }
}

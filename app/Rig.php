<?php

namespace App;

use Carbon\Carbon;

class Rig extends BaseModel
{
    protected $collection = 'rigs';

    protected $_state;

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
        'miner',
        'state',
    ];

    public function stats()
    {
        return $this->hasMany(\App\RigStat::class, 'uuid', '_id');
    }

    public function setStateAttribute($value)
    {
        $this->attributes['state'] = (new RigStat())->fill($value)->getAttributes();
    }

    public function getStateAttribute()
    {
        if (is_null($this->_state)) {

           $this->_state = (!isset($this->attributes['state']) || !is_array($this->attributes['state'])) ? $this
                ->stats()
                ->orderBy('created_at', 'desc')
                ->limit(1)
                ->first() :
               (new RigStat())->fill($this->attributes['state'])->setAttribute('updated_at', $this->updated_at);
        }
        return $this->_state;
    }

    public function getOnlineAttribute()
    {
        $state = $this->getStateAttribute();
        if (empty($state)) {
            return false;
        }
        return boolval(Carbon::createFromTimeString($state->updated_at)->diffInMinutes() < 6);
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

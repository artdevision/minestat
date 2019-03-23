<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class RigStat extends Model
{
    /**
     * @var string
     */
    protected $collection = 'rig_stats';

    /**
     * @var array
     */
    protected $fillable = [
        'uuid',
        'defunct',
        'uptime',
        'off',
        'overheat',
        'rx_kbps',
        'tx_kbps',
        'load',
        'cpu_temp',
        'freespace',
        'temp',
        'miner_secs',
        'fanrpm',
        'fanpercent',
        'hash',
        'miner_hashes',
        'default_core',
        'default_mem',
        'vramsize',
        'core',
        'mem',
        'memstates',
        'voltage',
        'default_watts',
        'watts',
        'watt_min',
        'watt_max',
        'powertune'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rig()
    {
        return $this->belongsTo(\App\Rig::class, 'uuid', '_id');
    }

    public function setDefunctAttribute($value)
    {
        $this->attributes['defunct'] = intval($value);
    }

    public function setUptimeAttribute($value)
    {
        $this->attributes['uptime'] = intval($value);
    }

    public function setOffAttribute($value)
    {
        $this->attributes['off'] = boolval($value);
    }

    public function setOverheatAttribute($value)
    {
        $this->attributes['overheat'] = boolval($value);
    }

    public function setRxKbpsAttribute($value)
    {
        $this->attributes['rx_kbps'] = floatval($value);
    }

    public function setTxKbpsAttribute($value)
    {
        $this->attributes['tx_kbps'] = floatval($value);
    }

    public function setLoadAttribute($value)
    {
        $this->attributes['load'] = floatval($value);
    }

    public function setCpuTempAttribute($value)
    {
        $this->attributes['cpu_temp'] = floatval($value);
    }

    public function setFreespaceAttribute($value)
    {
        $this->attributes['freespace'] = floatval($value);
    }

    public function setMinerSecsAttribute($value)
    {
        $this->attributes['miner_secs'] = floatval($value);
    }

    public function setHashAttribute($value)
    {
        $this->attributes['hash'] = floatval($value);
    }

    public function setTempAttribute($value)
    {
        $this->attributes['temp'] = $this->explodeAttribute($value);
    }

    public function setMinerHashesAttribute($value)
    {
        $this->attributes['miner_hashes'] = $this->explodeAttribute($value);
    }

    public function setDefaultCoreAttribute($value)
    {
        $this->attributes['default_core'] = $this->explodeAttribute($value);
    }

    public function setDefaultMemAttribute($value)
    {
        $this->attributes['default_mem'] = $this->explodeAttribute($value);
    }

    public function setVramsizeAttribute($value)
    {
        $this->attributes['vramsize'] = $this->explodeAttribute($value);
    }

    public function setCoreAttribute($value)
    {
        $this->attributes['core'] = $this->explodeAttribute($value);
    }

    public function setMemAttribute($value)
    {
        $this->attributes['mem'] = $this->explodeAttribute($value);
    }

    public function setMemstatesAttribute($value)
    {
        $this->attributes['memstates'] = $this->explodeAttribute($value);
    }

    public function setVoltageAttribute($value)
    {
        $this->attributes['voltage'] = $this->explodeAttribute($value);
    }

    public function setDefaultWattsAttribute($value)
    {
        $this->attributes['default_watts'] = $this->explodeAttribute($value);
    }

    public function setWattsAttribute($value)
    {
        $this->attributes['watts'] = $this->explodeAttribute($value);
    }

    public function setWattMinAttribute($value)
    {
        $this->attributes['watt_min'] = $this->explodeAttribute($value);
    }

    public function setWattMaxAttribute($value)
    {
        $this->attributes['watt_max'] = $this->explodeAttribute($value);
    }

    public function setPowertuneAttribute($value)
    {
        $this->attributes['powertune'] = $this->explodeAttribute($value);
    }

    public function setFanrpmAttribute($value)
    {
        $this->attributes['fanrpm'] = $this->explodeAttribute($value);
    }

    public function setFanpercentAttribute($value)
    {
        $this->attributes['fanpercent'] = $this->explodeAttribute($value);
    }

    private function explodeAttribute($value)
    {
        $value = explode(' ', $value);
        array_walk($value, function (&$item, $key) {
            $item = floatval($item);
        });
        return $value;
    }
}

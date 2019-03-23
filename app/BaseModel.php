<?php

namespace App;

use Carbon\CarbonInterval;
use Jenssegers\Mongodb\Eloquent\Model;

class BaseModel extends Model
{
    public static function timeForHuman($seconds)
    {
        return CarbonInterval::seconds(intval($seconds))->cascade()->spec();
    }
}

<?php

namespace App;

use Carbon\CarbonInterval;
use Jenssegers\Mongodb\Eloquent\Model;

class BaseModel extends Model
{
    public static function timeForHuman($seconds)
    {
        $humanize = CarbonInterval::seconds(intval($seconds))->cascade()->forHumans(['parts'=>1]);
        $parts = explode(' ', $humanize);
        if (count($parts) != 2) {
            return $humanize;
        }
        return $parts[0] . substr($parts[1], 0, 1);
    }
}

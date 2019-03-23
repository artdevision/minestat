<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Rig
 * @package App\Models
 * @version March 22, 2019, 3:44 pm UTC
 *
 * @property string uuid
 * @property string kernel
 * @property sting mac
 */
class Rig extends Model
{
    use SoftDeletes;

    public $table = 'rigs';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'uuid',
        'kernel',
        'mac'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'uuid' => 'string',
        'kernel' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'uuid' => 'required',
        'kernel' => 'required'
    ];

    
}

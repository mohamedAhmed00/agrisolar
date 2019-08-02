<?php

namespace Modules\Pumps\Entities;
use Eloquent;

class HeightPumps extends Eloquent
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'head','c0', 'c1', 'c2', 'c3', 'c4', 'c5', 'q_max', 'q_min', 'p_min', 'p_max', 'pump_id'
    ];

    protected $casts = [
        'head' => 'float(10,2)',
        'c0' => 'float(10,2)',
        'c1' => 'float(10,2)',
        'c2' => 'float(10,2)',
        'c3' => 'float(10,2)',
        'c4' => 'float(10,2)',
        'c5' => 'float(10,2)',
        'q_max' => 'float(10,2)',
        'q_min' => 'float(10,2)',
        'p_min' => 'float(10,2)',
        'p_max' => 'float(10,2)',
    ];

}

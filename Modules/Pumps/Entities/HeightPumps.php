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

}

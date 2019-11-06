<?php

namespace Modules\Cable\Entities;
use Eloquent;
use Modules\Radiation\Entities\Radiation;

class Cable extends Eloquent
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'motor_hp', 'c_3x1_5', 'c_3x2_5', 'c_3x4', 'c_3x6', 'c_3x10', 'c_3x16', 'c_3x25', 'c_3x35', 'c_3x50', 'c_3x70', 'c_3x95'
    ];

}

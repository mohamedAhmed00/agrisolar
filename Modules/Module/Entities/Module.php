<?php

namespace Modules\Module\Entities;
use Eloquent;

class Module extends Eloquent
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'voc', 'vmpp', 'power_max'
    ];
}

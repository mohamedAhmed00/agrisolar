<?php

namespace Modules\Base\Entities;
use Eloquent;

class Image extends Eloquent
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image', 'pivot_id', 'type'
    ];


}

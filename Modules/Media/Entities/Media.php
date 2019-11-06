<?php

namespace Modules\Media\Entities;
use Eloquent;
use Illuminate\Support\Str;

class Media extends Eloquent
{

    protected $table="medias";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'image'
    ];

}

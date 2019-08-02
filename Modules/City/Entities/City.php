<?php

namespace Modules\City\Entities;
use Eloquent;
use Modules\Radiation\Entities\Radiation;

class City extends Eloquent
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function Radiations(string $type)
    {
        return $this->hasMany(Radiation::class)->where('type' ,'LIKE' ,$type);
    }

    public function CoeffRadiations()
    {
        return $this->hasMany(Radiation::class)->where('type' ,'coefficient');
    }
}

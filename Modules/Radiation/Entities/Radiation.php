<?php

namespace Modules\Radiation\Entities;
use Eloquent;

class Radiation extends Eloquent
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'timing', 'january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december', 'avg', 'city_id','type'
    ];


    /**
     * @param $value
     * @author Nader Ahmed
     * @return void
     */
//    public function setTimingAttribute($value)
//    {
//        $this->attributes['password'] = date('g:i', strtotime($value));
//    }

}


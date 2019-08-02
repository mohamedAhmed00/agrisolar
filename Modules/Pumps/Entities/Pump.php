<?php

namespace Modules\Pumps\Entities;
use Eloquent;

class Pump extends Eloquent
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'model','motor','stages', 'q_min', 'q_max', 'h_min', 'h_max'
    ];

    public function Head(){
        return $this->hasMany(HeightPumps::class);
    }
}

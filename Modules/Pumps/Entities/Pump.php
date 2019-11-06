<?php

namespace Modules\Pumps\Entities;
use Eloquent;
use Modules\Media\Entities\Media;

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

    public function getMedias(){
        return $this->belongsToMany(Media::class,'media_pump','pump_id','media_id')->orderBy('order','asc');
    }
}

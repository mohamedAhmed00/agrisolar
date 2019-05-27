<?php

namespace Modules\Groups\Entities;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'permission','redirect'
    ];

    /**
     * @param  string  $value
     * @author Nader Ahmed
     * @return array
     */
    public function getPermissionAttribute($value)
    {
        return (object)json_decode($value,true);
    }

}

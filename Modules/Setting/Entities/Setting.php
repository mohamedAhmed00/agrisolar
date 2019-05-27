<?php

namespace Modules\Setting\Entities;
use Eloquent;
use Illuminate\Support\Str;

class Setting extends Eloquent
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key', 'value','type'
    ];

    /**
     * @param $value
     * @author Nader Ahmed
     * @return void
     */
    public function setKeyAttribute($value)
    {
        $this->attributes['key'] = Str::slug($value);
    }

    /**
     *
     * @param  string  $value
     * @author Nader Ahmed
     * @return string
     */
    public function getKeyAttribute($value)
    {
        return str_replace('-', ' ', $value);
    }
}

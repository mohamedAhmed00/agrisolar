<?php

namespace Modules\Users\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Modules\Base\Entities\Image;
use Modules\Groups\Entities\Group;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone_number','group_id'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @param $value
     * @author Nader Ahmed
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * @author Nader Ahmed
     * @return mixed
     */
    public function Image()
    {
        return $this->hasOne(Image::class,'pivot_id')->where('type' , 'user');
    }

    /**
     * @author Nader Ahmed
     * @return mixed
     */
    public function Group()
    {
        return $this->belongsTo(Group::class,'group_id','id');
    }
}

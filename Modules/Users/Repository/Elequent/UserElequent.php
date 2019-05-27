<?php

namespace Modules\Users\Repository\Elequent;
use Modules\Base\Repository\Elequent\BaseElequent;
use Modules\Users\Entities\User;
use Modules\Users\Repository\Interfaces\UserInterface;
use Auth;

class UserElequent extends BaseElequent implements UserInterface
{
    /**
     * @var
     */
    protected $user;

    public function __construct()
    {
        $this->user = new User();
        parent::__construct($this->user);
    }

    /**
     * @author Nader Ahmed
     * @return mixed
     */
    public function getUsers()
    {
        return $this->user->whereNotIn('id',[auth()->user()->id])->get();
    }

    /**
     * @author Nader Ahmed
     * @return bool
     */
    public function checkAuth()
    {
        //public-user-group
        $settings = getSetting();
        if($this->model->find(Auth::user()->id)->Group->slug == $settings['public user group']->value)
        {
            return true;
        }
        return false;

    }
}

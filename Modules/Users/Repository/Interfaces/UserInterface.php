<?php

namespace Modules\Users\Repository\Interfaces;

use Modules\Base\Repository\Interfaces\BaseInterface;

interface UserInterface extends BaseInterface
{

    /**
     * @author Nader Ahmed
     * @return mixed
     */
    public function getUsers();

    /**
     * @author Nader Ahmed
     * @return bool
     */
    public function checkAuth();
}

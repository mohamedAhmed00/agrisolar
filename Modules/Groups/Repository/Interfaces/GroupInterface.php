<?php

namespace Modules\Groups\Repository\Interfaces;

use Modules\Base\Repository\Interfaces\BaseInterface;

interface GroupInterface extends BaseInterface
{
    /**
     * @param array $data
     * @auther Nader Ahmed
     * @return mixed
     */
    public function storePermission(array $data);

    /**
     * @param array $data
     * @param int $id
     * @auther Nader Ahmed
     * @return mixed
     */
    public function updatePermission(int $id,array $data);
}

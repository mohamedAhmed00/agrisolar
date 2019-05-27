<?php

namespace Modules\Pumps\Repository\Interfaces;

use Modules\Base\Repository\Interfaces\BaseInterface;

interface PumpInterface extends BaseInterface
{
    /**
     * @param array $arg
     * @author Nader Ahmed
     * @return Mixed
     */
    public function search(array $arg);
}

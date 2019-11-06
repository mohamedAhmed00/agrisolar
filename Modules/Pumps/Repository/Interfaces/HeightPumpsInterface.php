<?php

namespace Modules\Pumps\Repository\Interfaces;

use Modules\Base\Repository\Interfaces\BaseInterface;

interface HeightPumpsInterface extends BaseInterface
{
    /**
     * @param int $pump_id
     * @author Nader Ahemd
     * @return Mixed
     */
    public function getHeadOrderByHead(int $pump_id);

    /**
     * @param int $pump_id
     * @param  $head
     * @author Nader Ahemd
     * @return Mixed
     */
    public function getHead(int $pump_id,$head);
}

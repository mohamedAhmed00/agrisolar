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

    /**
     * @param int $id
     * @return Mixed
     * @author Nader Ahmed
     */
    public function getChart(int $id);

    /**
     * @return Mixed
     * @author Nader Ahmed
     */
    public function getChartWithSearch();
}

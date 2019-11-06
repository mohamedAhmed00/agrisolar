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
     * @param $request
     * @return Mixed
     * @author Nader Ahmed
     */
    public function getChart( $request);

    /**
     * @return Mixed
     * @author Nader Ahmed
     */
    public function getChartWithSearch();

    /**
     * @param $request
     * @author Nader Ahmed
     */
    public function generatePDF( $request);

    /**
     * @param $pump
     * @param $order
     * @param $media
     * @author Nader Ahmed
     */
    public function saveMedia( $pump,$media,$order);

    /**
     * @param $pump_id
     * @author Nader Ahmed
     */
    public function getMedia($pump_id);
}

<?php

namespace Modules\Radiation\Repository\Interfaces;

use Modules\Base\Repository\Interfaces\BaseInterface;

interface RadiationInterface extends BaseInterface
{
    /**
     * @param int $city_id
     * @param string $type
     * @author Nader Ahmed
     * @return Void
     */
    public function saveAverage(int $city_id ,string $type );

    /**
     * @param int $city_id
     * @param string $type
     * @author Nader Ahmed
     * @return Void
     */
    public function updateAverage(int $city_id ,string $type  );

    /**
     * @param int $city_id
     * @param string $type
     * @auther Nader Ahmed
     * @return Void
     */
    public function deleteAll(int $city_id ,string $type);
}

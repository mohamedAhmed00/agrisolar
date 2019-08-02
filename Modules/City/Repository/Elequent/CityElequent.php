<?php

namespace Modules\City\Repository\Elequent;

use Modules\Base\Repository\Elequent\BaseElequent;
use Modules\City\Entities\City;
use Modules\City\Repository\Interfaces\CityInterface;

class CityElequent extends BaseElequent implements CityInterface
{
    /**
     * @var
     */
    protected $city;

    public function __construct()
    {
        $this->city = new City();
        parent::__construct($this->city);
    }
}


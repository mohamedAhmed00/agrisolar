<?php

namespace Modules\Pumps\Repository\Elequent;

use Modules\Base\Repository\Elequent\BaseElequent;
use Modules\Pumps\Entities\Pump;
use Modules\Pumps\Repository\Interfaces\PumpInterface;

class PumpElequent extends BaseElequent implements PumpInterface
{
    /**
     * @var
     */
    protected $pump;

    public function __construct()
    {
        $this->pump = new Pump();
        parent::__construct($this->pump);
    }

    /**
     * @param array $arg
     * @return Mixed
     * @author Nader Ahmed
     */
    public function search(array $arg)
    {
        $n5 = ($arg['mounting_structure'] == 'Fixed') ? 6.5 : 7.5;
        $q = (int)$arg['water_amount'] / $n5;
        $hd = $arg['dynamic_head'];
        $modules = $this->model->where([
            ['q_min', '<', $q],
            ['q_max', '>', $q],
            ['h_min', '<', $hd],
            ['h_max', '>', $hd],
        ])->get();
        return $modules;
    }
}

//h = 70
//
//    50 = n / 6.5;



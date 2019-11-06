<?php

namespace Modules\Pumps\Repository\Elequent;

use Illuminate\Support\Facades\DB;
use Modules\Base\Repository\Elequent\BaseElequent;
use Modules\Pumps\Entities\HeightPumps;
use Modules\Pumps\Repository\Interfaces\HeightPumpsInterface;
use PhpParser\Node\Stmt\DeclareDeclare;

class HeightPumpsElequent extends BaseElequent implements HeightPumpsInterface
{
    /**
     * @var
     */
    protected $heightPumps;

    public function __construct()
    {
        $this->heightPumps = new HeightPumps();
        parent::__construct($this->heightPumps);
    }

    /**
     * @param int $pump_id
     * @author Nader Ahemd
     * @return Mixed
     */
    public function getHeadOrderByHead(int $pump_id)
    {
        $collections =  $this->heightPumps->where(['pump_id' => $pump_id])->orderBy('head','asc')->get();
        return $this->preparePoints($collections);
    }

    private function preparePoints($collections)
    {
        $data = [];
        foreach ($collections as $heightPump)
        {
            $points = array();
            $ranges = range($heightPump->p_min,$heightPump->p_max,($heightPump->p_max-0)/30);
            foreach($ranges as $range)
            {
                $q =($heightPump->c5 * (pow($range , 5 ))) + ($heightPump->c4 * (pow($range , 4 ))) +  ($heightPump->c3 * (pow($range , 3 ))) +
                    ($heightPump->c2 * (pow($range , 2 ))) + ($heightPump->c1 * $range ) + ($heightPump->c0);
                $q = $q > 0 ? $q : 0;
                $points[] = [$range,$q];

            }

            $heightPump->points = json_encode($points);
            $data[] = $heightPump;

        }
        return $data;
    }

    /**
     * @param int $pump_id
     * @param  $head
     * @author Nader Ahemd
     * @return Mixed
     */
    public function getHead(int $pump_id,$head)
    {
        $data = DB::select( DB::raw("
        SELECT *
FROM `height_pumps`
WHERE `pump_id` = " . $pump_id ."
  AND (`head` in (SELECT min(`head`) FROM `height_pumps` WHERE `head` >= " . $head ." AND `pump_id` = " . $pump_id .")
    or (`head` in (SELECT MAX(`head`) FROM `height_pumps` WHERE `head` <= " . $head ." AND `pump_id` = " . $pump_id .")))
LIMIT 1;
"));
        return $this->preparePoints($data);
    }
}


<?php

namespace Modules\Pumps\Repository\Elequent;

use Illuminate\Support\Facades\DB;
use Modules\Base\Repository\Elequent\BaseElequent;
use Modules\City\Entities\City;
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

    /**
     * @param int $id
     * @return Mixed
     * @author Nader Ahmed
     */
    public function getChart(int $id)
    {
        $request = \request()->all();
        $data = $this->model->find($id);
        $head = $this->getHead($data->id ,(int)$request['dynamic_head']);
        if(empty($head))
        {
            return;
        }
        $head = $head[0];
        $city =  City::find($request['location']);
        $radiations = $city->Radiations($request['mounting_structure'])->get();
        $coff = $city->CoeffRadiations;
        $q = array();
//        dump($radiations,$coff);
        $keys = array_keys($radiations->toArray()[0]);
        unset($keys[0],$keys[1],$keys[14],$keys[15],$keys[16],$keys[17],$keys[18]);

        foreach($keys as $k)
        {
            $points = [];
            foreach ($radiations as $key => $radiation)
            {
                $p = $radiation->{$k} * $coff[$key]->{$k}  * $data->motor * .81 ;
                $operand =  $head->c5 * pow($p , 5 ) + $head->c4 * pow($p , 4 ) +  $head->c3 * pow($p , 3 ) +
                    $head->c2 * pow($p , 2 ) + ($head->c1 * $p) + $head->c0 ;
                $Q = ( $head->head / $request['dynamic_head'] ) *  $operand;
                if($Q < $data->q_min)
                {
                    $Q = 0;
                }
                if ($Q > $data->q_max)
                {
                    $Q = $data->q_max;
                }
                $points[] = $Q;
            }
            $q[$k] = $points;
        }
        $points = array();
        foreach ($q as $key => $item) {
            $points[] = array($key,array_sum($item) / count($item));
        }
        $arr['month'] = $this->getMonthChart($request['mounting_structure'],$id,'january');
        $arr['points'] = $points;
        $arr['head'] = $data->motor;
        return $arr;
    }

    private function getHead($id ,$dynamicHead )
    {
        $data = DB::select( DB::raw("
        SELECT *
FROM `height_pumps`
WHERE (`head` in (SELECT (SELECT min(`head`) FROM `height_pumps` WHERE `head` > " . $dynamicHead ." AND `pump_id` = " . $id ." )
FROM `height_pumps`
WHERE ((SELECT min(`head`) FROM `height_pumps` WHERE `head` > " . $dynamicHead ." AND `pump_id` = " . $id ." ) - " . $dynamicHead .") <
(" . $dynamicHead ." - (SELECT MAX(`head`) FROM `height_pumps` WHERE `head` < " . $dynamicHead ." AND `pump_id` = " . $id ." )))
OR `head` in (SELECT (SELECT MAX(`head`) FROM `height_pumps` WHERE `head` < " . $dynamicHead ." AND `pump_id` = " . $id ." )
FROM `height_pumps`
WHERE ((SELECT min(`head`)
FROM `height_pumps`
WHERE `head` > " . $dynamicHead ." AND `pump_id` = " . $id ." ) - " . $dynamicHead .") > (" . $dynamicHead ." - 
(SELECT MAX(`head`) FROM `height_pumps` WHERE `head` < " . $dynamicHead ." AND `pump_id` = " . $id ." ))) ) LIMIT 1
        "));
        return $data;
    }

    /**
     * @return Mixed
     * @author Nader Ahmed
     */
    public function getChartWithSearch()
    {
        $request = \request()->all();
        $data = $this->model->find($request['id']);
        $head = $this->getHead($data->id ,(int)$request['dynamic_head']);
        if(empty($head))
        {
            return;
        }
        $head = $head[0];
        $city =  City::find($request['location']);
        $radiations = $city->Radiations($request['mounting_structure'])->get();
        $coff = $city->CoeffRadiations;
        $q = array();
        $keys = array_keys($radiations->toArray()[0]);
        unset($keys[0],$keys[1],$keys[14],$keys[15],$keys[16],$keys[17],$keys[18]);
        foreach($keys as $k)
        {
            $points = [];
            foreach ($radiations as $key => $radiation)
            {
                $p = $radiation->{$k} * $coff[$key]->{$k}  * $request['head'] * .81;
                $operand =  $head->c5 * pow($p , 5 ) + $head->c4 * pow($p , 4 ) +  $head->c3 * pow($p , 3 ) +
                    $head->c2 * pow($p , 2 ) + ($head->c1 * $p) + $head->c0 ;
                $Q = $head->head / $request['dynamic_head'] * $operand;
                if($Q < $data->q_min)
                {
                    $Q = 0;
                }
                if ($Q > $data->q_max)
                {
                    $Q = $data->q_max;
                }
                $points[] = $Q;
            }
            $q[$k] = $points;
        }
        $points = array();
        foreach ($q as $key => $item) {
            $points[] = array($key,array_sum($item) / count($item));
        }
        $data = array();
        $data['year'] = $points;
        $data['month'] = $this->getMonthChartForSearch($request['mounting_structure'],$request['id'],$request['head']);
        return $data;
    }

    private function getMonthDetails($type,$month = 'january'){
        return DB::select( DB::raw("SELECT avg(" . $month .") as avg_hour , SUBSTRING_INDEX(`timing`,':',1)  as timing1 FROM `radiations` where type = '" . $type . "' group by timing1 ORDER BY id asc") );
    }

    /**
     * @param int $id
     * @return Mixed
     * @author Nader Ahmed
     */
    public function getMonthChart(string $type,int $id,$month = 'january')
    {
        $request = \request()->all();
        $data = $this->model->find($id);
        $head = $this->getHead($data->id ,(int)$request['dynamic_head']);
        if(empty($head))
        {
            return;
        }
        $head = $head[0];
        $radiations = $this->getMonthDetails($type,$month);
        $coff = $this->getMonthDetails('coefficient',$month);
        $points = array();
        foreach ($radiations as $key => $radiation)
        {

            if ((int)$coff[$key]->timing1)
            {
                $p = $radiation->avg_hour * $coff[$key]->avg_hour  * $data->motor * .81 / 1000;
                $operand =  $head->c5 * pow($p , 5 ) + $head->c4 * pow($p , 4 ) +  $head->c3 * pow($p , 3 ) +
                    $head->c2 * pow($p , 2 ) + ($head->c1 * $p) + $head->c0 ;
                $Q = ( $head->head / $request['dynamic_head'] ) *  $operand;
                if($Q < $data->q_min)
                {
                    $Q = 0;
                }
                if ($Q > $data->q_max)
                {
                    $Q = $data->q_max;
                }
                $points[] = array($radiation->timing1 , $Q);
            }

        }

        $arr['points'] = $points;
        $arr['head'] = $data->motor;
        return $arr;
    }

    /**
     * @param int $id
     * @return Mixed
     * @author Nader Ahmed
     */
    public function getMonthChartForSearch(string $type,int $id,float $motor,$month = 'january')
    {
        $request = \request()->all();
        $data = $this->model->find($id);
        $head = $this->getHead($data->id ,(int)$request['dynamic_head']);
        if(empty($head))
        {
            return;
        }
        $head = $head[0];
        $radiations = $this->getMonthDetails($type,$month);
        $coff = $this->getMonthDetails('coefficient',$month);
        $points = array();
        $keys = array_keys($radiations);
        unset($keys[0]);
        foreach ($radiations as $key => $radiation)
        {

            if ((int)$coff[$key]->timing1)
            {
                $p = $radiation->avg_hour * $coff[$key]->avg_hour  * $motor * .81 / 1000;
                $operand =  $head->c5 * pow($p , 5 ) + $head->c4 * pow($p , 4 ) +  $head->c3 * pow($p , 3 ) +
                    $head->c2 * pow($p , 2 ) + ($head->c1 * $p) + $head->c0 ;
                $Q = ( $head->head / $request['dynamic_head'] ) *  $operand;
                if($Q < $data->q_min)
                {
                    $Q = 0;
                }
                if ($Q > $data->q_max)
                {
                    $Q = $data->q_max;
                }
                $points[] = array($radiation->timing1 , $Q);
            }

        }

        $arr['points'] = $points;
        $arr['head'] = $data->motor;
        return $arr;
    }
}

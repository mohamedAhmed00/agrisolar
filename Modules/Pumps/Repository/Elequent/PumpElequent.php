<?php

namespace Modules\Pumps\Repository\Elequent;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Modules\Base\Repository\Elequent\BaseElequent;
use Modules\Cable\Entities\Cable;
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

//        try {
            if (!empty($arg['select_existing_pump'])){
                $modules = $this->model->where(['id' => $arg['select_existing_pump']])->get();
            } else {
                $n5 = ($arg['mounting_structure'] == 'Fixed') ? 6.5 : 7.5;
                $q = (int)$arg['water_amount'] / $n5;
                $hd = $arg['dynamic_head'];
                $modules = $this->model->where([
                    ['q_min', '<', $q],
                    ['q_max', '>', $q],
                    ['h_min', '<', $hd],
                    ['h_max', '>', $hd],
                ])->get();
            }
            foreach ($modules as $key1 => $module){

                $moduleData = $this->getChart(\request(),$module->id);

                if ($moduleData != null) {
                    $key = array_search(true,array_column($moduleData['pvgen_array'],'selected'));
                    $pvg = $moduleData['pvgen_array'][$key];
                    $modules[$key1]->output = $moduleData['avg'];
                    $modules[$key1]->eff = round($moduleData['avg'] / $pvg['pvgen'],2) ;
                    $modules[$key1]->pvgen = $pvg['string'];
                }
                else {
                    $modules[$key1]->output = 0;
                    $modules[$key1]->eff = 0 ;
                    $modules[$key1]->pvgen = 0;
                }

                $array = Cable::select('c_3x1_5', 'c_3x2_5', 'c_3x4', 'c_3x6', 'c_3x10', 'c_3x16', 'c_3x25', 'c_3x35', 'c_3x50', 'c_3x70', 'c_3x95')->where('motor_hp' , '>=' , $module->motor)->first();
                if (empty($array)){
                    $array = Cable::select('c_3x1_5', 'c_3x2_5', 'c_3x4', 'c_3x6', 'c_3x10', 'c_3x16', 'c_3x25', 'c_3x35', 'c_3x50', 'c_3x70', 'c_3x95')->orderBy('id', 'desc')->first();
                }

                $array = $array->toArray();
                $needle = array_search($arg['cable_length'],$array);
                if (empty($needle))
                {
                    foreach ($array as $key2=> $value) {

                        if ($value > $arg['cable_length']) {

                            $modules[$key1]->length = str_replace('_','.',trim($key2,'c_'));
                            break;
                        } else if(end($array)  == $value AND empty($modules[$key1]->length)) {
                            $modules[$key1]->length = str_replace('_','.',trim(array_key_last($array),'c_'));
                        } else {

                        }
                    }
                } else {
                    $modules[$key1]->length = str_replace('_','.',trim($needle,'c_'));
                }

            }

            return $modules->sortByDesc('eff');
//        }
//        catch (\Exception $e){
//
//            redirect('/dashboard');
//        }

    }

    /**
     * @param $request
     * @return Mixed
     * @author Nader Ahmed
     */
    public function getChart( $request,$moduleId = null)
    {
        Session::put('moduleData',$this->getModule($request,$moduleId));
        $id = $request->get('id');
        if ($moduleId == null){
            $data = $this->model->find($id);
        } else {
            $id = $moduleId;
            $data = $this->model->find($moduleId);
        }
        $request = \request()->all();
        $points = array();
        $months = ['january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'];
        foreach ($months as $month)
        {
            $tempPoints[$month] = $this->getMonthPoints($request['mounting_structure'],$month,$data);
        }
        $avg = 0;
        foreach ($tempPoints as $key => $item) {
            $sum = array_sum($item);
            $avg += $sum;
            $points[] = array($key,$sum);
        };

        $points[] = array('avg',round($avg / 12,2));
        $monthPoints = $this->getMonthChart($request['mounting_structure'],$id,'january');

//        $avgMonth = 0;
        foreach ($monthPoints['points'] as $key => $monthPoint){
//            $avgMonth += $monthPoint;
            $arr['month']['points'][] = array($key , $monthPoint);
        }
//        $arr['month']['points'][] = array('avg',round($avgMonth/count($arr['month']['points']),2));
        $arr['points'] = $points;
        $arr['head'] = $data->motor;
        $arr['avg'] = round($avg / 12,2);
        $arr['pvgen_array'] = Session::get('moduleData');
        return $arr;
    }

    private function getHead($id ,$dynamicHead )
    {
        $data = DB::select( DB::raw("
        SELECT *
FROM `height_pumps`
WHERE `pump_id` = " . $id ."
  AND (`head` in (SELECT min(`head`) FROM `height_pumps` WHERE `head` >= " . $dynamicHead ." AND `pump_id` = " . $id .")
    or (`head` in (SELECT MAX(`head`) FROM `height_pumps` WHERE `head` <= " . $dynamicHead ." AND `pump_id` = " . $id .")))
LIMIT 1;
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

        Session::put('moduleData',$this->getModuleWithBeforeAfter($request));

        $data = $this->model->find($request['id']);
        $months = ['january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'];
        foreach ($months as $month)
        {
            $tempPoints [$month] = $this->getMonthPoints($request['mounting_structure'],$month,$data);
        }
        $avg = 0;
        foreach ($tempPoints as $key => $item) {
            $sum = array_sum($item);
            $avg += $sum;
            $points[] = array($key,$sum);
        }

        $data = array();
        $data['year'] = $points;
        $monthPoints =  $this->getMonthChartForSearch($request['mounting_structure'],$request['id']);

//        $avgMonth = 0;
        foreach ($monthPoints['points'] as $key => $monthPoint){
//            $avgMonth += $monthPoint;
            $arr['month']['points'][] = array($key , $monthPoint);
        }
//        $arr['month']['points'][] = array('avg',round($avgMonth/count($arr['month']['points']),2));
        $data['month'] = $arr['month'];
        $data['avg'] = round($avg / 12,2);
        $data['pvgen_array'] = Session::get('moduleData');
        return $data;
    }

    private function getMonthDetails($type,$month = 'january',int $location){
        return DB::select( DB::raw("SELECT " . $month ." as hour , SUBSTRING_INDEX(`timing`,':',1)  as timing1 FROM `radiations` where ( type = '" . $type . "' AND city_id = '" . $location . "' ) ORDER BY id asc") );
    }

    /**
     * @param int $id
     * @return Mixed
     * @author Nader Ahmed
     */
    public function getMonthChart(string $type,int $id,$month = 'january')
    {
        $data = $this->model->find($id);
        $arr['points'] = $this->getMonthPoints($type,$month,$data);
        $arr['head'] = $data->motor;
        return $arr;
    }

    /**
     * @param int $id
     * @return Mixed
     * @author Nader Ahmed
     */
    public function getMonthChartForSearch(string $type,int $id,$month = 'january')
    {
        $data = $this->model->find($id);
        $arr['points'] = $this->getMonthPoints($type,$month,$data);
        $arr['head'] = $data->motor;
        return $arr;
    }

    public function getMonthPoints(string $type,$month,$data){
        $moduleData = Session::get('moduleData');
        $request = \request()->all();
        $head = $this->getHead($data->id ,(int)$request['dynamic_head']);

        if(empty($head))
        {
            return;
        }
        $head = $head[0];
        $radiations = $this->getMonthDetails($type,$month,$request['location']);
        $coff = $this->getMonthDetails('coefficient',$month,$request['location']);
        $points = array();
        $key = array_search(true,array_column($moduleData,'selected'));
        $pvg = $moduleData[$key];

        foreach ($radiations as $key => $radiation)
        {
            if ((int)$coff[$key]->timing1)
            {
                $p = (  $radiation->hour * $coff[$key]->hour  * $pvg['pvgen'] * .72 ) / 1000 ;
                $operand =  ( $head->c5 * pow($p , 5 ) ) +
                    ( $head->c4 * pow($p , 4 ) ) +
                    ( $head->c3 * pow($p , 3 ) ) +
                    ( $head->c2 * pow($p , 2 ) ) +
                    ( $head->c1 * $p ) +
                    $head->c0 ;
                $Q = ( $head->head / $request['dynamic_head'] ) *  $operand;
                if($Q < $head->q_min)
                {
                    $Q = 0;
                }
                if ($Q > $head->q_max)
                {
                    $Q = $head->q_max;
                }
                $points[$radiation->timing1][] = round($Q);
            }
        }
        return $this->makeAveragePoint($points);
    }

    /**
     * @param array $points
     */
    public function makeAveragePoint(array $points) {
        $array = array();

        foreach($points as $key => $point){
            $array[$key] = round(array_sum($point) / count($point));
        }

        return $array;
    }

    /**
     * @param $request
     * @return Mixed
     * @author Nader Ahmed
     */
    private function getChartForPDF( $request)
    {
        $id = $request->get('id');
        $data = $this->model->find($id);
        $request = \request()->all();
        $points = array();
        $months = ['january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'];
        foreach ($months as $month)
        {
            $tempPoints[$month] = $this->getMonthPoints($request['mounting_structure'],$month,$data);
        }
        $avg = 0;
        foreach ($tempPoints as $key => $item) {
            $sum = array_sum($item);
            $avg += $sum;
            $points[] = array($key,$sum);
        };
        $points[] = array('avg',round($avg / 12,2));
        $monthPoints = $this->getMonthChart($request['mounting_structure'],$id,'january');

//        $avgMonth = 0;
        foreach ($monthPoints['points'] as $key => $monthPoint){
//            $avgMonth += $monthPoint;
            $arr['month']['points'][] = array($key , $monthPoint);
        }
//        $arr['month']['points'][] = array('avg',round($avgMonth/count($arr['month']['points']),2));
        $arr['points'] = $points;
        $arr['head'] = $data->motor;
        $arr['avg'] = round($avg / 12,2);
        $arr['pvgen_array'] = Session::get('moduleData');

        return $arr;
    }
    /**
     * @param  $request
     * @author Nader Ahmed
     */
    public function generatePDF($request)
    {
        $dataPump = $this->model->find($request->get('id'));
        $data['year'] = json_encode( $this->getChartForPDF($request));
        $months = $request->get('month');
        if (!is_array($months)){
            $months = ['january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'];
        }
        $data['inputs'] = $request->all();
        foreach ($months as $month)
        {
            $selectMonth = $this->getMonthPoints($request->get('mounting_structure'),$month,$dataPump);
            $points = array();
            foreach ($selectMonth as $key=>$item){
                $points[] = array($key,$item);
            }

            $data['months'][$month] = $points;
        }
        $data['months'] = json_encode($data['months']);
        $data['user'] = auth()->user();
        $data['city'] = City::find($request->get('location'));
        $module = $request->get('module');
        $module_info = json_decode($module);

        if (!empty($module_info->id)){

            $module_info = DB::select( DB::raw("SELECT * FROM `modules` where ( id = '" . $module_info->id . "' ) limit 1") )[0];

        }
        $data['module'] = $module_info;
        $array = Cable::select('c_3x1_5', 'c_3x2_5', 'c_3x4', 'c_3x6', 'c_3x10', 'c_3x16', 'c_3x25', 'c_3x35', 'c_3x50', 'c_3x70', 'c_3x95')->where('motor_hp' , '>=' , $dataPump->motor)->first();
        if (empty($array)){
            $array = Cable::select('c_3x1_5', 'c_3x2_5', 'c_3x4', 'c_3x6', 'c_3x10', 'c_3x16', 'c_3x25', 'c_3x35', 'c_3x50', 'c_3x70', 'c_3x95')->orderBy('id', 'desc')->first();
        }
        $array = $array->toArray();
        $needle = array_search($request->get('cable_length'),$array);
        if (empty($needle))
        {
            foreach ($array as $key2=> $value) {

                if ($value > $request->get('cable_length')) {
                    $dataPump->length = str_replace('_','.',trim($key2,'c_'));
                    break;
                } else if(end($array)  == $value AND empty($dataPump->length)) {
                    $dataPump->length = array_key_last($array);
                } else {

                }
            }
        } else {
            $dataPump->length = str_replace('_','.',trim($needle,'c_'));
        }
        $data['model'] = $dataPump;

        return $data;

    }

    private function getModule($request,$moduleId = null){
        $id = $request->get('id');
        if ($moduleId == null){
            $data = $this->model->find($id);
        } else {
            $data = $this->model->find($moduleId);
        }
        $module = $request->get('module');
        $module_info = json_decode($module);
        if (!empty($module_info->id)){
            $module_info = DB::select( DB::raw("SELECT * FROM `modules` where ( id = '" . $module_info->id . "' ) limit 1") )[0];
        } else if(is_integer($module_info)){
            $module_info = DB::select( DB::raw("SELECT * FROM `modules` where ( id = '" . $module_info . "' ) limit 1") )[0];
        } else {
            $req = request()->all();
            if (is_object(json_decode($req['module']))){
                $module_info = json_decode($req['module']);
                $module_info->name = $module_info->module_name;
            } else {
                $module_info = (object) array('name' => $req['module_name'] , 'voc' => $req['voc'] , 'vmpp' => $req['vmpp'] , 'power_max' => $req['power_max']  );
            }
        }
        $pvgen = round($request->get('water_amount') * $request->get('dynamic_head')  / ( ($request->get('mounting_structure') == 'Fixed'?  6.5 : 7.5 )*180.32));
        $ns = round(620 / $module_info->vmpp);
        $np = round(($pvgen * 1000) / ( $module_info->power_max * $ns ));

        $pvgenFinal = $ns * $np * $module_info->power_max / 1000;



        $nsmin = round(575 / $module_info->vmpp);
        $nsmax = round(820 / $module_info->voc);

        $pvgenmin = round(.5 * $data->motor * 1000);
        $pvgenmax = round(1.5 * $data->motor * 1000);

        $npmax = round($pvgenmax / ($nsmin * $module_info->power_max));
        $npmin = round($pvgenmin / ($nsmin * $module_info->power_max));

        $array1 = range($nsmin,$nsmax,1);
        $array2 = range($npmin,$npmax);
        $array3 = array();
        foreach ($array1 as $value1)
        {
            foreach ($array2 as $value2){
                $pvg = $value1 * $value2 * $module_info->power_max / 1000;
                $array3[$value1 * $value2] = array('pvgen' => $pvg,'string' => $pvg .  ' WP  ( ' . $value1 . ' * ' . $value2 . ' ' .  $module_info->name . ' )' , 'selected' => $pvgenFinal == $pvg ? true : false);
            }
        }
        ksort($array3);
        $array = array();
        foreach ($array3 as $arr){
            $array[] = $arr;
        }
        return $array;
    }

    private function getModuleWithBeforeAfter($request){
        $moduleData = Session::get('moduleData');
        $needle = explode(' WP ' ,$request['head'])[0];
        $key = array_search($needle,array_column($moduleData,'pvgen'));
        $moduleData = $this->resetArray($moduleData);
        if ($request['type'] == 'before'){
            $moduleData[$key]['selected'] = false;
            $key--;
            $moduleData[$key]['selected'] = true;
        } else {
            $moduleData[$key]['selected'] = false;
            $key++;
            $moduleData[$key]['selected'] = true;
        }
        return $moduleData;
    }

    private function resetArray($array){

        foreach ($array as $key => $arr)
        {
            $array[$key]['selected'] = false;
        }
        return $array;
    }

    /**
     * @param $pump
     * @param $order
     * @param $media
     * @author Nader Ahmed
     */
    public function saveMedia( $pump,$media,$order){
        DB::table('media_pump')->where('pump_id', $pump->id)->delete();
        foreach ($media as $key => $value){
            DB::table('media_pump')->insert(['pump_id' => $pump->id, 'media_id' => $value, 'order' => $order[$key]]);
        }

        return ;
    }

    /**
     * @param $pump_id
     * @author Nader Ahmed
     */
    public function getMedia($pump_id){
        return DB::select( "Select * from `media_pump` where pump_id = " .$pump_id . " order by media_id asc" );
    }
}

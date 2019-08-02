<?php

namespace Modules\Radiation\Repository\Elequent;

use Illuminate\Support\Facades\DB;
use Modules\Base\Repository\Elequent\BaseElequent;
use Modules\Radiation\Entities\Radiation;
use Modules\Radiation\Repository\Interfaces\RadiationInterface;

class RadiationElequent extends BaseElequent implements RadiationInterface
{
    /**
     * @var
     */
    protected $radiation;

    public function __construct()
    {
        $this->radiation = new Radiation();
        parent::__construct($this->radiation);
    }

    /**
     * @param int $city_id
     * @param string $type
     * @author Nader Ahmed
     * @return Void
     */
    public function saveAverage(int $city_id ,string $type )
    {
        $varRadiation =  DB::select( DB::raw("
        select avg(january) as 'jan', avg(february) as 'feb' , avg(march) as 'march',avg(april) as 'april' ,avg(may) as 'may' ,avg(june) as 'june' ,avg(july) as 'july' ,
        avg(august) as 'august' , avg(september) as 'sept' ,avg(october) as 'oct' ,avg(november) as 'nov',avg(december) as 'dec',avg(avg) as 'avg' 
        from radiations
        WHERE radiations.type = '" . $type . "' AND radiations.city_id = " . $city_id ))[0] ;
        Radiation::create([
            'timing' => 'average',
            'january' => $varRadiation->jan,
            'february' => $varRadiation->feb,
            'march' => $varRadiation->march,
            'april' => $varRadiation->april,
            'may' => $varRadiation->may,
            'june' => $varRadiation->june,
            'july' => $varRadiation->july,
            'august' => $varRadiation->august,
            'september' => $varRadiation->sept,
            'october' => $varRadiation->oct,
            'november' => $varRadiation->nov,
            'december' => $varRadiation->dec,
            'avg' => $varRadiation->avg,
            'city_id' => $city_id,
            'type' => $type
        ]);

        $sumRadiation =  DB::select( DB::raw("
        select sum(january) as 'jan', sum(february) as 'feb' , sum(march) as 'march',sum(april) as 'april' ,sum(may) as 'may' ,sum(june) as 'june' ,sum(july) as 'july' ,
        sum(august) as 'august' , sum(september) as 'sept' ,sum(october) as 'oct' ,sum(november) as 'nov',sum(december) as 'dec',sum(avg) as 'avg' 
        from radiations
        WHERE radiations.type = '" . $type . "' AND radiations.city_id = " . $city_id ))[0] ;

        Radiation::create([
            'timing' => 'total',
            'january' => $sumRadiation->jan / 4000.0,
            'february' => $sumRadiation->feb/ 4000.0,
            'march' => $sumRadiation->march/ 4000.0,
            'april' => $sumRadiation->april/ 4000.0,
            'may' => $sumRadiation->may/ 4000.0,
            'june' => $sumRadiation->june/ 4000.0,
            'july' => $sumRadiation->july/ 4000.0,
            'august' => $sumRadiation->august/ 4000.0,
            'september' => $sumRadiation->sept/ 4000.0,
            'october' => $sumRadiation->oct/ 4000.0,
            'november' => $sumRadiation->nov/ 4000.0,
            'december' => $sumRadiation->dec/ 4000.0,
            'avg' => $sumRadiation->avg/ 4000.0,
            'city_id' => $city_id,
            'type' => $type
        ]);
    }

    /**
     * @param int $city_id
     * @param ,string $type
     * @author Nader Ahmed
     * @return Void
     */
    public function updateAverage(int $city_id ,string $type )
    {
        $varRadiation =  DB::select( DB::raw("
        select avg(january) as 'jan', avg(february) as 'feb' , avg(march) as 'march',avg(april) as 'april' ,avg(may) as 'may' ,avg(june) as 'june' ,avg(july) as 'july' ,
        avg(august) as 'august' , avg(september) as 'sept' ,avg(october) as 'oct' ,avg(november) as 'nov',avg(december) as 'dec',avg(avg) as 'avg'
        from radiations
        WHERE radiations.type = '" . $type . "' AND  radiations.city_id = " . $city_id ))[0];
        Radiation::where('city_id',$city_id)->where('timing' ,'LIKE', 'average' )->where('type' , $type)->first()->update([
            'january' => $varRadiation->jan,
            'february' => $varRadiation->feb,
            'march' => $varRadiation->march,
            'april' => $varRadiation->april,
            'may' => $varRadiation->may,
            'june' => $varRadiation->june,
            'july' => $varRadiation->july,
            'august' => $varRadiation->august,
            'september' => $varRadiation->sept,
            'october' => $varRadiation->oct,
            'november' => $varRadiation->nov,
            'december' => $varRadiation->dec,
            'avg' => $varRadiation->avg,
        ]);

        $sumRadiation =  DB::select( DB::raw("
        select sum(january) as 'jan', sum(february) as 'feb' , sum(march) as 'march',sum(april) as 'april' ,sum(may) as 'may' ,sum(june) as 'june' ,sum(july) as 'july' ,
        sum(august) as 'august' , sum(september) as 'sept' ,sum(october) as 'oct' ,sum(november) as 'nov',sum(december) as 'dec',sum(avg) as 'avg' 
        from radiations
        WHERE radiations.type = '" . $type . "' AND radiations.city_id = " . $city_id ))[0] ;

        Radiation::where(['timing' => 'total' , 'city_id' => $city_id , 'type' => $type ])->first()->update([
            'january' => $sumRadiation->jan / 4000.0,
            'february' => $sumRadiation->feb/ 4000.0,
            'march' => $sumRadiation->march/ 4000.0,
            'april' => $sumRadiation->april/ 4000.0,
            'may' => $sumRadiation->may/ 4000.0,
            'june' => $sumRadiation->june/ 4000.0,
            'july' => $sumRadiation->july/ 4000.0,
            'august' => $sumRadiation->august/ 4000.0,
            'september' => $sumRadiation->sept/ 4000.0,
            'october' => $sumRadiation->oct/ 4000.0,
            'november' => $sumRadiation->nov/ 4000.0,
            'december' => $sumRadiation->dec/ 4000.0,
            'avg' => $sumRadiation->avg/ 4000.0,
        ]);
    }

    /**
     * @param int $city_id
     * @param string $type
     * @auther Nader Ahmed
     * @return Void
     */
    public function deleteAll(int $city_id ,string $type){
        $this->radiation->where(['city_id' => $city_id,'type' => $type])->delete();
    }
}

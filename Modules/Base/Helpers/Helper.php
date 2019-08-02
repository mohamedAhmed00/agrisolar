<?php

if (!function_exists('getHomeCounts')) {
    /**
     * @author Nader Ahmed
     * @return mixed
     */
    function getHomeCounts()
    {
        $data['pumps'] =  app(\Modules\Pumps\Repository\Interfaces\PumpInterface::class)->getCount([]);
        $data['users'] =  app(\Modules\Users\Repository\Interfaces\UserInterface::class)->getCount([]);
        $data['cities'] =  app(\Modules\City\Repository\Interfaces\CityInterface::class)->getCount([]);
        $data['settings'] =  app(\Modules\Setting\Repository\Interfaces\SettingInterface::class)->getCount([]);
        return $data;
    }
}

if (!function_exists('getAdmin')) {
    /**
     * @author Nader Ahmed
     * @return mixed
     */
    function getAdmin()
    {
        return app(\Modules\Users\Repository\Interfaces\UserInterface::class)->getById(auth()->user()->id);
    }
}

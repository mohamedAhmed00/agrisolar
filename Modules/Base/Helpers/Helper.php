<?php

if (!function_exists('getServiceCount')) {
    /**
     * @author Nader Ahmed
     * @return mixed
     */
    function getServiceCount()
    {
        return app(\Modules\Services\Repository\Interfaces\ServiceInterface::class)->getWhere([]);
    }
}

if (!function_exists('getPageCount')) {
    /**
     * @author Nader Ahmed
     * @return mixed
     */
    function getPageCount()
    {
        return app(\Modules\Pages\Repository\Interfaces\PageInterface::class)->getWhere([]);
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

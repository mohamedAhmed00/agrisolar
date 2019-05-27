<?php

if (!function_exists('getSliderItem')) {
    /**
     * @author Nader Ahmed
     * @return mixed
     */
    function getSliderItem()
    {
        return app(\Modules\Slider\Repository\Interfaces\SliderInterface::class)->getWhere(['status'=>'1']);
    }
}

if (!function_exists('getPage')) {
    /**
     * @param string $key
     * @author Nader Ahmed
     * @return mixed
     */
    function getPage(string $key)
    {
        return app(\Modules\Pages\Repository\Interfaces\PageInterface::class)->getWhere(['key'=>$key])->first();
    }
}

if (!function_exists('getTeam')) {
    /**
     * @author Nader Ahmed
     * @return mixed
     */
    function getTeam()
    {
        return app(\Modules\Team\Repository\Interfaces\TeamInterface::class)->getWhere(['status'=>'1']);
    }
}

if (!function_exists('getServices')) {
    /**
     * @author Nader Ahmed
     * @return mixed
     */
    function getServices()
    {
        return app(\Modules\Services\Repository\Interfaces\ServiceInterface::class)->getWhere(['status'=>'1']);
    }
}

if (!function_exists('getSetting')) {
    /**
     * @author Nader Ahmed
     * @return mixed
     */
    function getSetting()
    {
        $settings = app(\Modules\Setting\Repository\Interfaces\SettingInterface::class)->getWhere([]);
        $settingArray = [];
        foreach($settings as $setting)
        {
            $settingArray[$setting->key] = $setting;
        }
        return $settingArray;
    }
}

if (!function_exists('getTestimonial')) {
    /**
     * @author Nader Ahmed
     * @return mixed
     */
    function getTestimonial()
    {
        return app(\Modules\Testimonials\Repository\Interfaces\TestimonialInterface::class)->getWhere(['status'=>'1']);
    }
}

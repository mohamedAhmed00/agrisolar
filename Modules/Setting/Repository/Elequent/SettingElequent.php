<?php

namespace Modules\Setting\Repository\Elequent;

use Modules\Base\Repository\Elequent\BaseElequent;
use Modules\Setting\Entities\Setting;
use Modules\Setting\Repository\Interfaces\SettingInterface;

class SettingElequent extends BaseElequent implements SettingInterface
{
    /**
     * @var
     */
    protected $setting;

    public function __construct()
    {
        $this->setting = new Setting();
        parent::__construct($this->setting);
    }
}

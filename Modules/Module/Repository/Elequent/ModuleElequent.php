<?php

namespace Modules\Module\Repository\Elequent;

use Modules\Base\Repository\Elequent\BaseElequent;
use Modules\Module\Entities\Module;
use Modules\Module\Repository\Interfaces\ModuleInterface;

class ModuleElequent extends BaseElequent implements ModuleInterface
{
    /**
     * @var
     */
    protected $module;

    public function __construct()
    {
        $this->module = new Module();
        parent::__construct($this->module);
    }
}


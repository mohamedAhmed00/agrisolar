<?php

namespace Modules\Media\Repository\Elequent;

use Modules\Base\Repository\Elequent\BaseElequent;
use Modules\Media\Entities\Media;
use Modules\Media\Repository\Interfaces\MediaInterface;

class MediaElequent extends BaseElequent implements MediaInterface
{
    /**
     * @var
     */
    protected $module;

    public function __construct()
    {
        $this->module = new Media();
        parent::__construct($this->module);
    }
}


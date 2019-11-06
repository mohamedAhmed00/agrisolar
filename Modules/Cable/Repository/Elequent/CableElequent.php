<?php

namespace Modules\Cable\Repository\Elequent;

use Modules\Base\Repository\Elequent\BaseElequent;
use Modules\Cable\Entities\Cable;
use Modules\Cable\Repository\Interfaces\CableInterface;

class CableElequent extends BaseElequent implements CableInterface
{
    /**
     * @var
     */
    protected $cable;

    public function __construct()
    {
        $this->cable = new Cable();
        parent::__construct($this->cable);
    }
}


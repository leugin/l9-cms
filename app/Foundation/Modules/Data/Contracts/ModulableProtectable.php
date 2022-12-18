<?php

namespace App\Foundation\Modules\Data\Contracts;

use App\Data\Contracts\Protectable;

/**
 *
 */
interface ModulableProtectable extends Modulable
{

    /**
     * @return Protectable[]
     */
    public function getPermissions():array;

}

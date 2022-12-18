<?php

namespace App\Foundation\Modules\Data\Contracts;

use App\Foundation\Modules\Data\Factory\Action;

/**
 *
 */
interface ModulableMenu extends Modulable
{

    /**
     * @return Action[]
     */
    public function getMenuActions():array;

}

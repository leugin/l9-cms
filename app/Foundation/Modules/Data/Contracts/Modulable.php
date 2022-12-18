<?php

namespace App\Foundation\Modules\Data\Contracts;

interface Modulable
{
    /**
     * @return string
     */
    public function getModuleName():string;

    public function getModuleKey():string;

}

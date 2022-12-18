<?php

namespace App\Foundation\Modules\Data\Collections;

use App\Foundation\Modules\Data\Contracts\Modulable;
use Illuminate\Support\Collection;

class ModuleCollection extends Collection
{
    public function withInterface(string $interface):Collection
    {
        return  $this->filter(fn(Modulable $modulable) =>  $modulable instanceof  $interface);
    }
}

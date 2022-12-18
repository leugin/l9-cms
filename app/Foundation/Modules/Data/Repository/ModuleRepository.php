<?php

namespace App\Foundation\Modules\Data\Repository;

use App\Foundation\Modules\Data\Contracts\Modulable;
use App\Foundation\Modules\Data\Dto\Module;
use App\Foundation\Modules\Data\Dto\SearchModule;
use App\Models\Admin;

/**
 *
 */
interface ModuleRepository
{

    /**
     * @return Modulable[]
     */
    public function all():array;
    public function store(Modulable $modulable):bool;
    public function findOne(SearchModule $search):?Modulable;
    public function clear():bool;

}

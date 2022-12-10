<?php

namespace App\Foundation\Modules\Data\Repository;

use App\Foundation\Modules\Data\Dto\Module;
use App\Models\Admin;

/**
 *
 */
interface ModuleRepository
{

    /**
     * @return Module[]
     */
    public function all():array;
    /**
     * @return Module[]
     */
    public function findByUser(Admin $admin):array;
}

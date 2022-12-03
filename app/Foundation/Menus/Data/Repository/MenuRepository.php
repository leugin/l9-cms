<?php

namespace App\Foundation\Menus\Data\Repository;

use App\Foundation\Menus\Data\Dto\Menu;
use App\Models\Admin;

/**
 *
 */
interface MenuRepository
{

    /**
     * @return Menu[]
     */
    public function all():array;
    /**
     * @return Menu[]
     */
    public function findByUser(Admin $admin):array;
}

<?php

namespace App\Data\Models;

use App\Data\Dto\Page;
use App\Data\Dto\TableAction;

class Admin
{
    const KEY = 'admins';
    public static function management():Page {
        return  new Page(
            'management.admins.datatable',
            __('Gestion de administradores'),
        );
    }

}

<?php

namespace App\Foundation\Modules\Data\Factory;

use App\Data\Contracts\Protectable;
use Stringable;

/**
 *
 */
enum ProtectableCategory:string
{
    case REDIRECT = 'redirect';
    case EDIT = 'edit';
    case LOAD = 'load';
    case STORE = 'store';

    case DELETE = 'delete';
}

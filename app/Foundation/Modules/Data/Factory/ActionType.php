<?php

namespace App\Foundation\Modules\Data\Factory;

use App\Data\Contracts\Protectable;
use Stringable;

/**
 *
 */
enum ActionType:string
{
    case REDIRECT = 'redirect';
}

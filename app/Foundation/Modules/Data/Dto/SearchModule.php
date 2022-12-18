<?php

namespace App\Foundation\Modules\Data\Dto;

use Illuminate\Support\Str;

class SearchModule
{

    public function __construct(
        public ?string $moduleKey = null
    )
    {
    }

}

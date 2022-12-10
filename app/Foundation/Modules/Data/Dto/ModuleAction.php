<?php

namespace App\Foundation\Modules\Data\Dto;

use App\Foundation\Modules\Data\Factory\Action;

class ModuleAction implements \JsonSerializable
{
    public function __construct(
        public readonly Module $menu,
         public string         $label,
        public string          $slug,
        public ?Action         $action =  null,

    )
    {
    }

    public function jsonSerialize(): array
    {
        return  [
            'label'=>$this->label,
            'action'=>$this->action,

        ];
    }
}

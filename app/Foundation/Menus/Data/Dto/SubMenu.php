<?php

namespace App\Foundation\Menus\Data\Dto;

use App\Foundation\Menus\Data\Factory\Action;

class SubMenu implements \JsonSerializable
{
    public function __construct(
        public readonly Menu $menu,
         public string $label,
        public string $slug,
        public ?Action $action =  null,

    )
    {
    }

    public function getSlugPermission(): string {
        return $this->menu->getSlugPermission().'-'.$this->slug;
    }
    public function jsonSerialize(): array
    {
        return  [
            'slug'=>$this->getSlugPermission(),
            'label'=>$this->label,
            'action'=>$this->action,

        ];
    }
}

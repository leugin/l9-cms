<?php

namespace App\Foundation\Menus\Data\Dto;

use App\Foundation\Menus\Data\Factory\Action;
use App\Foundation\Menus\Traits\ArrayAccess;

/**
 *
 */
class Menu implements \JsonSerializable, \ArrayAccess
{
    use ArrayAccess;

    /**
     * @param string $label
     * @param string $slugName
     * @param SubMenu[] $actions
     */
    public function __construct(
        public readonly string $label,
        public readonly string $slugName,
        public  array $actions = []
    )
    {}

    public function getSlugPermission():string
    {
        return  "list {$this->slugName}";
    }

    public function addSubMenu(string $label, string $slug, ?Action $action = null):self
    {
        $this->actions[] = new SubMenu($this, $label, $slug,  $action);
        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
       return [
           'label'=>$this->label,
           'slug_name'=>$this->slugName,
           'actions'=>$this->actions
       ];
    }

    public static function make(string $label, string $slugName): self
    {
        return new self($label, $slugName);
    }
}

<?php

namespace App\Foundation\Modules\Data\Dto;

use App\Data\Contracts\Protectable;
use App\Data\Dto\Page;
use App\Data\Dto\TableAction;
use App\Foundation\Modules\Data\Factory\Action;
use App\Foundation\Modules\Traits\ArrayAccess;

/**
 *
 */
class Module implements \JsonSerializable, \ArrayAccess
{
    use ArrayAccess;

    /**
     * @param string $label
     * @param string $slugName
     * @param Protectable[] $permissions
     * @param Action[] $menus
     */
    public function __construct(
        public readonly string $label,
        public readonly string $slugName,
        public readonly array $permissions = [],
        public readonly array $menus = [],
     )
    {}


    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
       return [
           'label'=>$this->label,
           'slug_name'=>$this->slugName,
        ];
    }

    /**
     * @param string $label
     * @param string $slugName
     * @return static
     */
    public static function make(string $label, string $slugName): self
    {
        return new self($label, $slugName);
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return  $this->label;
    }

    /**
     * @return null|Action[]
     */
    public function getMenuActions() :?array {
        return  $this->menus;
    }

    public function getPermission(): array {
        return  array_merge($this->menus, $this->permissions);
    }
}

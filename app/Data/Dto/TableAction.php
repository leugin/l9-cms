<?php

namespace App\Data\Dto;


use App\Data\Contracts\Protectable;


class TableAction implements Protectable
{
    const LOAD   = 'list';

    const CREATE = 'create';
    const EDIT = 'edit';

    const DELETE = 'delete';
    private function __construct(
        public string $type,
        public string $route,
     )
    {
    }

    public static function create(string $route):self {
        return  new self(self::CREATE, $route);
    }
    public static function load( string $route):self {
        return  new self(self::LOAD, $route);
    }
    public static function edit(string $route):self {
        return  new self(self::EDIT, $route);
    }

    public static function delete(string $route):self {
        return  new self(self::DELETE, $route);
    }

    public function getLabel(): string
    {
        return  __($this->type);
    }

    public function getSlugPermission(): string
    {
        return str_replace('.','-',$this->route);
    }

}

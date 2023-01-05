<?php

namespace App\Foundation\DataViewer\Dto;


class DataViewerAction
{
    final const LOAD   = 'list';
    final const CREATE = 'create';
    final const EDIT = 'edit';
    final  const DELETE = 'delete';
    private function __construct(
        public string $type,
        public string $route,
     )
    {
    }

    public static function create(string $route):self {
        return  new static(self::CREATE, $route);
    }
    public static function load( string $route):self {
        return  new static(self::LOAD, $route);
    }
    public static function edit(string $route):self {
        return  new static(self::EDIT, $route);
    }

    public static function delete(string $route):self {
        return  new static(self::DELETE, $route);
    }
}

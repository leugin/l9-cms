<?php

namespace App\Foundation\DataViewer\Dto;


class DataViewerAction
{
    const LOAD   = 'list';
    const CREATE = 'create';
    const EDIT = 'edit';
    const DELETE = 'delete';
    private function __construct(
        string $type,
        string $route
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
}

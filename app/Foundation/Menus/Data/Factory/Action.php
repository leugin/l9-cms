<?php

namespace App\Foundation\Menus\Data\Factory;

/**
 *
 */
class Action
{
    /**
     *
     */
    const URL = 'url';
    /**
     *
     */
    const CUSTOM = 'custom';

    /**
     * @param string $type
     * @param array $options
     */
    private function __construct(
        public readonly  string $type,
        public readonly  array $options = []
    ) {
    }

    /**
     * @param string $url
     * @return static
     */
    public static function url(string $url):self {
        return new  self(self::URL, [
            'url'=>$url
        ]);
    }

    /**
     * @param string $id
     * @param array $attributes
     * @return static
     */
    public static function custom(string $id, array $attributes = []):self {
        return new  self(self::CUSTOM, array_merge([
            'id'=>$id
        ], $attributes));
    }
}

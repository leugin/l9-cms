<?php

namespace App\Foundation\DataViewer\Dto;

use Illuminate\Support\Str;

/**
 *
 */
class Search
{



    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key):bool
    {
        return isset($this->{$key});
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key):mixed {
        return  !$this->has($key) ? null :  $this->{$key};
    }

    /**
     * @param array $attributes
     * @return static
     */
    public static function make(array $attributes = []): static
    {
        $instance = new static();
        foreach ($attributes as $k => $value) {
            $camelKey = Str::camel($k);
            if (property_exists($instance, $camelKey)) {
                $instance->{$camelKey} = $value;
            }
        }
        return  $instance;
    }
}

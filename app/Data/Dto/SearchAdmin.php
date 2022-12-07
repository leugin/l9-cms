<?php

namespace App\Data\Dto;

use Illuminate\Support\Str;

class SearchAdmin
{

    public function __construct(
        public string|null $search = null,
        public int|null $id = null,
        public int|null $excludeId = null,
        public int|null $perPage = 10,
    )
    {
    }

    public function has(string $key):bool
    {
        return isset($this->{$key});
    }

    public function get(string $key):mixed {
        return  !$this->has($key) ? null :  $this->{$key};
    }

    public static function make($attributes = []):self {
        $instance = new self();
        foreach ($attributes as $k => $value) {
            $camelKey = Str::camel($k);
            if (property_exists($instance, $camelKey)) {
                $instance->{$camelKey} = $value;
            }
        }
        return  $instance;
    }
}

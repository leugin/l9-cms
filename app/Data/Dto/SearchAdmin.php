<?php

namespace App\Data\Dto;

use Illuminate\Support\Str;

/**
 *
 */
class SearchAdmin
{

    /**
     * @param string|null $search
     * @param int|null $id
     * @param int|null $excludeId
     * @param int|null $perPage
     */
    public function __construct(
        public string|null $search = null,
        public int|null $id = null,
        public int|null $excludeId = null,
        public int|null $perPage = 10,
    )
    {
    }

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
    public static function make(array $attributes = []):self {
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

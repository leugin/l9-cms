<?php

namespace App\Foundation\Menus\Traits;

/**
 *
 */
trait ArrayAccess
{
    /**
     * @return array|null
     */
    public  function __toArray(): ?array
    {
        if ( method_exists($this,'jsonSerialize') && is_array($this->jsonSerialize()))
        {
            return $this->jsonSerialize();
        }
        if ( method_exists($this,'toArray') && is_array($this->toArray()))
        {
            return $this->toArray();
        }
        return  [];
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists(mixed $offset): bool
    {
        return array_key_exists($offset, $this->__toArray());
    }

    /**
     * @param mixed $offset
     * @return array
     */
    public function offsetGet(mixed $offset): array
    {
        return $this->__toArray()[$offset];
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     * @return void
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->{$offset} = $value;
    }

    /**
     * @param mixed $offset
     * @return void
     */
    public function offsetUnset(mixed $offset): void
    {
        unset($this->{$offset});
    }
}

<?php

namespace App\Data\Value;

class Password implements \Stringable
{

    public function __construct(
        public string $value
    )
    {
    }

    public function __toString()
    {
        return $this->value;
    }
}

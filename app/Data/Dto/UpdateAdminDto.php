<?php

namespace App\Data\Dto;

use App\Data\Helpers\ReflectionArrayAccess;
use Illuminate\Contracts\Support\Arrayable;

/**
 *
 */
class UpdateAdminDto implements Arrayable
{
    use ReflectionArrayAccess;

    /**
     * @param string $name
     * @param string $email
     * @param string|null $password
     */
    public function __construct(
        public string $name,
        public string $email,
        public ?string $password = null
    )
    {
    }

    /**
     * @param array $params
     * @return static
     */
    public static function makeByArray(array $params ):self
    {
        return  new self(
            $params['name'],
            $params['email'],
            $params['password'] ?? null
        );
    }

}

<?php

namespace App\Data\Dto;

/**
 *
 */
class CreateAdminDto
{

    /**
     * @param string $name
     * @param string $email
     * @param string $password
     */
    private function __construct(
        public string $name,
        public string $email,
        public string $password
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
            $params['password']
        );
    }
}

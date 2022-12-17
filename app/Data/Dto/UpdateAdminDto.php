<?php

namespace App\Data\Dto;

use Illuminate\Contracts\Support\Arrayable;

/**
 *
 */
class UpdateAdminDto implements Arrayable
{

    /**
     * @param string $name
     * @param string $email
     * @param string|null $password
     */
    private function __construct(
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

    public function toArray()
    {
        return [
            'name'=>$this->name,
            'email'=>$this->email,
            'password'=>$this->password
        ];
    }
}
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
    private string  $name;
    private string  $email;
    private ?string  $password;

    /**
     * @param string $name
     * @param string $email
     * @param string|null $password
     */
    public function __construct(
          string $name,
          string $email,
         ?string $password = null
    )
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
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

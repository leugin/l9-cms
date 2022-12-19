<?php
declare(strict_types=1);
namespace App\Data\Dto;

use App\Data\Helpers\ReflectionArrayAccess;
use Illuminate\Contracts\Support\Arrayable;

/**
 *
 */
class CreateAdminDto implements Arrayable
{
    use ReflectionArrayAccess;


    /**
     * @param string $name
     * @param string $email
     * @param string $password
     */
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly  string $password
    )
    {

    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }



    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
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

<?php

namespace App\Operations;

use App\Foundation\Menus\Data\Repository\MenuRepository;
use App\Models\Admin;
use Lucid\Units\Operation;

class GetMenusOperation extends Operation
{
    private $user;

    /**
     * @param Admin|null $user
     */
    public function __construct(?Admin $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the operation.
     *
     * @return array
     */
    public function handle(MenuRepository $repository): array
    {
        return  $this->user ? $repository->findByUser($this->user) : [];
    }
}

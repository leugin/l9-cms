<?php

namespace App\Services\Management\Operations;

use App\Domains\Permission\Jobs\CreateOrFirstPermissionJob;
use App\Foundation\Menus\Data\Repository\MenuRepository;
use App\Models\Admin;
use Lucid\Units\Operation;

class SetPermissionToAdminOperation extends Operation
{
    /**
     * Create a new operation instance.
     *
     * @return void
     */
    public function __construct(
        private readonly string $email,
        private readonly string $guard = 'admin',
        private readonly bool $all = false
    )
    {
        //
    }

    /**
     * Execute the operation.
     *
     * @param MenuRepository $repository
     * @return void
     */
    public function handle(MenuRepository $repository):bool
    {
        $menus = $repository->all();

        /**@var Admin $admin**/
        $admin = Admin::query()->where([
            'email'=>$this->email
        ])->firstOrFail();

        if ($this->all) {
             foreach ($menus as $menu) {
                 $this->run(CreateOrFirstPermissionJob::class, [
                    'name'=>$menu->getSlugPermission(),
                    'guard'=>$this->guard
                ]);
                $admin->givePermissionTo($menu->getSlugPermission());
                foreach ($menu->actions as $action) {

                    $this->run(CreateOrFirstPermissionJob::class, [
                        'name'=>$action->getSlugPermission(),
                        'guard'=>$this->guard
                    ]);
                    $admin->givePermissionTo($action->getSlugPermission());
                }
            }
        }
        return true;
    }
}

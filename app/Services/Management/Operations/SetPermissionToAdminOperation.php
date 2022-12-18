<?php

namespace App\Services\Management\Operations;

use App\Data\Dto\Page;
use App\Data\Dto\TableAction;
use App\Domains\Permission\Jobs\CreateOrFirstPermissionJob;
use App\Foundation\Modules\Data\Contracts\ModulableProtectable;
use App\Foundation\Modules\Data\Repository\ModuleRepository;
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
        private readonly ?bool $all = false
    )
    {
        //
    }

    /**
     * Execute the operation.
     *
     * @param ModuleRepository $repository
     * @return void
     */
    public function handle(ModuleRepository $repository):bool
    {
        $menus = $repository->all();

        /**@var Admin $admin**/
        $admin = Admin::query()->where([
            'email'=>$this->email
        ])->firstOrFail();

        if ($this->all) {
             foreach ($menus as $menu) {

                 if ($menu instanceof ModulableProtectable) {
                     foreach ($menu->getPermissions() as $action) {

                         $this->run(CreateOrFirstPermissionJob::class, [
                             'name'=>$action->getSlugPermission(),
                             'guard'=>$this->guard
                         ]);
                         $admin->givePermissionTo($action->getSlugPermission());
                     }
                 }

            }
        }
        return true;
    }
}

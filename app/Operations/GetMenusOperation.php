<?php

namespace App\Operations;

use App\Foundation\Modules\Data\Contracts\ModulableMenu;
use App\Foundation\Modules\Data\Factory\ProtectableCategory;
use App\Foundation\Modules\Data\Repository\ModuleRepository;
use App\Models\Admin;
use Lucid\Units\Operation;

class GetMenusOperation extends Operation
{

    /**
     * @param Admin $user
     */
    public function __construct(private readonly ?Admin $user)
    {

    }

    /**
     * Execute the operation.
     *
     * @param ModuleRepository $repository
     * @return array
     */
    public function handle(ModuleRepository $repository): array
    {
        $menus = [];

        if ($this->user) {
            $all = $repository->all();
            foreach ($all as $module) {
                if ($module instanceof ModulableMenu) {
                    $available = [];
                    foreach ($module->getMenuActions() as $action) {
                        info("checl {$module->getModuleKey()} permission=> {$action->getSlugPermission()}");
                        if ($this->user->can($action->getSlugPermission())) {
                            $available[] = $action;
                        }
                    }
                    if (sizeof($available) > 0) {
                        $menus[] =  [
                            'label'=>$module->getModuleName(),
                            'actions'=>$available
                        ];
                    }
                }

            }
        }
        return $menus;
    }
}

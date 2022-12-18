<?php

namespace App\Services\Management\Modules;

use App\Data\Dto\ProtectableDataViewerAction;
use App\Foundation\DataViewer\Dto\DataViewerAction;
use App\Foundation\Modules\Data\Contracts\ModulableMenu;
use App\Foundation\Modules\Data\Contracts\ModulableProtectable;
use App\Foundation\Modules\Data\Factory\Action;

class AdminModule implements  ModulableMenu, ModulableProtectable
{
    const KEY = 'admin';

    public function getModuleKey():string
    {
        return  self::KEY;
    }
    public function getModuleName():string
    {
        return  "Admin";
    }

    public function getMenuActions(): array {
        return [
            Action::redirect('management.admins.index', "List"),
            Action::redirect('management.admins.create', "Crear")
        ];
    }

    private function getTableActions(): array {
        return [
            ProtectableDataViewerAction::load('management-admins-datatable'),
            ProtectableDataViewerAction::create('management-admins-store'),
            ProtectableDataViewerAction::edit('management-admins-update'),
            ProtectableDataViewerAction::delete('management-admins-delete')
        ];
    }

    public function getPermissions(): array {
        return  array_merge(
            self::getMenuActions(),
            self::getTableActions()
        );
    }

}

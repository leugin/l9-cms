<?php

namespace App\Data\Repository;

use App\Data\Dto\TableAction;
use App\Foundation\Modules\Data\Dto\ModuleAction;
use App\Foundation\Modules\Data\Dto\Module;
use App\Foundation\Modules\Data\Factory\Action;
use App\Foundation\Modules\Data\Repository\ModuleRepository;
use App\Models\Admin;

class EloquentModuleRepository implements ModuleRepository
{

    public function findByUser(Admin $admin): array
    {
        return  [];
    }

    public function all(): array
    {

        return [
            new Module(
                'Admin',
                'admin',
                [
                    TableAction::create('management-admins-edit'),
                    TableAction::load('management-admins-datatable'),
                    TableAction::create('management-admins-store'),
                    TableAction::create('management-admins-update')
                ],
                [
                    Action::redirect('management.admins.index', "List"),
                    Action::redirect('management.admins.create', "Crear")
                ]
            )
        ];
    }
}

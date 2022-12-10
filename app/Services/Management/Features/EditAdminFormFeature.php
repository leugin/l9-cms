<?php

namespace App\Services\Management\Features;

use App\Data\Dto\Page;
use App\Data\Dto\TableAction;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;
use Lucid\Units\Feature;

class EditAdminFormFeature extends Feature
{
    /**
     * @param Admin $admin
     * @return Response
     */
    public function handle(Admin $admin): Response
    {
        return Inertia::render('Management/Sections/Admin/Form', [
            'api'=>route('management.admins.datatable'),
            'title'=>__('Edicion de administradores'),
            'model'=>$admin
        ]);
    }

}

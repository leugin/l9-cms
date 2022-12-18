<?php

namespace App\Services\Management\Features;

use App\Models\Admin;
use Inertia\Inertia;
use Inertia\Response;
use Lucid\Units\Feature;

class CreateAdminFormFeature extends Feature
{
    /**
     * @param Admin $admin
     * @return Response
     */
    public function handle(Admin $admin): Response
    {
        return Inertia::render('Management/Sections/Admin/Form', [
            'api'=>route('management.admins.datatable'),
            'title'=>__('Creacion de administradores'),
            'model'=>$admin
        ]);
    }

}

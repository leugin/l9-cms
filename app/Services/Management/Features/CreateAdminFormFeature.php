<?php

namespace App\Services\Management\Features;

use App\Models\Admin;
use Inertia\Inertia;
use Inertia\Response;
use Lucid\Units\Feature;

class CreateAdminFormFeature extends Feature
{
    /**
     * @return Response
     */
    public function handle(): Response
    {
        return Inertia::render('Management/Sections/Admin/AdminForm', [
            'api'=>route('management.admins.datatable'),
            'title'=>__('Creacion de administradores'),
        ]);
    }

}

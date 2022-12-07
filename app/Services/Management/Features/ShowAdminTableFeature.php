<?php

namespace App\Services\Management\Features;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;
use Lucid\Units\Feature;

class ShowAdminTableFeature extends Feature
{
    /**
     * @return Response
     */
    public function handle(): Response
    {
        return Inertia::render('Management/Sections/Admin/Index', [
            'api'=>route('management.admins.datatable'),
            'title'=>__('Gestion de administradores')
        ]);
    }
}

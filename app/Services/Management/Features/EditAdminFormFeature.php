<?php

namespace App\Services\Management\Features;

use App\Data\Dto\Page;
use App\Data\Dto\TableAction;
use App\Models\Admin;
use App\Models\User;
use App\Services\Management\Http\Resources\AdminResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;
use Lucid\Units\Feature;

class EditAdminFormFeature extends Feature
{


    /**
     * @param Admin $admin
     */
    public function __construct(private readonly Admin $admin)
    {
    }

    /**
     * @return Response
     */
    public function handle(): Response
    {
        return Inertia::render('Management/Sections/Admin/Form', [
            'title'=>__('Edicion de administradores'),
            'model'=>$this->admin
        ]);
    }

}

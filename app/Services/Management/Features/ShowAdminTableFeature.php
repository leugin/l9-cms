<?php

namespace App\Services\Management\Features;

use App\Data\Dto\Page;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Lucid\Units\Feature;

class ShowAdminTableFeature extends Feature
{
    /**
     * @param Request $request
     * @return Response
     */
    public function handle(Request $request): Response
    {
        $params = $this->getPage();

        return Inertia::render('Management/Sections/Admin/Index', [
            'route'=>$params->route,
            'title'=>$params->title
        ]);
    }

    public function getPage(): Page {
        return  \App\Data\Models\Admin::management();
    }
}

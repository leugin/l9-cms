<?php

namespace App\Services\Management\Features;

use App\Data\Dto\Page;
use App\Data\Dto\TableAction;
use App\Domains\Admin\Requests\StoreAdminRequest;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;
use Lucid\Units\Feature;

class StoreAdminFeature extends Feature
{
    /**
     * @param StoreAdminRequest $request
     * @return RedirectResponse
     */
    public function handle(StoreAdminRequest $request): RedirectResponse
    {
        /**@var Admin $admin*/
        $admin = Admin::query()->create($request->toArray());
        return  redirect()->route('management.admins.edit', [$admin->id])->with('message', 'save');
    }

}

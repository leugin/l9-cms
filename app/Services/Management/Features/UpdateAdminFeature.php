<?php

namespace App\Services\Management\Features;

use App\Data\Dto\Page;
use App\Data\Dto\TableAction;
use App\Data\Dto\UpdateAdminDto;
use App\Domains\Admin\Jobs\UpdateAdminJob;
use App\Domains\Admin\Requests\StoreAdminRequest;
use App\Domains\Admin\Requests\UpdateAdminRequest;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;
use Lucid\Units\Feature;

class UpdateAdminFeature extends Feature
{
    private Admin $admin;

    /**
     * @param Admin $admin
     */
    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    /**
     * @param UpdateAdminRequest $request
     * @return RedirectResponse
     */
    public function handle(UpdateAdminRequest $request): RedirectResponse
    {

        $this->run(UpdateAdminJob::class, [
            'id'=>$this->admin->id,
            'updateAdminDto'=> new UpdateAdminDto(
                name: $request->get('name'),
                email: $request->get('email'),
            )
        ]);
        /**@var Admin $admin*/
        return  redirect()->route('management.admins.edit', [$this->admin->id])->with('message', 'save');
    }

}

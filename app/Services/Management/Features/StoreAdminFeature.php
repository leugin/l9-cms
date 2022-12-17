<?php

namespace App\Services\Management\Features;

use App\Data\Dto\CreateAdminDto;
use App\Data\Dto\Page;
use App\Data\Dto\TableAction;
use App\Domains\Admin\Jobs\CreateAdminJob;
use App\Domains\Admin\Requests\StoreAdminRequest;
use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
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

        $admin =  $this->run(CreateAdminJob::class, [
            'createAdminDto'=>CreateAdminDto::makeByArray($request->validated())
        ]);
        return  redirect()->route('management.admins.edit', [$admin->id])->with('message', 'save');
    }

}

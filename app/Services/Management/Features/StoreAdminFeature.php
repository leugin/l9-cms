<?php

namespace App\Services\Management\Features;

use App\Data\Dto\CreateAdminDto;
use App\Domains\Admin\Jobs\StoreAdminJob;
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

        $admin =  $this->run(StoreAdminJob::class, [
            'createAdminDto'=>CreateAdminDto::makeByArray($request->validated())
        ]);
        return  redirect()->route('management.admins.edit', [$admin->id])->with('message', 'save');
    }

}

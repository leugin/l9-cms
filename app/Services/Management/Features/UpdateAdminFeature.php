<?php

namespace App\Services\Management\Features;

use App\Data\Dto\UpdateAdminDto;
use App\Domains\Admin\Jobs\UpdateAdminJob;
use App\Domains\Admin\Requests\UpdateAdminRequest;
use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
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
            'updateAdminDto'=> new UpdateAdminDto(  $request->get('name'), $request->get('email'))
        ]);
        /**@var Admin $admin*/
        return  redirect()->route('management.admins.edit', [$this->admin->id])->with('message', 'save');
    }

}
